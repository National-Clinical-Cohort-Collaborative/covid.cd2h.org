<?php

/**
 * @file
 * Lists available colors and color schemes for the Mbase theme.
 */

use Symfony\Component\Yaml\Yaml;

$info = array();

$color_file = dirname(__FILE__) . '/color.yml';
$info = Yaml::parse(file_get_contents($color_file));

// CSS files (excluding @import) to rewrite with new color scheme.
$info['css'] = array('css/colors.css');

// Files to copy.
$info['copy'] = array('logo.svg');

// Gradient definitions.
$info['gradients'] = array();

// Preview files.
$info['preview_library'] = 'mbase/color.preview';
$info['preview_html'] = 'color/preview.html';

// Put the logo path into JavaScript for the live preview.
$info['#attached']['drupalSettings']['color']['logo'] = theme_get_setting('logo.url', 'mbase');
