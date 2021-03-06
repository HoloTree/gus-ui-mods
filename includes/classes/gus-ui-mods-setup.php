<?php
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
		$version = GUS_UI_VERSION;
		if ( HT_DEV_MODE ) {
			$version = rand();
		}

		$gus_js = 'assets/js/src/gus_ui.js';
		if ( ! HT_DEV_MODE ) {
			$gus_js = 'assets/js/gus_ui.min.js';
		}
		wp_enqueue_style( 'gus', trailingslashit( GUS_UI_URL) . 'assets/css/gus_ui.min.css' );
		//wp_enqueue_script( 'gus', trailingslashit( GUS_UI_URL) . $gus_js, array( 'jquery', 'foundation' ), $version, true );
		$url = trailingslashit( GUS_UI_URL ).'vendor/zurb/foundation/js/foundation/';

		$version = '5.4.6';
		//@todo minify foundation
		wp_enqueue_script( 'foundation', $url.'foundation.js', array( 'jquery' ), $version, true );
		foreach( $this->foundation() as $name ) {
			$file = $url.'foundation.'.$name.'.js';
			wp_enqueue_script( $name, $file, array( 'jquery', 'foundation' ), $version, true );
		}

	}

	function foundation() {
		return array(
			//'accordion',
			'tab',
			//'alert',
			'reveal'
		);
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
