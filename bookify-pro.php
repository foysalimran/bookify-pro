<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeatelier.net/
 * @since             1.0.0
 * @package           Bookify_Pro
 *
 * @wordpress-plugin
 * Plugin Name:       Bookify Pro
 * Plugin URI:        https://https://https://wp-plugins.themeatelier.net/bookify-pro
 * Description:       Bookify Pro
 * Version:           1.0.0
 * Author:            ThemeAtelier
 * Author URI:        https://themeatelier.net//
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
define('BOOKIFY_PRO_BASENAME', plugin_basename(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bookify-pro-activator.php
 */
function bookify_pro_activate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bookify-pro-activator.php';
	Bookify_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bookify-pro-deactivator.php
 */
function bookify_pro_deactivate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-bookify-pro-deactivator.php';
	Bookify_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'bookify_pro_activate' );
register_deactivation_hook( __FILE__, 'bookify_pro_deactivate' );

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
function bookify_pro_run() {

	$plugin = new Bookify_Pro();
	$plugin->run();

}
bookify_pro_run();


function load_bookify_template($template) {
    global $post;

    if ($post->post_type == 'bookify') {
        $template = plugin_dir_path(__FILE__) . 'public/templates/single-bookify.php';
    }

    return $template;
}
add_filter('template_include', 'load_bookify_template');