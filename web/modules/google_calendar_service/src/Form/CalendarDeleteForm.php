<?php

namespace Drupal\google_calendar_service\Form;

use Drupal\Core\Entity\ContentEntityDeleteForm;

/**
 * Provides a form for deleting Google Calendar entities.
 *
 * @ingroup google_calendar_service
 */
class CalendarDeleteForm extends ContentEntityDeleteForm {

  /**
   * {@inheritdoc}
   */
  protected function getDeletionMessage() {
    /** @var \Drupal\google_calendar_service\Entity\Calendar $entity */
    $entity = $this->getEntity();
    $entityName = $entity->getName();

    // Delete events of the calendar.
    $events = \Drupal::entityQuery('gcs_calendar_event')->condition(
      'calendar',
      $entity->id()
    )->execute();

    if (!empty($events)) {
      entity_delete_multiple('gcs_calendar_event', $events);
    }

    return $this->t('The calendar %title has been deleted.', [
      '%title' => $entityName,
    ]);
  }

  /**
   * {@inheritdoc}
   */
  protected function logDeletionMessage() {
    /** @var \Drupal\google_calendar_service\Entity\Calendar $entity */
    $entity = $this->getEntity();
    $this->logger('content')->notice(
      'The calendar %title has been deleted.',
      ['%title' => $entity->getName()]
    );
  }

}
