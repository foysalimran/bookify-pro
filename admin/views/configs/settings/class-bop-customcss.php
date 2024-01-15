<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.

class BOP_CustomCSS {

	/**
	 * Custom CSS & JS settings.
	 *
	 * @param string $prefix The settings.
	 * @return void
	 */
	public static function section( $prefix ) {
		BOP::createSection(
			$prefix,
			array(
				'title'  => esc_html__( 'Custom CSS & JS', 'bookify-pro' ),
				'icon'   => 'fas fa-css3',
				'fields' => array(
					array(
						'id'       => 'bop_custom_css',
						'type'     => 'code_editor',
						'title'    => esc_html__( 'Custom CSS', 'bookify-pro' ),
						'settings' => array(
							'icon'  => 'fas fa-sliders',
							'theme' => 'mbo',
							'mode'  => 'css',
						),
					),
					array(
						'id'       => 'bop_custom_js',
						'type'     => 'code_editor',
						'title'    => esc_html__( 'Custom JS', 'bookify-pro' ),
						'settings' => array(
							'icon'  => 'fas fa-sliders',
							'theme' => 'monokai',
							'mode'  => 'javascript',
						),
					),
				),
			)
		);
	}
}
