<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://beescripts.com
 * @since             1.0.0
 * @package           Bee_Quick_Gallery
 *
 * @wordpress-plugin
 * Plugin Name:       Bee Quick Gallery
 * Plugin URI:        http://beescripts.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            aumsrini
 * Author URI:        http://beescripts.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bee-quick-gallery
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bee-quick-gallery-activator.php
 */
function activate_bee_quick_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bee-quick-gallery-activator.php';
	Bee_Quick_Gallery_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bee-quick-gallery-deactivator.php
 */
function deactivate_bee_quick_gallery() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bee-quick-gallery-deactivator.php';
	Bee_Quick_Gallery_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bee_quick_gallery' );
register_deactivation_hook( __FILE__, 'deactivate_bee_quick_gallery' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bee-quick-gallery.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bee_quick_gallery() {

	$plugin = new Bee_Quick_Gallery();
	$plugin->run();

}
run_bee_quick_gallery();

if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'ABSPATH' ) ) exit; 

if ( ! class_exists( 'RW_Meta_Box' ) )
   { 
	require_once plugin_dir_path( __FILE__ ) . 'includes/framework/meta-box.php'; // Path to the plugin's main file

	
	}
	
if ( ! class_exists( 'MB_Columns' ) )
{
	require_once  plugin_dir_path( __FILE__ ) . 'includes/framework/extn/meta-box-columns/meta-box-columns.php'; // Path to the extension's main file
	}
	
	if ( ! function_exists( 'mb_settings_page_load' ) ) {
		require_once  plugin_dir_path( __FILE__ ) . 'includes/framework/extn/mb-settings-page/mb-settings-page.php';
	}
	
	if ( ! class_exists( 'RWMB_Group' ) ) {
	require_once  plugin_dir_path( __FILE__ ) . 'includes/framework/extn/meta-box-group/meta-box-group.php'; // Path to the extension's main file
	}
	
	if ( ! class_exists( 'MB_Tabs' ) )
{	
	require_once  plugin_dir_path( __FILE__ ) . 'includes/framework/extn/meta-box-tabs/meta-box-tabs.php'; // Path to the extension's main file
	
	}

	require_once  plugin_dir_path( __FILE__ ) . 'includes/bee-quick-gallery-functions.php';
	

		
		
	