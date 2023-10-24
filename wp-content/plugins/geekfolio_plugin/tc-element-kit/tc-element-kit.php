<?php

/**
 * Plugin Name: TC Element Kit
 * Description: The all-new Element Kit brings incredibly advanced, and super-flexible widgets, and A to Z essential addons to the Elementor page builder for WordPress. Explore expertly-coded widgets with first-class support by experts.
 * Version: 1.0.0
 * Text Domain: tcl-element-kit
 * Domain Path: /languages
 * License: GPL3
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.14.1
 */

// Some pre defined value for easy use
define('TCEK_VER', '5.2.0');
define('TCEK_TPL_DB_VER', '1.0.0');
define('TCEK__FILE__', __FILE__);
define('TCEK_TITLE', 'Element Kit');
define('TCEK_PNAME', basename(dirname(TCEK__FILE__)));
define('TCEK_PBNAME', plugin_basename(TCEK__FILE__));
define('TCEK_PATH', plugin_dir_path(TCEK__FILE__));
define('TCEK_URL', plugins_url('/', TCEK__FILE__));
define('TCEK_INC_PATH', TCEK_PATH . 'includes/');

function tc_Element_Kit_load_plugin() {
	require_once(TCEK_PATH . 'loader.php');
}
add_action('plugins_loaded', 'tc_Element_Kit_load_plugin', 9);




