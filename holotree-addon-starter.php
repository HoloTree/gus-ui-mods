<?php
/*
Plugin Name: Holotree Starter Plugin
Plugin URI: http://add-on-site.com/
Description: Description
Version: 0.0.1
Author: Your Name
Author URI: http://your-site.com/
Text Domain: holotree-addon-starter
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
define( 'HOLOTREE_EXTEND_SLUG', plugin_basename( __FILE__ ) );
define( 'HOLOTREE_EXTEND_URL', plugin_dir_url( __FILE__ ) );
define( 'HOLOTREE_EXTEND_DIR', plugin_dir_path( __FILE__ ) );

/**
 *	Safely Activate The Main Class For This plugin
 *
 * @return holotree_addon_starter
 */
function holotree_addon_starter_safe_activate() {
	if ( defined( HT_VERSION ) ) {
		include_once( 'holotree_addon_starter' );
		$class = new holotree_addon_starter(
			holotree_addon_starter_info(),
			holotree_addon_starter_css(),
			holotree_addon_starter_js(),
			holotree_addon_starter_hooks(),
			null
		);

		return $class;

	}

}

/**
 * Setup info about this addon
 *
 * @return array
 */
function holotree_addon_starter_info() {
	return array(
		'name' 		=> 'HoloTree Addon Starter',
		'slug' 		=> 'holotree-addon-starter',
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
function holotree_addon_starter_css() {
	return array(
		'holotree-addon-starter' => 'holotree-addon-starter.css',

	);
}


/**
 * Define this addon's JavaScript
 *
 * In return array, for each JS file, set array with name as key, and values for path relative to the js directory, its dependencies and whether or not it should be loaded in the footer.
 *
 * @return array
 */
function holotree_addon_starter_js() {
	return array(
		'name' => array(
			'path' 			=> 'holotree-addon-starter.js',
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
function holotree_addon_starter_hooks() {
	return array(
		'action' => array(
			'hook' 		=> 'init',
			'callback' 	=> 'callback_function',
			'priority' 	=> 1,
			'args'  	=> 2,
		),
		'filter' => array(
			'hook' 		=> 'the_content',
			'callback'	=> 'content_callback',
			'priority'	=> 21,
			'args'		=> 1,
		),
	);

}
