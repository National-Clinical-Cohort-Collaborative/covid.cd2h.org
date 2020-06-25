<?php

namespace Drupal\google_calendar_service\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Calendar entity.
 *
 * @ingroup google_calendar_service
 *
 * @ContentEntityType(
 *   id = "gcs_calendar",
 *   label = @Translation("Calendar"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\google_calendar_service\CalendarListBuilder",
 *     "views_data" = "Drupal\google_calendar_service\Entity\CalendarViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\google_calendar_service\Form\CalendarForm",
 *       "add" = "Drupal\google_calendar_service\Form\CalendarForm",
 *       "edit" = "Drupal\google_calendar_service\Form\CalendarForm",
 *       "delete" = "Drupal\google_calendar_service\Form\CalendarDeleteForm",
 *     },
 *     "access" = "Drupal\google_calendar_service\CalendarAccessControlHandler",
 *     "route_provider" = {
 *        "html" = "Drupal\google_calendar_service\CalendarHtmlRouteProvider"
 *     }
 *   },
 *   base_table = "gcs_calendar",
 *   data_table = "gcs_calendar_field_data",
 *   admin_permission = "administer calendars and events",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/calendar/{gcs_calendar}",
 *     "add-form" = "/admin/calendar/add",
 *     "edit-form" = "/admin/calendar/{gcs_calendar}/edit",
 *     "delete-form" = "/admin/calendar/{gcs_calendar}/delete",
 *     "collection" = "/admin/calendar",
 *   },
 *   field_ui_base_route = "gcs_calendar.settings"
 * )
 */
class Calendar extends ContentEntityBase implements CalendarInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getGoogleCalendarId() {
    return $this->get('calendar_id')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getStartDate() {
    return $this->get('start_date')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getEndDate() {
    return $this->get('end_date')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function getSetAll() {
    return $this->get('set_all')->value;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(
    EntityTypeInterface $entity_type) {

    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Google Calendar entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['calendar_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Google Calendar ID'))
      ->setDescription(t(
        'The ID of the calendar in google.  This can be obtained form the
        "Integrate Calendar" section of your calendar\'s settings.'
      ))
      ->setSettings([
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['set_all'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Get all events'))
      ->setSettings([
        'on_label' => t('Yes'),
        'off_label' => t('No'),
      ])
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => TRUE,
        ],
        'weight' => 20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDefaultValue(TRUE);

    $fields['start_date'] = BaseFieldDefinition::create('timestamp')
      ->setLabel(t('Start Date'))
      ->setDescription(t(
        'Event Start Date.  This field is read-only, and should be changed in
        Google Calendar.'
      ))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['end_date'] = BaseFieldDefinition::create('timestamp')
      ->setLabel(t('End Date'))
      ->setDescription(t(
        'Event End Date.  This field is read-only, and should be changed in
        Google Calendar.'
      ))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t(
        'A boolean indicating whether the Google Calendar is published.'
      ))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
