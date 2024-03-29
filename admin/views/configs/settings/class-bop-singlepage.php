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
 * The single page class.
 */
class BOP_SinglePage {


	/**
	 * Single page setting section.
	 *
	 * @param string $prefix The settings.
	 * @return void
	 */
	public static function section( $prefix ) {
		BOP::createSection(
			$prefix,
			array(
				'title'  => esc_html__( 'Single Page', 'bookify-pro' ),
				'icon'   => 'far fa-file-code',
				'fields' => array(
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Single Page Settings', 'bookify-pro' ),
					),
					array(
						'id'         => 'bop_title',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Title', 'bookify-pro' ),
						'text_on'    => esc_html__( 'Enabled', 'bookify-pro' ),
						'text_off'   => esc_html__( 'Disabled', 'bookify-pro' ),
						'text_width' => 95,
						'default'    => true,
					),
					array(
						'id'         => 'bop_subtitle',
						'type'       => 'switcher',
						'title'      => esc_html__( 'Subtitle', 'bookify-pro' ),
						'text_on'    => esc_html__( 'Enabled', 'bookify-pro' ),
						'text_off'   => esc_html__( 'Disabled', 'bookify-pro' ),
						'text_width' => 95,
						'default'    => true,
					),
					array(
						'id'           => 'bop_single_book_fildes',
						'class'        => 'bop_custom_group_design',
						'type'         => 'group',
						'button_title' => esc_html__( 'Add New Meta', 'bookify-pro' ),
						'fields'       => array(
							array(
								'id'          => 'select_single_book_fildes',
								'class'       => 'select_single_book_fildes',
								'type'        => 'select',
								'title'       => esc_html__( 'Select Meta', 'bookify-pro' ),
								'placeholder' => esc_html__( 'Select a meta', 'bookify-pro' ),
								'options'     => array(
									'book_author'     => esc_html__( 'Book Author', 'bookify-pro' ),
									'publisher'       => esc_html__( 'Publisher', 'bookify-pro' ),
									'publish_date'    => esc_html__( 'Publish Date', 'bookify-pro' ),
									'price'           => esc_html__( 'Prices', 'bookify-pro' ),
									'category'        => esc_html__( 'Category', 'bookify-pro' ),
									'isbn'            => esc_html__( 'ISBN', 'bookify-pro' ),
									'isbn_10'         => esc_html__( 'ISBN-10', 'bookify-pro' ),
									'isbn_13'         => esc_html__( 'ISBN-13', 'bookify-pro' ),
									'asin'            => esc_html__( 'ASIN', 'bookify-pro' ),
									'subject'         => esc_html__( 'Subject', 'bookify-pro' ),
									'genre'           => esc_html__( 'Genre', 'bookify-pro' ),
									'country'         => esc_html__( 'Country', 'bookify-pro' ),
									'book_language'   => esc_html__( 'Book language', 'bookify-pro' ),
									'translator_name' => esc_html__( 'Translator Name', 'bookify-pro' ),
									'book_format'     => esc_html__( 'Book Format', 'bookify-pro' ),
									'rating'          => esc_html__( 'Ratings', 'bookify-pro' ),
									'book_multiple_purchase_link' => esc_html__( 'Book Multiple Purchase Link', 'bookify-pro' ),
								),
							),
							array(
								'id'      => 'select_single_book_fildes_icon',
								'class'   => 'select_single_book_fildes_icon',
								'type'    => 'icon',
								'title'   => esc_html__( 'Meta Icon', 'bookify-pro' ),
								'default' => 'far fa-folder',
							),
							array(
								'id'          => 'select_single_book_fildes_date_format',
								'type'        => 'text',
								'title'       => ' ',
								'class'       => 'select_single_book_fildes_date_format',
								'placeholder' => esc_html__( 'F j, Y', 'bookify-pro' ),
								'default'     => esc_html__( 'F j, Y', 'bookify-pro' ),
								'desc'        => __( 'To define format, check <a href="https://wordpress.org/support/article/formatting-date-and-time/" target="_blank" rel="noopener noreferrer nofollow"><em>this doc</em></a>.', 'bookify-pro' ),
								'dependency'  => array( 'select_single_book_fildes', '==', 'publish_date' ),
							),
							array(
								'id'    => 'bop_before_text',
								'type'  => 'text',
								'title' => esc_html__( 'Before Text', 'bookify-pro' ),
							),
						),

						'default'      => array(
							array(
								'select_single_book_fildes' => 'book_author',
								'select_single_book_fildes_icon' => 'fas fa-user-edit',
								'bop_before_text' => esc_html__( 'Author:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'publisher',
								'select_single_book_fildes_icon' => 'fas fa-user',
								'bop_before_text' => esc_html__( 'Publisher:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'publish_date',
								'select_single_book_fildes_icon' => 'fas fa-calendar-alt',
								'bop_before_text' => esc_html__( 'Published:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'price',
								'select_single_book_fildes_icon' => 'fas fa-money-check-alt',
								'bop_before_text' => esc_html__( 'Price:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'category',
								'select_single_book_fildes_icon' => 'fas fa-tag',
								'bop_before_text' => esc_html__( 'Category:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'isbn',
								'select_single_book_fildes_icon' => 'fas fa-barcode',
								'bop_before_text' => esc_html__( 'ISBN:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'isbn_10',
								'select_single_book_fildes_icon' => 'fas fa-barcode',
								'bop_before_text' => esc_html__( 'ISBN 10:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'isbn_13',
								'select_single_book_fildes_icon' => 'fas fa-barcode',
								'bop_before_text' => esc_html__( 'ISBN 13:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'asin',
								'select_single_book_fildes_icon' => 'fas fa-barcode',
								'bop_before_text' => esc_html__( 'ASIN:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'subject',
								'select_single_book_fildes_icon' => 'fas fa-book',
								'bop_before_text' => esc_html__( 'Subject:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'genre',
								'select_single_book_fildes_icon' => 'fas fa-book-open',
								'bop_before_text' => esc_html__( 'Genre:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'country',
								'select_single_book_fildes_icon' => 'fas fa-globe-americas',
								'bop_before_text' => esc_html__( 'Country:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'book_language',
								'select_single_book_fildes_icon' => 'fas fa-language',
								'bop_before_text' => esc_html__( 'Language:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'translator_name',
								'select_single_book_fildes_icon' => 'fas fa-user-edit',
								'bop_before_text' => esc_html__( 'Translator Name:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'book_format',
								'select_single_book_fildes_icon' => 'fas fa-remove-format',
								'bop_before_text' => esc_html__( 'Format:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'rating',
								'select_single_book_fildes_icon' => 'fas fa-star',
								'bop_before_text' => esc_html__( 'Rating:', 'bookify-pro' ),
							),
							array(
								'select_single_book_fildes' => 'book_multiple_purchase_link',
								'select_single_book_fildes_icon' => 'fas fa-link',
								'bop_before_text' => esc_html__( 'Multiple Purchase Link:', 'bookify-pro' ),
							),
						),
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Book Meta Color', 'bookify-pro' ),
					),
					array(
						'id'      => 'bop_single_book_meta_icon',
						'type'    => 'color',
						'title'   => esc_html__( 'Icon Color', 'bookify-pro' ),
						'default' => '#222',
						'output'  => '.bookify__single .bookify__details ul li b i',
					),
					array(
						'id'      => 'bop_single_book_meta_label',
						'type'    => 'color',
						'title'   => esc_html__( 'Label Color', 'bookify-pro' ),
						'default' => '#222',
						'output'  => '.bookify__single .bookify__details ul li b',
					),
					array(
						'id'      => 'bop_single_book_meta_value',
						'type'    => 'color',
						'title'   => esc_html__( 'Value Color', 'bookify-pro' ),
						'default' => '#687279',
						'output'  => '.bookify__single .bookify__details ul li',
					),
					array(
						'id'      => 'bop_single_book_meta_typography',
						'type'    => 'typography',
						'title'   => esc_html__( 'Meta Typography', 'bookify-pro' ),
						'default' => array(
							'color'              => '#444',
							'font-family'        => '',
							'font-weight'        => '',
							'subset'             => '',
							'font-size'          => '16',
							'tablet-font-size'   => '15',
							'mobile-font-size'   => '18',
							'line-height'        => '28',
							'tablet-line-height' => '24',
							'mobile-line-height' => '15',
							'letter-spacing'     => '0',
							'text-align'         => 'left',
							'text-transform'     => 'none',
							'type'               => '',
							'unit'               => 'px',
						),
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Book Rating Color', 'bookify-pro' ),
					),
					array(
						'id'      => 'bop_single_book_rating_icon',
						'type'    => 'color',
						'title'   => esc_html__( 'Icon Color', 'bookify-pro' ),
						'default' => '#faca51',
						'output'  => '.bookify__single .bookify__abarage__rating .bookify__rating',
					),
					array(
						'type'    => 'subheading',
						'content' => esc_html__( 'Button', 'bookify-pro' ),
					),
					array(
						'id'      => 'bop_single_button_color_button',
						'type'    => 'color_group',
						'title'   => esc_html__( 'Button Color', 'bookify-pro' ),
						'options' => array(
							'standard'     => esc_html__( 'Text Color', 'bookify-pro' ),
							'hover'        => esc_html__( 'Text Hover Color', 'bookify-pro' ),
							'bg'           => esc_html__( 'Background', 'bookify-pro' ),
							'hover_bg'     => esc_html__( 'Hover Background', 'bookify-pro' ),
							'border'       => esc_html__( 'Border', 'bookify-pro' ),
							'hover_border' => esc_html__( 'Hover Border', 'bookify-pro' ),
						),
						'default' => array(
							'standard'     => '#ffffff',
							'hover'        => '#ffffff',
							'bg'           => '#c27b7f',
							'hover_bg'     => '#876585',
							'border'       => '#c27b7f',
							'hover_border' => '#876585',
						),
					),
					array(
						'id'       => 'bop_single_button_padding',
						'type'     => 'spacing',
						'title'    => esc_html__( 'Button Padding', 'bookify-pro' ),
						'sanitize' => 'bop_sanitize_number_array_field',
						'units'    => array( 'px' ),
						'min'      => -100,
						'default'  => array(
							'top'    => '6',
							'right'  => '20',
							'bottom' => '6',
							'left'   => '20',
						),
						'output'   => '.bookify_single .bookify_purchase_btn',
					),
					array(
						'id'       => 'bop_single_button_radius',
						'type'     => 'spacing',
						'title'    => esc_html__( 'Border Radius', 'bookify-pro' ),
						'sanitize' => 'bop_sanitize_number_array_field',
						'all'      => true,
						'default'  => array(
							'all'  => '0',
							'unit' => 'px',
						),
						'units'    => array( 'px', '%' ),
					),
					array(
						'id'      => 'bop_single_button_typography',
						'type'    => 'typography',
						'title'   => esc_html__( 'Button Typography', 'bookify-pro' ),
						'default' => array(
							'color'              => '#444',
							'font-family'        => '',
							'font-weight'        => '',
							'subset'             => '',
							'font-size'          => '16',
							'tablet-font-size'   => '15',
							'mobile-font-size'   => '18',
							'line-height'        => '28',
							'tablet-line-height' => '24',
							'mobile-line-height' => '15',
							'letter-spacing'     => '0',
							'text-align'         => 'left',
							'text-transform'     => 'none',
							'type'               => '',
							'unit'               => 'px',
						),
					),
					array(
						'type'    => 'subheading',
						'content' => __( 'Description Typography', 'bookify-pro' ),
					),
					array(
						'id'      => 'bop_single_description_typography',
						'type'    => 'typography',
						'title'   => esc_html__( 'Description Typography', 'bookify-pro' ),
						'default' => array(
							'color'              => '#444',
							'font-family'        => '',
							'font-weight'        => '',
							'subset'             => '',
							'font-size'          => '16',
							'tablet-font-size'   => '15',
							'mobile-font-size'   => '18',
							'line-height'        => '28',
							'tablet-line-height' => '24',
							'mobile-line-height' => '15',
							'letter-spacing'     => '0',
							'text-align'         => 'left',
							'text-transform'     => 'none',
							'type'               => '',
							'unit'               => 'px',
						),
					),
				),
			),
		);
	}
}
