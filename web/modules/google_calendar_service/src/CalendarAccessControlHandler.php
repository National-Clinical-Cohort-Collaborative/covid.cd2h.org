<?php

namespace Drupal\google_calendar_service;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Google Calendar entity.
 *
 * @see \Drupal\google_calendar_service\Entity\GoogleCalendar.
 */
class CalendarAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(
    EntityInterface $entity,
    $operation,
    AccountInterface $account) {

    // @var \Drupal\google_calendar_service\Entity\GoogleCalendarInterface.
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission(
            $account,
            'view unpublished google calendar entities'
          );
        }
        return AccessResult::allowedIfHasPermission(
          $account,
          'view published google calendar entities'
        );

      case 'update':
        return AccessResult::allowedIfHasPermission(
          $account,
          'edit google calendar entities'
        );

      case 'delete':
        return AccessResult::allowedIfHasPermission(
          $account,
          'delete google calendar entities'
        );
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(
    AccountInterface $account,
    array $context,
    $entity_bundle = NULL) {

    return AccessResult::allowedIfHasPermission(
      $account,
      'add google calendar entities'
    );
  }

}
