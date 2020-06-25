<?php

namespace Drupal\google_calendar_service\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Google Calendar Event entities.
 *
 * @ingroup google_calendar_service
 */
interface CalendarEventInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  /**
   * Gets the Calendar Event name.
   *
   * @return string
   *   Name of the Calendar Event.
   */
  public function getName();

  /**
   * Sets the Calendar Event name.
   *
   * @param string $name
   *   The Calendar Event name.
   *
   * @return \Drupal\google_calendar_service\Entity\GoogleCalendarEventInterface
   *   The called Calendar Event entity.
   */
  public function setName($name);

  /**
   * Gets the Calendar Event creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Calendar Event.
   */
  public function getCreatedTime();

  /**
   * Sets the Calendar Event creation timestamp.
   *
   * @param int $timestamp
   *   The Calendar Event creation timestamp.
   *
   * @return \Drupal\google_calendar_service\Entity\GoogleCalendarEventInterface
   *   The called Calendar Event entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Calendar Event published status indicator.
   *
   * Unpublished Calendar Event are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Calendar Event is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Calendar Event.
   *
   * @param bool $published
   *   TRUE/FALSE to set this Calendar Event to published/unpublished.
   *
   * @return \Drupal\google_calendar_service\Entity\GoogleCalendarEventInterface
   *   The called Calendar Event entity.
   */
  public function setPublished($published);

  /**
   * Sets google calendar id to a Calendar Event.
   *
   * @param string $eventId
   *   The event id.
   *
   * @return mixed
   *   Return event.
   */
  public function setGoogleEventId($eventId);

  /**
   * Get google calendar id.
   *
   * @return mixed
   *   Return event it.
   */
  public function getGoogleEventId();

}
