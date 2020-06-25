<?php

namespace Drupal\google_calendar_service\Form;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\google_calendar_service\CalendarImport;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form controller for Calendar edit forms.
 *
 * @ingroup google_calendar_service
 */
class CalendarForm extends ContentEntityForm {

  /**
   * The messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Drupal\google_calendar_service\CalendarImport definition.
   *
   * @var \Drupal\google_calendar_service\CalendarImport
   */
  protected $calendarImport;

  /**
   * CalendarForm constructor.
   *
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfoInterface $bundle_info
   *   The entity type bundle info.
   * @param \Drupal\Component\Datetime\TimeInterface $time
   *   The time interface.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   * @param \Drupal\google_calendar_service\CalendarImport $calendar_import
   *   The calendar import service.
   */
  public function __construct(
    EntityManagerInterface $entity_manager,
    EntityTypeBundleInfoInterface $bundle_info = NULL,
    TimeInterface $time = NULL,
    MessengerInterface $messenger,
    CalendarImport $calendar_import) {

    parent::__construct($entity_manager, $bundle_info, $time);
    $this->messenger = $messenger;
    $this->calendarImport = $calendar_import;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager'),
      $container->get('entity_type.bundle.info'),
      $container->get('datetime.time'),
      $container->get('messenger'),
      $container->get('google_calendar_service.import_events')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\google_calendar_service\Entity\GoogleCalendar */
    $form = parent::buildForm($form, $form_state);

    $form['start_date']['#states'] = [
      'visible' => [
        ':input[name="set_all[value]"]' => ['checked' => FALSE],
      ],
    ];

    $form['end_date']['#states'] = [
      'visible' => [
        ':input[name="set_all[value]"]' => ['checked' => FALSE],
      ],
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        $this->messenger->addMessage($this->t(
          'Created the %label Google Calendar.',
          [
            '%label' => $entity->label(),
          ]
        ));

        break;

      default:
        $this->messenger->addMessage($this->t(
          'Saved the %label Google Calendar.',
          [
            '%label' => $entity->label(),
          ]
        ));
    }

    $form_state->setRedirect('entity.gcs_calendar.collection');
  }

}
