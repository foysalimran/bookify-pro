<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://https://https://themeatelier.net/
 * @since             1.0.0
 * @package           Bookify_Pro
 *
 * @wordpress-plugin
 * Plugin Name:       Bookify Pro
 * Plugin URI:        https://https://https://wp-plugins.themeatelier.net/bookify-pro
 * Description:       Bookify Pro
 * Version:           1.0.0
 * Author:            ThemeAtelier
 * Author URI:        https://https://https://https://themeatelier.net//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bookify-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'BOOKIFY_PRO_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bookify-pro-activator.php
 */
function activate_bookify_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bookify-pro-activator.php';
	Bookify_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bookify-pro-deactivator.php
 */
function deactivate_bookify_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bookify-pro-deactivator.php';
	Bookify_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_bookify_pro' );
register_deactivation_hook( __FILE__, 'deactivate_bookify_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-bookify-pro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_bookify_pro() {

	$plugin = new Bookify_Pro();
	$plugin->run();

}
run_bookify_pro();
