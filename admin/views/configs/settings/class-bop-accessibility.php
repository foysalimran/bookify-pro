<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

/**
 * The accessibility setting class.
 */
class BOP_Accessibility {


	/**
	 * Accessibility setting section.
	 *
	 * @param string $prefix The settings.
	 * @return void
	 */
	public static function section( $prefix ) {
		BOP::createSection(
			$prefix,
			array(
				'title'  => esc_html__( 'Accessibility', 'bookify-pro' ),
				'icon'   => 'fas fa-braille',
				'fields' => array(
					array(
						'id'         => 'accessibility',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Carousel Accessibility', 'bookify-pro' ),
						'text_on'    => esc_html__( 'Enabled', 'bookify-pro' ),
						'text_off'   => esc_html__( 'Disabled', 'bookify-pro' ),
						'text_width' => 100,
						'default'    => true,
					),
					array(
						'id'         => 'prev_slide_message',
						'type'       => 'text',
						'title'      => esc_html__( 'Previous Slide Message', 'bookify-pro' ),
						'default'    => esc_html__( 'Previous slide', 'bookify-pro' ),
						'dependency' => array( 'accessibility', '==', 'true' ),
					),
					array(
						'id'         => 'next_slide_message',
						'type'       => 'text',
						'title'      => esc_html__( 'Next Slide Message', 'bookify-pro' ),
						'default'    => esc_html__( 'Next slide', 'bookify-pro' ),
						'dependency' => array( 'accessibility', '==', 'true' ),
					),
					array(
						'id'         => 'first_slide_message',
						'type'       => 'text',
						'title'      => esc_html__( 'First Slide Message', 'bookify-pro' ),
						'default'    => esc_html__( 'This is the first slide', 'bookify-pro' ),
						'dependency' => array( 'accessibility', '==', 'true' ),
					),
					array(
						'id'         => 'last_slide_message',
						'type'       => 'text',
						'title'      => esc_html__( 'Last Slide Message', 'bookify-pro' ),
						'default'    => esc_html__( 'This is the last slide', 'bookify-pro' ),
						'dependency' => array( 'accessibility', '==', 'true' ),
					),
					array(
						'id'         => 'pagination_bullet_message',
						'type'       => 'text',
						'title'      => esc_html__( 'Pagination Bullet Message', 'bookify-pro' ),
						'default'    => esc_html__( 'Go to slide {{index}}', 'bookify-pro' ),
						'dependency' => array( 'accessibility', '==', 'true' ),
					),
				),
			)
		);
	}
}
