<?php

namespace Drupal\google_calendar_service\Form;

use Drupal\Component\Datetime\TimeInterface;
use Drupal\Core\Entity\ContentEntityDeleteForm;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\Entity\EntityTypeBundleInfoInterface;
use Drupal\google_calendar_service\CalendarEditEvents;
use Drupal\google_calendar_service\Entity\Calendar;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a form for deleting Google Calendar Event entities.
 *
 * @ingroup google_calendar_service
 */
class CalendarEventDeleteForm extends ContentEntityDeleteForm {

  /**
   * The edit event service.
   *
   * @var \Drupal\google_calendar_service\CalendarEditEvents
   */
  protected $editEvent;

  /**
   * CalendarEventDeleteForm constructor.
   *
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity type manager.
   * @param \Drupal\Core\Entity\EntityTypeBundleInfoInterface $bundle_info
   *   The entity type bundle info.
   * @param \Drupal\Component\Datetime\TimeInterface $time
   *   The timer interface.
   * @param \Drupal\google_calendar_service\CalendarEditEvents $editEvent
   *   The calendar edit events.
   */
  public function __construct(
    EntityManagerInterface $entity_manager,
    EntityTypeBundleInfoInterface $bundle_info = NULL,
    TimeInterface $time = NULL,
    CalendarEditEvents $editEvent) {

    parent::__construct($entity_manager, $bundle_info, $time);
    $this->editEvent = $editEvent;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity.manager'),
      $container->get('entity_type.bundle.info'),
      $container->get('datetime.time'),
      $container->get('google_calendar_service.edit_events')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getDeletionMessage() {
    /** @var \Drupal\node\CalendarEventInterface $entity */
    $entity = $this->getEntity();

    $calendarId = $entity->get('calendar')->getValue();
    $calendarEmail = $this->getCalendarName($calendarId[0]['target_id']);

    $eventId = $entity->getGoogleEventId();
    $eventName = $entity->getName();

    $this->editEvent->deleteGoogleCalendar($calendarEmail, $eventId);

    return $this->t('The calendar event %title has been deleted.', [
      '%title' => $eventName,
    ]);
  }

  /**
   * {@inheritdoc}
   */
  protected function logDeletionMessage() {
    /** @var \Drupal\google_calendar_service\Entity\CalendarEvent $entity */
    $entity = $this->getEntity();
    $this->logger('content')->notice(
      'The calendar %title has been deleted.',
      ['%title' => $entity->getName()]
    );
  }

  /**
   * Get calendar name.
   *
   * @param int $calendarId
   *   The calendar id.
   *
   * @return mixed
   *   Return calendar name.
   */
  public function getCalendarName($calendarId) {
    $calendar = Calendar::load($calendarId);

    return $calendar->getGoogleCalendarId();
  }

}
