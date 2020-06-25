<?php

namespace Drupal\google_calendar_service;

use Google_Client;
use GuzzleHttp\Client;
use Google_Service_Calendar;
use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\File\FileSystemInterface;

/**
 * Class GoogleHttpClientFactory.
 *
 * @package Drupal\google_calendar_service
 */
class GoogleHttpClientFactory {
  /**
   * The config factory.
   *
   * @var \Drupal\Core\Config\ConfigFactoryInterface
   */
  protected $configFactory;

  /**
   * The file_system.
   *
   * @var \Drupal\Core\File\FileSystemInterface
   */
  protected $fileSystem;

  /**
   * Constructs a UserPasswordForm object.
   *
   * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
   *   The config factory.
   * @param \Drupal\Core\File\FileSystemInterface $file_system
   *   The file_system.
   */
  public function __construct(
    ConfigFactoryInterface $config_factory,
    FileSystemInterface $file_system) {

    $this->configFactory = $config_factory;
    $this->fileSystem = $file_system;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('file_system')
    );
  }

  /**
   * Return a configured HttpClient object.
   */
  public function get() {
    $client = new Google_Client();
    $secret_uri = $this->configFactory->get('google_calendar_service.default')
      ->get('secret_file_uri');
    $email = $this->configFactory->get('google_calendar_service.default')
      ->get('google_user_email');

    if (!empty($secret_uri)) {
      $secret_file = $this->fileSystem->realpath($secret_uri);
      $client->setAuthConfig($secret_file);
      $client->setScopes([Google_Service_Calendar::CALENDAR]);
      $client->setSubject($email);
    }

    // Config HTTP client and config timeout.
    $client->setHttpClient(new Client([
      'timeout' => 10,
      'connect_timeout' => 10,
      'verify' => FALSE,
    ]));

    return $client;
  }

}
