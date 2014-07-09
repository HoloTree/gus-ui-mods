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
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts_styles' ), 25 );

		add_filter( 'app_starter_use_main_css', '__return_false' );
		add_filter( 'app_starter_use_main_js', '__return_false' );
	}

	function scripts_styles() {
		wp_enqueue_style( 'gus', trailingslashit( GUS_UI_MODS_URL) . 'css/gus.css' );
		wp_enqueue_script( 'gus', trailingslashit( GUS_UI_MODS_URL) . 'js/gus.min.js', array( 'jquery' ), false, true );

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
