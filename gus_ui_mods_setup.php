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
		add_action( 'wp_enqueue_scripts', array( $this, 'deregister_app_starter_scripts' ), 21 );

	}

	/**
	 * Remove app_starter's js and css
	 */
	function deregister_app_starter_scripts() {

		wp_deregister_script( 'app-starter' );
		wp_deregister_script( 'foundation' );
		wp_deregister_style( 'app_starter-style' );


	}

	function activate() {
		include_once( 'gus_ui_mods.php' );
		$class = new gus_ui_mods(
			gus_ui_mods_info(),
			gus_ui_mods_css(),
			gus_ui_mods_js(),
			gus_ui_mods_hooks(),
			null
		);

		return $class;
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
