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
class BOP_Archive
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
				'title'  => esc_html__('Book Archive', 'bookify-pro'),
				'icon'   => 'far fa-file-code',
				'fields' => array(
					array(
						'type'    => 'subheading',
						'content' => esc_html__('Book Archive', 'bookify-pro'),
					),
					array(
						'id'         => 'bop_archive_slug',
						'type'       => 'text',
						'title'      => esc_html__('Archive Slug', 'bookify-pro'),
						'desc'		=> esc_html__('After changing the slug go to settings->reading then click save changes button to flash your permalink.', 'bookify-pro'),
						'default'    => 'book_category',
					),
				),
			),
			
		);
	}
}
