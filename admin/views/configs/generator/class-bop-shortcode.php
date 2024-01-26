<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

/**
 * The Shortcode display class.
 */
class BOP_Shortcode {


	/**
	 * Shortcode display metabox section.
	 *
	 * @param string $prefix The metabox key.
	 * @return void
	 */
	public static function section( $prefix ) {
		if ( isset( $_GET['post'] ) ) {
			BOP::createSection(
				$prefix,
				array(
					'fields' => array(
						array(
							'type'  => 'shortcode',
							'class' => 'bop-admin-sidebar',
						),
					),
				)
			);
		}
	}
}
