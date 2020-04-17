<?php

/**
 * @file
 * bootstrap.inc
 *
 * Contains theme preprocessors to bootstrapize components.
 */

use Drupal\Core\Template\Attribute;
use Drupal\Component\Utility\NestedArray;
use Drupal\Component\Utility\Crypt;
use Drupal\Component\Utility\Unicode;
use Drupal\Core\Theme\ThemeManager;
use Drupal\Core\Utility\ThemeRegistry;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Menu\MenuTreeParameters;
use Drupal\Core\Form\FormState;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element;
use Drupal\Component\Utility\SafeMarkup;
use Drupal\Component\Utility\Html;
use Drupal\Core\Entity\ContentEntityFormInterface;
use Drupal\Core\Entity\Entity\EntityFormDisplay;
use Drupal\Component\Annotation\Plugin;
use Drupal\Core\Render\Element\FormElement;
use Drupal\Core\Theme\ThemeInitialization;

/**
 * Include common functions used through out theme.
 */

if (!defined('__DIR__')) {
  define('__DIR__', dirname(__FILE__));
}
include_once dirname(__FILE__) . '/helper.inc';

/**
 * Implements hook_preprocess_html().
 */
function mbase_preprocess_html(&$variables) {
  $theme = \Drupal::theme()->getActiveTheme()->getName();
  if ($theme != 'mbase') {
    $variables['attributes']['class'][] = 'mbase-child-theme';
  }
  else {
    $variables['attributes']['class'][] = 'mbase-main-theme';
  }
  if (!_mbase_setting('toggle_frontpage_content')) {
    $variables['attributes']['class'][] = 'hide-main-container';
  }
  $variables['navbar_position'] = 'navbar-is-' . _mbase_setting('navbar_position');
}

/**
 * Implements hook_preprocess_table().
 */
function mbase_preprocess_table(&$variables) {
  // Prepare classes array if necessary.
  if (!isset($variables['attributes']['class'])) {
    $variables['attributes']['class'] = array();
  }
  // Convert classes to an array.
  elseif (isset($variables['attributes']['class']) && is_string($variables['attributes']['class'])) {
    $variables['attributes']['class'] = explode(' ', $variables['attributes']['class']);
  }

  // Add the necessary classes to the table.
  _mbase_table_add_classes($variables['attributes']['class'], $variables);
}

/**
 * Implements hook_preprocess_forum_list().
 */
function mbase_preprocess_forum_list(&$variables) {
  _mbase_table_add_classes($variables['attributes']['class'], $variables);
}

/**
 * Implements hook_preprocess_views_view_table().
 */
function mbase_preprocess_views_view_table(&$variables) {
  _mbase_table_add_classes($variables['attributes']['class'], $variables);
}

/**
 * Implements hook_preprocess_status_messages().
 */
function mbase_preprocess_status_messages(&$variables) {
  $variables['alert_dismissible'] = _mbase_setting('alert_dismissible') ? 'alert-dismissible' : FALSE;
}

/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 */
function mbase_preprocess_page(&$variables) {
  // Add information about the number of sidebars.
  $variables['content_column_attributes'] = new Attribute();
  $variables['content_column_attributes']['class'] = array();
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_attributes']['class'][] = 'col-sm-6';
  }
  elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_attributes']['class'][] = 'col-sm-9';
  }
  else {
    $variables['content_column_attributes']['class'][] = 'col-sm-12';
  }

  $variables['navbar_attributes'] = new Attribute();
  $variables['navbar_attributes']['class'] = array('navbar');
  if (_mbase_setting('navbar_position') !== 'default') {
    $variables['navbar_attributes']['class'][] = 'navbar-' . _mbase_setting('navbar_position');
  }
  else {
    $variables['navbar_attributes']['class'][] = 'navbar-default';
    $variables['navbar_attributes']['class'][] = 'container';
    $variables['navbar_is_default'] = TRUE;
  }
  if (_mbase_setting('navbar_inverse')) {
    $variables['navbar_attributes']['class'][] = 'navbar-inverse';
  }

  // Primary nav.
  if (_mbase_setting('navigation_primary')) {
    $menu = \Drupal::menuTree()->load('main', new MenuTreeParameters());
    $variables['primary_nav'] = \Drupal::menuTree()->build($menu);
    $variables['primary_nav']['#attributes']['class'][] = 'navbar-nav';
    $variables['primary_nav']['#attributes']['class'][] = 'primary-menu';
  }

  // Secondary nav.
  if (_mbase_setting('navigation_account')) {
    $menu_secondary = \Drupal::menuTree()->load('account', new MenuTreeParameters());
    $variables['secondary_nav'] = \Drupal::menuTree()->build($menu_secondary);
    $variables['secondary_nav']['#attributes']['class'][] = 'navbar-nav';
    $variables['secondary_nav']['#attributes']['class'][] = 'secondary';
  }

  // Set site container.
  $variables['container'] = 'container';
  if (_mbase_setting('fluid_container')) {
    $variables['container'] = 'container-fluid';
  }
  // Theme credit, After all months of work.
  if (_mbase_setting('theme_credit')) {
    $variables['theme_credit'] = t('Theme contributed by <a href=":cmsbots" target = "_blank">CMSbots.com</a>', array(':cmsbots' => 'http://cmsbots.com'));
  }
}

/**
 * Overrides theme_menu_local_action().
 */
function mbase_preprocess_menu_local_action(&$variables) {
  $link = $variables['element']['#link'];
  $link += array(
    'localized_options' => array(),
  );
  $link['localized_options']['set_active_class'] = TRUE;

  $icon = _mbase_iconize_text($link['title']);
  $options = isset($link['localized_options']) ? $link['localized_options'] : array();

  if (isset($link['url'])) {
    // Turn link into a mini-button and colorize based on title.
    if ($class = _mbase_colorize_text($link['title'])) {
      if (!isset($options['attributes']['class'])) {
        $options['attributes']['class'] = array();
      }
      $string = is_string($options['attributes']['class']);
      if ($string) {
        $options['attributes']['class'] = explode(' ', $options['attributes']['class']);
      }
      $options['attributes']['class'][] = 'btn';
      $options['attributes']['class'][] = 'btn-xs';
      $options['attributes']['class'][] = 'btn-' . $class;
      if ($string) {
        $options['attributes']['class'] = implode(' ', $options['attributes']['class']);
      }
    }

    $variables['link'] = array(
      '#type' => 'link',
      '#title' => SafeMarkup::format($icon . '@text', array('@text' => $link['title'])),
      '#options' => $options,
      '#url' => $link['url'],
    );
  }
  else {
    $variables['link'] = array(
      '#type' => 'link',
      '#title' => $link['title'],
      '#options' => $options,
      '#url' => $link['url'],
    );
  }
}

/**
 * Implements hook_preprocess_breadcrumb().
 */
function mbase_preprocess_breadcrumb(&$variables) {
  $breadcrumb = &$variables['breadcrumb'];
  // Optionally get rid of the homepage link.
  $show_breadcrumb_home = _mbase_setting('breadcrumb_home');
  if (!$show_breadcrumb_home) {
    array_shift($breadcrumb);
  }
  else {
    $variables['attributes']['class'][] = "breadcrumb-with-home";
  }

  // Add the 'you are here'.
  $variables['breadcrumb_text'] = _mbase_setting('breadcrumb_text');

  if (_mbase_setting('breadcrumb_title') && !empty($breadcrumb)) {
    $request = \Drupal::request();
    $route_match = \Drupal::routeMatch();
    $page_title = \Drupal::service('title_resolver')->getTitle($request, $route_match->getRouteObject());

    if (!empty($page_title)) {
      $variables['attributes']['class'][] = "breadcrumb-with-title";
      $breadcrumb[] = array(
        'text' => $page_title,
        'attributes' => new Attribute(array('class' => array('active'))),
      );
    }
  }
}

/**
 * Prepares variables for comment field templates.
 *
 * Default template: field--comment.html.twig.
 *
 * @todo Rename to template_preprocess_field__comment() once
 *   https://www.drupal.org/node/939462 is resolved.
 */
function mbase_preprocess_field(&$variables) {
  $element = $variables['element'];
  if ($element['#field_type'] == 'comment') {
    // Provide contextual information.
    $variables['comment_display_mode'] = $element[0]['#comment_display_mode'];
    $variables['comment_type'] = $element[0]['#comment_type'];

    // Append additional attributes (eg. RDFa) from the first field item.
    $variables['attributes'] += $variables['items'][0]['attributes']->storage();

    // Create separate variables for the comments and comment form.
    $variables['comments'] = $element[0]['comments'];
    $variables['comment_form'] = $element[0]['comment_form'];
    // Check if any comments avaliable.
    $variables['no_comments'] = !isset($element[0]['comments']['#sorted']);
  }
}

/**
 * Preprocess form_element.
 */
function mbase_preprocess_form_element(&$variables) {

  $element = &$variables['element'];
  $title_display = $element['#title_display'];
  $name = !empty($element['#name']) ? $element['#name'] : FALSE;
  $type = !empty($element['#type']) ? $element['#type'] : FALSE;
  $checkbox = $type && $type === 'checkbox';
  $radio = $type && $type === 'radio';
  $vertical_tabs = $type && $type === 'vertical_tabs';
  $element_icons = _mbase_setting('form_elements_icons');

  // This function is invoked as theme wrapper, but the rendered form element
  // may not necessarily have been processed
  // by Drupal::formBuilder()->doBuildForm().
  $element += array(
    '#title_display' => 'before',
  );

  // Check for errors and set correct error class.
  $formstate = new FormState();
  if ((isset($element['#parents']) && $formstate->getError($element)) || (!empty($element['#required']) && _mbase_setting('forms_required_has_error'))) {
    $variables['has_error'] = TRUE;
  }

  if (!empty($element['#autocomplete_route_name']) && Drupal::PathValidator($element['#autocomplete_route_name'])) {
    $variables['is_autocomplete'] = TRUE;
  }

  // See http://getbootstrap.com/css/#forms-controls.
  if (isset($element['#type'])) {
    if ($radio) {
      $variables['is_radio'] = TRUE;
    }
    elseif ($checkbox) {
      $variables['is_checkbox'] = TRUE;
    }
    elseif ($type != 'hidden') {
      $variables['is_form_group'] = TRUE;
    }
  }

  // If #title is not set, we don't display any label or required marker.
  if (!isset($element['#title'])) {
    $element['#title_display'] = 'none';
  }
  $variables['title_display'] = $element['#title_display'];
  // Add label_display and label variables to template.
  $variables['label_display'] = $element['#title_display'];

  // Place single checkboxes and radios in the label field.
  if (($checkbox || $radio) && $title_display != 'none' && $title_display != 'invisible') {
    $variables['label']['#children'] = $variables['children'];
    unset($variables['children']);
    unset($variables['description']);

    // Pass the label attributes to the Label.
    if (isset($variables['element']['#label_attributes'])) {
      $variables['label']['#label_attributes'] = $variables['element']['#label_attributes'];
    }
  }

  // Create variables for #input_group and #input_group_button flags.
  if (isset($element['#input_group'])) {
    $variables['input_group'] = $element['#input_group'];
  }
  if (isset($element['#input_group_button'])) {
    $variables['input_group_button'] = $element['#input_group_button'];
  }

  $prefix = '';
  $suffix = '';
  if (isset($element['#field_prefix']) || isset($element['#field_suffix'])) {
    // Determine if "#input_group" was specified.
    $prefix = array(
      '#markup' => (isset($element['#field_prefix']) ? $element['#field_prefix'] : ''),
    );
    $suffix = array(
      '#markup' => (isset($element['#field_suffix']) ? $element['#field_suffix'] : '') ,
    );
    // Determine if "#input_group_button" was specified.
    if (!empty($element['#input_group_button'])) {
      $prefix = array(
        '#markup' => '<div class="input-group">' . (isset($element['#field_prefix']) ? '<span class="input-group-btn">' . $element['#field_prefix'] . '</span>' : ''),
      );
      $suffix = array(
        '#markup' => (isset($element['#field_suffix']) ? '<span class="input-group-btn">' . $element['#field_suffix'] . '</span>' : '') . '</div>',
      );
    }
    $render = \Drupal::service('renderer');
    $variables['prefix'] = $render->render($prefix);
    $variables['suffix'] = $render->render($suffix);
  }
  else {
    $variables['prefix'] = '';
    $variables['suffix'] = '';
    // Set email icon as prefix to email fields.
    if ($type == 'email' && $element_icons) {
      $variables['prefix']['#markup'] = _mbase_icon('envelope');
    }
    // Set icons for tel and telphone fields.
    if ($type == 'tel' && isset($element['#attributes']['type']) && $element['#attributes']['type'] == 'tel' && $element_icons) {
      $variables['prefix']['#markup'] = _mbase_icon('phone');
    }
    // Set icons for date and time fields.
    if ($type == 'date' && isset($element['#attributes']['type']) && $element['#attributes']['type'] == 'date' && $element_icons) {
      $variables['prefix']['#markup'] = _mbase_icon('calendar');
    }
    if ($type == 'date' && isset($element['#attributes']['type']) && $element['#attributes']['type'] == 'time' && $element_icons) {
      $variables['prefix']['#markup'] = _mbase_icon('time');
    }
  }
}

/**
 * Overrides theme_form_element_label().
 */
function mbase_preprocess_form_element_label(&$variables) {

  $element = $variables['element'];
  // If title and required marker are both empty, output no label.
  $variables['title'] = !empty($element['#title']) ? Xss::filterAdmin($element['#title']) : '';
  $variables['attributes'] = array();

  // Pass elements title_display to template.
  $variables['title_display'] = $element['#title_display'];

  // A #for property of a dedicated #type 'label' element as precedence.
  if (!empty($element['#for'])) {
    $variables['attributes']['for'] = $element['#for'];
    // A custom #id allows the referenced form input element to refer back to
    // the label element; e.g., in the 'aria-labelledby' attribute.
    if (!empty($element['#id'])) {
      $variables['attributes']['id'] = $element['#id'];
    }
  }
  // Otherwise, point to the #id of the form input element.
  elseif (!empty($element['#id'])) {
    $variables['attributes']['for'] = $element['#id'];
  }

  // Pass elements required to template.
  $variables['required'] = !empty($element['#required']) ? $element['#required'] : NULL;

  // Add generic Bootstrap identifier class.
  $variables['attributes']['class'][] = 'control-label';
}

/**
 * Implements hook_preprocess_input().
 */
function mbase_preprocess_input(&$variables) {
  $element = &$variables['element'];

  $attributes = new Attribute($variables['attributes']);
  $type = $element['#type'];
  // Set the element's attributes.
  \Drupal\Core\Render\Element::setAttributes($element, array(
    'id', 'name', 'value', 'type',
  ));

  // Handle button inputs.
  if (_mbase_is_button($element)) {
    $variables['attributes']['class'][] = 'btn';
    _mbase_colorize_button($variables);
    _mbase_iconize_button($element);

    // Add button size, if necessary.
    if ($size = _mbase_setting('button_size')) {
      $variables['attributes']['class'][] = $size;
    }

    // Add in the button type class.
    $variables['attributes']['class'][] = 'form-' . $element['#type'];
    $variables['label'] = $element['#value'];
  }

  _mbase_prerender_input($variables);

  // Autocomplete fields.
  if (!empty($element['#autocomplete_route_name']) && Drupal::PathValidator($element['#autocomplete_route_name'])) {
    $variables['autocomplete'] = TRUE;

    // Attributes for hidden input field.
    $autocomplete_attributes = new Attribute();
    $autocomplete_attributes['type'] = 'hidden';
    $autocomplete_attributes['id'] = $element['#attributes']['id'] . '-autocomplete';
    $autocomplete_attributes['value'] = Drupal::Url($element['#autocomplete_route_name'], $element['#autocomplete_route_parameters']);
    $autocomplete_attributes['disabled'] = 'disabled';
    $autocomplete_attributes['class'] = 'autocomplete';

    // Uses icon for autocomplete "throbber".
    $icon = _mbase_icon('refresh');

    // Fallback to using core's throbber.
    if (empty($icon)) {
      $icon = array(
        '#type' => 'container',
        '#attributes' => array(
          'class' => array(
            'ajax-progress',
            'ajax-progress-throbber',
            'invisible',
          ),
        ),
        'throbber' => array(
          '#type' => 'html_tag',
          '#tag' => 'div',
          '#attributes' => array(
            'class' => array('throbber'),
          ),
        ),
      );
    }
    $variables['autocomplete_icon'] = $icon;
    $variables['autocomplete_attributes'] = $autocomplete_attributes;
  }

  // Search fields.
  if ($element['#type'] == 'search') {
    $attributes['placeholder'] = t('Search');
    $attributes['data-original-title'] = t('Enter the terms you wish to search for.');
  }

  // Additional Twig variables.
  $variables['icon'] = $element['#icon'];
  $variables['element'] = $element;
}

/**
 * Implements hook_preprocess().
 *
 * @see template_preprocess_field_multiple_value_form()
 */
function mbase_preprocess_field_multiple_value_form(&$variables) {
  $element = $variables['element'];
  // Wrap header columns in label element for Bootstrap.
  if ($variables['multiple']) {

    $required = '';
    if (isset($element['#required']) && $element['#required'] == TRUE) {
      $required = '<span class = "form-required"> *</span>';
    }
    $header_attributes = new Attribute(array('class' => array('label')));
    $header = array(
      t('Order', array(), array('context' => 'Sort order')),
      array(
        'data' => array(
          '#prefix' => '<label' . $header_attributes . '>',
          'title' => array(
            '#markup' => $element['#title'],
          ),
          '#suffix' => $required . '</label>',
        ),
        'class' => array('field-label'),
      ),
      t('Weight', array(), array('context' => 'Sort order')),
    );

    $variables['table']['#header'] = $header;
    $help_description = '';
    if (isset($element['#description'])) {
      $help_description = '<div class="description help-block"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span> ' . $element['#description'] . '</div>';

      $footer = array(
        array(
          'class' => array('footer-class'),
          'data' => array(
            array(
              'data' => array('#markup' => $help_description),
              'colspan' => 3,
            ),
          ),
        ),
      );
      $variables['table']['#footer'] = $footer;
    }
  }
}

/**
 * Implements hook_pre_render().
 */
function mbase_pre_render($element) {
  if (!empty($element['#bootstrap_ignore_pre_render'])) {
    return $element;
  }

  // Only add the "form-control" class for specific element input types.
  $types = array(
    // Core.
    'password',
    'password_confirm',
    'select',
    'textarea',
    'textfield',

    // Elements module (HTML5).
    'date',
    'datefield',
    'email',
    'emailfield',
    'number',
    'numberfield',
    'range',
    'rangefield',
    'search',
    'searchfield',
    'tel',
    'telfield',
    'url',
    'urlfield',

    // Webform module.
    'webform_email',
    'webform_number',
  );

  // Add necessary classes for specific types.
  if (!empty($element['#type']) && (in_array($element['#type'], $types) || ($element['#type'] === 'file' && empty($element['#managed_file'])))) {
    $element['#attributes']['class'][] = 'form-control';
  }
  if (!empty($element['#type']) && $element['#type'] === 'machine_name') {
    $element['#wrapper_attributes']['class'][] = 'form-inline';
  }
  return $element;
}

/**
 * Implements hook_css_alter().
 */
function mbase_css_alter(&$css) {
  $config = \Drupal::config('mbase.settings');

  // Add Bootstrap CSS from CDN.
  $defaultbs_cdn_css = trim(_mbase_setting('addbscsscdn'));

  if (!$defaultbs_cdn_css) {
    $theme_info = \Drupal::service('theme_handler')->listInfo();
    $defaultbs_cdn_css = $theme_info['mbase']->info['bs-cdn-css'];
  }
  $css[$defaultbs_cdn_css] = _mbase_css_alter_array_build($defaultbs_cdn_css, -99.99);

  // Add other CDN css files.
  $include_cdn_css = trim(_mbase_setting('include_cdn_css'));
  if ($include_cdn_css) {
    $cdn_css_files = explode(PHP_EOL, _mbase_setting('include_cdn_css'));
    $cdn_weight = 100;
    foreach ($cdn_css_files as $cdn_css_file) {
      if (!trim($cdn_css_file)) {
        continue;
      }
      $cdn_weight += .01;
      $css[$cdn_css_file] = _mbase_css_alter_array_build($cdn_css_file, $cdn_weight);
    }
  }
  $theme_path = drupal_get_path('theme', 'mbase');

  // Exclude specified CSS files from theme.
  // Todo : take from settings.yml.
  $excludes = _mbase_setting('excludes_css');
  if (!empty($excludes)) {
    $css = array_diff_key($css, array_combine($excludes, $excludes));
  }
  // Exclude base color CSS for child theme.
  $current_theme = \Drupal::theme()->getActiveTheme()->getName();
  if ($current_theme != 'mbase') {
    $color_css_files = \Drupal::config('color.theme.mbase')->get('stylesheets');
    if (!empty($color_css_files)) {
      foreach ($color_css_files as $color_css_file) {
        unset($css[$color_css_file]);
      }
    }
    else {
      $default_mbase_color_css = $theme_path . '/css/colors.css';
      unset($css[$default_mbase_color_css]);
    }
  }
  if (!_mbase_setting('bsflatit')) {
    $bsflatit = $theme_path . '/css/flatit.css';
    unset($css[$bsflatit]);
  }
  if (!_mbase_setting('animatecss')) {
    $animatecss = $theme_path . '/css/animate.min.css';
    unset($css[$animatecss]);
  }
}

/**
 * Implements hook_element_info_alter().
 *
 * @todo This currently does not work due to the following issue.
 *
 * @see https://www.drupal.org/node/2390973
 */
function mbase_element_info_alter(&$info) {
  $theme_key = \Drupal::theme()->getActiveTheme()->getName();

  $cid = "theme_registry:mbase:element_info";
  $cached = array();
  if (($cache = \Drupal::cache()->get($cid)) && !empty($cache->data)) {
    $cached = $cache->data;
  }

  $themes = _mbase_get_base_themes($theme_key, TRUE);
  foreach ($themes as $theme) {
    if (!isset($cached[$theme])) {
      $cached[$theme] = array();
      foreach (array_keys($info) as $type) {
        $element = array();

        // Ensure elements that have a base type with the #input set match.
        if (isset($info[$type]['#base_type']) && isset($info[$type][$info[$type]['#base_type']]['#input'])) {
          $element['#input'] = $info[$info[$type]['#base_type']]['#input'];
        }

        // Setup a default "icon" variable. This allows #icon to be passed
        // to every template and theme function.
        // @see https://drupal.org/node/2219965
        $element['#icon'] = NULL;
        $element['#icon_position'] = 'before';

        $properties = array(
          '#process' => array(
            'form_process',
            'form_process_' . $type,
          ),
          '#pre_render' => array(
            'pre_render',
            'pre_render_' . $type,
          ),
        );
        foreach ($properties as $property => $callbacks) {
          foreach ($callbacks as $callback) {
            $function = $theme . '_' . $callback;
            if (function_exists($function)) {
              // Replace direct core function correlation.
              if (!empty($info[$type][$property]) && array_search($callback, $info[$type][$property]) !== FALSE) {
                $element['#bootstrap_replace'][$property][$callback] = $function;
              }
              // Check for a "form_" prefix instead (for #pre_render).
              elseif (!empty($info[$type][$property]) && array_search('form_' . $callback, $info[$type][$property]) !== FALSE) {
                $element['#bootstrap_replace'][$property]['form_' . $callback] = $function;
              }
              // Otherwise, append the function.
              else {
                $element[$property][] = $function;
              }
            }
          }
        }
        $cached[$theme][$type] = $element;
      }

      // Cache the element information.
      \Drupal::cache()->set($cid, $cached);
    }

    // Merge in each theme's cached element info.
    $info = _mbase_element_info_array_merge($info, $cached[$theme]);
  }
}

/**
 * Implements hook_js_alter().
 */
function mbase_js_alter(&$js) {
  $config = \Drupal::config('mbase.settings');

  $theme_path = drupal_get_path('theme', 'mbase');

  // Add Bootstrap JS from CDN.
  $defaultbs_cdn_js = trim(_mbase_setting('addbsjscdn'));
  if (!$defaultbs_cdn_js) {
    $theme_info = \Drupal::service('theme_handler')->listInfo();
    $defaultbs_cdn_js = $theme_info['mbase']->info['bs-cdn-js'];
  }
  $js[$defaultbs_cdn_js] = _mbase_js_alter_array_build($defaultbs_cdn_js, -19.991);

  // Add other CDN JS files.
  $cdn_js_files = explode(PHP_EOL, trim(_mbase_setting('include_cdn_js')));
  $cdn_weight = 100;
  foreach ($cdn_js_files as $cdn_js_file) {
    if (!trim($cdn_js_file)) {
      continue;
    }
    $cdn_weight += .01;
    $js[$cdn_js_file] = _mbase_js_alter_array_build($cdn_js_file, $cdn_weight);
  }

  // Add or replace JavaScript files when matching paths are detected.
  // Replacement files must begin with '_', like '_node.js'.
  // @TODO Move this to yml.
  $files = _mbase_file_scan_directory($theme_path . '/js', '/\.js$/');
  foreach ($files as $file) {
    if ($file->name == 'bootstrap' || $file->name == 'bootstrap.admin') {
      continue;
    }
    $path = str_replace($theme_path . '/js/', '', $file->uri);
    // Detect if this is a replacement file.
    $replace = FALSE;
    if (preg_match('/^[_]/', $file->filename)) {
      $replace = TRUE;
      $path = dirname($path) . '/' . preg_replace('/^[_]/', '', $file->filename);
    }
    $matches = array();
    if (preg_match('/^modules\/([^\/]*)/', $path, $matches)) {
      if (!\Drupal::moduleHandler()->moduleExists($matches[1])) {
        continue;
      }
      else {
        $path = str_replace('modules/' . $matches[1], drupal_get_path('module', $matches[1]), $path);
      }
    }
    // Path should always exist to either add or replace JavaScript file.
    if (!empty($path) && array_key_exists($path, $js)) {
      $mbase_js_defaults = array(
        'type' => 'file',
        'group' => -100,
        'every_page' => FALSE,
        'weight' => 0,
        'scope' => 'footer',
        'cache' => TRUE,
        'preprocess' => TRUE,
        'attributes' => array(),
        'version' => NULL,
        'data' => $file->uri,
        'browsers' => array(),
      );
      // Replace file.
      if ($replace) {
        $js[$file->uri] = $mbase_js_defaults;
        unset($js[$path]);
      }
      // Add file.
      else {
        $js[$file->uri] = $mbase_js_defaults;
      }
    }
  }

  // Exclude specified JavaScript files from theme.
  $excludes = $config->get('mbase_excludes_js');
  if (isset($theme_info['mbase']->info['javascript-remove'])) {
    foreach ($theme_info['mbase']->info['javascript-remove'] as $js_exclude) {
      $excludes[] = $js_exclude;
    }
  }
  if (!empty($excludes)) {
    foreach ($excludes as $exclude) {
      unset($js[$exclude]);
    }
  }
  // Exclude Animation js of not included.
  if (!_mbase_setting('animatecss')) {
    $animatejs = $theme_path . '/js/mbase-animate.js';
    unset($js[$animatejs]);
  }
}

/**
 * Implements hook_theme_suggestions_HOOK_alter().
 */
function mbase_theme_suggestions_input_alter(array &$suggestions, array $variables) {
  if (!empty($variables['element']['#is_button'])) {
    $suggestions[] = 'input__button';
  }
}

/**
 * Implements hook_form_alter().
 */
function mbase_form_alter(&$form, FormStateInterface $form_state, $form_id = NULL) {
  if ($form_id) {

    switch ($form_id) {
      case 'system_theme_settings':
        // Create vertical tabs for global settings (provided by core or other
        // contrib modules).
        if (!isset($form['global'])) {
          $form['global'] = array(
            '#type' => 'vertical_tabs',
            '#weight' => -9,
          );
          if (!empty($form_state->getBuildInfo()['args'])) {
            $form['global']['#prefix'] = '<h2><small>' . t('Override Global Settings') . '</small></h2>';
          }
        }

        // Iterate over all child elements and check to see if they should be
        // moved in the global vertical tabs.
        $global_children = Element::children($form);
        foreach ($global_children as $child) {
          if (isset($form[$child]['#type']) && $form[$child]['#type'] === 'details' && !isset($form[$child]['#group'])) {
            $form[$child]['#group'] = 'global';
          }
        }
        break;

      case 'search_form':
        // Add a clearfix class so the results don't overflow onto the form.
        $form['#attributes']['class'][] = 'clearfix';

        // Remove container-inline from the container classes.
        $form['basic']['#attributes']['class'] = array();

        // Hide the default button from display.
        $form['basic']['submit']['#attributes']['class'][] = 'visually-hidden';
        break;

      case 'search_block_form':
        $form['#attributes']['class'][] = 'form-search';

        $form['keys']['#title'] = '';
        $form['keys']['#placeholder'] = (string) t('Search');

        // Hide the default button from display and implement a theme wrapper
        // to add a submit button containing a search icon directly after the
        // input element.
        $form['actions']['submit']['#attributes']['class'][] = 'visually-hidden';

        // Apply a clearfix so the results don't overflow onto the form.
        $form['#attributes']['class'][] = 'content-search';
        break;

      case 'image_style_edit_form':
        $form['effects']['new']['effect']['data']['new']['#input_group_button'] = TRUE;
        break;

      case 'path_admin_filter_form':
        $form['basic']['filter']['#input_group_button'] = TRUE;
        break;
    }
  }

  // Convert delete links in forms to Bootstrap buttons with delete links.
  // @TODO revisit to see if there's a better place to handle this.
  if (!empty($form['actions']['delete']['#type']) && $form['actions']['delete']['#type'] === 'link') {
    $form['actions']['delete']['#attributes']['class'][] = 'btn';
    if (_mbase_setting('button_colorize')) {
      $form['actions']['delete']['#attributes']['class'][] = 'btn-danger';
    }
    if (_mbase_setting('button_iconize')) {
      $form['actions']['delete']['#options']['html'] = 'true';
      $trash_link = array(
        '#type' => 'item',
        '#markup' => _mbase_icon('trash') . t('Delete'),
      );
      $form['actions']['delete']['#title'] = \Drupal::service('renderer')->render($trash_link);
    }
  }
}

/**
 * Implements hook_js_callback_filter_xss_alter().
 */
function mbase_js_callback_filter_xss_alter(array &$allowed_tags = array()) {
  $allowed_tags[] = 'button';
  $allowed_tags[] = 'span';
}

/**
 * Implements hook_page_attachments_alter().
 */
function mbase_page_attachments_alter(&$variables) {
  $variables['#attached']['drupalSettings'] = array(
    'mbase' => array(
      'anchorsFix' => _mbase_setting('anchors_fix'),
      'anchorsSmoothScrolling' => _mbase_setting('anchors_smooth_scrolling'),
      'formHasError' => (int) _mbase_setting('forms_has_error_value_toggle'),
    ),
  );
  if (!_mbase_setting('animatecss')) {
    $filedata = _mbase_load_file_data();
    $variables['#attached']['drupalSettings']['mbase']['animate'] = $filedata['animate'];
  }
}

/**
 * Implements hook_form_process().
 */
function mbase_form_process($element, &$form_state, &$form) {
  if (!empty($element['#bootstrap_ignore_process'])) {
    return $element;
  }

  if (!empty($element['#attributes']['class']) && is_array($element['#attributes']['class'])) {
    $key = array_search('container-inline', $element['#attributes']['class']);
    if ($key !== FALSE) {
      $element['#attributes']['class'][$key] = 'form-inline';
    }

    if (in_array('form-wrapper', $element['#attributes']['class'])) {
      $element['#attributes']['class'][] = 'form-group';
    }
  }

  // Automatically inject the nearest button found after this element if
  // #input_group_button exists.
  if (!empty($element['#input_group_button'])) {
    // Obtain the parent array to limit search.
    $array_parents = array();
    if (!empty($element['#array_parents'])) {
      $array_parents += $element['#array_parents'];
      // Remove the current element from the array.
      array_pop($array_parents);
    }

    // If element is nested, return the referenced parent from the form.
    if (!empty($array_parents)) {
      $parent = &NestedArray::getValue($form, $array_parents);
    }
    // Otherwise return the complete form.
    else {
      $parent = &$form;
    }

    // Ignore buttons before we find the element in the form.
    $found_current_element = FALSE;
    foreach (Element::children($parent) as $child) {
      if ($parent[$child] === $element) {
        $found_current_element = TRUE;
        continue;
      }

      if ($found_current_element && (_mbase_is_button($parent[$child]) || (is_array($parent[$child]) && _mbase_is_button(current($parent[$child]))))) {
        _mbase_iconize_button($parent[$child]);
        $element['#field_suffix'] = \Drupal::service('renderer')->render($parent[$child]);
        break;
      }
    }
  }

  return $element;
}

/**
 * Implements hook_form_process_HOOK().
 */
function mbase_form_process_actions($element, &$form_state, &$form) {
  $element['#attributes']['class'][] = 'form-actions';
  $element['#attributes']['class'][] = 'form-inline';

  if (!empty($element['#bootstrap_ignore_process'])) {
    return $element;
  }

  foreach (Element::children($element) as $child) {
    _mbase_iconize_button($element[$child]);
  }
  return $element;
}

/**
 * Implements hook_form_process_HOOK().
 */
function mbase_form_process_text_format($element, &$form_state, &$form) {
  if (!empty($element['#bootstrap_ignore_process'])) {
    return $element;
  }

  // Allow the elements inside to be displayed inline.
  $element['format']['#attributes']['class'][] = 'form-inline';

  // Remove the cluttering guidelines; they can be viewed on a separate page.
  $element['format']['guidelines']['#access'] = FALSE;

  // Hide the select label.
  $element['format']['format']['#title_display'] = 'none';

  // Make the select element smaller using a Bootstrap class.
  $element['format']['format']['#attributes']['class'][] = 'input-sm';

  // Support the Bootstrap Select plugin if it is used.
  $element['format']['format']['#attributes']['data-style'] = 'btn-sm btn-default';

  return $element;
}

/**
 * Implements hook_preprocess_region().
 */
function mbase_preprocess_region(&$variables) {
  $region = $variables['elements']['#region'];
  $variables['region'] = $region;
  $variables['content'] = $variables['elements']['#children'];

  $theme = \Drupal::theme()->getActiveTheme()->getName();

  // Content region.
  if ($region === 'content' || $region === 'branding' || $region === 'navigation') {
    // @todo is this actually used properly?
    $variables['theme_hook_suggestions'][] = 'region__no_wrapper';
  }
  // Help region.
  elseif ($region === 'help' && !empty($variables['content'])) {
    $content = $variables['content'];
    $variables['content'] = array(
      'icon' => array(
        '#markup' => _mbase_icon('question-sign'),
      ),
      'content' => array(
        '#markup' => $content,
      ),
    );
    $variables['attributes']['class'][] = 'alert';
    $variables['attributes']['class'][] = 'alert-info';
    $variables['attributes']['class'][] = 'messages';
    $variables['attributes']['class'][] = 'info';
  }

  // Support for "well" classes in regions.
  static $wells;
  if (!isset($wells)) {
    foreach (system_region_list($theme) as $name => $title) {
      $wells[$name] = _mbase_setting('region_well-' . $name);
    }
  }
  if (!empty($wells[$region])) {
    $variables['attributes']['class'][] = $wells[$region];
  }

  // Support for "visibility" classes in regions.
  $breakpoints = array('xs', 'sm', 'md', 'lg');

  static $visibility;
  if (!isset($visibility)) {
    foreach (system_region_list($theme) as $name => $title) {
      foreach ($breakpoints as $breakpoint) {
        $visibility[$name][] = _mbase_setting('region_visibility-' . $name . '-' . $breakpoint);
      }
    }
  }
  if (!empty($visibility[$region])) {
    foreach ($visibility[$region] as $visibility_class) {
      $variables['attributes']['class'][] = $visibility_class;
    }
  }

  // Menu style per region.
  static $menu_style;
  if (!isset($menu_style)) {
    foreach (system_region_list($theme) as $name => $title) {
      $region_menu_style['region_menu_style_orientation'] = _mbase_setting('region_menu_style_orientation_' . $name);
      $region_menu_style['region_menu_child_display'] = _mbase_setting('region_menu_child_display_' . $name);
      $visibility[$name] = $region_menu_style;
    }
  }
  if (!empty($menu_style[$region])) {
    foreach ($menu_style[$region] as $menu_style_class) {
      $variables['attributes']['class'][] = $menu_style_class;
    }
  }

  // For bootstrap component.
  if (trim($region)) {
    $variables['grouped_blocks'] = _mbase_get_region_blocks($region);
    $setting_key = 'region_bscomponent_' . $region;
    $region_component = _mbase_setting($setting_key);
    if ($region_component != '-') {
      $variables['bootstrap_settings'] = _mbase_get_region_bscomponent_settings_cache($region, $region_component, $theme, FALSE);
    }
  }
}

/**
 * Implements hook_theme_suggestions_HOOK_alter().
 */
function mbase_theme_suggestions_region_alter(array &$suggestions, array $variables) {
  $region = isset($variables['elements']['#region']) ? trim($variables['elements']['#region']) : '';
  $region_component = '';
  if ($region) {
    $setting_key = 'region_bscomponent_' . $region;
    $region_component = _mbase_setting($setting_key);
    if ($region_component != '-') {
      $suggestions = array();
      $suggestions[] = 'region__' . $region_component;
    }
  }
}

/**
 * Implements hook_preprocess_block().
 */
function mbase_preprocess_block(&$variables) {
  // Use a bare template for the page's main content.
  if ($variables['plugin_id'] == 'system_main') {
    $variables['theme_hook_suggestions'][] = 'block__no_wrapper';
  }
  $variables['title_attributes']['class'][] = 'block-title';
  $variables['attributes']['class'][] = 'clearfix';
}

/**
 * Overrides theme_file_widget().
 */
function mbase_preprocess_file_widget(&$variables) {
  $element = $variables['element'];

  if (!empty($element['fids']['#value'])) {
    // Add the file size after the file name.
    $file = reset($element['#files']);
    $element['file_' . $file->id()]['filename']['#suffix'] = ' <span class="file-size badge">' . format_size($file->getSize()) . '</span> ';
  }
  // The "form-managed-file" class is required for proper Ajax functionality.
  $variables['attributes'] = array(
    'class' => array(
      'file-widget',
      'form-managed-file',
      'clearfix',
    ),
  );

  $element['upload']['#prefix'] = '<div class="input-group">';
  $element['upload_button']['#prefix'] = '<span class="input-group-btn">';
  $element['upload_button']['#suffix'] = '</span></div>';
  $element['upload_button']['#attributes']['class'] = array('btn', 'btn-primary');
  $variables['element'] = $element;
}

/**
 * Implements hook_preprocess_file_managed_file().
 */
function mbase_preprocess_file_managed_file(&$variables) {
  $file_id = isset($variables['element']['#default_value']['target_id']) ? $variables['element']['#default_value']['target_id'] : 0;
  if ($file_id) {
    $variables['file_id'] = $file_id;
    $variables['file_display'] = $variables['element']['file_' . $file_id];
  }
  // Temp file id.
  else {
    foreach ($variables['element'] as $key => $valuie) {
      if (0 === strpos($key, 'file_')) {
        $variables['file_display'] = $variables['element'][$key];
      }
    }
  }

  $variables['element']['description_title'] = isset($variables['element']['description']['#title']) ? $variables['element']['description']['#title'] : '';
  $variables['element']['description_help'] = isset($variables['element']['description']['#title']) ? $variables['element']['description']['#description'] : '';

  $variables['element']['description']['#title'] = NULL;
  $variables['element']['description']['#description'] = NULL;
}

/**
 * Implements hook_preprocess_file_widget_multiple().
 */
function mbase_preprocess_file_widget_multiple(&$variables) {
  $delta = isset($variables['element']['#file_upload_delta']) ? $variables['element']['#file_upload_delta'] : 0;
  $element = $variables['element'];

  if (isset($element['#file_upload_description']['#markup'])) {
    // @todo Join all the description together.
  }

  // Special ID and classes for draggable tables.
  $weight_class = $element['#id'] . '-weight';
  $table_id = $element['#id'] . '-table';

  // Build up a table of applicable fields.
  $headers = array();

  $headers[] = t('File information');
  $headers[] = t('Preview');
  $headers[] = t('Alternative text');
  $headers[] = t('Image title');
  $headers[] = t('Description');

  if ($element['#display_field']) {
    $headers[] = array(
      'data' => t('Display'),
      'class' => array('checkbox'),
    );
  }

  $headers[] = t('Operations');
  $headers[] = t('Weight');
  // Get our list of widgets in order (needed when the form comes back after
  // preview or failed validation).
  $widgets = array();
  foreach (Element::children($element) as $key) {
    $widgets[] = &$element[$key];
  }
  usort($widgets, '_field_multiple_value_form_sort_helper');

  $rows = array();
  $description_counts = 0;
  $alt_text_counts = 0;
  $image_title_counts = 0;
  $img_preview_counts = 0;
  foreach ($widgets as $key => &$widget) {
    // Save the uploading row for last.
    if (empty($widget['#files'])) {
      $widget['#title'] = $element['#file_upload_title'];
      $widget['#description'] = \Drupal::service('renderer')->renderPlain($element['#file_upload_description']);
      continue;
    }
    // Delay rendering of the buttons, so that they can be rendered later in the
    // "operations" column.
    $operations_elements = array();
    foreach (Element::children($widget) as $sub_key) {
      if (isset($widget[$sub_key]['#type']) && $widget[$sub_key]['#type'] == 'submit') {
        hide($widget[$sub_key]);
        $operations_elements[] = &$widget[$sub_key];
      }
    }
    // Delay rendering of the "Display" option and the weight selector, so that
    // each can be rendered later in its own column.
    if ($element['#display_field']) {
      hide($widget['display']);
    }
    hide($widget['_weight']);

    // Render everything else together in a column, without the normal wrappers.
    $widget['#theme_wrappers'] = array();
    $information = '';
    $file_id = isset($widget['#default_value']['target_id']) ? $widget['#default_value']['target_id'] : 0;
    if ($file_id) {
      $file_id = 'file_' . $file_id;
      $information = drupal_render($widget[$file_id]);
    }
    // Temp file id.
    else {
      foreach ($widget as $widget_key => $valuie) {
        if (0 === strpos($widget_key, 'file_')) {
          $information = drupal_render($widget[$widget_key]);
        }
      }
    }

    $fids = array(
      'data' => render($widget['fids']),
      'class' => array('hidden'),
    );

    $img_preview = '';
    if (isset($widget['preview'])) {
      unset($widget['preview']['#title']);
      unset($widget['preview']['#description']);
      $img_preview = array(
        'data' => render($widget['preview']),
        'class' => array('img-preview'),
      );
      $img_preview_counts++;
    }

    $alternative_text = '';
    if (isset($widget['alt']) && isset($widget['alt']['#access']) && $widget['alt']['#access']) {
      unset($widget['alt']['#title']);
      unset($widget['alt']['#description']);
      $alternative_text = array(
        'data' => render($widget['alt']),
        'class' => array('img-alt-text'),
      );
      $alt_text_counts++;
    }

    // Image Title.
    $image_title_text = '';
    if (isset($widget['title']) && isset($widget['title']['#access']) && $widget['title']['#access']) {
      unset($widget['title']['#title']);
      unset($widget['title']['#description']);
      $image_title_text = array(
        'data' => render($widget['title']),
        'class' => array('img-title-text'),
      );
      $image_title_counts++;
    }

    $display = '';
    if ($element['#display_field']) {
      unset($widget['display']['#title']);
      $display = array(
        'data' => render($widget['display']),
        'class' => array('checkbox'),
      );
    }

    $widget['_weight']['#attributes']['class'] = array($weight_class);
    $weight = render($widget['_weight']);

    $description = '';
    if (isset($widget['description'])) {
      unset($widget['description']['#title']);
      unset($widget['description']['#description']);
      $description = array(
        'data' => render($widget['description']),
        'class' => array('description'),
      );
      $description_counts++;
    }

    // Arrange the row with all of the rendered columns.
    $row = array();

    $row[] = $information;
    // Image preview for image widget.
    if ($img_preview_counts) {
      $row[] = $img_preview;
    }
    // Alt text for image widget.
    if ($alt_text_counts) {
      $row[] = $alternative_text;
    }
    // Image title.
    if ($image_title_counts) {
      $row[] = $image_title_text;
    }

    if ($description_counts) {
      $row[] = $description;
    }

    if ($element['#display_field']) {
      $row[] = $display;
    }

    // Show the buttons that had previously been marked as hidden in this
    // preprocess function. We use show() to undo the earlier hide().
    foreach (Element::children($operations_elements) as $key) {
      show($operations_elements[$key]);
    }
    $row[] = array(
      'data' => $operations_elements,
    );
    $row[] = $weight;
    // Hidden Row.
    $row[] = $fids;
    $rows[] = array(
      'data' => $row,
      'class' => isset($widget['#attributes']['class']) ? array_merge($widget['#attributes']['class'], array('draggable')) : array('draggable'),
    );
  }

  // Hide the image preview in table header for file widget.
  if (!$img_preview_counts) {
    unset($headers[1]);
  }
  // Hide the Alt text table header for file widget.
  if (!$alt_text_counts) {
    unset($headers[2]);
  }

  if (!$image_title_counts) {
    unset($headers[3]);
  }
  // Hide the description table header.
  if (!$description_counts) {
    unset($headers[4]);
  }
  $variables['table'] = array(
    '#type' => 'table',
    '#header' => $headers,
    '#rows' => $rows,
    '#attributes' => array(
      'id' => $table_id,
    ),
    '#tabledrag' => array(
      array(
        'action' => 'order',
        'relationship' => 'sibling',
        'group' => $weight_class,
      ),
    ),
    '#access' => !empty($rows),
  );
  $variables['element'] = $element;
}

/**
 * Implements hook_preprocess_image_widget_multiple().
 */
function mbase_preprocess_image_widget_multiple(&$variables, $test1, $test2) {
  $delta = isset($variables['element']['#file_upload_delta']) ? $variables['element']['#file_upload_delta'] : 0;
  $element = $variables['element'];

  if (isset($element['#file_upload_description']['#markup'])) {
    // @todo Join all the description together.
  }

  // Special ID and classes for draggable tables.
  $weight_class = $element['#id'] . '-weight';
  $table_id = $element['#id'] . '-table';

  // Build up a table of applicable fields.
  $headers = array();

  $headers[] = t('Image information');
  $headers[] = t('Description');

  if ($element['#display_field']) {
    $headers[] = array(
      'data' => t('Display'),
      'class' => array('checkbox'),
    );
  }

  $headers[] = t('Operations');
  $headers[] = t('Weight');
  // Get our list of widgets in order (needed when the form comes back after
  // preview or failed validation).
  $widgets = array();
  foreach (Element::children($element) as $key) {
    $widgets[] = &$element[$key];
  }
  usort($widgets, '_field_multiple_value_form_sort_helper');

  $rows = array();
  $description_counts = 0;
  foreach ($widgets as $key => &$widget) {
    // Save the uploading row for last.
    if (empty($widget['#files'])) {
      $widget['#title'] = $element['#file_upload_title'];
      $widget['#description'] = \Drupal::service('renderer')->renderPlain($element['#file_upload_description']);
      continue;
    }

    // Delay rendering of the buttons, so that they can be rendered later in the
    // "operations" column.
    $operations_elements = array();
    foreach (Element::children($widget) as $sub_key) {
      if (isset($widget[$sub_key]['#type']) && $widget[$sub_key]['#type'] == 'submit') {
        hide($widget[$sub_key]);
        $operations_elements[] = &$widget[$sub_key];
      }
    }

    // Delay rendering of the "Display" option and the weight selector, so that
    // each can be rendered later in its own column.
    if ($element['#display_field']) {
      hide($widget['display']);
    }
    hide($widget['_weight']);

    // Render everything else together in a column, without the normal wrappers.
    $widget['#theme_wrappers'] = array();

    $information = '';
    $file_id = isset($widget['#default_value']['target_id']) ? $widget['#default_value']['target_id'] : 0;
    if ($file_id) {
      $file_id = 'file_' . $file_id;
      $information = drupal_render($widget[$file_id]);
    }
    // Temp file id.
    else {
      foreach ($widget as $widget_key => $valuie) {
        if (0 === strpos($widget_key, 'file_')) {
          $information = drupal_render($widget[$widget_key]);
        }
      }
    }

    $fids = array(
      'data' => render($widget['fids']),
      'class' => array('hidden'),
    );

    $display = '';
    if ($element['#display_field']) {
      unset($widget['display']['#title']);
      $display = array(
        'data' => render($widget['display']),
        'class' => array('checkbox'),
      );
    }

    $widget['_weight']['#attributes']['class'] = array($weight_class);
    $weight = render($widget['_weight']);

    $description = '';
    if (isset($widget['description'])) {
      unset($widget['description']['#title']);
      unset($widget['description']['#description']);
      $description = array(
        'data' => render($widget['description']),
        'class' => array('description'),
      );
      $description_counts++;
    }

    // Arrange the row with all of the rendered columns.
    $row = array();

    $row[] = $information;

    if ($description_counts) {
      $row[] = $description;
    }

    if ($element['#display_field']) {
      $row[] = $display;
    }

    // Show the buttons that had previously been marked as hidden in this
    // preprocess function. We use show() to undo the earlier hide().
    foreach (Element::children($operations_elements) as $key) {
      show($operations_elements[$key]);
    }
    $row[] = array(
      'data' => $operations_elements,
    );
    $row[] = $weight;
    // Hidden row.
    $row[] = $fids;
    $rows[] = array(
      'data' => $row,
      'class' => isset($widget['#attributes']['class']) ? array_merge($widget['#attributes']['class'], array('draggable')) : array('draggable'),
    );
  }
  if (!$description_counts) {
    unset($headers[1]);
  }
  $variables['table'] = array(
    '#type' => 'table',
    '#header' => $headers,
    '#rows' => $rows,
    '#attributes' => array(
      'id' => $table_id,
    ),
    '#tabledrag' => array(
      array(
        'action' => 'order',
        'relationship' => 'sibling',
        'group' => $weight_class,
      ),
    ),
    '#access' => !empty($rows),
  );

  $variables['element'] = $element;
}

/**
 * Implements hook_preprocess_image().
 */
function mbase_preprocess_image(&$variables) {
  // Add image shape, if necessary.
  if ($shape = _mbase_setting('image_shape')) {
    $variables['attributes']['class'][] = $shape;
  }
  // Bootstrap image thumpnail class.
  if ($shape = _mbase_setting('image_thumbnail')) {
    $variables['attributes']['class'][] = 'img-thumbnail';
  }
}

/**
 * Implements hook_preprocess_image_widget().
 */
function mbase_preprocess_image_widget(&$variables) {
  $element = $variables['element'];

  $variables['attributes'] = array(
    'class' => array(
      'image-widget',
      'js-form-managed-file',
      'form-managed-file',
      'clearfix',
      'mbase-file-upload',
    ),
  );
  if (!empty($element['fids']['#value'])) {
    $file = reset($element['#files']);
    $element['file_' . $file->id()]['filename']['#suffix'] = ' <span class="file-size">(' . format_size($file->getSize()) . ')</span> ';
  }
  $variables['data'] = array();
  foreach (Element::children($element) as $child) {
    if ($child == 'alt' || $child == 'title') {
      $element[$child]['#field_prefix'] = $element[$child]['#title'];
      if (isset($element[$child]['#description']) && !empty($element[$child]['#description'])) {
        $desc = '<span class="glyphicon glyphicon-info-sign" aria-hidden="true" data-toggle="tooltip" title="' . $element[$child]['#description'] . '"> </span> ';
        $element[$child]['#field_suffix'] = $desc;
        $element[$child]['#description'] = NULL;
      }
      $element[$child]['#title'] = NULL;
    }
    $variables['data'][$child] = $element[$child];
  }
}

/**
 * Prepares variables for file upload help text templates.
 *
 * Default template: file-upload-help.html.twig.
 */
function mbase_preprocess_file_upload_help(&$variables) {
  $upload_validators = $variables['upload_validators'];
  $cardinality = $variables['cardinality'];
  $descriptions = array();

  if (isset($cardinality)) {
    if ($cardinality == -1) {
      $descriptions[] = t('Unlimited number of files can be uploaded to this field.');
    }
    else {
      $descriptions[] = \Drupal::translation()->formatPlural($cardinality, 'One file only.', 'Maximum @count files.');
    }
  }
  if (isset($upload_validators['file_validate_size'])) {
    $descriptions[] = t('@size limit.', array('@size' => format_size($upload_validators['file_validate_size'][0])));
  }
  if (isset($upload_validators['file_validate_extensions'])) {
    $descriptions[] = t('Allowed types: @extensions.', array('@extensions' => $upload_validators['file_validate_extensions'][0]));
  }

  if (isset($upload_validators['file_validate_image_resolution'])) {
    $max = $upload_validators['file_validate_image_resolution'][0];
    $min = $upload_validators['file_validate_image_resolution'][1];
    if ($min && $max && $min == $max) {
      $descriptions[] = t('Images must be exactly <strong>@size</strong> pixels.', array('@size' => $max));
    }
    elseif ($min && $max) {
      $descriptions[] = t('Images must be larger than <strong>@min</strong> pixels. Images larger than <strong>@max</strong> pixels will be resized.', array('@min' => $min, '@max' => $max));
    }
    elseif ($min) {
      $descriptions[] = t('Images must be larger than <strong>@min</strong> pixels.', array('@min' => $min));
    }
    elseif ($max) {
      $descriptions[] = t('Images larger than <strong>@max</strong> pixels will be resized.', array('@max' => $max));
    }
  }
  $variables['descriptions'] = $descriptions;
}

/**
 * Implements hook_preprocess_picture().
 */
function mbase_preprocess_picture(&$variables) {
  // Add responsiveness, if necessary.
  if (_mbase_setting('image_responsive')) {
    $variables['attributes']['class'][] = 'img-responsive';
  }
}

/**
 * Implements hook_preprocess_image_srcset().
 */
function mbase_preprocess_image_srcset(&$variables) {
  // Add image shape, if necessary.
  if ($shape = _mbase_setting('image_shape')) {
    $variables['attributes']['class'][] = $shape;
  }
  // Bootstrap image thumpnail class.
  if ($shape = _mbase_setting('image_thumbnail')) {
    $variables['attributes']['class'][] = 'img-thumbnail';
  }
}

/**
 * Implements hook_preprocess_links().
 */
function mbase_preprocess_links(&$variables) {
  if (isset($variables['attributes']) && isset($variables['attributes']['class'])) {
    $string = is_string($variables['attributes']['class']);
    if ($string) {
      $variables['attributes']['class'] = explode(' ', $variables['attributes']['class']);
    }

    if ($key = array_search('inline', $variables['attributes']['class'])) {
      $variables['attributes']['class'][$key] = 'list-inline';
    }

    if ($string) {
      $variables['attributes']['class'] = implode(' ', $variables['attributes']['class']);
    }
  }
  foreach ($variables['links'] as $item => &$content) {
    // Convert link to button with icon.
    if (isset($content['link']['#title'])) {
      // Add icon.
      $icon = _mbase_iconize_text($content['link']['#title']);
      $content['link']['#title'] = SafeMarkup::format($icon . '@text', array('@text' => $content['link']['#title']));
      // Make it button.
      $content['link']['#attributes']['class'][] = 'btn';
      $content['link']['#attributes']['class'][] = 'btn-' . _mbase_colorize_text($content['link']['#title'], 'primary');
      $content['link']['#attributes']['class'][] = 'btn-xs';
    }
  }
}

/**
 * Implements hook_preprocess_item_list().
 */
function mbase_preprocess_item_list(&$variables) {
  // Check if the list of user login block.
  if (isset($variables['items']['create_account']) || isset($variables['items']['request_password'])) {
    $variables['attributes']['class'][] = 'list-unstyled';
  }
}

/**
 * Implements hook_preprocess_details().
 */
function mbase_preprocess_details(&$variables) {
  $element = $variables['element'];
  $variables['isgroup'] = 0;
}
