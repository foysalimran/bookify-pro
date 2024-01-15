<?php if (!defined('ABSPATH')) {
	die;
} // Cannot access directly.

/**
 * The Layout building class.
 */
class BOP_Layout
{

	/**
	 * Layout metabox section.
	 *
	 * @param string $prefix The metabox key.
	 * @return void
	 */
	public static function section($prefix)
	{
		BOP::createSection(
			$prefix,
			array(
				'fields' => array(
					array(
						'type'  => 'metabox_branding',
						'image' => BOP_URL . 'admin/assets/img/bookify-logo.svg',
						'after' => '<i class="fas fa-life-ring"></i> Support',
						'link'  => 'https://themeatelier.net/',
						'class' => 'BOP-admin-header',
					),
					array(
						'id'      => 'BOP_layout_preset',
						'type'    => 'layout_preset',
						'title'   => esc_html__('Layout Preset', 'bookify-pro'),
						'class'   => 'BOP-layout-preset',
						'options' => array(
							'grid_layout'      => array(
								'image' => BOP_URL . 'admin/assets/img/grid.png',
								'text'  => esc_html__('Grid', 'bookify-pro'),
							),
							'list_layout'  => array(
								'image' => BOP_URL . 'admin/assets/img/list.png',
								'text'  => esc_html__('List', 'bookify-pro'),
							),
							'carousel_layout'  => array(
								'image' => BOP_URL . 'admin/assets/img/carousel.png',
								'text'  => esc_html__('Carousel', 'bookify-pro'),
							),
						),
						'default' => 'grid_layout',
					),
				), // End of fields array.
			)
		);
	}
}
