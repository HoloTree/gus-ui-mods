<?php
/*
Plugin Name: Gus UI Mods
Plugin URI: http://add-on-site.com/
Description: Description
Version: 0.0.1
Author: Your Name
Author URI: http://your-site.com/
Text Domain: gus-ui-mods
License: GPL v2 or later
*/

/**
 * Copyright (c) YEAR Your Name (email: Your Email). All rights reserved.
 *
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 *
 * This is an add-on for WordPress
 * http://wordpress.org/
 *
 * **********************************************************************
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 * **********************************************************************
 */

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Define constants
 *
 * @since 0.0.1
 */
define( 'GUS_UI_MODS_SLUG', plugin_basename( __FILE__ ) );
define( 'GUS_UI_MODS_URL', plugin_dir_url( __FILE__ ) );
define( 'GUS_UI_MODS_DIR', plugin_dir_path( __FILE__ ) );

/**
 * Add this add-on to the possible add-ons
 */
add_filter( 'ht_registered_addons', function( $addons ){
	$addons[] = array(
		'gus-ui-mods' =>
			array(
			   'class' 	=> gus_ui_mods_setup::init(),
			   'method' => 'activate',
			)
	);

	return $addons;

});

/**
 *
 *
 * @return gus_ui_mods
 */
function gus_ui_mods_activate() {

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
 * Setup info about this addon
 *
 * @return array
 */
function gus_ui_mods_info() {
	return array(
		'name' 		=> 'HoloTree Addon Starter',
		'slug' 		=> 'gus-ui-mods',
		'author'  	=> 'Your Name',
		'authorURI' => 'http://your-site.com/',
		'URI'		=> 'http://add-on-site.com/',
		'ht_min'	=> '0.0.1',
		'ht_max'	=> '0.0.2',
		'scope'		=> 'ht_dms',
	);
}

/**
 * Define this addon's CSS
 *
 * In return array, for each CSS file, set its name => its path, relative to the css directory of this plugin.
 *
 * @return array
 */
function gus_ui_mods_css() {
	return array(
		'gus-ui-mods' => 'gus-ui-mods.css',

	);
}


/**
 * Define this addon's JavaScript
 *
 * In return array, for each JS file, set array with name as key, and values for path relative to the js directory, its dependencies and whether or not it should be loaded in the footer.
 *
 * @return array
 */
function gus_ui_mods_js() {
	return array(
		'name' => array(
			'path' 			=> 'gus-ui-mods.js',
			'dependencies' 	=> 'jquery',
			'in_footer'		=> 'true',
		),

	);

}

/**
 * Set the hooks for this addon.
 *
 * Will be passed to add_action() or add_filter()
 *
 * @return array
 */
function gus_ui_mods_hooks() {
	return;
	return array(
		'action' => array(
			'hook' 		=> 'wp_enqueue_scripts',
			'callback' 	=> array( gus_ui_mods_setup::init(), 'deregister_app_starter_scripts'),
			'priority' 	=> 23,
			'args'  	=> 1,
		),
	);

}

/**
 * Include and return the setup class
 *
 * @return object
 */
add_action( 'plugins_loaded', 'gus_ui_mods_setup' );
function gus_ui_mods_setup() {
	include_once( 'gus_ui_mods_setup.php' );

	return gus_ui_mods_setup::init();

}


