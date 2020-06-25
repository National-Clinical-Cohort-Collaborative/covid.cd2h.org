<?php

namespace Drupal\google_calendar_service\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Calendar entities.
 *
 * @ingroup google_calendar_service
 */
interface CalendarInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Calendar name.
   *
   * @return string
   *   Name of the Calendar.
   */
  public function getName();

  /**
   * Sets the Calendar name.
   *
   * @param string $name
   *   The Calendar name.
   *
   * @return \Drupal\google_calendar_service\Entity\GoogleCalendarInterface
   *   The called Calendar entity.
   */
  public function setName($name);

  /**
   * Gets the Calendar creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Calendar.
   */
  public function getCreatedTime();

  /**
   * Sets the Calendar creation timestamp.
   *
   * @param int $timestamp
   *   The Calendar creation timestamp.
   *
   * @return \Drupal\google_calendar_service\Entity\GoogleCalendarInterface
   *   The called Google Calendar entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Calendar published status indicator.
   *
   * Unpublished Calendar are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Calendar is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Calendar.
   *
   * @param bool $published
   *   TRUE to set this Calendar to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\google_calendar_service\Entity\GoogleCalendarInterface
   *   The called Calendar entity.
   */
  public function setPublished($published);

  /**
   * Get google calendar id.
   *
   * @return string
   *   Return google calendar id.
   */
  public function getGoogleCalendarId();

  /**
   * Get start date range.
   *
   * @return string
   *   Return timestamp.
   */
  public function getStartDate();

  /**
   * Get end date range.
   *
   * @return string
   *   Return timestamp.
   */
  public function getEndDate();

  /**
   * Get checkbox value set all.
   *
   * @return bool
   *   Return set all.
   */
  public function getSetAll();

}
