INTRODUCTION
------------

  * Google Calendar Import provides the functionality to create the calendar and
    sync calendar events in the Drupal system.
    The calendar events can be imported with specific range time or choosing to
    import all. This functionality is designed for sites which want to keep and
    track all calendars events.


REQUIREMENTS
------------

  * To install the module it needs to run before
  "composer require google/apiclient".


INSTALLATION
------------
  * Run "composer require google/apiclient" before installation.
  * The module can be installed like other modules.
  * Once the module has been installed, navigate to
  "/admin/config/google-calendar-service/settings" and configure the settings.

CONFIGURATION
  * Navigate to "/admin/config/google-calendar-service/settings"
  * Go to https://console.developers.google.com/projectcreate and create your
  project.
  * Navigate to Google Api's list and enable "Google Calendar API".
  * Create credentials for your API, using the hint from the enabled Google
  Calendar API page or https://console.developers.google.com/apis/credentials
  * Create "OAuth client ID".
  * Download Your Secret Client JSON and upload it on the below form.
  * Upload the secret client file.
  * Add the google email used Google Calendar API from the above steps.
  * Save configuration.

  Setting up the Google Calendar:
  * On the "Share this Calendar" tab add the service account id. Give permission
  "Make changes to events". This permission is required in order to make changes
  to events from the Drupal site.
