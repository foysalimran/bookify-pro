<?php

/**
 * The Enqueue and Dequeue CSS and JS files setting configurations.
 *
 * @package Bookify_pro
 * @subpackage Bookify_pro/admin
 */

if (!defined('ABSPATH')) {
	die;
} // Cannot access pages directly.

/**
 * The single page class.
 */
class BOP_SinglePage
{

	/**
	 * Single page setting section.
	 *
	 * @param string $prefix The settings.
	 * @return void
	 */
	public static function section($prefix)
	{
		BOP::createSection(
			$prefix,
			array(
				'title'  => esc_html__('Single Page', 'bookify-pro'),
				'icon'   => 'far fa-file-code',
				'fields' => array(
					array(
						'type'    => 'subheading',
						'content' => esc_html__('Single Page Settings', 'bookify-pro'),
					),
					array(
						'id'         => 'bop_title',
						'type'       => 'switcher',
						'title'      => esc_html__('Title', 'bookify-pro'),
						'text_on'    => esc_html__('Enqueued', 'bookify-pro'),
						'text_off'   => esc_html__('Dequeued', 'bookify-pro'),
						'text_width' => 95,
						'default'    => true,
					),
					array(
						'id'         => 'bop_subtitle',
						'type'       => 'switcher',
						'title'      => esc_html__('Subtitle', 'bookify-pro'),
						'text_on'    => esc_html__('Enqueued', 'bookify-pro'),
						'text_off'   => esc_html__('Dequeued', 'bookify-pro'),
						'text_width' => 95,
						'default'    => true,
					),
					array(
						'id'      => 'bop_single_book_fildes',
						'class'   => 'bop_custom_group_design',
						'type'    => 'group',
						'button_title' => esc_html__('Add New Meta', 'bookify-pro'),
						'fields'  => array(
							array(
								'id'       => 'select_single_book_fildes',
								'class'       => 'select_single_book_fildes',
								'type'     => 'select',
								'title'    => esc_html__('Select Meta', 'bookify-pro'),
								'placeholder' => esc_html__('Select a meta', 'bookify-pro'),
								'options'  => array(
									'book_author'     => esc_html__('Book Author', 'bookify-pro'),
									'publisher'     => esc_html__('Publisher', 'bookify-pro'),
									'publish_date'     => esc_html__('Publish Date', 'bookify-pro'),
									'regular_price'     => esc_html__('Book Regular Prices', 'bookify-pro'),
									'sale_price'     => esc_html__('Book Sale Prices', 'bookify-pro'),
									'isbn'     => esc_html__('ISBN', 'bookify-pro'),
									'isbn_10'     => esc_html__('ISBN-10', 'bookify-pro'),
									'isbn_13'     => esc_html__('ISBN-13', 'bookify-pro'),
									'asin'     => esc_html__('ASIN', 'bookify-pro'),
									'subject'     => esc_html__('Subject', 'bookify-pro'),
									'genre'     => esc_html__('Genre', 'bookify-pro'),
									'country'     => esc_html__('Country', 'bookify-pro'),
									'book_language'     => esc_html__('Book language', 'bookify-pro'),
									'translator_name'     => esc_html__('Translator Name', 'bookify-pro'),
									'book_format'     => esc_html__('Book Format', 'bookify-pro'),
									'rating'     => esc_html__('Ratings', 'bookify-pro'),
									'book_multiple_purchase_link'     => esc_html__('Book Multiple Purchase Link', 'bookify-pro'),
								),
							),
							array(
								'id'      => 'select_single_book_fildes_icon',
								'class'      => 'select_single_book_fildes_icon',
								'type'    => 'icon',
								'title'   => esc_html__('Meta Icon', 'bookify-pro'),
								'default' => 'far fa-folder',
							),
							array(
								'id'    => 'select_single_book_fildes_date_format',
								'type'  => 'text',
								'title' => ' ',
								'class' => 'select_single_book_fildes_date_format',
								'placeholder' => esc_html__('F j, Y', 'bookify-pro'),
								'default'   => esc_html__('F j, Y', 'bookify-pro'),
								'desc' => __('To define format, check <a href="https://wordpress.org/support/article/formatting-date-and-time/" target="_blank" rel="noopener noreferrer nofollow"><em>this doc</em></a>.', 'bookify-pro'),
								'dependency' => array('select_single_book_fildes', '==', 'publish_date'),
							),
							array(
								'id'       => 'show_before_text',
								'type'     => 'switcher',
								'title'    => esc_html__('Before Text', 'bookify-pro'),
								'text_on'  => esc_html__('Show', 'bookify-pro'),
								'text_off' => esc_html__('Hide', 'bookify-pro'),
								'text_width' => 80,
							),
							array(
								'id'       => 'bop_before_text',
								'type'     => 'text',
								'title'    => ' ',
								'dependency' => array('show_before_text', '==', 'true'),
							),
						),


						'default' => array(
							array(
								'select_single_book_fildes'     => 'book_author',
								'select_single_book_fildes_icon'    => 'fas fa-user-edit',
							),
							array(
								'select_single_book_fildes'     => 'publisher',
								'select_single_book_fildes_icon'    => 'fas fa-user',
							),
							array(
								'select_single_book_fildes'     => 'publish_date',
								'select_single_book_fildes_icon'    => 'fas fa-calendar-alt',
							),
						),
					),
				),
			),
			
		);
	}
}
