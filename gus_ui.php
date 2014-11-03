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
	if (  defined( 'HT_DMS_VERSION' ) ) {
		include( trailingslashit( GUS_UI_PATH ) . 'includes/classes/gus-ui-mods-setup.php' );
		$GLOBALS[ 'gus_ui_mods_setup' ] = gus_ui_mods_setup::init();
	}
}

//set logo in title & login
add_filter( 'ht_dms_logo_instead_of_name_in_title', 'gus_ui_logo' );
add_filter( 'ht_dms_login_logo', 'gus_ui_login_logo' );

function gus_ui_logo( $logo ) {
	return GUS_UI_IMG_URL . 'ht-logo-tree-only-white.png';
}

function gus_ui_login_logo( $logo ) {
	return GUS_UI_IMG_URL . 'ht-logo-tree-only-black.png';
}

//no off canvas
add_filter( 'app_starter_end_page', '__return_true' );
add_filter( 'app_starter_header', '__return_true' );


/**
 * Make sure home url Doesn't have /wp
 */
//add_filter( 'ht_dms_home_url', 'gus_ui_home_url' );
function gus_ui_home_url( $home ) {
	return str_replace( '/wp', '', $home );
}

/**
 * Customize admin screen
 */
add_action( 'login_enqueue_scripts', 'gus_ui_login_style'  );
function gus_ui_login_style() {

	$logo = GUS_UI_IMG_URL . 'ht-logo-square-full.png';
	$registration = pods_v_sanitized( 'action')
?>
	<style type="text/css">
		.login h1 a {
			margin: 0 auto;
			color: white;
			background-image: url(<?php echo $logo; ?>) !important;
			background-repeat: no-repeat;
			width: 300px !important;
			height: 150px !important;
		}
		html, body{
			background-color: #EFC771;
		}

		.login form {
			background-color: #F4D99F;
			border: 4px solid #5A180A;
		}

		input#wp-submit {
			background-color: #5A180A;
		}

		#login .message {
			background-color: #F4D99F;
			border-left: none;
		}

		input[type=text]:focus, input[type=password]:focus, .button:focus  {
			border-color: #fbfbfb;
			box-shadow: 0 0 10px rgba(251, 251, 251, 1);
		}

		input#wp-submit.button.button-primary.button-large {
			border: none;
			box-shadow: none;
            width: 100%;
		}

		input#wp-submit.button.button-primary.button-large:hover {
			box-shadow: 0 5px 10px rgba(251, 251, 251, 1);
		}

		input[type=checkbox]:checked:before {
			content: '\f147';
			margin: -3px 0 0 -4px;
			color: #5a180a;
		}

		input[type=checkbox]:focus {
			border: none;
			box-shadow: 0 0 10px rgba(251, 251, 251, 1);
		}

		.login #backtoblog a, .login #nav a {
			color: #5A180A;
		}

		.login #backtoblog a:hover, .login #nav a:hover{
			color: #777;
		}

		.login #backtoblog, .login #nav {
			display: none;
		}

        p.forgetmenot {
            display: block;
            width: 100%;
            margin-bottom: 7px !important;
            text-align: center;
        }

		p.message.register .button {
			background: #5A180A !important;
			color: #f4d99f !important;
			box-shadow: none !important;
			-webkit-box-shadow: none  !important;
			border: none !important;
		}

		p.message.register .button:hover, p.message.register .button:focus {
			background: #f4d99f !important;
			color: #5A180A  !important;
			box-shadow: 0 0 10px rgba(251, 251, 251, 1) !important;
			border: 1px solid #5A180A !important;
		}

		@media only screen and (max-width: 600px) {
			button, .button, button a, .button a {
				width: 100%;
			}
		}

		<?php
			if ( $registration ) : ?>
				#login {
					width: 61.8%;
					padding: 9% 5.6%;
					margin: auto;
				}

                p#no-submit {
                    background: #5a180a;
                    color: #f4d99f;
                    text-align: center;
                    padding: 8px;
                }


				p.message.register {
					text-align: center;
					font-size: 1.46em;
				}

	        <?php else : ?>
				p.message.register .button:first-child {
					float:left;
				}

				p.message.register .button:first-child {
					float:right;
				}

		<?php endif; ?>


	</style>
<?php

}

//double make sure no admin bar
add_filter('show_admin_bar', '__return_false', 100 );

add_filter( 'login_headerurl', 'ht_dms_home');
