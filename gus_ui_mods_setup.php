<?php
/**
 * @TODO What this does.
 *
 * @package   @TODO
 * @author    Josh Pollock <Josh@JoshPress.net>
 * @license   GPL-2.0+
 * @link      
 * @copyright 2014 Josh Pollock
 */

class gus_ui_mods_setup {


	function __construct() {
		//load the main js and ccs for this addon late
		add_filter( 'ht_gus_ui_mods_enqueue_scripts_priority', function(){
			return 99;
		});
	}

	/**
	 * Remove app_starter's js and css
	 */
	function deregister_app_starter_scripts() {
		if ( get_stylesheet() === 'app_starter' ) {
			wp_deregister_script( 'app-starter' );
			wp_deregister_script( 'foundation' );
			wp_deregister_style( 'app-starter' );
		}

	}


	/**
	 * Holds the instance of this class.
	 *
	 *
	 * @access private
	 * @var    object
	 */
	private static $instance;


	/**
	 * Returns the instance.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return object
	 */
	public static function init() {

		if ( !self::$instance )
			self::$instance = new gus_ui_mods_setup();

		return self::$instance;

	}
} 
