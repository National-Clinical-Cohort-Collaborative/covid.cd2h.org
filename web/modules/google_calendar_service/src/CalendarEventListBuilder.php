<?php

namespace Drupal\google_calendar_service;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Defines a class to build a listing of Google Calendar Event entities.
 *
 * @ingroup google_calendar_service
 */
class CalendarEventListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('Name');
    $header['calendar'] = $this->t('Calendar Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    // @var $entity \Drupal\google_calendar_service\Entity\GoogleCalendarEvent.
    $row['calendar'] = $entity->calendar->entity->label();

    return $row + parent::buildRow($entity);
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultOperations(EntityInterface $entity) {
    $operations = [];

    if ($entity->access('update') && $entity->hasLinkTemplate('edit-form')) {
      $operations['edit'] = [
        'title' => $this->t('Edit'),
        'weight' => 10,
        'url' => $entity->urlInfo('edit-form'),
      ];
    }

    $operations['delete'] = [
      'title' => $this->t('Delete'),
      'weight' => 100,
      'url' => $entity->urlInfo('delete-form'),
    ];

    return $operations;
  }

}
