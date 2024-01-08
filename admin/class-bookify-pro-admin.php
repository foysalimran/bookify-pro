<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://https://https://themeatelier.net/
 * @since      1.0.0
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/admin
 * @author     ThemeAtelier <themeatelierbd@gmail.com>
 */
class Bookify_Pro_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action('init', array($this, 'register_bookify_post'));
		add_action('init', array($this, 'register_bookify_category'));
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bookify_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bookify_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/bookify-pro-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Bookify_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Bookify_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/bookify-pro-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function register_bookify_post() {
		$labels = array(
			'name'               => __('Bookify', 'bookify-pro'),
			'singular_name'      => __('Bookify', 'bookify-pro'),
			'add_new'            => __('Add New Book', 'bookify-pro'),
			'add_new_item'       => __('Add New Book', 'bookify-pro'),
			'edit_item'          => __('Edit Book', 'bookify-pro'),
			'new_item'           => __('New Book', 'bookify-pro'),
			'all_items'          => __('All Book', 'bookify-pro'),
			'view_item'          => __('View Book', 'bookify-pro'),
			'search_items'       => __('Search Book', 'bookify-pro'),
			'not_found'          => __('No Book Found', 'bookify-pro'),
			'not_found_in_trash' => __('No Book Found in Trash', 'bookify-pro'),
			'parent_item_colon'  => '',
			'menu_name'          => __('Bookify', 'bookify-pro'),
		);
		
		$args = array(
			'labels'        => $labels,
			'public'        => true,
			'has_archive'   => true,
			'menu_position' => 5,
			'supports'      => array('title', 'editor', 'thumbnail', 'custom-fields'),
			'menu_icon'          => 'dashicons-book',
			'taxonomies'    => array('bookify_category'),
		);
	
		register_post_type('bookify', $args);
	}

	public function register_bookify_category() {
        $taxonomy_labels = array(
            'name'          => __('Bookify Categories', 'bookify-pro'),
            'singular_name' => __('Bookify Categories', 'bookify-pro'),
            'search_items'  => __('Search Bookify Categoriess', 'bookify-pro'),
            'all_items'     => __('All Bookify Categoriess', 'bookify-pro'),
            'parent_item'   => __('Parent Bookify Categories', 'bookify-pro'),
            'parent_item_colon' => __('Parent Bookify Categories:', 'bookify-pro'),
            'edit_item'     => __('Edit Bookify Categories', 'bookify-pro'),
            'update_item'   => __('Update Bookify Categories', 'bookify-pro'),
            'add_new_item'  => __('Add New Bookify Categories', 'bookify-pro'),
            'new_item_name' => __('New Bookify Categories Name', 'bookify-pro'),
            'menu_name'     => __('Bookify Categories', 'bookify-pro'),
        );

        $taxonomy_args = array(
            'hierarchical'      => true, // Set to true if your taxonomy should have parent-child relationships
            'labels'            => $taxonomy_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => 'bookify_category'),
        );

        register_taxonomy('bookify_category', 'bookify', $taxonomy_args);
    }
}
