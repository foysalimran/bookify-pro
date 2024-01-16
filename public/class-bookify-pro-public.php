<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://https://https://https://themeatelier.net/
 * @since      1.0.0
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 * @author     ThemeAtelier <themeatelierbd@gmail.com>
 */
class Bookify_Pro_Public {

	/**
	 * Script and style suffix
	 *
	 * @since 2.2.0
	 * @access protected
	 * @var string
	 */
	protected $suffix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct()
	{
		$this->load_public_dependencies();
		$this->bop_public_action();
	}

	private function load_public_dependencies()
	{
		require_once BOP_PATH . 'public/helpers/class-post-functions.php';
		require_once BOP_PATH . 'public/helpers/class-bop-user-like.php';
		new BOP_User_Like();
		require_once BOP_PATH . 'public/helpers/class-bop-queryinside.php';
		require_once BOP_PATH . 'public/helpers/class-bop-customfieldprocess.php';
		require_once BOP_PATH . 'public/helpers/class-bop-shuffle-filter.php';
		require_once BOP_PATH . 'public/helpers/class-bop-live-filter.php';
		new BOP_Live_Filter();
		require_once BOP_PATH . 'public/helpers/class-loop-html.php';
	}

	private function bop_public_action()
	{

		add_action('wp_ajax_post_grid_ajax', array($this, 'post_grid_ajax'));
		add_action('wp_ajax_nopriv_post_grid_ajax', array($this, 'post_grid_ajax'));

		add_action('wp_ajax_bop_post_bopup', array($this, 'bop_post_bopup'));
		add_action('wp_ajax_nopriv_bop_post_bopup', array($this, 'bop_post_bopup'));

		add_action('wp_ajax_bop_post_bopup_next_prev', array($this, 'bop_post_bopup_next_prev'));
		add_action('wp_ajax_nopriv_bop_post_bopup_next_prev', array($this, 'bop_post_bopup_next_prev'));

		add_action('wp_ajax_post_pagination_bar', array($this, 'post_pagination_bar'));
		add_action('wp_ajax_nopriv_post_pagination_bar', array($this, 'post_pagination_bar'));

		add_action('wp_ajax_post_pagination_bar_mobile', array($this, 'post_pagination_bar_mobile'));
		add_action('wp_ajax_nopriv_post_pagination_bar_mobile', array($this, 'post_pagination_bar_mobile'));

		add_action('wp_ajax_bop_post_order', array($this, 'bop_post_order'));
		add_action('wp_ajax_nopriv_bop_post_order', array($this, 'bop_post_order'));

		add_shortcode('bookify', array($this, 'bop_shortcode_render'));

		$this->suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) || (defined('WP_DEBUG') && WP_DEBUG) ? '' : '.min';
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    2.0.0
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

		$bop_settings        = get_option('ta_bookify_settings');
		$bop_fontawesome_css = isset($bop_settings['bop_fontawesome_css']) ? $bop_settings['bop_fontawesome_css'] : true;
		$bop_swiper_css      = isset($bop_settings['bop_swiper_css']) ? $bop_settings['bop_swiper_css'] : true;
		$bop_bxslider_css    = isset($bop_settings['bop_bxSlider_css']) ? $bop_settings['bop_bxSlider_css'] : true;
		$bop_like_css        = isset($bop_settings['bop_like_css']) ? $bop_settings['bop_like_css'] : true;
		$bop_magnific_css    = isset($bop_settings['bop_magnific_css']) ? $bop_settings['bop_magnific_css'] : true;
		if ($bop_fontawesome_css) {
			wp_enqueue_style('bop-font-awesome', BOP_URL . 'public/assets/css/fontawesome.min.css', array(), BOP_VERSION, 'all');
		}
		if ($bop_swiper_css) {
			wp_enqueue_style('bop_swiper', BOP_URL . 'public/assets/css/swiper-bundle' . $this->suffix . '.css', array(), BOP_VERSION, 'all');
		}
		if ($bop_bxslider_css) {
			wp_enqueue_style('bop-bxslider', BOP_URL . 'public/assets/css/jquery.bxslider' . $this->suffix . '.css', array(), BOP_VERSION, 'all');
		}
		if ($bop_like_css) {
			wp_enqueue_style('bop-likes', BOP_URL . 'public/assets/css/bop-likes-public' . $this->suffix . '.css', array(), BOP_VERSION, 'all');
		}
		wp_enqueue_style('bop-grid', BOP_URL . 'public/assets/css/ta-grid' . $this->suffix . '.css', array(), BOP_VERSION, 'all');
		wp_enqueue_style('bop-style', BOP_URL . 'public/assets/css/style' . $this->suffix . '.css', array(), BOP_VERSION, 'all');

		$bop_posts       = new WP_Query(
			array(
				'post_type'      => 'bookify',
				'posts_per_page' => 900,
			)
		);
		$post_ids        = wp_list_pluck($bop_posts->posts, 'ID');
		$custom_css      = '';
		$enqueue_fonts   = array();
		$setting_options = get_option('ta_bookify_settings');
		$bop_custom_css  = isset($setting_options['bop_custom_css']) ? $setting_options['bop_custom_css'] : '';

		$bop_enqueue_google_font = isset($setting_options['bop_enqueue_google_font']) ? $setting_options['bop_enqueue_google_font'] : true;
		foreach ($post_ids as $bop_id) {
			// Include dynamic style file.
			$view_options = get_post_meta($bop_id, 'ta_bop_view_options', true);
			$layouts      = get_post_meta($bop_id, 'ta_bop_layouts', true);
			include 'dynamic-css/dynamic-css.php';

			if ($bop_enqueue_google_font) {
				// Google fonts.
				$view_options     = get_post_meta($bop_id, 'ta_bop_view_options', true);
				$all_fonts        = array();
				$bop_typography   = array();
				$bop_typography[] = $view_options['section_title_typography'];
				$bop_typography[] = $view_options['post_title_typography'];
				$bop_typography[] = $view_options['post_meta_typography'];
				$bop_typography[] = $view_options['post_content_typography'];
				$bop_typography[] = isset($view_options['read_more_typography']) ? $view_options['read_more_typography'] : array(
					'font-family'        => '',
					'font-weight'        => '600',
					'subset'             => '',
					'font-size'          => '12',
					'tablet-font-size'   => '12',
					'mobile-font-size'   => '10',
					'line-height'        => '18',
					'tablet-line-height' => '18',
					'mobile-line-height' => '16',
					'letter-spacing'     => '0',
					'text-align'         => 'left',
					'text-transform'     => 'uppercase',
					'type'               => '',
					'unit'               => 'px',
				);
				if (!empty($bop_typography)) {
					foreach ($bop_typography as $font) {
						if (isset($font['font-family']) && isset($font['type']) && 'google' === $font['type']) {
							$variant     = (isset($font['font-weight']) && '' !== $font['font-weight']) ? ':' . $font['font-weight'] : '';
							$all_fonts[] = $font['font-family'] . $variant;
						}
					}
				}
				if ($all_fonts) {
					$enqueue_fonts[] = $all_fonts;
				}
			}
		}
		// Enqueue Google fonts.
		if ($bop_enqueue_google_font && !empty($enqueue_fonts)) {
			wp_enqueue_style('bop-google-fonts', esc_url(add_query_arg('family', rawurlencode(implode('|', array_merge(...$enqueue_fonts))), '//fonts.googleapis.com/css')), array(), BOP_VERSION, false);
		}
		include 'dynamic-css/responsive-css.php';
		if (!empty($bop_custom_css)) {
			$custom_css .= $bop_custom_css;
		}
		// Add dynamic style.
		wp_add_inline_style('bop-style', $custom_css);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    2.2.0
	 */
	public function enqueue_scripts()
	{
		wp_register_script('bop-swiper', BOP_URL . 'public/assets/js/swiper-bundle' . $this->suffix . '.js', array('jquery'), BOP_VERSION, true);
		wp_register_script('bop-isotope', BOP_URL . 'public/assets/js/isotope' . $this->suffix . '.js', array('jquery'), BOP_VERSION, true);
		wp_register_script('bop-bxslider', BOP_URL . 'public/assets/js/jquery.bxslider' . $this->suffix . '.js', array('jquery'), BOP_VERSION, true);
		wp_register_script('bop-lazy', BOP_URL . 'public/assets/js/bop-lazyload' . $this->suffix . '.js', array('jquery'), BOP_VERSION, true);
		wp_register_script('bop-script', BOP_URL . 'public/assets/js/scripts' . $this->suffix . '.js', array('bop-swiper', 'bop-bxslider'), BOP_VERSION, true);
		wp_localize_script(
			'bop-script',
			'spbop',
			array(
				'ajaxurl' => admin_url('admin-ajax.php'),
				'nonce'   => wp_create_nonce('spbop_nonce'),
			)
		);
	}

	/**
	 * Post Ajax Pagination.
	 */
	public static function post_grid_ajax()
	{
		if (isset($_POST['nonce']) && !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'spbop_nonce')) {
			return false;
		}
		$views_id            = isset($_POST['id']) ? absint($_POST['id']) : '';
		$keyword             = isset($_POST['keyword']) ? sanitize_text_field(wp_unslash($_POST['keyword'])) : '';
		$orderby             = isset($_POST['orderby']) ? sanitize_text_field(wp_unslash($_POST['orderby'])) : '';
		$order               = isset($_POST['order']) ? sanitize_text_field(wp_unslash($_POST['order'])) : '';
		$taxonomy            = isset($_POST['taxonomy']) ? sanitize_text_field(wp_unslash($_POST['taxonomy'])) : '';
		$term_id             = isset($_POST['term_id']) ? sanitize_text_field(wp_unslash($_POST['term_id'])) : '';
		$bop_lang            = isset($_POST['lang']) ? sanitize_text_field(wp_unslash($_POST['lang'])) : '';
		$author_id           = isset($_POST['author_id']) ? sanitize_text_field(wp_unslash($_POST['author_id'])) : '';
		$paged               = isset($_POST['page']) ? sanitize_text_field(wp_unslash($_POST['page'])) : '';
		$custom_fields_array = isset($_POST['custom_fields_array']) ? wp_unslash($_POST['custom_fields_array']) : '';
		$selected_term_list  = isset($_POST['term_list']) ? wp_unslash($_POST['term_list']) : '';
		// $bop_search_url     = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( sanitize_text_field( $_SERVER['REQUEST_URI'] ) ) : '';
		$layout        = get_post_meta($views_id, 'ta_bop_layouts', true);
		$layout_preset = isset($layout['bop_layout_preset']) ? $layout['bop_layout_preset'] : '';
		$view_options  = get_post_meta($views_id, 'ta_bop_view_options', true);
		// Post display settings.
		if ('filter_layout' === $layout_preset) {
			$pagination_type        = isset($view_options['filter_pagination_type']) ? $view_options['filter_pagination_type'] : '';
			$pagination_type_mobile = isset($view_options['filter_pagination_type']) ? $view_options['filter_pagination_type'] : '';
		} else {
			$pagination_type        = isset($view_options['post_pagination_type']) ? $view_options['post_pagination_type'] : '';
			$pagination_type_mobile = isset($view_options['post_pagination_type_mobile']) ? $view_options['post_pagination_type_mobile'] : '';
		}

		if ('ajax_number' === $pagination_type) {
			if (empty($paged)) {
				$paged = isset($_POST['page']) ? sanitize_text_field(wp_unslash($_POST['page'])) : '';
			}
		}
		$post_content_sorter              = isset($view_options['post_content_sorter']) ? $view_options['post_content_sorter'] : '';
		$query_args                       = BOP_QueryInside::get_filtered_content($view_options, $views_id, $layout_preset);
		$post_limit                       = isset($view_options['bop_post_limit']) && !empty($view_options['bop_post_limit']) ? $view_options['bop_post_limit'] : 10000;
		$post_offset                      = isset($view_options['bop_post_offset']) ? $view_options['bop_post_offset'] : 0;
		$new_query_args                   = $query_args;
		$new_query_args['fields']         = 'ids';
		$new_query_args['posts_per_page'] = $post_limit;
		$query_post_ids                   = get_posts($new_query_args);
		$relation                         = isset($view_options['bop_filter_by_taxonomy']['bop_taxonomies_relation']) ? $view_options['bop_filter_by_taxonomy']['bop_taxonomies_relation'] : 'AND';
		$query_args                       = BOP_Functions::modify_query_params($query_args, $keyword, $author_id, $custom_fields_array, $orderby, $order, $selected_term_list, $post_offset, $relation, $query_post_ids, $bop_lang);
		$new_query_args                   = $query_args;
		$new_query_args['fields']         = 'ids';
		$new_query_args['posts_per_page'] = $post_limit;
		$total_posts                      = count(get_posts($new_query_args));
		$post_limit                       = $total_posts;
		if ($post_limit > 0) {
			$post_per_page = isset($view_options['post_per_page']) ? $view_options['post_per_page'] : '';
			$post_per_page = ($post_per_page > $post_limit) ? $post_limit : $post_per_page;
			if ($post_limit < 1) {
				$total_page = 0;
			} else {
				$total_page = BOP_Functions::bop_max_pages($post_limit, $post_per_page);
			}
			$bop_last_page_post   = BOP_Functions::bop_last_page_post($post_limit, $post_per_page, $total_page);
			$offset               = (int) $post_per_page * ($paged - 1);
			$query_args['offset'] = (int) $offset + (int) $post_offset;
			if ($total_page == $paged) {
				$query_args['posts_per_page'] = $bop_last_page_post;
			}
			if ($paged > $total_page) {
				return false;
			}
		}
		$query_args['paged'] = $paged;
		$bop_query           = new WP_Query($query_args);
		BOP_HTML::bop_get_posts($view_options, $layout_preset, $post_content_sorter, $bop_query, $views_id);
		die();
	}

	/**
	 * Post Ajax Pagination.
	 */
	public static function post_pagination_bar()
	{
		if (isset($_POST['nonce']) && !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'spbop_nonce')) {
			return false;
		}
		$views_id            = isset($_POST['id']) ? absint($_POST['id']) : '';
		$keyword             = isset($_POST['keyword']) ? sanitize_text_field(wp_unslash($_POST['keyword'])) : '';
		$orderby             = isset($_POST['orderby']) ? sanitize_text_field(wp_unslash($_POST['orderby'])) : '';
		$order               = isset($_POST['order']) ? sanitize_text_field(wp_unslash($_POST['order'])) : '';
		$taxonomy            = isset($_POST['taxonomy']) ? sanitize_text_field(wp_unslash($_POST['taxonomy'])) : '';
		$term_id             = isset($_POST['term_id']) ? sanitize_text_field(wp_unslash($_POST['term_id'])) : '';
		$bop_lang            = isset($_POST['lang']) ? sanitize_text_field(wp_unslash($_POST['lang'])) : '';
		$author_id           = isset($_POST['author_id']) ? sanitize_text_field(wp_unslash($_POST['author_id'])) : '';
		$paged               = isset($_POST['page']) ? sanitize_text_field(wp_unslash($_POST['page'])) : '';
		$custom_fields_array = isset($_POST['custom_fields_array']) ? wp_unslash($_POST['custom_fields_array']) : '';
		$selected_term_list  = isset($_POST['term_list']) ? wp_unslash($_POST['term_list']) : '';
		$view_options        = get_post_meta($views_id, 'ta_bop_view_options', true);
		$layout              = get_post_meta($views_id, 'ta_bop_layouts', true);
		$layout_preset       = isset($layout['bop_layout_preset']) ? $layout['bop_layout_preset'] : '';
		$pagination_type     = isset($view_options['post_pagination_type']) ? $view_options['post_pagination_type'] : '';
		$pagination_type     = isset($view_options['post_pagination_type_mobile']) ? $view_options['post_pagination_type_mobile'] : '';
		$query_args          = BOP_QueryInside::get_filtered_content($view_options, $views_id, $layout_preset);

		$post_offset                      = isset($view_options['bop_post_offset']) ? $view_options['bop_post_offset'] : 0;
		$new_query_args                   = $query_args;
		$new_query_args['fields']         = 'ids';
		$post_limit                       = isset($view_options['bop_post_limit']) && !empty($view_options['bop_post_limit']) ? $view_options['bop_post_limit'] : 10000;
		$new_query_args['posts_per_page'] = $post_limit;
		$query_post_ids                   = get_posts($new_query_args);

		$relation           = isset($view_options['bop_filter_by_taxonomy']['bop_taxonomies_relation']) ? $view_options['bop_filter_by_taxonomy']['bop_taxonomies_relation'] : 'AND';
		$query_args         = BOP_Functions::modify_query_params($query_args, $keyword, $author_id, $custom_fields_array, $orderby, $order, $selected_term_list, $post_offset, $relation, $query_post_ids, $bop_lang);
		$query_args['lang'] = '';
		$bop_query          = new WP_Query($query_args);
		BOP_HTML::bop_pagination_bar($bop_query, $view_options, $layout, $views_id, $paged);
		die();
	}

	/**
	 * Post Ajax mobile Pagination.
	 */
	public static function post_pagination_bar_mobile()
	{
		if (isset($_POST['nonce']) && !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'spbop_nonce')) {
			return false;
		}
		$views_id            = isset($_POST['id']) ? absint($_POST['id']) : '';
		$keyword             = isset($_POST['keyword']) ? sanitize_text_field(wp_unslash($_POST['keyword'])) : '';
		$orderby             = isset($_POST['orderby']) ? sanitize_text_field(wp_unslash($_POST['orderby'])) : '';
		$order               = isset($_POST['order']) ? sanitize_text_field(wp_unslash($_POST['order'])) : '';
		$taxonomy            = isset($_POST['taxonomy']) ? sanitize_text_field(wp_unslash($_POST['taxonomy'])) : '';
		$term_id             = isset($_POST['term_id']) ? sanitize_text_field(wp_unslash($_POST['term_id'])) : '';
		$bop_lang            = isset($_POST['lang']) ? sanitize_text_field(wp_unslash($_POST['lang'])) : '';
		$author_id           = isset($_POST['author_id']) ? sanitize_text_field(wp_unslash($_POST['author_id'])) : '';
		$paged               = isset($_POST['page']) ? sanitize_text_field(wp_unslash($_POST['page'])) : '';
		$selected_term_list  = isset($_POST['term_list']) ? wp_unslash($_POST['term_list']) : '';
		$custom_fields_array = isset($_POST['custom_fields_array']) ? wp_unslash($_POST['custom_fields_array']) : '';
		$view_options        = get_post_meta($views_id, 'ta_bop_view_options', true);
		$layout              = get_post_meta($views_id, 'ta_bop_layouts', true);
		$layout_preset       = isset($layout['bop_layout_preset']) ? $layout['bop_layout_preset'] : '';
		$pagination_type     = isset($view_options['post_pagination_type']) ? $view_options['post_pagination_type'] : '';
		$pagination_type     = isset($view_options['post_pagination_type_mobile']) ? $view_options['post_pagination_type_mobile'] : '';
		$query_args          = BOP_QueryInside::get_filtered_content($view_options, $views_id, $layout_preset, 'on_mobile');
		$tax_settings        = array();
		$post_offset         = isset($view_options['bop_post_offset']) ? $view_options['bop_post_offset'] : 0;

		$new_query_args                   = $query_args;
		$new_query_args['fields']         = 'ids';
		$post_limit                       = isset($view_options['bop_post_limit']) && !empty($view_options['bop_post_limit']) ? $view_options['bop_post_limit'] : 10000;
		$new_query_args['posts_per_page'] = $post_limit;
		$query_post_ids                   = get_posts($new_query_args);
		$query_post_ids                   = array('');

		$relation   = isset($view_options['bop_filter_by_taxonomy']['bop_taxonomies_relation']) ? $view_options['bop_filter_by_taxonomy']['bop_taxonomies_relation'] : 'AND';
		$query_args = BOP_Functions::modify_query_params($query_args, $keyword, $author_id, $custom_fields_array, $orderby, $order, $selected_term_list, $post_offset, $relation, $query_post_ids, $bop_lang);
		$bop_query  = new WP_Query($query_args);
		BOP_HTML::bop_pagination_bar($bop_query, $view_options, $layout, $views_id, $paged, 'on_mobile');
		die();
	}

	/**
	 * Post Ajax filter.
	 */
	public static function bop_post_order()
	{
		if (isset($_POST['nonce']) && !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['nonce'])), 'spbop_nonce')) {
			return false;
		}
		$views_id               = isset($_POST['id']) ? absint($_POST['id']) : '';
		$keyword                = isset($_POST['keyword']) ? sanitize_text_field(wp_unslash($_POST['keyword'])) : '';
		$orderby                = isset($_POST['orderby']) ? sanitize_text_field(wp_unslash($_POST['orderby'])) : '';
		$order                  = isset($_POST['order']) ? sanitize_text_field(wp_unslash($_POST['order'])) : '';
		$taxonomy               = isset($_POST['taxonomy']) ? sanitize_text_field(wp_unslash($_POST['taxonomy'])) : '';
		$term_id                = isset($_POST['term_id']) ? sanitize_text_field(wp_unslash($_POST['term_id'])) : '';
		$bop_lang               = isset($_POST['lang']) ? sanitize_text_field(wp_unslash($_POST['lang'])) : '';
		$author_id              = isset($_POST['author_id']) ? sanitize_text_field(wp_unslash($_POST['author_id'])) : '';
		$selected_term_list     = isset($_POST['term_list']) ? wp_unslash($_POST['term_list']) : '';
		$custom_fields_array    = isset($_POST['custom_fields_array']) ? wp_unslash($_POST['custom_fields_array']) : '';
		$layout                 = get_post_meta($views_id, 'ta_bop_layouts', true);
		$layout_preset          = isset($layout['bop_layout_preset']) ? $layout['bop_layout_preset'] : '';
		$view_options           = get_post_meta($views_id, 'ta_bop_view_options', true);
		$pagination_type        = isset($view_options['post_pagination_type']) ? $view_options['post_pagination_type'] : '';
		$pagination_type_mobile = isset($view_options['post_pagination_type_mobile']) ? $view_options['post_pagination_type_mobile'] : '';
		$post_content_sorter    = isset($view_options['post_content_sorter']) ? $view_options['post_content_sorter'] : '';
		$query_args             = BOP_QueryInside::get_filtered_content($view_options, $views_id, $layout_preset);
		$post_offset            = isset($view_options['bop_post_offset']) ? $view_options['bop_post_offset'] : 0;

		$new_query_args                   = $query_args;
		$new_query_args['fields']         = 'ids';
		$post_limit                       = isset($view_options['bop_post_limit']) && !empty($view_options['bop_post_limit']) ? $view_options['bop_post_limit'] : 10000;
		$new_query_args['posts_per_page'] = $post_limit;
		$query_post_ids                   = get_posts($new_query_args);
		$relation                         = isset($view_options['bop_filter_by_taxonomy']['bop_taxonomies_relation']) ? $view_options['bop_filter_by_taxonomy']['bop_taxonomies_relation'] : 'AND';
		$query_args                       = BOP_Functions::modify_query_params($query_args, $keyword, $author_id, $custom_fields_array, $orderby, $order, $selected_term_list, $post_offset, $relation, $query_post_ids, $bop_lang);
		$bop_query                        = new WP_Query($query_args);
		BOP_HTML::bop_get_posts($view_options, $layout_preset, $post_content_sorter, $bop_query, $views_id);
		die();
	}



	/**
	 * Function get layout from atts and create class depending on it.
	 *
	 * @since 2.0
	 * @param array $attribute attribute of this shortcode.
	 */
	public function bop_shortcode_render($attribute)
	{
		if (empty($attribute['id'])) {
			return;
		}
		$bop_gl_id = $attribute['id']; // Bookify Pro global ID for Shortcode metaboxes.
		// Preset Layouts.
		$layout        = get_post_meta($bop_gl_id, 'ta_bop_layouts', true);
		$view_options  = get_post_meta($bop_gl_id, 'ta_bop_view_options', true);
		$section_title = get_the_title($bop_gl_id);
		ob_start();
		BOP_HTML::bop_html_show($view_options, $layout, $bop_gl_id, $section_title);
		return ob_get_clean();
	}

}
