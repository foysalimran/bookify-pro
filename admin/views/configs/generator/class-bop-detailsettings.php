<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

/**
 * The Popup settings class.
 */
class BOP_DetailSettings {

	/**
	 * Popup settings section metabox.
	 *
	 * @param string $prefix The metabox key.
	 * @return void
	 */
	public static function section( $prefix ) {
		BOP::createSection(
			$prefix,
			array(
				'title'  => esc_html__( 'Detail page Settings', 'bookify-pro' ),
				'icon'   => 'fas fa-external-link-square-alt',
				'fields' => array(
					array(
						'id'       => 'bop_page_link_type',
						'class'    => 'bop_page_link_type',
						'type'     => 'radio',
						'title'    => esc_html__( 'Detail Page Link Type', 'bookify-pro' ),
						'subtitle' => esc_html__( 'Choose a link type for the (item) detail page.', 'bookify-pro' ),
						'desc'     => esc_html__( 'More amazing Popup Settings', 'bookify-pro' ),
						'options'  => array(
							'single_page' => esc_html__( 'Single Page', 'bookify-pro' ),
							'none'        => esc_html__( 'None (no link action)', 'bookify-pro' ),
						),
						'default'  => 'single_page',
					),
					array(
						'id'         => 'bop_link_target',
						'type'       => 'radio',
						'title'      => esc_html__( 'Target', 'bookify-pro' ),
						'subtitle'   => esc_html__( 'Set a target for the item link.', 'bookify-pro' ),
						'options'    => array(
							'_self'   => esc_html__( 'Current Tab', 'bookify-pro' ),
							'_blank'  => esc_html__( 'New Tab', 'bookify-pro' ),
							'_parent' => esc_html__( 'Parent', 'bookify-pro' ),
							'_top'    => esc_html__( 'Top', 'bookify-pro' ),
						),
						'default'    => '_self',
						'dependency' => array( 'bop_page_link_type', '==', 'single_page' ),
					),
					array(
						'id'      => 'bop_link_rel',
						'type'    => 'checkbox',
						'title'   => esc_html__( 'Add rel="nofollow" to item links', 'bookify-pro' ),
						'default' => 'false',
					),
				), // End of fields array.
			)
		); // Display settings section end.
	}
}
