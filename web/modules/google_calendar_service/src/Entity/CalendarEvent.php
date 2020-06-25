<?php

namespace Drupal\google_calendar_service\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Calendar Event entity.
 *
 * @ingroup google_calendar_service
 *
 * @ContentEntityType(
 *   id = "gcs_calendar_event",
 *   label = @Translation("Calendar Event"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\google_calendar_service\CalendarEventListBuilder",
 *     "views_data" = "Drupal\google_calendar_service\Entity\CalendarEventViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\google_calendar_service\Form\CalendarEventForm",
 *       "add" = "Drupal\google_calendar_service\Form\CalendarEventForm",
 *       "edit" = "Drupal\google_calendar_service\Form\CalendarEventForm",
 *       "delete" = "Drupal\google_calendar_service\Form\CalendarEventDeleteForm"
 *     },
 *     "access" = "Drupal\google_calendar_service\CalendarEventAccessControlHandler",
 *     "route_provider" = {
 *        "html" = "Drupal\google_calendar_service\CalendarHtmlRouteProvider"
 *     }
 *   },
 *   base_table = "gcs_calendar_event",
 *   data_table = "gcs_calendar_event_field_data",
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
 *     "canonical" = "/calendar/event/{gcs_calendar_event}",
 *     "add-form" = "/admin/calendar/event/add",
 *     "edit-form" = "/admin/calendar/event/{gcs_calendar_event}/edit",
 *     "delete-form" = "/admin/calendar/event/{gcs_calendar_event}/delete",
 *     "collection" = "/admin/calendar/events",
 *   },
 *   field_ui_base_route = "google_calendar_event.settings"
 * )
 */
class CalendarEvent extends ContentEntityBase implements
    CalendarEventInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(
    EntityStorageInterface $storage_controller,
    array &$values) {

    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

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
  public function setGoogleEventId($eventId) {
    $this->set('event_id', $eventId);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getGoogleEventId() {
    return $this->get('event_id')->value;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t(
        'The user ID of author of the Google Calendar Event entity.'
      ))
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t(
        'The name of the event. This field is read-only, and should be changed
        in Google Calendar.'
      ))
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

    $fields['location'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Location'))
      ->setDescription(t(
        'Event Location.  This field is read-only, and should be changed in
        Google Calendar.'
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

    $fields['event_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Event ID'))
      ->setReadOnly(TRUE);

    $fields['calendar'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Calendar'))
      ->setDescription(t('The calendar this event is part of.'))
      ->setSetting('target_type', 'gcs_calendar')
      ->setSetting('handler', 'default')
      ->setDisplayOptions('view', [
        'label'  => 'hidden',
        'type'   => 'gcs_calendar',
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDescription(t(
        'This field is read-only, and should be changed in Google Calendar.'
      ))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'text_default',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['start_date'] = BaseFieldDefinition::create('timestamp')
      ->setLabel(t('Start Date'))
      ->setDescription(t(
        'Event Start Date.  This field is read-only, and should be changed in
        Google Calendar.'
      ))
      ->setRequired(TRUE)
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
      ->setRequired(TRUE)
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
        'A boolean indicating whether the Google Calendar Event is published.'
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
