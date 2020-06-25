<?php

namespace Drupal\google_calendar_service;

use Drupal\Core\Config\ConfigFactory;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Logger\LoggerChannelFactoryInterface;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Exception;

/**
 * Class CalendarImport.
 *
 * @package google_calendar_service
 */
class CalendarEditEvents {

  /**
   * Google Calendar service definition.
   *
   * @var \Google_Service_Calendar
   */
  public $service;

  /**
   * Logger.
   *
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * Config.
   *
   * @var \Drupal\Core\Config\Config|\Drupal\Core\Config\ImmutableConfig
   */
  protected $config;

  /**
   * EntityTypeManager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The current user.
   *
   * @var \Drupal\Core\Session\AccountInterface
   */
  protected $currentUser;

  /**
   * Constructor.
   */
  public function __construct(
    Google_Client $google_client,
    ConfigFactory $config,
    EntityTypeManagerInterface $entityTypeManager,
    LoggerChannelFactoryInterface $loggerChannelFactory,
    AccountInterface $current_user) {

    $this->service = new Google_Service_Calendar($google_client);
    $this->config = $config->getEditable(
      'google_calendar_service.last_imports'
    );
    $this->entityTypeManager = $entityTypeManager;
    $this->logger = $loggerChannelFactory->get('google_calendar_service');
    $this->current_user = $current_user;
  }

  /**
   * Patch calendar event.
   *
   * @param string $calendarId
   *   The calendar id.
   * @param string $eventId
   *   The event id.
   * @param array $data
   *   The data.
   * @param string $timezone
   *   The timezone.
   */
  public function patchCalendar($calendarId, $eventId, array $data, $timezone) {
    $event = $this->service->events->get($calendarId, $eventId);

    if (isset($data['name'])) {
      $event->setSummary($data['name']);
    }
    if (isset($data['location'])) {
      $event->setLocation($data['location']);
    }
    if (isset($data['description'])) {
      $event->setDescription($data['description']);
    }

    if (isset($data['startDate'])) {
      $start_timestamp = strtotime($data['startDate']);
      $start = new \Google_Service_Calendar_EventDateTime();
      $start->setDateTime(date('c', $start_timestamp));
      $start->setTimeZone($timezone);
      $event->setStart($start);
    }

    if (isset($data['endDate'])) {
      $end_timestamp = strtotime($data['endDate']);
      $end = new \Google_Service_Calendar_EventDateTime();
      $end->setDateTime(date('c', $end_timestamp));
      $end->setTimeZone($timezone);
      $event->setEnd($end);
    }

    // Update calendar event service.
    $this->service->events->update($calendarId, $eventId, $event);
  }

  /**
   * The add calendar event to the calendar.
   *
   * @param string $calendarId
   *   The calendar id.
   * @param string $eventSummary
   *   The title of event.
   * @param string $eventLocation
   *   The location of event.
   * @param string $eventDescription
   *   The event description.
   * @param string $eventStart
   *   The event start.
   * @param string $eventEnd
   *   The event end.
   * @param string $timezone
   *   The timezone.
   *
   * @return \Google_Service_Calendar_Event
   *   Return calendar event.
   */
  public function addCalendarEvent(
    $calendarId,
    $eventSummary,
    $eventLocation,
    $eventDescription,
    $eventStart,
    $eventEnd,
    $timezone) {

    $event = new \Google_Service_Calendar_Event($eventSummary);
    if (isset($eventSummary)) {
      $event->setSummary($eventSummary);
    }

    if (isset($eventLocation)) {
      $event->setLocation($eventLocation);
    }

    if (isset($eventStart)) {
      $start_timestamp = strtotime($eventStart);
      $start = new \Google_Service_Calendar_EventDateTime();
      $start->setDateTime(date('c', $start_timestamp));
      $start->setTimeZone($timezone);
      $event->setStart($start);
    }

    if (isset($eventEnd)) {
      $end_timestamp = strtotime($eventEnd);
      $end = new \Google_Service_Calendar_EventDateTime();
      $end->setDateTime(date('c', $end_timestamp));
      $end->setTimeZone($timezone);
      $event->setEnd($end);
    }

    if (isset($eventDescription)) {
      $event->setDescription($eventDescription);
    }

    try {
      return $this->service->events->insert($calendarId, $event);
    }
    catch (Google_Service_Exception $e) {
      // Catch non-authorized exception.
      if ($e->getCode() == 401) {
        return FALSE;
      }
    }
  }

  /**
   * Delete google calendar event.
   *
   * @param string $calendarId
   *   The calendar id.
   * @param string $eventId
   *   The event id.
   *
   * @return bool
   *   Return deletion of calendar.
   */
  public function deleteGoogleCalendar($calendarId, $eventId) {
    try {
      $this->service->events->delete($calendarId, $eventId);
    }
    catch (Google_Service_Exception $e) {
      // Catch non-authorized exception.
      if ($e->getCode() == 401) {
        return FALSE;
      }
    }
  }

}
