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
class Bookify_Pro_Admin
{

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
	public function __construct($plugin_name, $version)
	{

		$this->suffix      = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG || defined('WP_DEBUG') && WP_DEBUG ? '' : '.min';
		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// Autoload system.
		spl_autoload_register(array($this, 'autoload'));

		BOP_Metaboxes::bookify_metabox('ta_bop_postmeta');
		BOP_Metaboxes::layout_metabox('ta_bop_layouts');
		BOP_Metaboxes::option_metabox('ta_bop_view_options');
		BOP_Metaboxes::shortcode_metabox('ta_bop_display_shortcode');
		BOP_Settings::settings('ta_bookify_settings');

		$active_plugins = get_option('active_plugins');
		foreach ($active_plugins as $active_plugin) {
			$_temp = strpos($active_plugin, 'bookify-pro.php');
			if (false != $_temp) {
				add_filter('plugin_action_links_' . $active_plugin, array($this, 'add_plugin_action_links'));
			}
		}

		add_action('init', array($this, 'register_bookify_post'));
		add_action('init', array($this, 'register_bookify_category'));
		add_action('init', array($this, 'register_bookify_author'));
	}

	public function add_plugin_action_links($links)
	{
		$new_links = array(
			sprintf('<a href="%s">%s</a>', admin_url('post-new.php?post_type=bookify'), esc_html__('Add New', 'bookify-pro')),
			sprintf('<a href="%s">%s</a>', admin_url('edit.php?post_type=bookify'), esc_html__('Settings', 'bookify-pro')),
		);
		return array_merge($new_links, $links);
	}

	/**
	 * Autoload class files on demand
	 *
	 * @param string $class requested class name.
	 * @since 2.2.0
	 */
	private function autoload($class)
	{
		$name = explode('_', $class);
		if (isset($name[1])) {
			$class_name       = strtolower($name[1]);
			$BOP_config_paths = array('views/', 'views/configs/settings/', 'views/configs/generator/');
			foreach ($BOP_config_paths as $ta_bop_path) {
				$filename = plugin_dir_path(__FILE__) . '/' . $ta_bop_path . 'class-bop-' . $class_name . '.php';
				if (file_exists($filename)) {
					require_once $filename;
				}
			}
		}
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

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

		wp_enqueue_style('bookify-admin', BOP_URL . 'admin/assets/css/bookify-pro-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

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

		wp_enqueue_script('bookify-admin', BOP_URL . 'admin/assets/js/bookify-pro-admin.js', array('jquery'), $this->version, false);
	}

	public function register_bookify_post()
	{
		$labels = array(
			'name'               => __('Bookify', 'bookify-pro'),
			'singular_name'      => __('Bookify', 'bookify-pro'),
			'add_new'            => __('Add New Book', 'bookify-pro'),
			'add_new_item'       => __('Add New Book', 'bookify-pro'),
			'edit_item'          => __('Edit Book', 'bookify-pro'),
			'new_item'           => __('New Book', 'bookify-pro'),
			'all_items'          => __('All Books', 'bookify-pro'),
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
			'supports'      => array('title', 'editor', 'thumbnail', 'excerpt'),
			'menu_icon'          => 'dashicons-book',
			'taxonomies'    => array('bookify_category'),
		);

		$generate_shortcode = array(
			'name'               => esc_html__('Generate Shortcodes', 'bookify-pro'),
			'singular_name'      => esc_html__('Generate Shortcode', 'bookify-pro'),
			'menu_name'          => esc_html__('Generate Shortcode', 'bookify-pro'),
			'all_items'          => esc_html__('Generate Shortcodes', 'bookify-pro'),
			'add_new'            => esc_html__('Add New Shortcode', 'bookify-pro'),
			'add_new_item'       => esc_html__('Add New Shortcode', 'bookify-pro'),
			'new_item'           => esc_html__('Add New Shortcode', 'bookify-pro'),
			'edit_item'          => esc_html__('Edit Shortcode', 'bookify-pro'),
			'view_item'          => esc_html__('View Shortcode', 'bookify-pro'),
			'name_admin_bar'     => esc_html__('Generate Shortcode', 'bookify-pro'),
			'search_items'       => esc_html__('Search Shortcode', 'bookify-pro'),
			'parent_item_colon'  => esc_html__('Parent Shortcode:', 'bookify-pro'),
			'not_found'          => esc_html__('No Shortcode found.', 'bookify-pro'),
			'not_found_in_trash' => esc_html__('No Shortcode found in Trash.', 'bookify-pro')
		);
	
		$generate_shortcode_args = array(
			'labels'              => $generate_shortcode,
			'public'              => false,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'query_var'           => true,
			'rewrite'             => array('slug' => 'generate_shortcode'),
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array('title'),
			'show_in_nav_menus'   => false,
			'show_in_menu'        => 'edit.php?post_type=bookify',
		);

		register_post_type('bookify', $args);
		register_post_type('generate_shortcode', $generate_shortcode_args);
	}

	public function register_bookify_category()
	{
		$taxonomy_labels = array(
			'name'          => __('Book Categories', 'bookify-pro'),
			'singular_name' => __('Book Categories', 'bookify-pro'),
			'search_items'  => __('Search Book Categoriess', 'bookify-pro'),
			'all_items'     => __('All Book Categoriess', 'bookify-pro'),
			'parent_item'   => __('Parent Book Categories', 'bookify-pro'),
			'parent_item_colon' => __('Parent Book Categories:', 'bookify-pro'),
			'edit_item'     => __('Edit Book Categories', 'bookify-pro'),
			'update_item'   => __('Update Book Categories', 'bookify-pro'),
			'add_new_item'  => __('Add New Book Categories', 'bookify-pro'),
			'new_item_name' => __('New Book Categories Name', 'bookify-pro'),
			'menu_name'     => __('Book Categories', 'bookify-pro'),
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
	public function register_bookify_author()
	{
		$taxonomy_labels = array(
			'name'          => __('Bookify Author', 'bookify-pro'),
			'singular_name' => __('Bookify Author', 'bookify-pro'),
			'search_items'  => __('Search Bookify Authors', 'bookify-pro'),
			'all_items'     => __('All Bookify Authors', 'bookify-pro'),
			'parent_item'   => __('Parent Bookify Author', 'bookify-pro'),
			'parent_item_colon' => __('Parent Bookify Author:', 'bookify-pro'),
			'edit_item'     => __('Edit Bookify Author', 'bookify-pro'),
			'update_item'   => __('Update Bookify Author', 'bookify-pro'),
			'add_new_item'  => __('Add New Bookify Author', 'bookify-pro'),
			'new_item_name' => __('New Bookify Author Name', 'bookify-pro'),
			'menu_name'     => __('Bookify Author', 'bookify-pro'),
		);

		$taxonomy_args = array(
			'hierarchical'      => true, // Set to true if your taxonomy should have parent-child relationships
			'labels'            => $taxonomy_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array('slug' => 'bookify_author'),
		);

		register_taxonomy('bookify_author', 'bookify', $taxonomy_args);
	}
}

/**
 * Bookify dashboard capability.
 *
 * @return string
 */
function bop_dashboard_capability()
{
	return apply_filters('bop_dashboard_capability', 'manage_options');
}
