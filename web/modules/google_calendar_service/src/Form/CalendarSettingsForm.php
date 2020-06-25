<?php

namespace Drupal\google_calendar_service\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityFieldManager;
use Drupal\Core\Config\ConfigFactoryInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\File\FileSystemInterface;
use Drupal\Core\Url;

/**
 * Class CalendarSettingsForm.
 *
 * @ingroup google_calendar_service
 */
class CalendarSettingsForm extends ConfigFormBase {

  /**
   * The field manager.
   *
   * @var \Drupal\Core\Entity\EntityFieldManager
   */
  protected $fieldManager;

  /**
   * The messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * The file_system.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  protected $fileSystem;

  /**
   * Constructs a UserPasswordForm object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\Entity\EntityFieldManager $fieldManager
   *   The core entity type manager.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The core entity type manager.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger.
   * @param \Drupal\Core\File\FileSystemInterface $file_system
   *   The file_system.
   */
  public function __construct(
    ConfigFactoryInterface $config_factory,
    EntityFieldManager $fieldManager,
    EntityTypeManagerInterface $entity_type_manager,
    MessengerInterface $messenger,
    FileSystemInterface $file_system) {

    parent::__construct($config_factory);
    $this->fieldManager = $fieldManager;
    $this->entityManager = $entity_type_manager;
    $this->messenger = $messenger;
    $this->fileSystem = $file_system;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('entity_field.manager'),
      $container->get('entity_type.manager'),
      $container->get('messenger'),
      $container->get('file_system')
    );
  }

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'gcs_calendar_settings';
  }

  /**
   * Defines the settings form for Test entities.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return array
   *   Form definition array.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('google_calendar_service.default');

    $form['setup_steps_info'] = [
      '#type' => 'fieldset',
      '#title' => $this->t('Secret Client File Steps to obtain.'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
    ];

    $form['setup_steps_info']['setup_steps'] = [
      '#markup' => $this->t(
      '<ol>
      <li>
      Go to <a href="https://console.developers.google.com/projectcreate"
      target="_blank">Google add project page</a> and create your project.
      </li>
      <li>Navigate to Google Api\'s list and enable "Google Calendar API".</li>
      <li>Create credentials for your APi, using the hint from the enabled
      Google Calendar API page or
      <a href="https://console.developers.google.com/apis/credentials"
      target="_blank">Add them here</a>
      </li>
      <li>Create "OAuth client ID".</li>
      <li>Download Your Secret Client JSON and upload it on the below form.</li>
      <li>Add the Google Email used Google Calendar API from the above steps.</li>
      </ol>'
      ),
      '#allowed_tags' => ['div', 'ul', 'ol', 'li'],
    ];

    if ($file_uri = $config->get('secret_file_uri')) {
      $file_url = Url::fromUserInput(
        file_url_transform_relative(file_create_url($file_uri))
      );

      $form['fieldset_info'] = [
        '#type' => 'fieldset',
        '#title' => $this->t('Secret Client File'),
      ];
      $form['fieldset_info']['file_uri_link_description'] = [
        '#markup' => $this->t('Your secret client key is setup. <br />'),
        '#allowed_tags' => ['div'],
      ];

      $form['fieldset_info']['file_uri_link'] = [
        '#title' => $this->t('Secret Client File'),
        '#type' => 'link',
        '#url' => $file_url,
      ];

      $form['fieldset_info']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Remove File'),
        '#submit' => [[$this, 'removeSecretClientFile']],
        '#limit_validation_errors' => [],
      ];
    }
    else {
      $form['client_secret'] = [
        '#type' => 'managed_file',
        '#title' => $this->t('Client Secret File'),
        '#upload_location' => 'public://google-calendar-service/',
        '#default_value' => "",
        '#description' => $this->t(
          'Client Secret JSON file downloaded from Google Calendar.'
        ),
        '#upload_validators' => [
          'file_validate_extensions' => ['json'],
        ],
      ];
    }

    $form['google_user_email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Google User Email'),
      '#default_value' => $config->get('google_user_email'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('google_calendar_service.default');

    // Check of file has been uploaded corectly and set it permanently.
    $file = $this->entityManager->getStorage('file')->load(
      reset($form_state->getValue('client_secret'))
    );

    if ($file) {
      $file->setPermanent();
      $file->save();

      // Save the uri to settings.
      $this->config('google_calendar_service.default')
        ->set('secret_file_uri', $file->getFileUri())
        ->save();

      $this->messenger->addMessage($this->t(
        'Client Secret file has been uploaded successfully.'
      ));
    }
    elseif ($config->get('secret_file_uri')) {
      $this->messenger->addMessage($this->t(
        'Changes has been applied.'
      ));
    }

    // Save the uri to settings.
    $this->config('google_calendar_service.default')
      ->set('google_user_email', $form_state->getValue('google_user_email'))
      ->save();
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function removeSecretClientFile(
    array &$form,
    FormStateInterface $form_state) {

    $config = $this->config('google_calendar_service.default');
    $file_storage = $this->entityManager->getStorage('file');

    if ($file_uri = $config->get('secret_file_uri')) {
      $file = $file_storage->loadByProperties(['uri' => $file_uri]);
      $file = reset($file);

      $file->delete();
      $config->set('secret_file_uri', NULL);
      $config->save();
      $this->messenger->addMessage($this->t(
        'File has been deleted.'
      ));
    }
  }

  /**
   * Gets the configuration names that will be editable.
   *
   * @return array
   *   An array of configuration object names that are editable if called in
   *   conjunction with the trait's config() method.
   */
  protected function getEditableConfigNames() {
    return ['google_calendar_service.default'];
  }

}
