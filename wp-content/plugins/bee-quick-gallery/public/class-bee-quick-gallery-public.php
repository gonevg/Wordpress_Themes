<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://beescripts.com
 * @since      1.0.0
 *
 * @package    Bee_Quick_Gallery
 * @subpackage Bee_Quick_Gallery/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bee_Quick_Gallery
 * @subpackage Bee_Quick_Gallery/public
 * @author     aumsrini <seenu.ceo@gmail.com>
 */
class Bee_Quick_Gallery_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bee_Quick_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bee_Quick_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bee-quick-gallery-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bee_Quick_Gallery_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bee_Quick_Gallery_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script('modern', plugin_dir_url( __FILE__ ) . 'js/modernizr.custom.js', array( 'jquery' ), '', false );
		

	}
	
}

	
	
	function bee_quick_gallery_scripts() {
    wp_enqueue_script( 'bee-quick-js', plugin_dir_url( __FILE__ ) . 'js/bee-quick-gallery-public.js', array('jquery'), false,  true);
	wp_enqueue_script( 'bee-classie', plugin_dir_url( __FILE__ ) . 'js/bee_quick_classie.js', array('jquery'), false, true);
	wp_enqueue_script( 'bee-quick-imgloaded', plugin_dir_url( __FILE__ ) . 'js/bee.imagesloaded.pkgd.min.js', array('jquery'), false,true);
	wp_enqueue_script( 'bee-quick-masonry', plugin_dir_url( __FILE__ ) . 'js/bee.masonry.pkgd.min.js', array('jquery'), false,  true); 
	}    

 add_action('wp_enqueue_scripts', 'bee_quick_gallery_scripts');
 
 function bee_quick_gallery_intialscript(){
	
	
	echo "<script>
	jQuery(window).load(function($) {
			new CBPGridGallery( document.getElementById( 'bee-quick-grid-gallery' ) );
			
			});
		</script>";
		
	
	 
	}
	add_action('wp_footer','bee_quick_gallery_intialscript',100);