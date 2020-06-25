<?php

namespace Drupal\google_calendar_service\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\google_calendar_service\CalendarImport;
use Drupal\google_calendar_service\Entity\CalendarInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Drupal\Core\Messenger\MessengerInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;

/**
 * Class CalendarImportController.
 */
class CalendarImportController extends ControllerBase {

  /**
   * Drupal\google_calendar_service\CalendarImport definition.
   *
   * @var \Drupal\google_calendar_service\CalendarImport
   */
  protected $calendarImport;

  /**
   * The request stack.
   *
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * The messenger.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Constructs a CalendarImport object.
   *
   * @param \Drupal\google_calendar_service\CalendarImport $calendar_import
   *   The calendar import.
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   *   The request stack manager.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   The messenger service.
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(
    CalendarImport $calendar_import,
    RequestStack $request_stack,
    MessengerInterface $messenger,
    EntityTypeManagerInterface $entity_type_manager) {

    $this->calendarImport = $calendar_import;
    $this->requestStack = $request_stack;
    $this->messenger = $messenger;
    $this->entityManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('google_calendar_service.import_events'),
      $container->get('request_stack'),
      $container->get('messenger'),
      $container->get('entity_type.manager')
    );
  }

  /**
   * Import calendar.
   *
   * @return string
   *   Return Hello string.
   */
  public function import($calendar = NULL) {
    if (!empty($calendar)) {
      $cid = $this->requestStack->getCurrentRequest()
        ->attributes->get('calendar');

      $calendar = $this->entityManager
        ->getStorage('gcs_calendar')
        ->load($cid);
    }
    if ($calendar instanceof CalendarInterface) {
      if ($this->calendarImport->import($calendar)) {
        $this->messenger->addMessage(
          $this->t(
            'Events for the <strong>@calendar</strong> Calendar have been
            imported successfully!',
            [
              '@calendar' => $calendar->label(),
            ]
          )
        );
      }
      else {
        $this->messenger->addMessage(
          $this->t(
            'Error from Google Calendar API, please check your API settings.'
          )
        );
      }
    }

    return $this->redirect('entity.gcs_calendar.collection');
  }

}
