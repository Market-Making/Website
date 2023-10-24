<?php
/**
 * Plugin Name: Geekfolio Theme Addons
 * Plugin URI: http://themeforest.net/user/themescamp/portfolio
 * Description: This is plugin bundle for Geekfolio WordPress Theme.
 * Author: themesCamp
 * Author URI: https://themeforest.net/user/themescamp
 * Version: 1.0.6
 * Text Domain: geekfolio_plg
 * Domain Path: /lang
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'GEEKFOLIO__FILE__', __FILE__ );
define( 'GEEKFOLIO_URL', plugins_url( '/', GEEKFOLIO__FILE__ ) );
define( 'GEEKFOLIO_PLUGIN_BASE', plugin_basename( GEEKFOLIO__FILE__ ) );


/**
 * Load Hello World
 *
 * Load the plugin after Elementor (and other plugins) are loaded.
 *
 * @since 1.0.1
 */
function geekfolio_plg_load() {
	// Load localization file
	load_plugin_textdomain( 'geekfolio_plg' );

	// Require the main plugin file 
	require( __DIR__ . '/plugin.php' );

}
add_action( 'plugins_loaded','geekfolio_plg_load' );


function geekfolio_plg_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Geekfolio Plugin is not working because you are using an old version of Elementor.', 'geekfolio_plg' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'geekfolio_plg' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}


//adding reduxoptions into themes
/**
 * Optional: set 'ot_show_pages' filter to false.
 * This will hide the settings & documentation pages.
 */
add_filter( 'ot_show_pages', '__return_false' );
	/**
 * Optional: set 'ot_show_new_layout' filter to false.
 * This will hide the "New Layout" section on the Theme Options page.
 */
add_filter( 'ot_show_new_layout', '__return_false' );


//==============================================Theme Enhancement============================================

// Remove the calculated image sizes
add_filter( 'wp_calculate_image_sizes', '__return_false' );


// Remove iframe obsolete attribute
function geekfolio_remove_iframe_attributes($content){
    return str_replace(array('<iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"', '</iframe>'), array('<iframe ', '</iframe>'), $content);
}
add_filter('the_content', 'geekfolio_remove_iframe_attributes');

// Remove noscript obsolete attribute
function geekfolio_remove_noscript_attributes($content){
    return str_replace(array('<noscript><img'), array('<img'), $content);
}
add_filter('the_content', 'geekfolio_remove_noscript_attributes');


// Remove font-display from the header
function geekfolio_start_wp_head_buffer()
{
    ob_start();
}
function geekfolio_end_wp_head_buffer()
{
    $head_content = ob_get_clean();
    $head_content = str_replace('font-display:swap;', '', $head_content);

    echo $head_content;
}
add_action('wp_head', 'geekfolio_start_wp_head_buffer', 0);
add_action('wp_head', 'geekfolio_end_wp_head_buffer', PHP_INT_MAX);

//--------------------------------------------------------------------------------------------


//include elementor addon
include('inc/elementor-addon.php');

//include elementor addon
include('inc/elemntor-extras.php');

//include portfolio custom post type,metaboxes & single portfolio script
include('inc/portfolio.php');
include('inc/portfolio-metaboxes.php');

//include page metabox
include('inc/page-metaboxes.php');

//include post metabox
include('inc/post-metaboxes.php');
include('meta-box/meta-box.php');

//include custom footer
include('inc/footer.php');

//include custom header
include('inc/header.php');

//include side panel
include('inc/side-panel.php');

//include admin custom script 
include('inc/admin-script.php');

//include single portfolio function
include('inc/single-portfolio.php');


//included newsletter widget
include('inc/newsletter.php');

//included custom widget
include('inc/about-us.php');

//included recent posts widget
include('inc/recent-posts.php');

//included sharing
include('inc/sharebox.php');

//included User roles
include('inc/user-roles.php');

//included one click importer
include('inc/one-click.php');

//included shortcode importer
include('inc/shortcode.php');

//included breadcrumbs
include('inc/breadcrumbs.php');

//included tc-element-kit
include('tc-element-kit/tc-element-kit.php');

function geekfolio_admin_styles() {
  wp_enqueue_style('admin-styles', GEEKFOLIO_URL.'inc/css/admin.css');
  wp_enqueue_style('geekfolio-admin-collection-styles', GEEKFOLIO_URL.'assets/css/geekfolio-elementor-iframe.css');
}
add_action('admin_enqueue_scripts', 'geekfolio_admin_styles');


//plugin translation
function geekfolio_textdomain_translation() {
    load_plugin_textdomain('geekfolio_plg', false, dirname(plugin_basename(__FILE__)) . '/lang/');
} // end custom_theme_setup
add_action('after_setup_theme', 'geekfolio_textdomain_translation');

