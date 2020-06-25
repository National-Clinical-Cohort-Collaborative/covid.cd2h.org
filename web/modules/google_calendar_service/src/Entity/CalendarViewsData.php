<?php

namespace Drupal\google_calendar_service\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Google Calendar entities.
 */
class CalendarViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();
    return $data;
  }

}
