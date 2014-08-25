<?php
/**
 * Plugin Name: Gus UI
 * Plugin URI:  http://holotree.com
 * Description: Gus User Interface
 * Version:     0.1.0
 * Author:      Josh Pollock
 * Author URI:  http://JoshPress.net
 * License:     GPLv2+
 * Text Domain: gus_ui
 * Domain Path: /languages
 */

/**
 * Copyright (c) 2014 Josh Pollock (email : Josh@JoshPress.net)
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Built using grunt-wp-plugin
 * Copyright (c) 2013 10up, LLC
 * https://github.com/10up/grunt-wp-plugin
 */

// Useful global constants
define( 'GUS_UI_VERSION', '0.1.0' );
define( 'GUS_UI_URL',     plugin_dir_url( __FILE__ ) );
define( 'GUS_UI_PATH',    dirname( __FILE__ ) . '/' );
define( 'GUS_UI_ASSETS_PATH', GUS_UI_PATH . 'assets/' );
define( 'GUS_UI_ASSETS_URL', GUS_UI_URL . 'assets/' );
define( 'GUS_UI_IMG_PATH', GUS_UI_ASSETS_PATH . 'img/' );
define( 'GUS_UI_IMG_URL', GUS_UI_ASSETS_URL . 'img/' );


/**
 * Default initialization for the plugin:
 * - Registers the default textdomain.
 */
function gus_ui_init() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'gus_ui' );
	load_textdomain( 'gus_ui', WP_LANG_DIR . '/gus_ui/gus_ui-' . $locale . '.mo' );
	load_plugin_textdomain( 'gus_ui', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

}

/**
 * Activate the plugin
 */
function gus_ui_activate() {
	// First load the init scripts in case any rewrite functionality is being loaded
	gus_ui_init();

	flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'gus_ui_activate' );

/**
 * Deactivate the plugin
 * Uninstall routines should be in uninstall.php
 */
function gus_ui_deactivate() {

}
register_deactivation_hook( __FILE__, 'gus_ui_deactivate' );

//init
add_action( 'init', 'gus_ui_init' );

//vertical tabs
add_filter( 'ht_dms_foundation_vertical_tabs', '__return_true' );

//load
add_action( 'plugins_loaded', 'gus_ui_mods_load' );
function gus_ui_mods_load() {
	if (  defined( 'HT_VERSION' ) ) {
		include( trailingslashit( GUS_UI_PATH ) . 'includes/classes/gus-ui-mods-setup.php' );
		$GLOBALS[ 'gus_ui_mods_setup' ] = gus_ui_mods_setup::init();
	}
}

//set logo in title
add_action( 'ht_dms_logo_instead_of_name_in_title', function( $logo ) {
	return GUS_UI_IMG_URL . 'ht-logo-circle-two-color.png';
} );
