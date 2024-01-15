<?php

/**
 * The file of query insides.
 *
 * @package Bookify_pro
 * @subpackage Bookify_pro/public
 *
 * @since 2.0.0
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}
/**
 * Post all html method.
 *
 * @since 2.0.0
 */
class BOP_HTML
{
	/**
	 * Post title html.
	 *
	 * @param array  $sorter post content option array.
	 * @param string $layout layout preset.
	 * @return void
	 */
	public static function bop_post_title($sorter, $layout, $options, $post, $is_table = false)
	{

		$_meta_settings     = BOP_Functions::bop_metabox_value('bop_post_meta', $sorter);
		$post_meta_fields   = BOP_Functions::bop_metabox_value('bop_post_meta_group', $_meta_settings);
		$show_post_meta     = BOP_Functions::bop_metabox_value('show_post_meta', $_meta_settings, true);
		$bop_page_link_type = BOP_Functions::bop_metabox_value('bop_page_link_type', $options);
		$bop_link_rel       = BOP_Functions::bop_metabox_value('bop_link_rel', $options);
		$bop_link_rel_text  = '1' === $bop_link_rel ? "rel='nofollow'" : '';

		$bop_link_target = BOP_Functions::bop_metabox_value('bop_link_target', $options);
		if (is_array($post_meta_fields) && 'accordion_layout' !== $layout && $show_post_meta) {
			foreach ($post_meta_fields as $each_meta) {
				if ('taxonomy' === $each_meta['select_post_meta']) {
					$taxonomy      = $each_meta['post_meta_taxonomy'];
					$meta_position = $each_meta['bop_meta_position'];
					if ('above_title' === $meta_position) {
						$terms = get_the_term_list($post->ID, $taxonomy, '', ' ');
						if ($terms) {
							ob_start();
							include BOP_Functions::bop_locate_template('item/meta-over-title.php');
							$meta_over_title = apply_filters('bop_meta_over_title', ob_get_clean());
							echo wp_kses_post($meta_over_title);
						};
					}
				}
			}
		}

		$post_title_setting = isset($sorter['bop_post_title']) ? $sorter['bop_post_title'] : '';
		$show_post_title    = BOP_Functions::bop_metabox_value('show_post_title', $post_title_setting);

		$bop_post_title = get_the_title($post->ID);

		if ($show_post_title && !empty($bop_post_title)) {
			// Post Title Settings.
			$post_title_tag    = BOP_Functions::bop_metabox_value('post_title_tag', $post_title_setting, 'h2');
			$limit_post_title = BOP_Functions::bop_metabox_value('post_title_limit', $post_title_setting);
			if ($limit_post_title) {
				$post_title_length = (int) isset($post_title_setting['bop_title_length']) ? $post_title_setting['bop_title_length'] : '';
				$bop_post_title    = BOP_Functions::limit_post_title($bop_post_title, $post_title_length);
			}

			$allowed_html_tags = array(
				'em'     => array(),
				'strong' => array(),
				'sup'    => array(),
				'i'      => array(),
				'small'  => array(),
				'del'    => array(),
				'ins'    => array(),
				'span'   => array(
					'style' => array(),
					'class' => array(),
				),
			);
			$td                = self::table_td($is_table);
			$allow_tag         = array('td' => array());
			ob_start();
			echo wp_kses($td['start'], $allow_tag);
			include BOP_Functions::bop_locate_template('item/title.php');
			echo wp_kses($td['end'], $allow_tag);
			$title = apply_filters('bop_item_title', ob_get_clean());
			echo wp_kses_post($title);
		}
	}

	/**
	 * Show Post Content html.
	 *
	 * @param array $sorter The field ID array.
	 * @param array $options options.
	 * @return void
	 */
	public static function bop_content_html($sorter, $options, $post, $is_table = false)
	{
		$post_content_setting = BOP_Functions::bop_metabox_value('bop_post_content', $sorter);
		$show_post_content    = BOP_Functions::bop_metabox_value('show_post_content', $post_content_setting);
		$show_read_more                = BOP_Functions::bop_metabox_value('show_read_more', $post_content_setting);
		$bop_content_type              = BOP_Functions::bop_metabox_value('post_content_type', $post_content_setting);
		$td                            = self::table_td($is_table);
		$allow_tag                     = array('td' => array());
		if ($show_post_content || $show_read_more) {
			ob_start();
			echo wp_kses($td['start'], $allow_tag);
			include BOP_Functions::bop_locate_template('item/content.php');
			echo wp_kses($td['end'], $allow_tag);
			$description = apply_filters('bop_item_description', ob_get_clean());
			echo wp_kses_post($description);
		}
	}
	/**
	 * Show Post Content html.
	 *
	 * @param array $sorter The field ID array.
	 * @param array $options options.
	 * @return void
	 */
	public static function bop_read_more_html($sorter, $options, $post, $is_table = false)
	{
		$post_content_setting = BOP_Functions::bop_metabox_value('bop_post_content_readmore', $sorter);
		$show_read_more                = BOP_Functions::bop_metabox_value('show_read_more', $post_content_setting);
		$bop_content_type              = BOP_Functions::bop_metabox_value('post_content_type', $post_content_setting);
		$td                            = self::table_td($is_table);
		$allow_tag                     = array('td' => array());
		if ($show_read_more) {
			self::bop_readmore( $post_content_setting, $bop_content_type, $options, $post );
		}
	}

	/**
	 * Read more function
	 *
	 * @param array $view_options Read more options array.
	 * @param array $content_type The content type.
	 * @param array $options The parent of this field.
	 */
	public static function bop_readmore($view_options, $content_type, $options, $post)
	{
		$show_read_more = isset($view_options['show_read_more']) ? $view_options['show_read_more'] : '';
		if (!$show_read_more || 'full_content' === $content_type) {
			return '';
		}
		$read_more_type     = isset($view_options['read_more_type']) ? $view_options['read_more_type'] : '';
		$bop_read_label     = isset($view_options['bop_read_label']) ? $view_options['bop_read_label'] : '';
		$bop_page_link_type = BOP_Functions::bop_metabox_value('bop_page_link_type', $options);
		$bop_link_rel       = BOP_Functions::bop_metabox_value('bop_link_rel', $options);
		$bop_link_rel_text  = '';
		if ($bop_link_rel) {
			$bop_link_rel_text = "rel='nofollow'";
		}
		$readmore_target = BOP_Functions::bop_metabox_value('bop_link_target', $options);

		ob_start();
		include BOP_Functions::bop_locate_template('item/read-more.php');
		$read_more_button = apply_filters('bop_read_more_btn', ob_get_clean(), $link = get_permalink($post));
		echo wp_kses_post($read_more_button);
	}

	/**
	 * Post thumb HTML.
	 *
	 * @param array $sorter post content option array.
	 * @param int   $scode_id Shortcode ID.
	 * @param int   $slide_id The slide/post ID.
	 * @param array $options The slide/post ID.
	 * @return void
	 */
	public static function bop_post_thumb_html($sorter, $scode_id, $post, $options, $layout, $is_table = false)
	{
		$_post_thumb_setting = BOP_Functions::bop_metabox_value('bop_post_thumb', $sorter);
		$bop_page_link_type  = BOP_Functions::bop_metabox_value('bop_page_link_type', $options);
		$bop_link_rel        = BOP_Functions::bop_metabox_value('bop_link_rel', $options);
		$bop_post_type       = 'bookify';

		$post_thumb_meta 	= $_post_thumb_setting['post_thumb_meta'];
		$taxonomy_name 	= isset($_post_thumb_setting['post_thumb_meta_taxonomy']) ? $_post_thumb_setting['post_thumb_meta_taxonomy'] : '';
		$post_thumb_meta_position 	= $_post_thumb_setting['post_thumb_meta_position'];
		$meta_date_format     = isset($each_meta['post_thumb_meta_date_format']) ? $each_meta['post_thumb_meta_date_format'] : 'default';
		$is_attachment       = false;
		if ('attachment' === $bop_post_type) {
			$is_attachment = true;
		}
		$bop_link_rel_text    = '1' === $bop_link_rel ? "rel='nofollow'" : '';
		$bop_link_target      = BOP_Functions::bop_metabox_value('bop_link_target', $options);
		if (BOP_Functions::bop_metabox_value('post_thumb_show', $_post_thumb_setting)) {
			$bop_image_attr  = BOP_Functions::bop_sized_thumb($_post_thumb_setting, $post->ID, $is_attachment);

			$thumb_url       = $bop_image_attr['src'];

			$retina_img_src  = $bop_image_attr['2x_src'];
			$retina_img_attr = '';
			if (!empty($retina_img_src)) {
				$retina_img_attr = 'srcset="' . esc_attr($thumb_url) . ', ' . esc_attr($retina_img_src) . ' 2x"';
			}

			$alter_text       = BOP_Functions::bop_thumb_alter_text($post->ID);
			$_meta_settings   = BOP_Functions::bop_metabox_value('bop_post_meta', $sorter);
			$post_meta_fields = BOP_Functions::bop_metabox_value('bop_post_meta_group', $_meta_settings);
			$show_post_meta   = BOP_Functions::bop_metabox_value('show_post_meta', $_meta_settings, true);
			$td               = self::table_td($is_table);
			$allow_tag        = array('td' => array());
			if (!empty($thumb_url)) {
				ob_start();
				echo wp_kses($td['start'], $allow_tag);
				include BOP_Functions::bop_locate_template('item/thumbnail.php');
				echo wp_kses($td['end'], $allow_tag);
				$item_thumb = apply_filters('bop_item_thumbnail', ob_get_clean());
				echo $item_thumb; // phpcs:ignore
			}
		}
	}

	/**
	 * Over Thumb meta taxonomy
	 *
	 * @param  mixed  $post_meta_fields meta field.
	 * @param  mixed  $show_post_meta show meta.
	 * @param  object $post post.
	 * @return void
	 */
	public static function over_thumb_meta_taxonomy($post_meta_fields, $show_post_meta, $post)
	{
		if (is_array($post_meta_fields) && $show_post_meta) {
			foreach ($post_meta_fields as $each_meta) {
				if ('taxonomy' === $each_meta['select_post_meta']) {
					$taxonomy      = $each_meta['post_meta_taxonomy'];
					$meta_position = $each_meta['bop_meta_position'];
					if ('over_thumb' === $meta_position) {
						$meta_over_thumb_position = isset($each_meta['bop_meta_over_thump_position']) ? $each_meta['bop_meta_over_thump_position'] : 'top_left';
						$terms                    = get_the_term_list($post->ID, $taxonomy, '', ' ');
						if ($terms) {
							ob_start();
							include BOP_Functions::bop_locate_template('item/over-thumb-taxonomy.php');
							$item_over_thumb_taxonomy = apply_filters('item_over_thumb_taxonomy', ob_get_clean(), $terms);
							echo wp_kses_post($item_over_thumb_taxonomy);
						}
					}
				}
			}
		}
	}

	/**
	 * Post Social Html
	 *
	 * @param array  $field_id post content option array.
	 * @param array  $options options.
	 * @param object $bop_post post.
	 * @param bool   $is_table is table layout.
	 * @return void
	 */
	public static function bop_social_share_html($field_id, $bop_post, $post, $is_table = false)
	{
		$post_social          = BOP_Functions::bop_metabox_value('bop_social_share', $field_id);
		$social_share_media   = BOP_Functions::bop_metabox_value('social_sharing_media', $post_social);
		$social_icon_shape    = BOP_Functions::bop_metabox_value('social_icon_shape', $post_social);
		$td                   = self::table_td($is_table);
		$allow_tag            = array('td' => array());
?>
		<?php
		if ($social_share_media) {
			ob_start();
			echo wp_kses($td['start'], $allow_tag);
			include BOP_Functions::bop_locate_template('item/social-share.php');
			echo wp_kses($td['end'], $allow_tag);
			$social_share = apply_filters('bop_item_social_share', ob_get_clean());
			echo wp_kses_post($social_share);
		}
	}

	/**
	 * Post meta HTML
	 *
	 * @param array $sorter post content option array.
	 * @param int   $visitor_count views count.
	 * @return void
	 */
	public static function bop_post_meta_html($sorter, $visitor_count, $post, $is_table = false)
	{
		$_meta_settings   = BOP_Functions::bop_metabox_value('bop_post_meta', $sorter);
		$post_meta_fields = BOP_Functions::bop_metabox_value('bop_post_meta_group', $_meta_settings);
		$show_post_meta   = BOP_Functions::bop_metabox_value('show_post_meta', $_meta_settings, true);
		$_meta_separator  = BOP_Functions::bop_metabox_value('meta_separator', $_meta_settings);

		if ($post_meta_fields && $show_post_meta) {

			ob_start();
			include BOP_Functions::bop_locate_template('item/meta.php');
			$item_meta = apply_filters('bop_item_meta', ob_get_clean());
			echo wp_kses_post($item_meta);
		}
	}
	/**
	 * Event fildes HTML
	 *
	 * @param array $sorter post content option array.
	 * @param int   $visitor_count views count.
	 * @return void
	 */
	public static function bop_event_fildes_html($sorter, $visitor_count, $post, $is_table = false)
	{
		$_meta_settings   = BOP_Functions::bop_metabox_value('bop_event_fildes', $sorter);
		$event_fildes_fields = BOP_Functions::bop_metabox_value('bop_event_fildes_group', $_meta_settings);
		$show_event_fildes   = BOP_Functions::bop_metabox_value('show_event_fildes', $_meta_settings, true);
		$_event_meta_separator  = BOP_Functions::bop_metabox_value('event_meta_separator', $_meta_settings);

		if ($event_fildes_fields && $show_event_fildes) {
			
			ob_start();
			include BOP_Functions::bop_locate_template('item/event-fildes.php');
			$item_meta = apply_filters('bop_item_meta', ob_get_clean());
			echo wp_kses_post($item_meta);
		}
	}


	/**
	 * Post content with thumb.
	 *
	 * @param array  $sorter post sorting option.
	 * @param string $layout Layout preset.
	 * @param int    $visitor_count visitor number.
	 * @param int    $scode_id The Shortcode ID.
	 * @param object $post The Post object.
	 * @return void
	 */
	public static function bop_post_content_with_thumb($sorter, $layout, $visitor_count, $scode_id, $post, $options, $is_table = false)
	{
		if ($sorter) {
			foreach ($sorter as $style_key => $style_value) {
				switch ($style_key) {
					case 'bop_post_thumb':
						self::bop_post_thumb_html($sorter, $scode_id, $post, $options, $layout, $is_table);
						break;
					case 'bop_post_title':
						self::bop_post_title($sorter, $layout, $options, $post, $is_table);
						break;
					case 'bop_post_content':
						self::bop_content_html($sorter, $options, $post, $is_table);
						break;
					case 'bop_post_content_readmore':
						self::bop_read_more_html($sorter, $options, $post, $is_table);
						break;
					case 'bop_post_meta':
						self::bop_post_meta_html($sorter, $visitor_count, $post, $is_table);
						break;
					case 'bop_event_fildes':
						self::bop_event_fildes_html($sorter, $visitor_count, $post, $is_table);
						break;
					case 'bop_social_share':
						self::bop_social_share_html($sorter, $options, $post, $is_table);
						break;
					case 'bop_custom_fields':
			
						bop_custom_field_html($post, $sorter, true, $is_table);
						break;
				}
			}
		}
	}

	/**
	 * Post content without thumb.
	 *
	 * @param array  $sorter post sorting option.
	 * @param string $layout Layout preset.
	 * @param int    $visitor_count visitor number.
	 * @param object $post visitor number.
	 * @param array  $options Shortcode options.
	 * @return void
	 */
	public static function bop_post_content_without_thumb($sorter, $layout, $visitor_count, $scode_id, $post, $options, $is_table = false)
	{
		if ($sorter) {
			foreach ($sorter as $style_key => $style_value) {
				switch ($style_key) {
					case 'bop_post_title':
						self::bop_post_title($sorter, $layout, $options, $post, $is_table);
						break;
					case 'bop_post_content':
						self::bop_content_html($sorter, $options, $post, $is_table);
						break;
					case 'bop_post_content_readmore':
						self::bop_read_more_html($sorter, $options, $post, $is_table);
						break;
					case 'bop_post_meta':
						self::bop_post_meta_html($sorter, $visitor_count, $post, $is_table);
						break;
					case 'bop_event_fildes':
						self::bop_event_fildes_html($sorter, $visitor_count, $post, $is_table);
						break;
					case 'bop_social_share':
						self::bop_social_share_html($sorter, $options, $post, $is_table);
						break;
					case 'bop_custom_fields':
						bop_custom_field_html( $post, $sorter, true, $is_table );
						break;
				}
			}
		}
	}

	/**
	 * HTML classes for Post.
	 *
	 * @return string
	 */
	public static function bop_alt_post_class($options, $layout_preset)
	{
		if ( 'list_layout' === $layout_preset ) {
			if ( 'left-thumb' === BOP_Functions::bop_metabox_value( 'post_list_orientation', $options ) ) {
				$bop_alt_post_class = 'bookify__item left-thumb';
			} else {
				$bop_alt_post_class = 'right-thumb bookify__item';
			}
		} elseif ('carousel_layout' === $layout_preset || 'grid_layout' === $layout_preset) {
			if ('overlay' === BOP_Functions::bop_metabox_value('post_content_orientation', $options)) {
				$bop_alt_post_class = 'ta-overlay bookify__item';
			} else {
				$bop_alt_post_class = 'bookify__item';
			}
		} else {
			$bop_alt_post_class = 'bookify__item';
		}
		return apply_filters('post_post_class_name', $bop_alt_post_class);
	}

	/**
	 * Pagination function
	 *
	 * @param object $loop Query array.
	 * @param array  $view_options options.
	 * @param array  $layout layout.
	 * @param array  $views_id id.
	 * @param array  $paged paged.
	 * @param array  $on_screen screen type.
	 */
	public static function bop_pagination_bar($loop, $view_options, $layout, $views_id, $paged = null, $on_screen = null)
	{
		$posts_found   = $loop->found_posts;
		$post_offset   = isset($view_options['bop_post_offset']) ? $view_options['bop_post_offset'] : 0;
		$posts_found   = (int) $posts_found - (int) $post_offset;
		$post_limit    = isset($view_options['bop_post_limit']) ? $view_options['bop_post_limit'] : 100000;
		$post_limit    = ($post_limit > 0 && $posts_found > $post_limit) ? $post_limit : $posts_found;
		$post_per_page = isset($view_options['post_per_page']) ? $view_options['post_per_page'] : 12;
		$post_per_page = ($post_per_page > $post_limit) ? $post_limit : $post_per_page;

		$layout_preset = isset($layout['bop_layout_preset']) ? $layout['bop_layout_preset'] : '';
		// Post display settings.
		if ('filter_layout' === $layout_preset) {
			$pagination_type = isset($view_options['filter_pagination_type']) ? $view_options['filter_pagination_type'] : '';
		} else {
			$pagination_type = isset($view_options['post_pagination_type']) ? $view_options['post_pagination_type'] : 'ajax_load_more';
			if ('on_mobile' === $on_screen) {
				$pagination_type = isset($view_options['post_pagination_type_mobile']) ? $view_options['post_pagination_type_mobile'] : 'infinite_scroll';
			}
		}
		$post_limit = (int) $post_limit;
		if ($post_limit < 1) {
			$pages = 0;
		} else {
			$pages = BOP_Functions::bop_max_pages($post_limit, $post_per_page);
		}
		$big = 999999999; // need an unlikely integer.
		if ($pages > 1) {
			$page_current     = max(1, get_query_var('paged'));
			$filter_url_value = isset($_SERVER['QUERY_STRING']) ? wp_unslash($_SERVER['QUERY_STRING']) : ''; //phpcs:ignore
			if (!empty($filter_url_value)) {
				$shortcode_id = isset($_GET['sps']) ? wp_unslash(sanitize_text_field($_GET['sps'])) : ''; //phpcs:ignore
				if ($shortcode_id == $views_id) {
					$bop_page = isset($_GET['bop_page']) ? wp_unslash(sanitize_text_field($_GET['bop_page'])) : ''; //phpcs:ignore
					if (!empty($bop_page)) {
						$page_current = $bop_page;
					}
				}
			}

			if ('ajax_pagination' === $pagination_type) {
				$page_links = paginate_links(
					array(
						'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
						'format'    => '?paged=%#%',
						'current'   => $page_current,
						'total'     => $pages,
						'show_all'  => true,
						'prev_next' => false,
						'type'      => 'array',
						'prev_text' => '<i class="fa fa-angle-left"></i>',
						'next_text' => '<i class="fa fa-angle-right"></i>',
					)
				);
				$prev_link  = '<a class="next page-numbers" href="#"><i class="fa fa-angle-right"></i></a>';
				$next_link  = '<a class="prev page-numbers active" href="#"><i class="fa fa-angle-left"></i></a>';
				array_unshift($page_links, $next_link);
				$page_links[] = $prev_link;
				$html         = '';
				$p_num        = 0;
				foreach ($page_links as $link) {
					$class = 'page-numbers ';
					if (strpos($link, 'current') !== false) {
						$class .= 'active';
					}
					if (strpos($link, 'next') !== false) {
						$data_page = 'data-page="next"';
						$class    .= 'bop_next ';
					} elseif (strpos($link, 'prev') !== false) {
						$data_page = 'data-page="prev"';
						$class    .= 'bop_prev';
					} else {
						$data_page = 'data-page="' . $p_num . '"';
					}
					$link  = preg_replace('/<span[^>]*>/', '<a href="#" class="' . $class . '" ' . $data_page . '>', $link);
					$link  = preg_replace('/<a [^>]*>/', '<a href="#" class="' . $class . '" ' . $data_page . '>', $link);
					$link  = str_replace('</span>', '</a>', $link);
					$html .= $link;
					$p_num++;
				}
				echo wp_kses_post($html); //phpcs:ignore
			} elseif ('no_ajax' === $pagination_type) {

				$paged_var    = 'paged' . $views_id;
				$page_current = (!empty($_GET["$paged_var"])) ? sanitize_text_field(wp_unslash($_GET["$paged_var"])) : 1;

				$page_links = paginate_links(
					array(
						'format'    => '?' . $paged_var . '=%#%',
						'current'   => $page_current,
						'total'     => $pages,
						'show_all'  => apply_filters('bop_show_all_normal_pagination', true),
						'prev_next' => true,
						'end_size'  => 2,
						'mid_size'  => 1,
						'type'      => 'array',
						'prev_text' => '<i class="fa fa-angle-left"></i>',
						'next_text' => '<i class="fa fa-angle-right"></i>',
					)
				);
				echo implode($page_links); //phpcs:ignore
			} else {
				$page_links = paginate_links(
					array(
						'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
						'format'    => '?paged=%#%',
						'current'   => $page_current,
						'total'     => $pages,
						'show_all'  => true,
						'prev_next' => false,
						'type'      => 'array',
						'prev_text' => '<i class="fa fa-angle-left"></i>',
						'next_text' => '<i class="fa fa-angle-right"></i>',
					)
				);
				$html       = '';
				$p_num      = 1;
				foreach ($page_links as $link) {
					$class = 'page-numbers ';
					if (strpos($link, 'current') !== false) {
						$class .= 'active';
					}
					if (strpos($link, 'next') !== false) {
						$data_page = 'data-page="next"';
						$class    .= 'bop_next ';
					} elseif (strpos($link, 'prev') !== false) {
						$data_page = 'data-page="prev"';
						$class    .= 'bop_prev active';
					} else {
						$data_page = 'data-page="' . $p_num . '"';
					}
					$link  = preg_replace('/<span[^>]*>/', '<a href="#" class="' . $class . '" ' . $data_page . '>', $link);
					$link  = preg_replace('/<a [^>]*>/', '<a href="#" class="' . $class . '" ' . $data_page . '>', $link);
					$link  = str_replace('</span>', '</a>', $link);
					$html .= $link;
					$p_num++;
				}
				echo wp_kses_post($html); //phpcs:ignore
			}
		}
	}

	/**
	 * Section title
	 *
	 * @param int $bop_id Shortcode id.
	 * @return void
	 */

	public static function bop_section_title($section_title_text, $show_section_title)
	{

		if ($show_section_title) {
			$section_title_text = apply_filters('bop_section_title_text', $section_title_text);
			ob_start();
			do_action('bop_before_section_title');
			include BOP_Functions::bop_locate_template('section-title.php');
			do_action('bop_after_section_title');
			$section_title = apply_filters('bop_filter_section_title', ob_get_clean());
			echo wp_kses_post($section_title);
		}
	}

	/**
	 * Preloader
	 *
	 * @param bool $preloader show preloader.
	 * @return void
	 */
	public static function bop_preloader($preloader)
	{
		if ($preloader) {
			ob_start();
			include BOP_Functions::bop_locate_template('preloader.php');
			$preloader = apply_filters('bop_preloader', ob_get_clean());
			echo wp_kses_post($preloader);
		}
	}

	/**
	 * Get all query posts.
	 *
	 * @param array $options Views options.
	 * @param array $layout Layout preset.
	 * @param array $sorter  Post sorting options.
	 * @param object $bop_query post query.
	 * @param int   $view_id Shortcode ID.
	 * @return void
	 */
	public static function bop_get_posts($options, $layout, $sorter, $bop_query, $view_id)
	{
		$bop_count = 1;
		$all_posts = $bop_query->posts;
		foreach ($all_posts as $key => $post) {
			$visitor_count = get_post_meta($post->ID, '_post_views_count', true);
			self::bop_post_loop($options, $layout, $sorter, $bop_count, $view_id, $post);
			$bop_count++;
		}
	}

	/**
	 * Table td markup.
	 *
	 * @param  mixed $is_table check table layout.
	 * @return array
	 */
	public static function table_td($is_table = false)
	{
		$td_before = '';
		$td_after  = '';
		if ($is_table) {
			$td_before = '<td>';
			$td_after  = '</td>';
		}
		return array(
			'start' => $td_before,
			'end'   => $td_after,
		);
	}

	/**
	 * Post responsive columns class.
	 *
	 * @param string $layout Layout preset.
	 * @param string $columns Columns number.
	 * @return string
	 */
	public static function bop_post_responsive_columns($layout, $columns)
	{

		$bop_post_columns = '';
		if ('carousel_layout' === $layout) {
			$bop_post_columns .= ' swiper-slide swiper-lazy';
		} elseif ( 'list_layout' === $layout ) {
			$bop_post_columns = 'ta-col-xs-1';
		} else {
			$bop_post_columns .= " ta-col-xs-$columns[mobile] ta-col-sm-$columns[mobile_landscape] ta-col-md-$columns[tablet] ta-col-lg-$columns[desktop] ta-col-xl-$columns[lg_desktop]";
		}
		return $bop_post_columns;
	}

	/**
	 * Post Loop.
	 *
	 * @param array  $options Views options.
	 * @param string $layout Layout preset.
	 * @param array  $sorter Post sorting options.
	 * @param int    $scode_id Shortcode ID.
	 * @return void
	 */
	public static function bop_post_loop($options, $layout, $sorter, $bop_count, $scode_id, $post)
	{
		$number_of_columns = BOP_Functions::bop_metabox_value('bop_number_of_columns', $options);
		$slide_effect      = BOP_Functions::bop_metabox_value('bop_slide_effect', $options);
		$visitor_count     = get_post_meta($post->ID, '_post_views_count', true);
		$lazy_load         = BOP_Functions::bop_metabox_value('bop_lazy_load', $options);
		if ('cube' === $slide_effect || 'flip' === $slide_effect) {
			$lazy_load = 'false';
		}
		if (('carousel_layout' === $layout || 'grid_layout' === $layout || 'filter_layout' === $layout) && ('default' === BOP_Functions::bop_metabox_value('post_content_orientation', $options))) {
		?>
			<div class="<?php echo esc_attr(self::bop_post_responsive_columns($layout, $number_of_columns, $post->ID)); ?>">
				<div class="bookify__item bop-item-<?php echo esc_attr($post->ID); ?>" data-id="<?php echo esc_attr($post->ID); ?>">
					<?php
					self::bop_post_content_with_thumb($sorter, $layout, $visitor_count, $scode_id, $post, $options);
					?>
				</div>
				<?php if ('carousel_layout' === $layout && $lazy_load && 'ticker' !== BOP_Functions::bop_metabox_value('bop_carousel_mode', $options)) { ?>
					<!-- <div class="swiper-lazy-preloader swiper-lazy-preloader-black"></div> -->
				<?php } ?>
			</div>
		<?php
		} else {
			$animation_class = '';
			if (('overlay' === BOP_Functions::bop_metabox_value('post_content_orientation', $options) || 'overlay-box' === BOP_Functions::bop_metabox_value('post_content_orientation', $options))) {
				$animation_class = ('on_hover' === BOP_Functions::bop_metabox_value('post_overlay_content_visibility', $options)) ? BOP_Functions::bop_metabox_value('post_animation', $options) . ' animated' : '';
			}
			if ('list_layout' === $layout || 'zigzag_layout' === $layout) {
				$animation_class = '';
			}
		?>
			<div class="<?php echo esc_attr(self::bop_post_responsive_columns($layout, $number_of_columns, $post->ID)); ?>">
				<div class="<?php echo esc_attr(self::bop_alt_post_class($options, $layout)); ?> bop-item-<?php echo esc_attr($post->ID); ?>" data-id="<?php echo esc_attr($post->ID); ?>">
					<?php
					self::bop_post_thumb_html($sorter, $scode_id, $post, $options, $layout);
					?>
					<div class="bookify__item__details <?php echo esc_html($animation_class); ?>">
						<?php
						self::bop_post_content_without_thumb($sorter, $layout, $visitor_count, $scode_id, $post, $options);
						?>
					</div>
				</div>
			</div>
<?php
		}
	}

	/**
	 * BOP shortcode markup wrapper classes.
	 *
	 * @param string $layout_preset The selected layout name.
	 * @param int    $shortcode_id The shortcode ID.
	 *
	 */
	public static function bop_wrapper_classes($layout_preset, $shortcode_id, $grid_style = null, $item_same_height_class = '')
	{
		$wrapper_class = "ta-bop-section ta-container bop-wrapper-{$shortcode_id}";
		switch ($layout_preset) {
			case 'carousel_layout':
				$wrapper_class .= " bop-carousel-wrapper{$item_same_height_class}";
				break;
			case 'grid_layout':
				$wrapper_class .= 'even' === $grid_style ? ' bop-even' : ' bop-masonry';
				$wrapper_class .= $item_same_height_class;
				break;
			case 'list_layout':
				$wrapper_class .= $item_same_height_class;
				break;
		}
		echo esc_attr($wrapper_class);
	}

	/**
	 * Shortcode Wrapper data attributes.
	 *
	 * @param int    $shortcode_id The shortcode ID.
	 * @return void
	 */
	public static function wrapper_data($pagination_type, $pagination_type_mobile, $shortcode_id)
	{
		$wrapper_data = '';
		if ($pagination_type) {
			$wrapper_data .= " data-pagination={$pagination_type}";
		}
		if ($pagination_type_mobile) {
			$wrapper_data .= " data-pagination_mobile={$pagination_type_mobile}";
		}
		if ($shortcode_id) {
			$wrapper_data .= " data-sid={$shortcode_id}";
		}
		echo esc_html($wrapper_data);
	}

	/**
	 * Full html show.
	 *
	 * @param array  $view_options all options.
	 * @param array  $layout show layout.
	 * @param array  $bop_gl_id Shortcode ID.
	 * @param array  $section_title section title.
	 * @param object $query layout query.
	 */
	public static function bop_html_show($view_options, $layout, $bop_gl_id, $section_title = '', $query = array())
	{
		$options              = $view_options;
		$layout_preset        = isset($layout['bop_layout_preset']) ? $layout['bop_layout_preset'] : 'carousel_layout';
		$bop_settings         = get_option('ta_bookify_settings');
		$grid_style           = isset($view_options['bop_grid_style']) ? $view_options['bop_grid_style'] : 'even';
		$post_content_sorter  = isset($view_options['post_content_sorter']) ? $view_options['post_content_sorter'] : '';
		$show_section_title   = isset($view_options['section_title']) ? $view_options['section_title'] : false;
		$bop_content_position = isset($view_options['post_content_orientation']) ? $view_options['post_content_orientation'] : '';
		$margin_between_post  = isset($view_options['margin_between_post']['all']) ? $view_options['margin_between_post']['all'] : '';
		$show_preloader       = isset($view_options['show_preloader']) ? $view_options['show_preloader'] : 0;

		$item_same_height_class = isset($view_options['item_same_height']) && $view_options['item_same_height'] ? ' bop_same_height ' : '';

		if (is_object($query) && !empty($query)) {
			$query_args       = array();
			$bop_query        = $query;
			$total_post_count = $bop_query->post_count;
		} else {
			$query_args       = BOP_QueryInside::get_filtered_content($view_options, $bop_gl_id, $layout_preset);
			$bop_query        = new WP_Query($query_args);
			$total_post_count = $bop_query->post_count;
		}
		// Pagination.
		$show_pagination = isset($view_options['show_post_pagination']) ? $view_options['show_post_pagination'] : true;
		if ('filter_layout' === $layout_preset) {
			$pagination_type        = isset($view_options['filter_pagination_type']) ? $view_options['filter_pagination_type'] : '';
			$pagination_type_mobile = isset($view_options['filter_pagination_type']) ? $view_options['filter_pagination_type'] : '';
		} else {
			$pagination_type        = isset($view_options['post_pagination_type']) ? $view_options['post_pagination_type'] : 'ajax_load_more';
			$pagination_type_mobile = isset($view_options['post_pagination_type_mobile']) ? $view_options['post_pagination_type_mobile'] : 'infinite_scroll';
		}
		$accordion_mode  = isset($view_options['accordion_mode']) ? $view_options['accordion_mode'] : '';
		$advanced_filter = isset($view_options['bop_advanced_filter']) ? $view_options['bop_advanced_filter'] : false;
		// Enqueue Settings.
		$swiper_js   = isset($bop_settings['bop_swiper_js']) ? $bop_settings['bop_swiper_js'] : true;
		$bx_js       = isset($bop_settings['bop_bx_js']) ? $bop_settings['bop_bx_js'] : true;
		$magnific_js = isset($bop_settings['bop_magnific_js']) ? $bop_settings['bop_magnific_js'] : true;
		$isotope_js  = isset($bop_settings['bop_isotope_js']) ? $bop_settings['bop_isotope_js'] : true;
		if ($magnific_js) {
			wp_enqueue_script('bop_bopup');
		}
		if ($isotope_js) {
			wp_enqueue_script('bop_isotope');
		}
		wp_enqueue_script('bop-script');
		$bop_custom_js = isset($bop_settings['bop_custom_js']) ? $bop_settings['bop_custom_js'] : '';
		if (!empty($bop_custom_js)) {
			wp_add_inline_script('bop-script', $bop_custom_js);
		}
		$spta_lang = '';
		if (function_exists('pll_current_language')) {
			$spta_lang = pll_current_language();
		}

		if ('carousel_layout' === $layout_preset) {
			include BOP_Functions::bop_locate_template('carousel.php');
		} elseif ('list_layout' === $layout_preset) {
			include BOP_Functions::bop_locate_template('list.php');
		} elseif ('grid_layout' === $layout_preset) {
			include BOP_Functions::bop_locate_template('grid.php');
		} elseif ('filter_layout' === $layout_preset) {
			include BOP_Functions::bop_locate_template('filter.php');
		}
	}
}
