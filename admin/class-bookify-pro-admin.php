<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://themeatelier.net/
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


	protected $suffix;
	private $plugin_name;
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->suffix      = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		// Autoload system.
		spl_autoload_register( array( $this, 'autoload' ) );

		BOP_Metaboxes::bookify_metabox( 'ta_bookify_postmeta' );
		BOP_Metaboxes::layout_metabox( 'ta_bookify_layouts' );
		BOP_Metaboxes::option_metabox( 'ta_bookify_options' );
		BOP_Metaboxes::shortcode_metabox( 'ta_bookify_shortcode' );
		BOP_Settings::settings( 'ta_bookify_settings' );

		$active_plugins = get_option( 'active_plugins' );
		foreach ( $active_plugins as $active_plugin ) {
			$_temp = strpos( $active_plugin, 'bookify-pro.php' );
			if ( false != $_temp ) {
				add_filter( 'plugin_action_links_' . $active_plugin, array( $this, 'add_plugin_action_links' ) );
			}
		}

		add_action( 'init', array( $this, 'register_bookify_post' ) );
		add_action( 'init', array( $this, 'register_bookify_category' ) );
	}

	public function add_plugin_action_links( $links ) {
		$new_links = array(
			sprintf( '<a href="%s">%s</a>', admin_url( 'post-new.php?post_type=bookify' ), esc_html__( 'Add New', 'bookify-pro' ) ),
			sprintf( '<a href="%s">%s</a>', admin_url( 'edit.php?post_type=bookify' ), esc_html__( 'Settings', 'bookify-pro' ) ),
		);
		return array_merge( $new_links, $links );
	}

	/**
	 * Autoload class files on demand
	 *
	 * @param string $class requested class name.
	 * @since 2.2.0
	 */
	private function autoload( $class ) {
		$name = explode( '_', $class );
		if ( isset( $name[1] ) ) {
			$class_name       = strtolower( $name[1] );
			$BOP_config_paths = array( 'views/', 'views/configs/settings/', 'views/configs/generator/' );
			foreach ( $BOP_config_paths as $ta_bop_path ) {
				$filename = plugin_dir_path( __FILE__ ) . '/' . $ta_bop_path . 'class-bop-' . $class_name . '.php';
				if ( file_exists( $filename ) ) {
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

		$current_screen        = get_current_screen();
		$the_current_post_type = $current_screen->post_type;
		if ( 'bookify' == $the_current_post_type || 'bookify_shortcode' === $the_current_post_type ) {
			wp_enqueue_style( 'bookify-admin', BOP_URL . 'admin/assets/css/bookify-pro-admin' . $this->suffix . '.css', array(), $this->version, 'all' );
		}
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

		$current_screen        = get_current_screen();
		$the_current_post_type = $current_screen->post_type;
		if ( 'bookify' == $the_current_post_type || 'bookify_shortcode' == $the_current_post_type ) {
			wp_enqueue_script( 'bookify-admin', BOP_URL . 'admin/assets/js/bookify-pro-admin' . $this->suffix . '.js', array( 'jquery' ), $this->version, false );
		}
	}

	public function register_bookify_post() {
		$options       = get_option( 'ta_bookify_settings' );
		$bop_post_slug = $options['bop_post_slug'];
		// Section creator post type
		if ( $bop_post_slug ) {
			$bop_post_slug;
		} else {
			$bop_post_slug = 'books';
		}
		$labels = array(
			'name'               => esc_html__( 'Bookify', 'bookify-pro' ),
			'singular_name'      => esc_html__( 'Bookify', 'bookify-pro' ),
			'add_new'            => esc_html__( 'Add New Book', 'bookify-pro' ),
			'add_new_item'       => esc_html__( 'Add New Book', 'bookify-pro' ),
			'edit_item'          => esc_html__( 'Edit Book', 'bookify-pro' ),
			'new_item'           => esc_html__( 'New Book', 'bookify-pro' ),
			'all_items'          => esc_html__( 'All Books', 'bookify-pro' ),
			'view_item'          => esc_html__( 'View Book', 'bookify-pro' ),
			'search_items'       => esc_html__( 'Search Book', 'bookify-pro' ),
			'not_found'          => esc_html__( 'No Book Found', 'bookify-pro' ),
			'not_found_in_trash' => esc_html__( 'No Book Found in Trash', 'bookify-pro' ),
			'parent_item_colon'  => '',
			'menu_name'          => esc_html__( 'Bookify', 'bookify-pro' ),
		);

		$args = array(
			'labels'        => $labels,
			'public'        => true,
			'has_archive'   => true,
			'menu_position' => 5,
			'supports'      => array( 'title', 'editor', 'thumbnail' ),
			'menu_icon'     => 'dashicons-book',
			'taxonomies'    => array( 'bookify_category' ),
			'rewrite'       => array( 'slug' => $bop_post_slug ),
		);

		$bookify_shortcode = array(
			'name'               => esc_html__( 'Generate Shortcodes', 'bookify-pro' ),
			'singular_name'      => esc_html__( 'Generate Shortcode', 'bookify-pro' ),
			'menu_name'          => esc_html__( 'Generate Shortcode', 'bookify-pro' ),
			'all_items'          => esc_html__( 'Generate Shortcodes', 'bookify-pro' ),
			'add_new'            => esc_html__( 'Add New Shortcode', 'bookify-pro' ),
			'add_new_item'       => esc_html__( 'Add New Shortcode', 'bookify-pro' ),
			'new_item'           => esc_html__( 'Add New Shortcode', 'bookify-pro' ),
			'edit_item'          => esc_html__( 'Edit Shortcode', 'bookify-pro' ),
			'view_item'          => esc_html__( 'View Shortcode', 'bookify-pro' ),
			'name_admin_bar'     => esc_html__( 'Generate Shortcode', 'bookify-pro' ),
			'search_items'       => esc_html__( 'Search Shortcode', 'bookify-pro' ),
			'parent_item_colon'  => esc_html__( 'Parent Shortcode:', 'bookify-pro' ),
			'not_found'          => esc_html__( 'No Shortcode found.', 'bookify-pro' ),
			'not_found_in_trash' => esc_html__( 'No Shortcode found in Trash.', 'bookify-pro' ),
		);

		$bookify_shortcode_args = array(
			'labels'              => $bookify_shortcode,
			'public'              => false,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'show_ui'             => true,
			'query_var'           => true,
			'rewrite'             => array( 'slug' => 'bookify_shortcode' ),
			'capability_type'     => 'post',
			'hierarchical'        => false,
			'supports'            => array( 'title' ),
			'show_in_nav_menus'   => false,
			'show_in_menu'        => 'edit.php?post_type=bookify',
		);

		register_post_type( 'bookify', $args );
		register_post_type( 'bookify_shortcode', $bookify_shortcode_args );
	}

	public function register_bookify_category() {
		$options            = get_option( 'ta_bookify_settings' );
		$book_category_slug = $options['bop_archive_slug'];
		// Section creator post type
		if ( $book_category_slug ) {
			$book_category_slug;
		} else {
			$book_category_slug = 'book_category';
		}
		$taxonomy_labels = array(
			'name'              => esc_html__( 'Book Categories', 'bookify-pro' ),
			'singular_name'     => esc_html__( 'Book Categories', 'bookify-pro' ),
			'search_items'      => esc_html__( 'Search Book Categoriess', 'bookify-pro' ),
			'all_items'         => esc_html__( 'All Book Categoriess', 'bookify-pro' ),
			'parent_item'       => esc_html__( 'Parent Book Categories', 'bookify-pro' ),
			'parent_item_colon' => esc_html__( 'Parent Book Categories:', 'bookify-pro' ),
			'edit_item'         => esc_html__( 'Edit Book Categories', 'bookify-pro' ),
			'update_item'       => esc_html__( 'Update Book Categories', 'bookify-pro' ),
			'add_new_item'      => esc_html__( 'Add New Book Categories', 'bookify-pro' ),
			'new_item_name'     => esc_html__( 'New Book Categories Name', 'bookify-pro' ),
			'menu_name'         => esc_html__( 'Book Categories', 'bookify-pro' ),
		);

		$taxonomy_args = array(
			'hierarchical'      => true, // Set to true if your taxonomy should have parent-child relationships
			'labels'            => $taxonomy_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => $book_category_slug ),
		);

		register_taxonomy( 'bookify_category', 'bookify', $taxonomy_args );
	}

	/**
	 * Add bookify admin columns.
	 *
	 * @since 2.0.0
	 * @return statement
	 */
	public function filter_bookify_admin_column() {

		$admin_columns['cb']         = '<input type="checkbox" />';
		$admin_columns['title']      = esc_html__( 'Title', 'bookify-pro' );
		$admin_columns['shortcode']  = esc_html__( 'Shortcode', 'bookify-pro' );
		$admin_columns['bop_layout'] = esc_html__( 'Layout', 'bookify-pro' );
		$admin_columns['date']       = esc_html__( 'Date', 'bookify-pro' );

		return $admin_columns;
	}

	/**
	 * Display admin columns for the bookifys.
	 *
	 * @param mix    $column The columns.
	 * @param string $post_id The post ID.
	 * @return void
	 */
	public function display_bookify_admin_fields( $column, $post_id ) {

		$bop_layouts    = get_post_meta( $post_id, 'ta_bookify_layouts', true );
		$bookifys_types = isset( $bop_layouts['bop_layout_preset'] ) ? $bop_layouts['bop_layout_preset'] : '';
		switch ( $column ) {
			case 'shortcode':


				$allowed_html = array(
					'input' => array(
						'class'    => array(),
						'style'    => array(),
						'title'    => array(),
						'onClick'  => array(),
						'value'    => array(),
						'readonly' => array(),
						'type' => array(),
					),
					'i'     => array(
						'class' => array(),
					),
					'div'   => array(
						'class' => array(),
					),
				);
				
				$column_field = '<input class="ta_bop_input" style="width: 230px; padding: 4px 8px; cursor: pointer;" type="text" onClick="selectText(this)" readonly="readonly" value="[bookify id=&quot;' . esc_attr($post_id) . '&quot;]"/>
                 <div class="bop-after-copy-text"><i class="far fa-check-circle"></i> "' . esc_html__('Shortcode Copied to Clipboard!', 'bookify-pro') . '" </div>';
				
				echo wp_kses($column_field, $allowed_html);
				
				break;
			case 'bop_layout':
				$layout = ucwords( str_replace( '_layout', ' ', $bookifys_types ) );
				esc_html_e( $layout, 'bookify-pro' );
				break;
		} // end switch.
	}

	/**
	 * If it is the plugins page.
	 *
	 * @since 2.2.0
	 * @access private
	 */
	private function is_plugins_screen() {
		return in_array( get_current_screen()->id, array( 'plugins', 'plugins-network' ) );
	}
}

/**
 * Bookify dashboard capability.
 *
 * @return string
 */
function bop_dashboard_capability() {
	return apply_filters( 'bop_dashboard_capability', 'manage_options' );
}
