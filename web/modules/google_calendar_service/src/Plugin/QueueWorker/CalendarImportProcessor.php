<?php

namespace Drupal\google_calendar_service\Plugin\QueueWorker;

use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\Core\Queue\QueueWorkerBase;
use Drupal\google_calendar_service\CalendarImport;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Queue Worker for import calendar events.
 *
 * @QueueWorker(
 *   id = "gcs_calendar_import_processor",
 *   title = "Calendar Import Processor",
 *   cron = {"time" = 60}
 * )
 */
class CalendarImportProcessor extends QueueWorkerBase implements
    ContainerFactoryPluginInterface {

  /**
   * Drupal\google_calendar_service\GoogleCalendarImport definition.
   *
   * @var \Drupal\google_calendar_service\GoogleCalendarImport
   */
  protected $calendarImport;

  /**
   * CalendarImportProcessor constructor.
   *
   * @param \Drupal\google_calendar_service\CalendarImport $calendar_import
   *   The calendar import service.
   */
  public function __construct(CalendarImport $calendar_import) {
    $this->calendarImport = $calendar_import;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(
    ContainerInterface $container,
    array $configuration,
    $plugin_id,
    $plugin_definition) {

    return new static(
      $container->get('google_calendar_service.import_events')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function processItem($calendar) {
    $this->calendarImport->import($calendar);
  }

}
