<?php if (!defined('ABSPATH')) {
  die;
} // Cannot access directly.

class BOP_Metaboxes {
    /**
	 * Bookify Metabox function.
	 *
	 * @param string $prefix The meta-key for this metabox.
	 * @return void
	 */
	public static function bookify_metabox( $prefix ) {
		BOP::createMetabox(
			$prefix,
			array(
				'title'        => esc_html__( 'Bookify Information', 'bookify-pro' ),
				'post_type'    => 'bookify',
				'show_restore' => false,
				'context'      => 'normal',
			)
		);
		
		BOP_Postmeta::section( $prefix );
	}
    /**
	 * Layout Metabox function.
	 *
	 * @param string $prefix The meta-key for this metabox.
	 * @return void
	 */
	public static function layout_metabox( $prefix ) {
		BOP::createMetabox(
			$prefix,
			array(
				'title'        => esc_html__( 'Bookify', 'bookify-pro' ),
				'post_type'    => 'generate_shortcode',
				'show_restore' => false,
				'context'      => 'normal',
			)
		);

		BOP_Layout::section( $prefix );

	}

	/**
	 * Option Metabox function
	 *
	 * @param string $prefix The metabox key.
	 * @return void
	 */
	public static function option_metabox( $prefix ) {
		BOP::createMetabox(
			$prefix,
			array(
				'title'        => esc_html__( 'View Options', 'bookify-pro' ),
				'post_type'    => 'generate_shortcode',
				'show_restore' => false,
				'nav'        => 'inline',
				'theme'        => 'light',
			)
		);

		BOP_FilterPost::section( $prefix );
		BOP_Display::section( $prefix );
		BOP_Carousel::section( $prefix );
		BOP_DetailSettings::section( $prefix );
		BOP_Typography::section( $prefix );
	}
	/**
	 * Shortcode Metabox function
	 *
	 * @param string $prefix The metabox key.
	 * @return void
	 */
	public static function shortcode_metabox( $prefix ) {
		BOP::createMetabox(
			$prefix,
			array(
				'title'        => esc_html__( 'Bookify', 'bookify-pro' ),
				'post_type'    => 'generate_shortcode',
				'context'      => 'side',
				'show_restore' => false,
			)
		);

		BOP_Shortcode::section( $prefix );

	}
}