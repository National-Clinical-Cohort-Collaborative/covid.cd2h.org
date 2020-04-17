<?php

/**
 * @file
 * theme-settings.php
 *
 * Provides theme settings for Bootstrap based themes when admin theme is not.
 *
 * @see ./includes/settings.inc
 */

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Include common Bootstrap functions.
 */
include_once dirname(__FILE__) . '/includes/helper.inc';

/**
 * Implements hook_form_FORM_ID_alter().
 */
function mbase_form_system_theme_settings_alter(&$form, FormStateInterface $form_state, $form_id = NULL) {
  // Do not add Bootstrap specific settings to non-bootstrap based themes,
  // including a work-around for a core bug affecting admin themes.
  // @see https://drupal.org/node/943212
  $args = $form_state->getBuildInfo()['args'];
  // Do not add Bootstrap specific settings to non-bootstrap based themes.
  $theme = !empty($args[0]) ? $args[0] : FALSE;
  if (isset($form_id) || $theme === FALSE || !in_array('mbase', _mbase_get_base_themes($theme, TRUE))) {
    return;
  }

  $form['mbase'] = array(
    '#type' => 'vertical_tabs',
    '#attached' => array(
      'library'  => array('mbase/adminscript'),
    ),
    '#prefix' => '<h2><small>' . t('Modern Base theme Settings') . '</small></h2>',
    '#weight' => -10,
  );

  // General.
  $form['general'] = array(
    '#type' => 'details',
    '#title' => t('General'),
    '#group' => 'mbase',
  );

  // Container.
  $form['general']['container'] = array(
    '#type' => 'fieldset',
    '#title' => t('Container'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['container']['mbase_fluid_container'] = array(
    '#type' => 'checkbox',
    '#title' => t('Fluid container'),
    '#default_value' => _mbase_setting('fluid_container', $theme),
    '#description' => t('Use <code>.container-fluid</code> class. See <a href="http://getbootstrap.com/css/#grid-example-fluid">Fluid container</a>'),
  );
  // Navigations.
  $form['general']['navigation'] = array(
    '#type' => 'fieldset',
    '#title' => t('Navigations'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['navigation']['mbase_navigation_primary'] = array(
    '#type' => 'checkbox',
    '#title' => t('Navigation Primary'),
    '#default_value' => _mbase_setting('navigation_primary', $theme),
    '#description' => t('Enable this show primary menu in navigation bar. Optionally you can use menu block in navigation region'),
  );
  $form['general']['navigation']['mbase_navigation_account'] = array(
    '#type' => 'checkbox',
    '#title' => t('Navigation Account'),
    '#default_value' => _mbase_setting('navigation_account', $theme),
    '#description' => t('Enable this show account menu in navigation bar. Optionally you can use menu block in navigation region'),
  );

  // Buttons.
  $form['general']['buttons'] = array(
    '#type' => 'details',
    '#title' => t('Buttons'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['buttons']['mbase_button_size'] = array(
    '#type' => 'select',
    '#title' => t('Default button size'),
    '#default_value' => _mbase_setting('button_size', $theme),
    '#empty_option' => t('Normal'),
    '#options' => array(
      'btn-xs' => t('Extra Small'),
      'btn-sm' => t('Small'),
      'btn-lg' => t('Large'),
    ),
  );
  $form['general']['buttons']['mbase_button_colorize'] = array(
    '#type' => 'checkbox',
    '#title' => t('Colorize Buttons'),
    '#default_value' => _mbase_setting('button_colorize', $theme),
    '#description' => t('Adds classes to buttons based on their text value. See: <a href=":bootstrap_url" target="_blank">Buttons</a>', array(
      ':bootstrap_url' => 'http://getbootstrap.com/css/#buttons',
    )),
  );
  $form['general']['buttons']['mbase_button_iconize'] = array(
    '#type' => 'checkbox',
    '#title' => t('Iconize Buttons'),
    '#default_value' => _mbase_setting('button_iconize', $theme),
    '#description' => t('Adds icons to buttons based on the text value.'),
  );

  // Forms.
  $form['general']['forms'] = array(
    '#type' => 'details',
    '#title' => t('Forms'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['forms']['mbase_forms_required_has_error'] = array(
    '#type' => 'checkbox',
    '#title' => t('Make required elements display as an error'),
    '#default_value' => _mbase_setting('forms_required_has_error', $theme),
    '#description' => t('If an element in a form is required, enabling this will always display the element with a <code>.has-error</code> class. This turns the element red and helps in usability for determining which form elements are required to submit the form.  This feature compliments the "JavaScript > Forms > Automatically remove error classes when values have been entered" feature.'),
  );
  $form['general']['forms']['mbase_form_elements_icons'] = array(
    '#type' => 'checkbox',
    '#title' => t('Form Element Icons'),
    '#default_value' => _mbase_setting('form_elements_icons', $theme),
    '#description' => t('Make some form element like email, date, etc with input group icons.'),
  );
  // Images.
  $form['general']['images'] = array(
    '#type' => 'details',
    '#title' => t('Images'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['images']['mbase_image_shape'] = array(
    '#type' => 'select',
    '#title' => t('Default image shape'),
    '#description' => t('Add classes to an <code>&lt;img&gt;</code> element to easily style images in any project. Note: Internet Explorer 8 lacks support for rounded corners. See: <a href=":bootstrap_url" target="_blank">Image Shapes</a>', array(
      ':bootstrap_url' => 'http://getbootstrap.com/css/#images-shapes',
    )),
    '#default_value' => _mbase_setting('image_shape', $theme),
    '#empty_option' => t('None'),
    '#options' => array(
      'img-rounded' => t('Rounded'),
      'img-circle' => t('Circle'),
    ),
  );
  $form['general']['images']['mbase_image_responsive'] = array(
    '#type' => 'checkbox',
    '#title' => t('Responsive Images'),
    '#default_value' => _mbase_setting('image_responsive', $theme),
    '#description' => t('Images in Bootstrap 3 can be made responsive-friendly via the addition of the <code>.img-responsive</code> class. This applies <code>max-width: 100%;</code> and <code>height: auto;</code> to the image so that it scales nicely to the parent element.'),
  );
  $form['general']['images']['mbase_image_thumbnail'] = array(
    '#type' => 'checkbox',
    '#title' => t('Images Thumbnail'),
    '#default_value' => _mbase_setting('image_thumbnail', $theme),
    '#description' => t('Add class <code>img-thumbnail</code> to the image.'),
  );

  // Tables.
  $form['general']['tables'] = array(
    '#type' => 'details',
    '#title' => t('Tables'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['general']['tables']['mbase_table_bordered'] = array(
    '#type' => 'checkbox',
    '#title' => t('Bordered table'),
    '#default_value' => _mbase_setting('table_bordered', $theme),
    '#description' => t('Add borders on all sides of the table and cells.'),
  );
  $form['general']['tables']['mbase_table_condensed'] = array(
    '#type' => 'checkbox',
    '#title' => t('Condensed table'),
    '#default_value' => _mbase_setting('table_condensed', $theme),
    '#description' => t('Make tables more compact by cutting cell padding in half.'),
  );
  $form['general']['tables']['mbase_table_hover'] = array(
    '#type' => 'checkbox',
    '#title' => t('Hover rows'),
    '#default_value' => _mbase_setting('table_hover', $theme),
    '#description' => t('Enable a hover state on table rows.'),
  );
  $form['general']['tables']['mbase_table_striped'] = array(
    '#type' => 'checkbox',
    '#title' => t('Striped rows'),
    '#default_value' => _mbase_setting('table_striped', $theme),
    '#description' => t('Add zebra-striping to any table row within the <code>&lt;tbody&gt;</code>. <strong>Note:</strong> Striped tables are styled via the <code>:nth-child</code> CSS selector, which is not available in Internet Explorer 8.'),
  );
  $form['general']['tables']['mbase_table_responsive'] = array(
    '#type' => 'checkbox',
    '#title' => t('Responsive tables'),
    '#default_value' => _mbase_setting('table_responsive', $theme),
    '#description' => t('Makes tables responsive by wrapping them in <code>.table-responsive</code> to make them scroll horizontally up to small devices (under 768px). When viewing on anything larger than 768px wide, you will not see any difference in these tables.'),
  );

  // Components.
  $form['components'] = array(
    '#type' => 'details',
    '#title' => t('Components'),
    '#group' => 'mbase',
  );

  // Breadcrumbs.
  $form['components']['breadcrumbs'] = array(
    '#type' => 'details',
    '#title' => t('Breadcrumbs'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['components']['breadcrumbs']['mbase_breadcrumb'] = array(
    '#type' => 'select',
    '#title' => t('Breadcrumb visibility'),
    '#default_value' => _mbase_setting('breadcrumb', $theme),
    '#options' => array(
      0 => t('Hidden'),
      1 => t('Visible'),
      2 => t('Only in admin areas'),
    ),
  );
  $form['components']['breadcrumbs']['mbase_breadcrumb_home'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show "Home" breadcrumb link'),
    '#default_value' => _mbase_setting('breadcrumb_home', $theme),
    '#description' => t('If your site has a module dedicated to handling breadcrumbs already, ensure this setting is enabled.'),
    '#states' => array(
      'invisible' => array(
        ':input[name="mbase_breadcrumb"]' => array('value' => 0),
      ),
    ),
  );
  $form['components']['breadcrumbs']['mbase_breadcrumb_title'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show current page title at end'),
    '#default_value' => _mbase_setting('breadcrumb_title', $theme),
    '#description' => t('If your site has a module dedicated to handling breadcrumbs already, ensure this setting is disabled.'),
    '#states' => array(
      'invisible' => array(
        ':input[name="mbase_breadcrumb"]' => array('value' => 0),
      ),
    ),
  );
  $form['components']['breadcrumbs']['mbase_breadcrumb_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Prefix text'),
    '#description' => t('Enter the prefix text for breadcrumbs.'),
    '#default_value' => _mbase_setting('breadcrumb_text', $theme),
  );

  // Navbar.
  $form['components']['navbar'] = array(
    '#type' => 'details',
    '#title' => t('Navbar'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['components']['navbar']['mbase_navbar_position'] = array(
    '#type' => 'select',
    '#title' => t('Navbar Position'),
    '#description' => t('Select your Navbar position.'),
    '#default_value' => _mbase_setting('navbar_position', $theme),
    '#options' => array(
      'default' => t('Default'),
      'static-top' => t('Static Top'),
      'fixed-top' => t('Fixed Top'),
      'fixed-bottom' => t('Fixed Bottom'),
    ),
  );
  $form['components']['navbar']['mbase_navbar_inverse'] = array(
    '#type' => 'checkbox',
    '#title' => t('Inverse navbar style'),
    '#description' => t('Select if you want the inverse navbar style.'),
    '#default_value' => _mbase_setting('navbar_inverse', $theme),
  );

  // Region wells.
  $wells = array(
    '' => t('None'),
    'well' => t('.well (normal)'),
    'well well-sm' => t('.well-sm (small)'),
    'well well-lg' => t('.well-lg (large)'),
  );
  $form['components']['region_wells'] = array(
    '#type' => 'details',
    '#title' => t('Region wells'),
    '#description' => t('Enable the <code>.well</code>, <code>.well-sm</code> or <code>.well-lg</code> classes for specified regions. See: documentation on :wells.', array(
      ':wells' => \Drupal::l(t('Bootstrap Wells'), Url::fromUri('http://getbootstrap.com/components/#wells')),
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  // Get defined regions.
  $regions = system_region_list($theme);
  foreach ($regions as $name => $title) {
    $form['components']['region_wells']['mbase_region_well-' . $name] = array(
      '#title' => $title,
      '#type' => 'select',
      '#attributes' => array(
        'class' => array('input-sm'),
      ),
      '#options' => $wells,
      '#default_value' => _mbase_setting('region_well-' . $name, $theme),
    );
  }
  // Menu style per region.
  $region_menu_style_orientation = array(
    'mb-menu-vertical' => t('Vertical Menu'),
    'mb-menu-horizontal' => t('Horizontal Menu'),
  );
  $region_menu_child_display = array(
    'mb-menu-dropdown' => t('Drop Down'),
    'mb-menu-dropup' => t('Drop up'),
    'mb-menu-dropleft' => t('Drop Left'),
    'mb-menu-dropright' => t('Drop Right'),
    'mb-menu-dropno' => t('No dropdown'),
  );
  $form['components']['region_menu_style'] = array(
    '#type' => 'details',
    '#title' => t('Region Menu style'),
    '#description' => t('Select the menu style like vertical, horizontal, hover effect, child menu position etc'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  foreach ($regions as $name => $title) {
    $form['components']['region_menu_style'][$name] = array(
      '#type' => 'details',
      '#title' => $name,
      '#collapsible' => FALSE,
    );
    $form['components']['region_menu_style'][$name]['mbase_region_menu_style_orientation_' . $name] = array(
      '#title' => t('Menu Orientation'),
      '#type' => 'select',
      '#attributes' => array(
        'class' => array('input-sm'),
      ),
      '#options' => $region_menu_style_orientation,
      '#default_value' => _mbase_setting('region_menu_style_orientation_' . $name, $theme),
    );
    $form['components']['region_menu_style'][$name]['mbase_region_menu_child_display_' . $name] = array(
      '#title' => t('Menu child style'),
      '#type' => 'select',
      '#attributes' => array(
        'class' => array('input-sm'),
      ),
      '#options' => $region_menu_child_display,
      '#default_value' => _mbase_setting('region_menu_child_display_' . $name, $theme),
    );
  }
  // Region visibility.
  $breakpoints = array(
    'xs' => t('Extra small devices (Phones)'),
    'sm' => t('Small devices (Tablets)'),
    'md' => t('Medium devices (Desktops)'),
    'lg' => t('Large devices (Desktops)'),
  );
  $form['components']['region_visibility'] = array(
    '#type' => 'details',
    '#title' => t('Region Visibility'),
    '#description' => t('Choose the visibility per breakpoints per region. See: documentation on :responsive.', array(
      ':responsive' => \Drupal::l(t('Bootstrap Responsive utilities'), Url::fromUri('http://getbootstrap.com/css/#responsive-utilities')),
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  foreach ($regions as $name => $title) {
    $form['components']['region_visibility'][$name] = array(
      '#type' => 'details',
      '#title' => $name,
      '#collapsible' => FALSE,
    );
    foreach ($breakpoints as $devicekey => $devicename) {
      $visibility_options = array(
        'visible-' . $devicekey . '-block' => t('Display as block'),
        'visible-' . $devicekey . '-inline' => t('Display as inline'),
        'visible-' . $devicekey . '-inline-block' => t('Display as inline block'),
        'hidden-' . $devicekey => t('Hide from display'),
      );
      $form['components']['region_visibility'][$name]['mbase_region_visibility-' . $name . '-' . $devicekey] = array(
        '#title' => $devicename,
        '#type' => 'select',
        '#attributes' => array(
          'class' => array('input-sm'),
        ),
        '#options' => $visibility_options,
        '#default_value' => _mbase_setting('region_visibility-' . $name . '-' . $devicekey, $theme),
      );
    }
  }

  // Region Bootstrap component.
  $bs_components = _mbase_get_bs_components();
  $bs_component_settings = _mbase_get_bs_components_form_settings();
  $form['components']['region_bscomponent'] = array(
    '#type' => 'details',
    '#title' => t('Region Bootstrap Component'),
    '#description' => t('Choose the Bootstrap Component region. See: documentation on :bootstrap.', array(
      ':responsive' => \Drupal::l(t('Bootstrap Responsive utilities'), Url::fromUri('http://getbootstrap.com/css/#responsive-utilities')),
    )),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  foreach ($regions as $reg_key => $title) {
    $form['components']['region_bscomponent'][$reg_key] = array(
      '#type' => 'details',
      '#title' => $title,
      '#collapsible' => FALSE,
    );
    $region_bscomponent = _mbase_setting('region_bscomponent_' . $reg_key, $theme);
    $form['components']['region_bscomponent'][$reg_key]['mbase_region_bscomponent_' . $reg_key] = array(
      '#title' => 'Select the component',
      '#type' => 'select',
      '#options' => $bs_components,
      '#description' => t('Choose the Bootstrap Component for this region'),
      '#default_value' => $region_bscomponent,
    );
    // Per Component type settings.
    foreach ($bs_component_settings as $bs_comp_key => $bs_comp_settings) {
      $bs_comp_settings_form = isset($bs_comp_settings['form']) ? $bs_comp_settings['form'] : NULL;
      if ($bs_comp_settings_form && count($bs_comp_settings_form)) {
        foreach ($bs_comp_settings_form as $bs_comp_setting_key => $bs_comp_setting_field) {
          $bs_comp_setting_field_key = 'region_bs_component_' . $reg_key . '_' . $bs_comp_key . '_' . $bs_comp_setting_key;
          $default_reg_comp_field_setting = _mbase_setting($bs_comp_setting_field_key, $theme);
          if (!trim($default_reg_comp_field_setting)) {
            $default_reg_comp_field_setting = $bs_comp_setting_field['_default'];
          }
          unset($bs_comp_setting_field['_default']);
          $form['components']['region_bscomponent'][$reg_key]['mbase_' . $bs_comp_setting_field_key] = $bs_comp_setting_field;
          $form['components']['region_bscomponent'][$reg_key]['mbase_' . $bs_comp_setting_field_key]['#states'] = array(
            'visible' => array(
              ':input[name="mbase_region_bscomponent_' . $reg_key . '"]' => array('value' => $bs_comp_key),
            ),
          );
          $form['components']['region_bscomponent'][$reg_key]['mbase_' . $bs_comp_setting_field_key]['#default_value'] = $default_reg_comp_field_setting;
        }
      }
    }
  }
  // JavaScript settings.
  $form['javascript'] = array(
    '#type' => 'details',
    '#title' => t('JavaScript'),
    '#group' => 'mbase',
  );

  // Anchors.
  $form['javascript']['anchors'] = array(
    '#type' => 'details',
    '#title' => t('Anchors'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['anchors']['mbase_anchors_fix'] = array(
    '#type' => 'checkbox',
    '#title' => t('Fix anchor positions'),
    '#default_value' => _mbase_setting('anchors_fix', $theme),
    '#description' => t('Ensures anchors are correctly positioned only when there is margin or padding detected on the BODY element. This is useful when fixed navbar or administration menus are used.'),
  );
  $form['javascript']['anchors']['mbase_anchors_smooth_scrolling'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable smooth scrolling'),
    '#default_value' => _mbase_setting('anchors_smooth_scrolling', $theme),
    '#description' => t('Animates page by scrolling to an anchor link target smoothly when clicked.'),
    '#states' => array(
      'invisible' => array(
        ':input[name="mbase_anchors_fix"]' => array('checked' => FALSE),
      ),
    ),
  );

  // Forms.
  $form['javascript']['forms'] = array(
    '#type' => 'details',
    '#title' => t('Forms'),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['forms']['mbase_forms_has_error_value_toggle'] = array(
    '#type' => 'checkbox',
    '#title' => t('Automatically remove error classes when values have been entered'),
    '#default_value' => _mbase_setting('forms_has_error_value_toggle', $theme),
    '#description' => t('If an element has a <code>.has-error</code> class attached to it, enabling this will automatically remove that class when a value is entered. This feature compliments the "General > Forms > Make required elements display as an error" feature.'),
  );
  // Other settings.
  $form['javascript']['others'] = array(
    '#type' => 'details',
    '#title' => t('Other Settings'),
    '#description' => t("Other Bootstrap Js settings"),
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  $form['javascript']['others']['mbase_alert_dismissible'] = array(
    '#type' => 'checkbox',
    '#title' => t('Dismissible Alert'),
    '#description' => t("Makes the alert messages dismissable."),
    '#default_value' => _mbase_setting('alert_dismissible', $theme),
  );
  // Advanced settings.
  $form['advanced'] = array(
    '#type' => 'details',
    '#title' => t('Advanced'),
    '#group' => 'mbase',
  );
  $form['advanced']['mbase_bsflatit'] = array(
    '#type' => 'checkbox',
    '#title' => t('Bootstrap Flat.it'),
    '#description' => t('Select to Remove all border radiuses to zero. Using <a href="@flatitlink" target = "_blank">Bootstrap Rate.it</a> CSS.', array('@flatitlink' => 'https://github.com/cmsbots/bsflat.it')),
    '#default_value' => _mbase_setting('bsflatit', $theme),
  );
  $form['advanced']['mbase_animatecss'] = array(
    '#type' => 'checkbox',
    '#title' => t('Add animate.css'),
    '#description' => t('Select to add CSS3 animations to site. Using <a href="@animation" target = "_blank">Animate.css</a> CSS.', array('@animation' => 'https://github.com/daneden/animate.css')),
    '#default_value' => _mbase_setting('animatecss', $theme),
  );
  $form['advanced']['mbase_fontawesome'] = array(
    '#type' => 'checkbox',
    '#title' => t('Add Font awesome'),
    '#description' => t('Add fontawesome icons, it will override the default glyphicon icons comes with Bootstrap. Make sure you added right CDN file for fontawesome to work.'),
    '#default_value' => _mbase_setting('fontawesome', $theme),
  );

  $theme_info = \Drupal::service('theme_handler')->listInfo();
  $default_cdn_css = trim(_mbase_setting('addbscsscdn', $theme));
  $theme_path = drupal_get_path('theme', 'mbase');
  $bootstrap_path = base_path() . $theme_path . '/bootstrap/';
  $default_cdn_css = $default_cdn_css ? $default_cdn_css : $theme_info['mbase']->info['bs-cdn-css'];
  $form['advanced']['mbase_addbscsscdn'] = array(
    '#type' => 'textfield',
    '#title' => t('Add Bootstrap CDN CSS file.'),
    '#description' => t("Add Bootstrap CSS CDN file. Enter Fully qualified URL. Or optionally use this local copy : @bscopycss", array('@bscopycss' => $bootstrap_path . 'css/bootstrap.min.css')),
    '#default_value' => $default_cdn_css,
    '#required' => TRUE,
  );

  $default_cdn_js = trim(_mbase_setting('addbsjsscdn', $theme));
  $default_cdn_js = $default_cdn_js ? $default_cdn_js : $theme_info['mbase']->info['bs-cdn-css'];
  $form['advanced']['mbase_addbsjsscdn'] = array(
    '#type' => 'textfield',
    '#title' => t('Add Bootstrap CDN Javascript file.'),
    '#description' => t("Add Bootstrap Javascript CDN file. Enter Fully qualified URL.  Or optionally use this local copy : @bscopyjs", array('@bscopyjss' => $bootstrap_path . 'css/bootstrap.min.js')),
    '#default_value' => $default_cdn_js,
    '#required' => TRUE,
  );
  $form['advanced']['mbase_include_cdn_css'] = array(
    '#type' => 'textarea',
    '#title' => t('Add CSS files from CDN'),
    '#description' => t("Add one css file per line. It must be full URL."),
    '#default_value' => _mbase_setting('include_cdn_css', $theme),
  );
  $form['advanced']['mbase_include_cdn_js'] = array(
    '#type' => 'textarea',
    '#title' => t('Add JS files from CDN'),
    '#description' => t("Add one Javascript file per line. It must be full URL."),
    '#default_value' => _mbase_setting('include_cdn_js', $theme),
  );
  $form['advanced']['mbase_credits'] = array(
    '#type' => 'checkbox',
    '#title' => t('Display credits'),
    '#default_value' => _mbase_setting('credits', $theme),
    '#description' => t('Display the theme credits to cmsbots.com at bottom of footer.'),
  );
  // Some settings exclusively for child themes.
  if ($theme != 'mbase') {
    // Option to hide and show the home page content region for child theme.
    $form['advanced']['mbase_toggle_frontpage_content'] = array(
      '#type' => 'checkbox',
      '#title' => t('Show content region in front page'),
      '#default_value' => _mbase_setting('toggle_frontpage_content', $theme),
      '#description' => t('Toggle the content region in front page. Especally useful if the sub-theme generated using cmsbots.com'),
    );
  }
  // Support information.
  $form['support'] = array(
    '#type' => 'details',
    '#title' => t('support'),
    '#group' => 'mbase',
    '#weight' => 100,
  );
  $form['support']['support_markup'] = array(
    '#type' => 'markup',
    '#markup' => t('<strong><a href = "mailto:adal@cmsbots.com?Subject=Drupal%20SUpport" target = "_blank">Support</a>
      &nbsp; <a href = "http://cmsbots.com/" target = "_blank">Design more Themes</a>
      &nbsp; <a href = "https://www.paypal.me/adala/0.99" target = "_blank">Donate 0.99$ via paypal</a>
      &nbsp; <a href = "mailto:adal@cmsbots.com?Subject=Hello%20from%20mbase" " target = "_blank">Hire the developer</a>
      </strong>'),
  );
}
