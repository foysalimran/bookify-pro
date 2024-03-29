<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access directly.

/**
 * Custom post class to register the carousel.
 */
class Bookify_pro_Post_Type {


	/**
	 * The single instance of the class.
	 *
	 * @var self
	 * @since 2.2.0
	 */
	private static $instance;

	/**
	 * Path to the file.
	 *
	 * @since 2.2.0
	 *
	 * @var string
	 */
	public $file = __FILE__;

	/**
	 * Holds the base class object.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $base;

	/**
	 * Allows for accessing single instance of class. Class should only be constructed once per call.
	 *
	 * @since 2.2.0
	 * @static
	 * @return self Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Bookify post type
	 */
	public function register_bookify_post_type() {
		if ( post_type_exists( 'bookify' ) ) {
			return;
		}
		$capability = bop_dashboard_capability();
		// Set the Bookify post type labels.
		$labels = apply_filters(
			'bookify_post_type_labels',
			array(
				'name'               => esc_html__( 'Bookify Shortcode', 'bookify-pro' ),
				'singular_name'      => esc_html__( 'Shortcode', 'bookify-pro' ),
				'menu_name'          => esc_html__( 'Bookify', 'bookify-pro' ),
				'all_items'          => esc_html__( 'All Layouts', 'bookify-pro' ),
				'add_new'            => esc_html__( 'Add Layout', 'bookify-pro' ),
				'add_new_item'       => esc_html__( 'Generate New Shortcode', 'bookify-pro' ),
				'new_item'           => esc_html__( 'Generate New Shortcode', 'bookify-pro' ),
				'edit_item'          => esc_html__( 'Edit Generated Shortcode', 'bookify-pro' ),
				'view_item'          => esc_html__( 'View Generated Shortcode', 'bookify-pro' ),
				'name_admin_bar'     => esc_html__( 'Bookify Generator', 'bookify-pro' ),
				'search_items'       => esc_html__( 'Search Generated Shortcode', 'bookify-pro' ),
				'parent_item_colon'  => esc_html__( 'Parent Generated Shortcode:', 'bookify-pro' ),
				'not_found'          => esc_html__( 'No Shortcode found.', 'bookify-pro' ),
				'not_found_in_trash' => esc_html__( 'No Shortcode found in Trash.', 'bookify-pro' ),
			)
		);

		$args = apply_filters(
			'bookify_post_type_args',
			array(
				'label'           => esc_html__( 'Bookify Shortcode', 'bookify-pro' ),
				'description'     => esc_html__( 'Bookify Shortcode', 'bookify-pro' ),
				'public'          => false,
				'show_ui'         => true,
				'show_in_menu'    => true,
				'menu_icon'       => 'dashicons-calendar',
				'hierarchical'    => false,
				'query_var'       => false,
				'menu_position'   => 5,
				'supports'        => array( 'title' ),
				'capabilities'    => array(
					'publish_posts'       => $capability,
					'edit_posts'          => $capability,
					'edit_others_posts'   => $capability,
					'delete_posts'        => $capability,
					'delete_others_posts' => $capability,
					'read_private_posts'  => $capability,
					'edit_post'           => $capability,
					'delete_post'         => $capability,
					'read_post'           => $capability,
				),
				'capability_type' => 'post',
				'labels'          => $labels,
			)
		);

		register_post_type( 'bookify', $args );
	}
}
