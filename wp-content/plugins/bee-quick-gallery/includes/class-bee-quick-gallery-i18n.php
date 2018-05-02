<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://beescripts.com
 * @since      1.0.0
 *
 * @package    Bee_Quick_Gallery
 * @subpackage Bee_Quick_Gallery/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Bee_Quick_Gallery
 * @subpackage Bee_Quick_Gallery/includes
 * @author     aumsrini <seenu.ceo@gmail.com>
 */
class Bee_Quick_Gallery_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'bee-quick-gallery',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
