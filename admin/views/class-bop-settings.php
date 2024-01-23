<?php
/**
 * The main class for Settings configurations.
 *
 * @package Bookify_pro
 * @subpackage Bookify_pro/admin/views
 */

if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access pages directly.

/**
 * Settings.
 */
class BOP_Settings {

	/**
	 * Create a settings page.
	 *
	 * @param string $prefix The settings.
	 * @return void
	 */
	public static function settings( $prefix ) {

		$capability = bop_dashboard_capability(); // TODO: filter is not working.

		BOP::createOptions(
			$prefix,
			array(
				'menu_title'       => esc_html__( 'Settings', 'bookify-pro' ),
				'menu_parent'      => 'edit.php?post_type=bookify',
				'menu_type'        => 'submenu', // menu, submenu, options, theme, etc.
				'menu_slug'        => 'bop_settings',
				'theme'            => 'light',
				'show_all_options' => false,
				'show_search'      => false,
				'show_footer'      => false,
				'show_bar_menu'           => false,
				'class'            => 'ta-pc-settings',
				'framework_title'  => esc_html__( 'Bookify', 'bookify-pro' ),
				'menu_capability'  => $capability,
			)
		);
		BOP_ScriptsAndStyles::section( $prefix );
		BOP_Accessibility::section( $prefix );
		BOP_SinglePage::section( $prefix );
		BOP_Archive::section( $prefix );
		BOP_CustomCSS::section( $prefix );
	}

}
