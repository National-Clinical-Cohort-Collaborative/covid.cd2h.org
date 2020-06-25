<?php

namespace Drupal\google_calendar_service\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\google_calendar_service\CalendarImport;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Class ImportCalendarForm.
 *
 * @package Drupal\google_calendar_service\Form
 */
class ImportEventsForm extends FormBase {

  /**
   * Drupal\google_calendar_service\CalendarImport.
   *
   * @var \Drupal\google_calendar_service\CalendarImport
   */
  protected $calendarService;

  /**
   * EntityTypeManager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * ImportEventsForm constructor.
   *
   * @param \Drupal\google_calendar_service\CalendarImport $google_calendar_service
   *   The calendar import.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entityTypeManager
   *   The entity type manager.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger.
   */
  public function __construct(
    CalendarImport $google_calendar_service,
    EntityTypeManagerInterface $entityTypeManager,
    MessengerInterface $messenger) {

    $this->calendarService = $google_calendar_service;
    $this->entityTypeManager = $entityTypeManager;
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('google_calendar_service.import_events'),
      $container->get('entity_type.manager'),
      $container->get('messenger')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'calendar_import_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Import Events'),
    ];

    return $form;
  }

  /**
   * Handle batch process.
   *
   * @param string $calendar
   *   The calendar.
   * @param string $total
   *   The total.
   * @param string $context
   *   The context.
   */
  public static function handleBatchProcess($calendar, $total, &$context) {
    $name = $calendar->label();
    $context['message'] = "Imported Calendar: $name";
    \Drupal::service('google_calendar_service.import_events')
      ->import($calendar);
  }

  /**
   * Batch process callback.
   *
   * @param bool $success
   *   The execution with success.
   * @param string $results
   *   The results.
   * @param string $operations
   *   The operations.
   */
  public static function batchProcessCallback($success, $results, $operations) {
    if ($success) {
      $message = t("Finished importing calendar events");
    }
    else {
      $message = t('Finished with an error.');
    }

    \Drupal::messenger()->addMessage($message);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $query = $this->entityTypeManager
      ->getStorage('gcs_calendar')
      ->getQuery()
      ->condition('status', 1);

    $cids = $query->execute();

    $calendars = $this->entityTypeManager
      ->getStorage('gcs_calendar')
      ->loadMultiple($cids);
    $operations = [];
    $total = count($calendars);

    foreach ($calendars as $calendar) {
      $operations[] = [
        '\Drupal\google_calendar_service\Form\ImportEventsForm::handleBatchProcess',
        [$calendar,
          $total,
        ],
      ];
    }

    $batch = [
      'title' => $this->t('Importing Calendars'),
      'operations' => $operations,
      'finished' => '\Drupal\google_calendar_service\Form\ImportEventsForm::batchProcessCallback',
    ];

    return batch_set($batch);
  }

}
