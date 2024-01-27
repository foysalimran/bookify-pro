<?php

if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.

if (!class_exists('BOP_Field_shortcode')) {
	/**
	 * BOP_Field_shortcode
	 */
	class BOP_Field_shortcode extends BOP_Fields
	{
		/**
		 * Field constructor.
		 *
		 * @param array  $field The field type.
		 * @param string $value The values of the field.
		 * @param string $unique The unique ID for the field.
		 * @param string $where To where show the output CSS.
		 * @param string $parent The parent args.
		 */
		public function __construct($field, $value = '', $unique = '', $where = '', $parent = '')
		{
			parent::__construct($field, $value, $unique, $where, $parent);
		}
		/**
		 * Render method.
		 *
		 * @return void
		 */
		public function render()
		{
			$allowed_html = array(
				'i'     => array(
					'class' => array(),
				),
				'div'   => array(
					'class' => array(),
				),
				'p'   => array(
					'class' => array(),
				),
				'span'   => array(
					'class' => array(),
				),
			);

			// Get the Post ID.
			$post_id = get_the_ID();
			echo wp_kses((!empty($post_id)) ? '<div class="bop-scode-wrap-side"><p>"'. esc_html('To display your show, add the following shortcode into your post, custom post types, page, widget or block editor. If adding the show to your theme files, additionally include the surrounding PHP code.‎', 'bookify-pro') .'"</p><span class="bop-shortcode-selectable">[bookify id="' . esc_attr($post_id) . '"]</span></div><div class="bop-after-copy-text"><i class="far fa-check-circle"></i> "' . esc_html__('Shortcode Copied to Clipboard!', 'bookify-pro') . '" </div>' : '', $allowed_html);
		}
	}
}
