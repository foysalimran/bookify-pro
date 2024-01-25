<?php

/**
 * The Enqueue and Dequeue CSS and JS files setting configurations.
 *
 * @package Bookify_pro
 * @subpackage Bookify_pro/admin
 */

if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

/**
 * The Layout building class.
 */
class BOP_ScriptsAndStyles {


	/**
	 * Advanced setting section.
	 *
	 * @param string $prefix The settings.
	 * @return void
	 */
	public static function section( $prefix ) {
		BOP::createSection(
			$prefix,
			array(
				'title'  => esc_html__( 'Scripts & Styles', 'bookify-pro' ),
				'icon'   => 'far fa-file-code',
				'fields' => array(
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Enqueue or Dequeue JS', 'bookify-pro' ),
					),
					array(
						'id'         => 'bop_swiper_js',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Swiper JS', 'bookify-pro' ),
						'text_on'    => esc_html__( 'Enqueued', 'bookify-pro' ),
						'text_off'   => esc_html__( 'Dequeued', 'bookify-pro' ),
						'text_width' => 95,
						'default'    => true,
					),
					array(
						'id'         => 'bop_bx_js',
						'type'       => 'switcher',
						'title'      => esc_html__( 'bxSlider JS', 'bookify-pro' ),
						'text_on'    => esc_html__( 'Enqueued', 'bookify-pro' ),
						'text_off'   => esc_html__( 'Dequeued', 'bookify-pro' ),
						'text_width' => 95,
						'default'    => true,
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Enqueue or Dequeue CSS', 'bookify-pro' ),
					),
					array(
						'id'         => 'bop_swiper_css',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Swiper CSS', 'bookify-pro' ),
						'text_on'    => esc_html__( 'Enqueued', 'bookify-pro' ),
						'text_off'   => esc_html__( 'Dequeued', 'bookify-pro' ),
						'text_width' => 95,
						'default'    => true,
					),
					array(
						'id'         => 'bop_fontawesome_css',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Font Awesome CSS', 'bookify-pro' ),
						'text_on'    => esc_html__( 'Enqueued', 'bookify-pro' ),
						'text_off'   => esc_html__( 'Dequeued', 'bookify-pro' ),
						'text_width' => 95,
						'default'    => true,
					),
				),
			)
		);
	}
}
