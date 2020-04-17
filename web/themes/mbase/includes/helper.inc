<?php

/**
 * @file
 * helper.inc
 *
 * Contains helper functions for theme.
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
use Symfony\Component\Yaml\Yaml;

/**
 * Retrieves a setting for the current theme or for a given theme.
 *
 * This is a wrapper for theme_get_setting(), ensuring to use deprecated
 * setting values instead.
 *
 * @param string $name
 *   The name of the setting to be retrieved.
 * @param string $theme
 *   The name of a given theme; defaults to the currently active theme.
 * @param string $prefix
 *   The prefix used on the $name of the setting, this will be appended with
 *   "_" automatically if set.
 *
 * @return mixed
 *   The value of the requested setting, NULL if the setting does not exist.
 *
 * @see theme_get_setting()
 */
function _mbase_setting($name, $theme = NULL, $prefix = 'mbase') {
  $prefix = !empty($prefix) ? $prefix . '_' : '';
  $setting = theme_get_setting($prefix . $name, $theme);
  return $setting;
}

/**
 * Same as _mbase_setting but parse array item.
 */
function _mbase_setting_array($name, $theme = NULL, $prefix = 'mbase') {
  $prefix = !empty($prefix) ? $prefix . '_' : '';
  $items = theme_get_setting($prefix . $name, $theme);
  $string = '';
  if (!empty($items)) {
    foreach ($items as $item) {
      $string .= $item . PHP_EOL;
    }
  }
  return $string;
}

/**
 * Helper function for adding the necessary classes to a table.
 *
 * @param array|string $classes
 *   The array of classes, passed by reference.
 * @param array|string $variables
 *   The variables of the theme hook, passed by reference.
 */
function _mbase_table_add_classes(&$classes, &$variables) {
  $context = isset($variables['context']) ? $variables['context'] : NULL;

  // Generic table class for all tables.
  $classes[] = 'table';

  // Bordered table.
  if (!empty($context['bordered']) || _mbase_setting('table_bordered')) {
    $classes[] = 'table-bordered';
  }

  // Condensed table.
  if (!empty($context['condensed']) || _mbase_setting('table_condensed')) {
    $classes[] = 'table-condensed';
  }

  // Hover rows.
  if (!empty($context['hover']) || _mbase_setting('table_hover')) {
    $classes[] = 'table-hover';
  }

  // Striped rows.
  if (!empty($context['striped']) || _mbase_setting('table_striped')) {
    $classes[] = 'table-striped';
  }

  $variables['responsive'] = !empty($context['responsive']) ? $context['responsive'] : _mbase_setting('table_responsive');
}

/**
 * Helper function for determining whether an element is a button.
 *
 * @param array $element
 *   A renderable element.
 *
 * @return bool
 *   TRUE or FALSE.
 */
function _mbase_is_button(array $element) {
  return !empty($element['#type']) &&
    !empty($element['#value']) && (
      $element['#type'] === 'button' ||
      $element['#type'] === 'submit' ||
      $element['#type'] === 'image_button'
    );
}

/**
 * Helper function for adding colors to button elements.
 *
 * @param array $variables
 *   The form variables of the element, passed by reference.
 */
function _mbase_colorize_button(array &$variables) {
  // Do not add the class if one is already present in the array.
  $button_classes = array(
    'btn-default',
    'btn-primary',
    'btn-success',
    'btn-info',
    'btn-warning',
    'btn-danger',
    'btn-link',
  );
  $class_intersection = array_intersect($button_classes, $variables['attributes']['class']);
  if (empty($class_intersection)) {
    // Get the matched class.
    $class = _mbase_setting('button_colorize') ? _mbase_colorize_text($variables['element']['#value']) : FALSE;
    // If no particular class matched, use the default style.
    if (!$class) {
      $class = 'default';
    }
    $variables['attributes']['class'][] = 'btn-' . 'primary';
  }
}

/**
 * Helper function for associating Bootstrap classes based on a string's value.
 *
 * @param string $string
 *   The string to match classes against.
 * @param string $default
 *   The default class to return if no match is found.
 *
 * @return string
 *   The Bootstrap class matched against the value of $haystack or $default if
 *   no match could be made.
 */
function _mbase_colorize_text($string, $default = '') {
  static $texts;
  if (!isset($texts)) {
    $filedata = _mbase_load_file_data();
    $texts = $filedata['textcolor'];
    // Allow sub-themes to alter this array of patterns.
    \Drupal::moduleHandler()->alter('mbase_colorize_text', $texts);
  }
  // Iterate over the array.
  foreach ($texts as $pattern => $strings) {
    foreach ($strings as $class => $values) {
      foreach ($values as $value) {
        switch ($pattern) {
          case 'matches':
            if ($string === $value) {
              return $class;
            }
            break;

          case 'contains':
            if (strpos(Unicode::strtolower($string), Unicode::strtolower($value)) !== FALSE) {
              return $class;
            }
            break;
        }
      }
    }
  }
  return $default;
}

/**
 * Helper function for adding icons to button elements.
 *
 * @param array $element
 *   The form element, passed by reference.
 */
function _mbase_iconize_button(array &$element) {
  if (_mbase_setting('button_iconize') && _mbase_is_button($element) && ($icon = _mbase_iconize_text($element['#value']))) {
    $element['#icon'] = $icon;
  }
}

/**
 * Helper function for associating Bootstrap icons with text.
 *
 * @param string $string
 *   The string to match classes against.
 * @param string $default
 *   The default icon to return if no match is found.
 *
 * @return string
 *   The Bootstrap icon matched against the value of $haystack or $default if
 *   no match could be made.
 */
function _mbase_iconize_text($string, $default = '') {
  static $texts;
  if (!isset($texts)) {
    $filedata = _mbase_load_file_data();
    $texts = $filedata['texticons'];
    // @todo allow sub-themes to alter this array of patterns.
    \Drupal::moduleHandler()->alter('mbase_iconize_text', $texts);
  }

  // Iterate over the array.
  foreach ($texts as $pattern => $strings) {
    if (!empty($strings)) {
      foreach ($strings as $icon => $values) {
        foreach ($values as $value) {
          switch ($pattern) {
            case 'matches':
              if ($string === $value) {
                return _mbase_icon($icon);
              }
              break;

            case 'contains':
              if (strpos(Unicode::strtolower($string), Unicode::strtolower($value)) !== FALSE) {
                return _mbase_icon($icon);
              }
              break;
          }
        }
      }
    }
  }
  // Return a default icon if nothing was matched.
  return _mbase_icon($default);
}

/**
 * Helper function to prerender input fields.
 */
function _mbase_prerender_input(&$variables) {
  $element = $variables['element'];
  $type = $element['#type'];

  // Only add the "form-control" class for specific element input types.
  $types = array(
    // Core.
    'password',
    'password_confirm',
    'select',
    'textfield',
    'machine_name',
    'entity_autocomplete',
    // HTML5.
    'email',
    // Webform module.
    'webform_email',
    'webform_number',
    // Elements module.
    'date',
    'color',
    'email',
    'number',
    'range',
    'search',
    'tel',
    'url',
  );

  if (!empty($type) && (in_array($type, $types) || ($type === 'file' && empty($element['#managed_file'])))) {
    $variables['attributes']['class'][] = 'form-control';
  }
  return $variables;
}

/**
 * Helper function for returning a Icon.
 *
 * @param string $name
 *   The icon name, minus the "glyphicon-" or "fa-" prefix.
 * @param string $icon_provider
 *   (Optional) Icon provider class prefix name, "glyphicon" or "fa".
 * @param string $default
 *   (Optional) The default value to return.
 *
 * @return string
 *   The HTML markup containing the icon defined by $name, $default value if
 *   icon does not exist or returns empty output for whatever reason.
 */
function _mbase_icon($name, $icon_provider = 'glyphicon', $default = NULL) {
  $output = NULL;
  if (_mbase_setting('fontawesome')) {
    $icon_provider = 'fa';
  }
  $filedata = _mbase_load_file_data();
  $icons = array();
  foreach ($filedata['icons'] as $key => $icon) {
    $icons[$icon[$icon_provider]] = $key;
  }

  if (in_array($name, $icons)) {
    // Attempt to use the Icon API module, if enabled and it generates output.
    if (\Drupal::moduleHandler()->moduleExists('icon')) {
      $icon = array(
        '#type' => 'icon',
        '#bundle' => 'bootstrap',
        '#icon' => $icon_provider . '-' . $name,
      );
    }
    else {
      $icon = array(
        '#type' => 'html_tag',
        '#tag' => 'span',
        '#value' => '',
        '#attributes' => array(
          'class' => array('icon', $icon_provider, array_search($name, $icons)),
          'aria-hidden' => 'true',
        ),
      );
    }

    $output = \Drupal::service('renderer')->render($icon);
  }
  return empty($output) && isset($default) ? $default : $output;
}

/**
 * Helper function for retrieving an element attributes array.
 *
 * @param array $element
 *   The individual renderable array element. It is possible to also pass the
 *   $variables parameter in [pre]process functions and it will logically
 *   determine the correct path to that particular theme hook's attribute array.
 *   Passed by reference.
 * @param string $property
 *   Determines which attributes array to retrieve. By default, this is the
 *   normal attributes, but can be "wrapper_attributes" or
 *   "input_group_attributes".
 *
 * @return array
 *   The attributes array. Passed by reference.
 */
function &_mbase_get_attributes(array &$element, $property = 'attributes') {
  // Attempt to retrieve a renderable element attributes first.
  if (
    isset($element['#type']) ||
    isset($element['#theme']) ||
    isset($element['#pre_render']) ||
    isset($element['#markup']) ||
    isset($element['#theme_wrappers']) ||
    isset($element["#$property"])
  ) {
    if (!isset($element["#$property"])) {
      $element["#$property"] = array();
    }
    return $element["#$property"];
  }
  // Treat $element as if it were a [pre]process function $variables parameter
  // and look for a renderable "element".
  elseif (isset($element['element'])) {
    if (!isset($element['element']["#$property"])) {
      $element['element']["#$property"] = array();
    }
    return $element['element']["#$property"];
  }

  // If all else fails, create (if needed) a default "attributes" array. This
  // will, at the very least, either work or cause an error that can be tracked.
  if (!isset($element[$property])) {
    $element[$property] = array();
  }

  return $element[$property];
}

/**
 * Helper function for retrieving an element classes array.
 *
 * @param array $element
 *   The individual renderable array element. It is possible to also pass the
 *   $variables parameter in [pre]process functions and it will logically
 *   determine the correct path to that particular theme hook's classes array.
 *   Passed by reference.
 * @param string $property
 *   Determines which attributes array to retrieve. By default, this is the
 *   normal attributes, but can be "wrapper_attributes" or
 *   "input_group_attributes".
 *
 * @return array
 *   The classes array. Passed by reference.
 */
function &_mbase_get_classes(array &$element, $property = 'attributes') {
  $attributes = &_mbase_get_attributes($element, $property);

  if (!isset($attributes['class'])) {
    $attributes['class'] = array();
  }
  // Contrib modules have a very bad habit of frequently adding classes as
  // strings, convert them to a proper array.
  // @see https://www.drupal.org/node/2269653
  elseif (!is_array($attributes['class'])) {
    $attributes['class'] = explode(' ', $attributes['class']);
  }

  // Ensure classes are not duplicated.
  $attributes['class'] = array_unique($attributes['class']);
  return $attributes['class'];
}

/**
 * Helper function for adding a class to an element.
 *
 * @param string|array $class
 *   An individual class or an array of classes to add.
 * @param array $element
 *   The individual renderable array element. It is possible to also pass the
 *   $variables parameter in [pre]process functions and it will logically
 *   determine the correct path to that particular theme hook's classes array.
 *   Passed by reference.
 * @param string $property
 *   Determines which attributes array to retrieve. By default, this is the
 *   normal attributes, but can be "wrapper_attributes" or
 *   "input_group_attributes".
 */
function _mbase_add_class($class, array &$element, $property = 'attributes') {
  // Retrieve the element's classes.
  $classes = &_mbase_get_classes($element, $property);

  // Convert the class to an array.
  if (!is_array($class)) {
    $class = array($class);
  }

  // Iterate over all classes to add.
  foreach ($class as $_class) {
    // Ensure the class to add does not yet already exist.
    if (!in_array($_class, $classes)) {
      $classes[] = $_class;
    }
  }
}

/**
 * Helper function for removing a class from an element.
 *
 * @param string|array $class
 *   An individual class or an array of classes to remove.
 * @param array $element
 *   The individual renderable array element. It is possible to also pass the
 *   $variables parameter in [pre]process functions and it will logically
 *   determine the correct path to that particular theme hook's classes array.
 *   Passed by reference.
 * @param string $property
 *   Determines which attributes array to retrieve. By default, this is the
 *   normal attributes, but can be "wrapper_attributes" or
 *   "input_group_attributes".
 */
function _mbase_remove_class($class, array &$element, $property = 'attributes') {
  // Retrieve the element's classes.
  $classes = &_mbase_get_classes($element, $property);

  // Convert the class to an array.
  if (!is_array($class)) {
    $class = array($class);
  }

  // Iterate over all classes to add.
  foreach ($class as $_class) {
    $key = array_search($_class, $classes);
    if ($key !== FALSE) {
      unset($classes[$key]);
    }
  }
}

/**
 * Helper function for returning whether a theme is Mbase based.
 *
 * @param string $theme_key
 *   The machine name of the theme to check, if not set the active theme name
 *   will be used.
 * @param bool $include_theme_key
 *   Whether to append the returned list with $theme_key.
 *
 * @return array
 *   An indexed array of base themes.
 */
function _mbase_get_base_themes($theme_key, $include_theme_key = FALSE) {
  static $base_themes;
  if (!isset($base_themes)) {
    $theme_lists = \Drupal::service('theme_handler')->listInfo();
    $base_themes = array();
    if (isset($theme_lists[$theme_key]->base_themes)) {
      foreach ($theme_lists[$theme_key]->base_themes as $key => $name) {
        $base_themes[] = $key;
      }
    }
  }
  if ($include_theme_key) {
    $base_themes[] = $theme_key;
  }
  return $base_themes;
}

/**
 * Helper function that wraps file_scan_directory().
 *
 * Finds all files that match a given mask in a given directory and then caches
 * the results. A general site cache clear will force new scans to be initiated
 * for already cached directories.
 *
 * @param string $dir
 *   The base directory or URI to scan, without trailing slash.
 * @param string $mask
 *   The preg_match() regular expression of the files to find.
 * @param array $options
 *   Additional options to pass to file_scan_directory().
 *
 * @return array
 *   An associative array (keyed on the chosen key) of objects with 'uri',
 *   'filename', and 'name' members corresponding to the matching files.
 *
 * @see file_scan_directory()
 */
function _mbase_file_scan_directory($dir, $mask, array $options = array()) {
  // Retrieve cached data.
  $cid = 'theme_registry:mbase:files';
  $files = array();
  if ($cached = \Drupal::cache()->get($cid)) {
    $files = $cached->data;
  }
  // Generate a unique hash for all parameters passed as a change in any of
  // them would return different results.
  $hash = Crypt::hashBase64(serialize(func_get_args()));
  if (!isset($files[$hash])) {
    $files[$hash] = file_scan_directory($dir, $mask, $options);
    \Drupal::cache()->set($cid, $files);
  }
  return $files[$hash];
}

/**
 * Merges the cached element information into the runtime array.
 *
 * @param array $info
 *   The element info array to merge data into.
 * @param array $cached
 *   The cached element info data array to merge from.
 *
 * @return array
 *   The altered element info array.
 */
function _mbase_element_info_array_merge(array $info, array $cached) {
  foreach ($cached as $type => $element) {
    $replacement_data = isset($element['#bootstrap_replace']) ? $element['#bootstrap_replace'] : array();
    unset($element['#bootstrap_replace']);
    foreach ($element as $property => $data) {
      if (is_array($data)) {
        if (!isset($info[$type][$property])) {
          $info[$type][$property] = array();
        }
        // Append the values if not already in the array.
        foreach ($data as $key => $value) {
          if (!in_array($value, $info[$type][$property])) {
            $info[$type][$property][] = $value;
          }
        }
      }
      // Create the property, if not already set.
      elseif (!isset($info[$type][$property])) {
        $info[$type][$property] = $data;
      }
    }
    // Replace data, if necessary.
    foreach ($replacement_data as $property => $data) {
      if (is_array($data)) {
        foreach ($data as $needle => $replacement) {
          if (!empty($info[$type][$property]) && ($key = array_search($needle, $info[$type][$property])) !== FALSE) {
            $info[$type][$property][$key] = $replacement;
          }
        }
      }
      // Replace the property with the new data.
      else {
        $info[$type][$property] = $data;
      }
    }
  }

  // Return the altered element info array.
  return $info;
}

/**
 * Helper funtion to create CSS array.
 */
function _mbase_css_alter_array_build($link, $weight, $type = 'external') {
  $css = array(
    'data' => $link,
    'type' => $type,
    'every_page' => TRUE,
    'media' => 'all',
    'preprocess' => FALSE,
    'group' => CSS_AGGREGATE_DEFAULT,
    'browsers' => array('IE' => TRUE, '!IE' => TRUE),
    'weight' => $weight,
  );
  return $css;
}

/**
 * Helper funtion to create JS array.
 */
function _mbase_js_alter_array_build($link, $weight, $type = 'external') {
  $js = drupal_js_defaults($link);
  $js['type'] = $type;
  $js['every_page'] = TRUE;
  $js['scope'] = 'footer';
  $js['group'] = -100;
  $js['weight'] = $weight;
  return $js;
}

/**
 * Helper function to load data from YML file if not in cache.
 */
function _mbase_load_file_data() {
  // Use the advanced drupal_static pattern, since this is called very often.
  static $drupal_static_fast;
  if (!isset($drupal_static_fast)) {
    $drupal_static_fast = &drupal_static(__FUNCTION__);
  }
  // Get our static data.
  $data = &$drupal_static_fast;
  $data_types = array('icons', 'textcolor', 'texticons', 'animate');
  $theme_key = \Drupal::theme()->getActiveTheme()->getName();
  $base_themes = array_reverse(_mbase_get_base_themes($theme_key));
  foreach ($data_types as $type) {
    if (!isset($data[$type])) {
      // Retrieve cached data.
      $cid = 'theme_registry:' . $theme_key . ':yml_' . $type;
      if (($cache = \Drupal::cache()->get($cid)) && !empty($cache->data)) {
        $data[$type] = $cache->data;
      }
      else {
        foreach ($base_themes as $base_theme) {
          // Load the data from YML file.
          $data_file = drupal_get_path('theme', $base_theme) . '/config/optional/' . $type . '.yml';
          if (file_exists($data_file)) {
            $data[$type] = Yaml::parse(file_get_contents($data_file));
            // Store our retrived data in the cache.
            \Drupal::cache()->set($cid, $data[$type]);
            break;
          }
        }
      }
    }
  }
  return $data;
}

/**
 * Helper function to load default data for home page content settings.
 */
function _mbase_default_content($region, $theme) {
  $saved = trim(_mbase_setting('section_' . $region . '_code', $theme, NULL));
  if ($saved) {
    return $saved;
  }
  else {
    $filename = drupal_get_path('theme', $theme) . '/assets/html/' . $region . '.txt';
    if (!file_destination($filename, FILE_EXISTS_ERROR)) {
      $file_content = file_get_contents($filename);
      return _mbase_helper_token_replace($file_content, $theme, $token = '<<path-to-theme>>');
    }
    else {
      return '';
    }
  }
}

/**
 * Helper function for child theme theme.settings.php.
 */
function _mbase_homepage_settings($regions, $theme) {
  // List of possible footer regions.
  $footer_regions = array('footer', 'footer_menu', 'footer_menu1',
    'footer_menu2', 'footer_menu3', 'footer_social', 'footer_copyright', 'footer_signup',
  );
  $form['homecontents'] = array(
    '#type' => 'details',
    '#title' => t('Homepage Contents'),
    '#group' => 'mbase',
  );
  foreach ($regions as $name => $title) {
    if (in_array($name, $footer_regions)) {
      $form['footersettings'] = array(
        '#type' => 'details',
        '#title' => t('Footer Contents'),
        '#group' => 'mbase',
      );
      break;
    }
  }

  foreach ($regions as $name => $title) {
    $detail = 'homecontents';
    if (in_array($name, $footer_regions)) {
      $detail = 'footersettings';
    }
    $form[$detail][$name] = array(
      '#type' => 'details',
      '#title' => $title . ' Settings',
      '#collapsible' => FALSE,
    );
    $visibility = 'section_' . $name . '_visibility';
    $form[$detail][$name][$visibility] = array(
      '#type' => 'checkbox',
      '#title' => t('Enable @region', array('@region' => $title)),
      '#default_value' => _mbase_setting($visibility, $theme, NULL),
      '#description' => t('Enable this to display content for @region from below code.', array('@region' => $title)),
    );
    $code = 'section_' . $name . '_code';
    $form[$detail][$name][$code] = array(
      '#type' => 'textarea',
      '#title' => t('Code for home page @region region', array('@region' => $title)),
      '#default_value' => _mbase_default_content($name, $theme),
      '#description' => t('Enter the code for @region region in home page. Empty this field will refill the default code.', array('@region' => $title)),
    );
  }
  return $form;
}

/**
 * Theme token replace.
 */
function _mbase_helper_token_replace($string, $theme, $token = '<<path-to-theme>>') {
  $replace = base_path() . drupal_get_path('theme', $theme);
  return str_replace($token, $replace, $string);
}

/**
 * Helper function to render home blocks of cmsbots.com generated themes.
 */
function _mbase_smart_render($regions, $theme) {
  $snippet = array();
  $allowed_tags = Xss::getAdminTagList();
  $extra_tags = array('form', 'input', 'iframe', 'i', 'button');
  $allowed_tags = array_merge($allowed_tags, $extra_tags);
  foreach ($regions as $region) {
    $region_visibility = _mbase_setting('section_' . $region . '_visibility', $theme, NULL);
    if ($region_visibility) {
      $content = _mbase_default_content($region, $theme);
      if (trim($content)) {
        $snippet[$region]['#markup'] = $content;
        $snippet[$region]['#allowed_tags'] = $allowed_tags;
      }
    }
  }
  return $snippet;
}

/**
 * Comparison function for menu sort.
 */
function _mbase_weight_compare(&$a, &$b) {
  if ($a['weight'] == $b['weight']) {
    return 0;
  }
  return ($a['weight'] < $b['weight']) ? -1 : 1;
}

/**
 * Alter the Menu tree array, add few stuffs like description. More to come.
 */
function _mbase_menu_items_alter(&$items, $show_desc = 0, $hide_orphan = 0, $isparent = 1) {
  foreach ($items as $key => &$item) {
    if ($hide_orphan && !$item['original_link']->hasChildren && count($item['below']) == 0 && $isparent) {
      unset($items[$key]);
      continue;
    }
    $item['weight'] = $item['original_link']->getWeight();
    $desc = $item['original_link']->getDescription();
    if ($show_desc) {
      $item['descrip'] = $desc ? $desc : FALSE;
    }
    $item['menulink'] = $item['original_link']->getUrlObject()->toString();
    if (count($item['below'])) {
      _mbase_menu_items_alter($item['below'], $show_desc, $hide_orphan, 0);
      uasort($item['below'], "_mbase_weight_compare");
    }
  }
}

/**
 * Cache the menu tree data, for performance.
 */
function _mbase_get_cached_menu_tree($menu_name = 'main', $theme = "mbase", $show_desc = 0, $hide_orphan = 0) {
  $cid = $theme . '_menu_' . $menu_name . ':';

  $data = NULL;
  if ($cache = \Drupal::cache()->get($cid)) {
    $data = $cache->data;
  }
  else {
    $data = _mbase_menu_items_alter($menu_name, $show_desc, $hide_orphan);
    \Drupal::cache()->set($cid, $data);
  }
  return $data;
}

/**
 * Get all the blocks of given region.
 */
function _mbase_get_region_blocks($region, $theme = 'mbase') {
  $blocks = entity_load_multiple_by_properties('block', array('theme' => $theme, 'region' => $region));
  uasort($blocks, 'Drupal\block\Entity\Block::sort');
  $return = array();
  $weight = 0;
  foreach ($blocks as $key => $block) {
    if ($block->access('view')) {
      $return[$weight]['key'] = $key;
      $return[$weight]['title'] = $block->label();
      $return[$weight]['body'] = entity_view($block, 'block');
      $return[$weight]['weight'] = $weight;
      $weight++;
    }
  }
  return $return;
}

/**
 * Cachable verson if the function _mbase_get_region_bscomponent_settings().
 */
function _mbase_get_region_bscomponent_settings_cache($region, $component, $theme = 'mbase', $cache = TRUE) {
  $key_prefix = 'mbase_region_bs_component_' . $region . '_' . $component;
  $key = $theme . '.' . $key_prefix;
  $cid = 'mbase_' . $key;
  $data = NULL;
  if ($cache = \Drupal::cache()->get($cid) && $cache) {
    $data = $cache->data;
  }
  else {
    $settings = _mbase_settings_all($theme);
    $form = _mbase_get_bs_components_form_settings();
    $data = _mbase_get_region_bscomponent_settings($region, $component, $settings, $form, $theme);
    \Drupal::cache()->set($cid, $data);
  }
  return $data;
}

/**
 * Get the bootstrap component settings per region.
 */
function _mbase_get_region_bscomponent_settings($region, $component, &$settings, &$form, $theme = 'mbase') {
  $key_prefix = 'mbase_region_bs_component_' . $region . '_' . $component . '_';
  $output = array();
  $allowed_tags = array('div', 'i');
  if ($settings && count($settings)) {

    foreach ($settings as $key => $value) {
      if (substr($key, 0, strlen($key_prefix)) === $key_prefix) {
        $twig_var = str_replace($key_prefix, '', $key);
        if (trim($twig_var)) {
          if (isset($form[$component]) && isset($form[$component]['form']) && isset($form[$component]['form'][$twig_var])) {
            // If 'select' store the data directly.
            if ($form[$component]['form'][$twig_var]['#type'] === 'select') {
              $output[$twig_var] = trim($value) ? trim($value) : $form[$component]['form'][$twig_var]['_default'];
            }
            // If it is text field, Still follow the same like select.
            if ($form[$component]['form'][$twig_var]['#type'] === 'textfield') {
              $output[$twig_var] = trim($value) ? trim($value) : $form[$component]['form'][$twig_var]['_default'];
            }
            // If textarea, process the data for block deltas.
            if ($form[$component]['form'][$twig_var]['#type'] === 'textarea') {
              $textarea_settings = array();
              $textarea_settings_default = $form[$component]['form'][$twig_var]['_default'];
              $textarea = trim($value) ? trim($value) : '';
              $delta_settings = explode(PHP_EOL, $textarea);
              if (!trim($delta_settings[0])) {
                $delta_settings = array($textarea_settings_default);
                return 'first';
              }
              else {
                $delta_settings = array_merge(array($textarea_settings_default), $delta_settings);
              }
              foreach ($delta_settings as $delta_setting) {
                $delta_setting = trim($delta_setting);
                $delta_setting_key_value = explode('|', $delta_setting);
                $delta_setting_key = NULL;
                $delta_setting_value = NULL;
                if ($delta_setting_key_value && isset($delta_setting_key_value[0])) {
                  $delta_setting_key = intval(trim($delta_setting_key_value[0]));
                }
                if ($delta_setting_key_value && isset($delta_setting_key_value[1])) {
                  $delta_setting_value = trim($delta_setting_key_value[1]);
                }
                if ($delta_setting_value) {
                  $textarea_settings[$delta_setting_key] = $delta_setting_value;
                }
              }
              if ($component === 'bstimeline') {
                foreach ($textarea_settings as $ts_key => $ts_value) {
                  $textarea_settings[$ts_key] = '';
                  $textarea_settings[$ts_key]['#markup'] = $ts_value;
                  $textarea_settings[$ts_key]['#allowed_tags'] = $allowed_tags;
                }
              }
              $output[$twig_var] = $textarea_settings;
            }
          }
        }
      }
    }
  }
  return $output;
}

/**
 * Get whole theme settings using config.
 */
function _mbase_settings_all($theme = 'mbase') {
  $key = $theme . '.settings';
  $cid = 'mbase_' . $key;
  $data = NULL;
  if ($cache = \Drupal::cache()->get($cid)) {
    $data = $cache->data;
  }
  else {
    $data = \Drupal::config($key)->getOriginal();
    \Drupal::cache()->set($cid, $data);
  }
  return $data;
}

/**
 * Get the list of all bootstrap components as array.
 */
function _mbase_get_bs_components() {
  $components = array(
    '-' => t('--Default Block Style--'),
    'bspanel' => t('Bootstrap Panel'),
    // Add this later 'bsscrollspy' => t('Bootstrap ScrollSpy'),.
    'bsjumbotron' => t('Bootstrap Jumbotron'),
    'bstimeline' => t('Bootstrap Timeline'),
    'bslistgroups' => t('Bootstrap List Groups'),
    'bsmodal' => t('Bootstrap Modal'),
    'bsnavtab' => t('Bootstrap Nav Tabs'),
    'bscarousel' => t('Bootstrap Carousel'),
    'bsaccordion' => t('Bootstrap Accordion'),
    'bspopover' => t('Bootstrap Popover'),
  );
  return $components;
}

/**
 * Get the list of all bootstrap components settings as form array.
 */
function _mbase_get_bs_components_form_settings() {

  $settings = array();
  $settings['bspanel'] = array();
  $settings['bspanel']['form'] = array();
  $settings['bspanel']['form']['panel_class'] = array(
    '#type' => 'textarea',
    '#title' => t('Bootstrap Panel Class(es).'),
    '#description' => t("Enter the bootstrap panel classes, refer bootstrap 3 components, default is panel-default"),
    '_default' => '-1|panel-default',
    '#required' => FALSE,
    '#description' => t("Enter panel class for per item(block delta). Example <strong>0|panel-default</strong> will render the first block with Default panel style. Use -1 to apply for all blocks. Seperated by comma"),
  );
  // Panel header color, size.
  $settings['bsscrollspy'] = array();
  // Navbar style : verticle or horizontal.
  $settings['bsscrollspy']['form'] = array();
  $settings['bsscrollspy']['form']['offset'] = array(
    '#type' => 'textfield',
    '#title' => t('Bootstrap Scrollspy Offset.'),
    '#description' => t("Enter the bootstrap Scrollspy offset, default is 50"),
    '_default' => '50',
    '#required' => FALSE,
  );
  $settings['bsscrollspy']['form']['verticle'] = array(
    '#type' => 'select',
    '#options' => array(
      'true' => 'true',
      'false' => 'false',
    ),
    '#title' => t('Show the block titles verticle'),
    '#description' => t('Whether Bootstrap scrollspy titles should display verticle using nav-stacked class, default false'),
    '_default' => 'false',
  );

  $settings['bsjumbotron'] = array();

  $settings['bstimeline'] = array();
  $settings['bstimeline']['form'] = array();
  $settings['bstimeline']['form']['icons'] = array(
    '#type' => 'textarea',
    '#title' => t('Bootstrap timeline icons.'),
    '#description' => t("Enter class for icon per item(block delta). Example <strong>DELTA|HTML</strong> will render the first block with Edit font awesome icon. Use -1 to apply for all blocks. Seperated by comma"),
    '_default' => '-1|<div class="timeline-badge success"><i class="fa fa-star" aria-hidden="true"></i></div>',
    '#required' => FALSE,
  );

  $settings['bslistgroups'] = array();
  $settings['bslistgroups']['form'] = array();
  $settings['bslistgroups']['form']['colorclass'] = array(
    '#type' => 'textarea',
    '#title' => t('Bootstrap listgroups Items color.'),
    '#description' => t("Enter listgroups item(block delta) background color class. Example <strong>0|list-group-item-success</strong> will render the first block with green background. Use -1 to apply for all blocks. Seperated by comma"),
    '_default' => '-1|list-group-item-info',
    '#required' => FALSE,
  );

  $settings['bsmodal'] = array();
  $settings['bsmodal']['form'] = array();
  $settings['bsmodal']['form']['triggerstyle'] = array(
    '#type' => 'select',
    '#title' => t('Select the button style'),
    '#description' => t('Select the button style of modal triggers. Or you can hide the trigger buttons'),
    '#options' => array(
      'hide' => t('Hide'),
      'dropdownmenu' => t('Dropdown menu'),
      'btngrp' => t('Button Group'),
    ),
    '_default' => 'btngrp',
  );
  $settings['bsmodal']['form']['dropdowntext'] = array(
    '#type' => 'textfield',
    '#title' => t('Trigger button text for dropdown style.'),
    '#description' => t("Enter the text to display on the trigger dropdown menu"),
    '_default' => 'Click',
    '#required' => FALSE,
  );
  $settings['bsmodal']['form']['dropdownstyle'] = array(
    '#type' => 'textfield',
    '#title' => t('Trigger button text for dropdown style.'),
    '#description' => t("Enter the class for trigger dropdown menu"),
    '_default' => 'btn-primary',
    '#required' => FALSE,
  );
  $settings['bsmodal']['form']['buttongroupstyle'] = array(
    '#type' => 'textfield',
    '#title' => t('Trigger button Group style.'),
    '#description' => t("Enter the class for button groups. Eg: btn-group-lg, btn-group-vertical, btn-group-justified"),
    '_default' => 'btn-group-justified',
    '#required' => FALSE,
  );
  $settings['bsmodal']['form']['buttonstyles'] = array(
    '#type' => 'textarea',
    '#title' => t('Bootstrap Model trigger button color and size.'),
    '#description' => t("Enter button color class and size class seperated by | symbol, first item should be block delta. Example <strong>0|btn-success btn-sm</strong> will render the first button small and green color. Use -1 to apply for all blocks. Seperated deltas by comma"),
    '_default' => '-1|btn-success btn-sm',
    '#required' => FALSE,
  );
  $settings['bsmodal']['form']['modalstyles'] = array(
    '#type' => 'textarea',
    '#title' => t('Bootstrap Model Styles and classes.'),
    '#description' => t("Enter modal class and extra class seperated by | symbol, first item should be block delta. Example <strong>0|modal-lg </strong> will render the first modal Large. Use -1 to apply for all blocks. Seperated deltas by new line"),
    '_default' => '-1|modal-lg',
    '#required' => FALSE,
  );

  $settings['bsnavtab'] = array();
  $settings['bsnavtab']['form']['verticle'] = array(
    '#title' => t('Show the block titles verticle'),
    '#type' => 'select',
    '#options' => array(
      'true' => 'true',
      'false' => 'false',
    ),
    '#description' => t('Whether Bootstrap nav pill titles should display verticle using nav-stacked class, default false'),
    '_default' => 'false',
  );
  $settings['bsnavtab']['form']['animateclass'] = array(
    '#type' => 'textfield',
    '#title' => t('Bootstrap animate class.'),
    '#description' => t("Enter the bootstrap animate class, default is fade"),
    '_default' => 'fade',
    '#required' => FALSE,
  );

  $settings['bscarousel'] = array();
  $settings['bscarousel']['form'] = array();
  $settings['bscarousel']['form']['interval'] = array(
    '#type' => 'textfield',
    '#title' => t('Bootstrap carousel Intervel'),
    '#description' => t("The amount of time to delay between automatically cycling an item. If false, carousel will not automatically cycle. Default 5000 milliseconds"),
    '_default' => '5000',
    '#required' => FALSE,
  );
  $settings['bscarousel']['form']['pause'] = array(
    '#type' => 'textfield',
    '#title' => t('Bootstrap carousel Pause method'),
    '#description' => t('If set to "hover", pauses the cycling of the carousel on mouseenter and resumes the cycling of the carousel on mouseleave. If set to null, hovering over the carousel wont pause it.'),
    '_default' => 'hover',
    '#required' => FALSE,
  );
  $settings['bscarousel']['form']['wrap'] = array(
    '#type' => 'textfield',
    '#title' => t('Bootstrap carousel wrap'),
    '#description' => t('Whether the carousel should cycle continuously or have hard stops. true or false'),
    '_default' => 'true',
    '#required' => FALSE,
  );
  $settings['bscarousel']['form']['keyboard'] = array(
    '#type' => 'textfield',
    '#title' => t('Bootstrap carousel enable keyboard'),
    '#description' => t('Whether the carousel should react to keyboard events. true or false'),
    '_default' => 'true',
    '#required' => FALSE,
  );
  $settings['bscarousel']['form']['minheight'] = array(
    '#type' => 'textfield',
    '#title' => t('Bootstrap carousel minimum height'),
    '#description' => t('Set the minimum height for this region. With unit, example 250px'),
    '_default' => '250px',
    '#required' => FALSE,
  );
  $settings['bscarousel']['form']['maxheight'] = array(
    '#type' => 'textfield',
    '#title' => t('Bootstrap carousel maximum height'),
    '#description' => t('Set the maximum height for this region. With unit, example 350px'),
    '_default' => '350px',
    '#required' => FALSE,
  );
  $settings['bscarousel']['form']['showarrows'] = array(
    '#type' => 'select',
    '#options' => array(
      'true' => 'true',
      'false' => 'false',
    ),
    '#title' => t('Show the arrow keys on both side'),
    '#description' => t('Whether carousal arrows to be shown, default yes'),
    '_default' => 'true',
  );
  $settings['bscarousel']['form']['shownavs'] = array(
    '#type' => 'select',
    '#options' => array(
      'true' => 'true',
      'false' => 'false',
    ),
    '#title' => t('Show the carousel navigations'),
    '#description' => t('Whether carousal navigations to be shown, default yes'),
    '_default' => 'true',
  );

  $settings['bsaccordion'] = array();
  $settings['bsaccordion']['form'] = array();
  $settings['bsaccordion']['form']['allcollapsed'] = array(
    '#type' => 'select',
    '#options' => array(
      'true' => 'true',
      'false' => 'false',
    ),
    '#title' => t('Collapse All'),
    '#description' => t('Collapse all items by default'),
    '_default' => 'false',
  );
  $settings['bsaccordion']['form']['panel_class'] = array(
    '#title' => t('Bootstrap Panel Class(es) for accordion.'),
    '#type' => 'textarea',
    '#description' => t("Enter the bootstrap panel classes, refer bootstrap 3 components, default is panel-default"),
    '_default' => '-1|panel-default',
    '#required' => FALSE,
    '#description' => t("Enter panel class for per item(block delta). Example <strong>0|panel-default</strong> will render the first block with Default panel style. Use -1 to apply for all blocks. Seperated by new line"),
  );

  $settings['bspopover'] = array();
  $settings['bspopover']['form'] = array();
  $settings['bspopover']['form']['animation'] = array(
    '#type' => 'select',
    '#options' => array(
      'true' => 'true',
      'false' => 'false',
    ),
    '#title' => t('Animate popover'),
    '#description' => t('Apply a CSS fade transition to the popover'),
    '_default' => 'true',
  );
  $settings['bspopover']['form']['buttongroupstyle'] = array(
    '#type' => 'textfield',
    '#title' => t('Button Group style'),
    '#description' => t("Button Group style for popover triggers. Eg: btn-group-lg, btn-group-vertical, btn-group-justified"),
    '_default' => 'btn-group-justified',
    '#required' => FALSE,
  );
  $settings['bspopover']['form']['container'] = array(
    '#type' => 'textfield',
    '#title' => t('Container'),
    '#description' => t("Appends the popover to a specific element. Example: container: 'body'. This option is particularly useful in that it allows you to position the popover in the flow of the document near the triggering element - which will prevent the popover from floating away from the triggering element during a window resize."),
    '_default' => 'body',
    '#required' => FALSE,
  );
  $settings['bspopover']['form']['placement'] = array(
    '#type' => 'textfield',
    '#title' => t('Placement'),
    '#description' => t("Placement of the popover, see the bootstrap document."),
    '_default' => 'auto right',
    '#required' => FALSE,
  );
  $settings['bspopover']['form']['trigger'] = array(
    '#type' => 'textfield',
    '#title' => t('Trigger'),
    '#description' => t("How popover is triggered - click | hover | focus | manual. You may pass multiple triggers; separate them with a space. manual cannot be combined with any other trigger."),
    '_default' => 'hover',
    '#required' => FALSE,
  );
  $settings['bspopover']['form']['buttonstyles'] = array(
    '#type' => 'textarea',
    '#title' => t('Bootstrap popover trigger button color and size.'),
    '#description' => t("Enter button color class and size class seperated by | symbol, first item should be block delta. Example <strong>0|btn-success btn-sm</strong> will render the first button small and green color. Use -1 to apply for all blocks. Seperated deltas by new line"),
    '_default' => '-1|btn-success btn-sm',
    '#required' => FALSE,
  );
  return $settings;
}
