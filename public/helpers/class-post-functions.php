<?php

/**
 * The file functions.
 *
 * @package Bookify_Pro
 * @subpackage Bookify_Pro/public/helper
 *
 * @since 2.0.0
 */

/**
 * Post views helper method.
 *
 * @since 2.0.0
 */
class BOP_Functions {


	/**
	 * WP Version compare
	 *
	 * @param  mixed $version_to_compare version compare.
	 * @param  mixed $operator operator.
	 * @return statement
	 */
	public static function wp_version_compare( $version_to_compare, $operator = '>=' ) {
		if ( empty( $version_to_compare ) ) {
			return true;
		}
		global $wp_version;

		// Check if using WordPress version 3.7 or higher.
		return version_compare( $wp_version, $version_to_compare, $operator );
	}

	/**
	 * Post title character limit.
	 *
	 * @param string  $bop_title The post title.
	 * @param integer $limit_length The length for the title.
	 * @param string  $bop_after_string The string after title.
	 * @return statement
	 */
	public static function limit_post_title( $bop_title, $limit_length, $bop_after_string = '...' ) {
		return mb_strimwidth( $bop_title, 0, $limit_length, apply_filters( 'bop_post_title_ellipsis', $bop_after_string ) );
	}

	/**
	 * Tag name to full tag conversion.
	 *
	 * @param array $meta_tag Tag option.
	 * @return string
	 */
	public static function short_tag_to_html( $meta_tag ) {
		$exclude_tag_string = '';
		foreach ( $meta_tag as $key => $value ) {
			$exclude_tag_string .= '<' . $value . '>,';
		}
		return $exclude_tag_string;
	}

	/**
	 * Limit the the text.
	 *
	 * @param mixed  $text The text you want to limit.
	 * @param int    $limit The number of words to display.
	 * @param string $ellipsis The ellipsis at the end of the text.
	 * @return statement
	 */
	public static function bop_limit_text( $text, $limit, $ellipsis = '...' ) {
		$word_arr = explode( ' ', $text );
		if ( count( $word_arr ) > $limit ) {
			$words = implode( ' ', array_slice( $word_arr, 0, $limit ) ) . $ellipsis;
			return $words;
		} else {
			return $text;
		}
	}

	/**
	 * Characters Limit of the text.
	 *
	 * @param mixed  $text The text you want to limit.
	 * @param int    $limit The number of words to display.
	 * @param string $ellipsis The ellipsis at the end of the text.
	 * @return statement
	 */
	public static function limit_content_chr( $text, $limit, $ellipsis = '...' ) {
		$length = $limit;
		if ( strlen( $text ) < $length + 10 ) {
			return $text; // don't cut if too short.
		}
		$visible = substr( $text, 0, $length );
		return $visible . $ellipsis;
	}

	/**
	 * Allowed tags function of the Plugin.
	 *
	 * @since 2.0.0
	 * @return array allowed tags
	 */
	public static function allowed_tags() {
		$allowed_tags           = wp_kses_allowed_html( 'post' );
		$allowed_tags['iframe'] = array(
			'src'             => array(),
			'height'          => array(),
			'width'           => array(),
			'frameborder'     => array(),
			'allowfullscreen' => array(),
			'title'           => array(),
			'alt'             => array(),
		);

		$allowed_tags['style'] = array();

		return $allowed_tags;
	}

	/**
	 * Content function.
	 *
	 * @param array  $view_options Read more options array.
	 * @param string $type Content type.
	 * @param  mixed  $post post.
	 * @return content
	 */
	public static function bop_content( $view_options, $type, $post ) {

		$bop_content_length_type      = isset( $view_options['bop_content_length_type'] ) ? $view_options['bop_content_length_type'] : 'words';
		$post_content_length          = isset( $view_options['bop_content_limit'] ) ? $view_options['bop_content_limit'] : '';
		$bop_content_characters_limit = isset( $view_options['bop_content_characters_limit'] ) ? $view_options['bop_content_characters_limit'] : '';
		$post_content_ellipsis        = isset( $view_options['post_content_ellipsis'] ) ? $view_options['post_content_ellipsis'] : '';
		$bop_strip_tags               = isset( $view_options['bop_strip_tags'] ) ? $view_options['bop_strip_tags'] : '';
		$bop_allow_tag_name           = isset( $view_options['bop_allow_tag_name'] ) ? $view_options['bop_allow_tag_name'] : '';
		$allowed_tags                 = explode( ',', $bop_allow_tag_name );

		$is_page_content = false;
		$is_page_content = apply_filters( 'bop_strip_shortcode_in_page_content', $is_page_content );
		global $wp_embed;
		if ( 'excerpt' === $type ) {
			$bop_post_content = get_the_excerpt( $post );
		} elseif ( 'full_content' === $type ) {

			if ( $is_page_content ) {
				$post_content = apply_filters( 'ta_bop_the_content', strip_shortcodes( $post->post_content ) );
			} else {
				$post_content = apply_filters( 'ta_bop_the_content', $post->post_content );
			}
			if ( 'allow_some' === $bop_strip_tags ) {
				$bop_post_content = strip_tags( $post_content, self::short_tag_to_html( $allowed_tags ) );
			} elseif ( 'strip_all' === $bop_strip_tags ) {
				$bop_post_content = wp_strip_all_tags( $post_content );
			} else {
				$bop_post_content = $post_content;
			}
		} else {
			if ( $is_page_content ) {
				$post_content = apply_filters( 'ta_bop_the_content', strip_shortcodes( $post->post_content ) );
			} else {
				$post_content = apply_filters( 'ta_bop_the_content', $post->post_content );
			}
			if ( 'characters' === $bop_content_length_type ) {
				$_trimmed_content = ( 'strip_all' === $bop_strip_tags ) ? wp_html_excerpt( $post_content, $bop_content_characters_limit, $post_content_ellipsis ) : self::limit_content_chr( $post_content, $bop_content_characters_limit, $post_content_ellipsis );
			} else {
				$_trimmed_content = self::bop_limit_text( $post_content, $post_content_length, $post_content_ellipsis );
			}
			if ( 'allow_some' === $bop_strip_tags ) {
				$bop_post_content = strip_tags( $_trimmed_content, self::short_tag_to_html( $allowed_tags ) );
			} elseif ( 'strip_all' === $bop_strip_tags ) {
				$bop_post_content = wp_strip_all_tags( $_trimmed_content );
			} else {
				$bop_post_content = $_trimmed_content;
			}
			$bop_post_content = force_balance_tags( $bop_post_content );
		}
		$bop_post_content = do_shortcode( $wp_embed->autoembed( $bop_post_content ) );
		return $bop_post_content;
	}

	/**
	 * Get the ID by the Image URL.
	 *
	 * @param mixed $url The image url.
	 * @param int   $post_id The image url.
	 * @return statement
	 */
	public static function bop_image_id_by_url( $url, $post_id = null ) {
		global $wpdb;

		// If the URL is auto-generated thumbnail, remove the sizes and get the URL of the original image.
		$url       = preg_replace( '/-\d+x\d+(?=\.(png|jp(e|g|eg)|gif|bmp|ico|webp|svg)$)/i', '', $url );
		$cache_key = 'bop_content_img_url_to_id' . $post_id;
		$img_cache = wp_cache_get( $cache_key );
		if ( false === $img_cache ) {
			$image = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid=%s;", $url ) );
			wp_cache_set( $cache_key, $img_cache );
		}
		if ( ! empty( $image ) ) {
			return $image[0];
		}
		return false;
	}
	/**
	 * Thumb alter text
	 *
	 * @param integer $slide_id The slide/post ID.
	 *
	 * @return string
	 */
	public static function bop_thumb_alter_text( $slide_id ) {
		$image_id = get_post_thumbnail_id( $slide_id );
		$alt_text = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		return $alt_text;
	}

	/**
	 * Modify query params
	 *
	 * @param  array  $query_args query_args.
	 * @param  string $keyword keyword.
	 * @param  int    $author_id author id.
	 * @param  array  $custom_fields_array custom fields array.
	 * @param  string $orderby orderby.
	 * @param  string $order order.
	 * @param  array  $selected_term_list term_list.
	 * @param  int    $post_offset offset.
	 * @param  string $relation relation operator.
	 * @param  array  $post_in post in.
	 * @param  string $lang current lang.
	 * @return array
	 */
	public static function modify_query_params( $query_args, $keyword, $author_id, $custom_fields_array, $orderby, $order, $selected_term_list, $post_offset, $relation, $post_in = array(), $lang = '' ) {
		if ( ! empty( $keyword ) ) {
			$query_args['s'] = $keyword;
			$post_offset     = 0;
		}
		if ( 'all' !== $author_id & ! empty( $author_id ) ) {
			$query_args['author__in'] = $author_id;
			$post_offset              = 0;
		}
		if ( ! empty( $lang ) ) {
			$query_args['lang'] = $lang;
		}
		$query_args['post__in'] = $post_in;
		if ( ! empty( $custom_fields_array ) ) {
			$bop_meta_query = array();
			foreach ( $custom_fields_array as $_custom_field ) {
				$c_field_key   = $_custom_field['custom_field_key'];
				$c_field_value = $_custom_field['custom_field_value'];
				if ( strpos( $c_field_value, ' ' ) !== false ) {
					$c_field_value    = explode( ' ', $c_field_value );
					$bop_meta_query[] = array(
						'key'     => $c_field_key,
						'value'   => $c_field_value,
						'compare' => 'BETWEEN',
						'type'    => 'numeric',
					);
				} else {
					if ( strpos( $c_field_value, ',' ) !== false ) {
						$c_field_value = explode( ',', $c_field_value );
					}
					$bop_meta_query[] = array(
						'key'     => $c_field_key,
						'compare' => 'IN',
						'value'   => $c_field_value,
					);
				}
			}
			if ( count( $bop_meta_query ) > 1 ) {
				$bop_meta_query['relation'] = 'AND';
			}
			$query_args['meta_query'] = $bop_meta_query;
		}

		if ( ! empty( $orderby ) ) {
			$query_args['orderby'] = ( 'rand' === $orderby ) ? 'rand(' . get_transient( 'bop_rand' ) . ')' : $orderby;
		}
		if ( ! empty( $order ) ) {
			$query_args['order'] = $order;
		}
		if ( ! empty( $selected_term_list ) ) {
			if ( count( $selected_term_list ) > 1 ) {
				$tax_settings['relation'] = $relation;
			}
			if ( is_array( $selected_term_list ) ) {
				foreach ( $selected_term_list as $key => $tax_type ) {
					$taxonomy = $tax_type['taxonomy'];
					$terms    = $tax_type['term_id'];
					if ( strpos( $terms, ',' ) !== false ) {
						$terms = explode( ',', $terms );
					}
					if ( $taxonomy && $terms ) {
						$tax_settings[] = array(
							'taxonomy'         => $taxonomy,
							'field'            => 'term_id',
							'terms'            => $terms,
							'operator'         => 'IN',
							'include_children' => false,
						);
					}
				}
				$query_args['tax_query'] = $tax_settings;
			}
			$post_offset = 0;
		}
		$query_args['offset'] = $post_offset;
		return $query_args;
	}

	/**
	 * Thumb Sized function
	 *
	 * @param array   $post_thumb_setting Thumbnails options array.
	 * @param integer $slide_id The slide/post ID.
	 * @param  bool    $is_attachment type attachment.
	 *
	 * @return string
	 */
	public static function bop_sized_thumb( $post_thumb_setting, $slide_id, $is_attachment = false ) {
		$thumb_id                  = '';
		$image                     = '';
		$bop_thumb_src_replace     = isset( $post_thumb_setting['bop_thumb_src_replace'] ) ? $post_thumb_setting['bop_thumb_src_replace'] : '';
		$post_featured_thumb_found = isset( $post_thumb_setting['post_featured_thumb_found'] ) ? $post_thumb_setting['post_featured_thumb_found'] : 'no_featured_img_found';
		$show_2x_image             = isset( $post_thumb_setting['load_2x_image'] ) ? $post_thumb_setting['load_2x_image'] : false;
		$image_resize_2x_url       = '';
		if ( 'even_featured_img_found' === $post_featured_thumb_found && is_array( $bop_thumb_src_replace ) ) {
			$replace_thumb = self::bop_thumb_replace( $post_thumb_setting, $slide_id );
			$thumb_id      = $replace_thumb['id'];
		} elseif ( ! has_post_thumbnail( $slide_id ) && 'no_featured_img_found' === $post_featured_thumb_found ) {
			$replace_thumb = self::bop_thumb_replace( $post_thumb_setting, $slide_id );
			$thumb_id      = $replace_thumb['id'];
		} elseif ( has_post_thumbnail( $slide_id ) ) {
			$thumb_id = get_post_thumbnail_id( $slide_id );
		}

		$placeholder_img = BOP_URL . 'public/assets/img/placeholder.png';
		$placeholder_img = apply_filters( 'bop_no_thumb_placeholder', $placeholder_img );

		if ( empty( $thumb_id ) && ! empty( $placeholder_img ) ) {
			$thumb_id = attachment_url_to_postid( $placeholder_img );
		}
		if ( $is_attachment ) {
			$thumb_id = $slide_id;
		}
		if ( ! empty( $thumb_id ) ) {
			$image_sizes       = isset( $post_thumb_setting['bop_thumb_sizes'] ) ? $post_thumb_setting['bop_thumb_sizes'] : 'large';
			$post_image_width  = isset( $post_thumb_setting['bop_image_crop_size']['top'] ) ? $post_thumb_setting['bop_image_crop_size']['top'] : '';
			$post_image_height = isset( $post_thumb_setting['bop_image_crop_size']['right'] ) ? $post_thumb_setting['bop_image_crop_size']['right'] : '';
			$post_image_crop   = isset( $post_thumb_setting['bop_image_crop_size']['style'] ) ? $post_thumb_setting['bop_image_crop_size']['style'] : '';
			$thumb_full_src    = wp_get_attachment_image_src( $thumb_id, 'full' );
			$thumb_full_src    = is_array( $thumb_full_src ) ? $thumb_full_src : array( '', '', '' );
			$image_src         = wp_get_attachment_image_src( $thumb_id, $image_sizes );
			$image_src         = is_array( $image_src ) ? $image_src : array( '', '', '' );

			if ( ( 'custom' === $image_sizes ) && ( ! empty( $post_image_width ) && $thumb_full_src[1] >= $post_image_width ) && ( ! empty( $post_image_height ) && $thumb_full_src[2] >= $post_image_height ) ) {
				$hard_crop = 'Hard-crop' === $post_image_crop ? true : false;

				$image = ta_bop_resize( $thumb_full_src[0], $post_image_width, $post_image_height, $hard_crop );
				if ( $show_2x_image && ( $thumb_full_src[1] >= ( $post_image_width * 2 ) ) && $thumb_full_src[2] >= ( $post_image_height * 2 ) ) {
					$image_resize_2x_url = ta_bop_resize( $thumb_full_src[0], $post_image_width * 2, $post_image_height * 2, $hard_crop );
				} elseif ( $show_2x_image && ( ( $post_image_width * 2 ) === $thumb_full_src[1] ) && ( $post_image_height * 2 ) === $thumb_full_src[2] ) {
					$image_resize_2x_url = $thumb_full_src[0];
				}
				$image_width  = $post_image_width;
				$image_height = $post_image_height;
			} else {
				$image        = ! empty( $image_src[0] ) ? $image_src[0] : $placeholder_img;
				$image_width  = ! empty( $image_src[1] ) ? $image_src[1] : 600;
				$image_height = ! empty( $image_src[2] ) ? $image_src[2] : 450;
			}
		} else {
			$image        = $placeholder_img;
			$image_width  = 600;
			$image_height = 450;
		}
		$bop_image_attr = array(
			'src'        => $image,
			'2x_src'     => $image_resize_2x_url,
			'width'      => $image_width,
			'height'     => $image_height,
			'video'      => ! empty( $replace_thumb['video'] ) ? $replace_thumb['video'] : '',
			'audio'      => ! empty( $replace_thumb['audio'] ) ? $replace_thumb['audio'] : '',
			'aria_label' => ! empty( $replace_thumb['aria_label'] ) ? $replace_thumb['aria_label'] : 'feature_image',
		);

		return $bop_image_attr;
	}


	/**
	 * Thumb Sized function
	 *
	 * @param  array $view_options options array.
	 * @param  int   $slide_id post id.
	 * @param  bool  $is_attachment type attachment.
	 * @return array
	 */
	public static function bop_sized_bopup_thumb( $view_options, $slide_id, $is_attachment = false ) {
		$thumb_id     = '';
		$image        = '';
		$image_height = '';
		$image_width  = '';
		if ( has_post_thumbnail( $slide_id ) ) {
			$thumb_id = get_post_thumbnail_id( $slide_id );
		}
		if ( $is_attachment ) {
			$thumb_id = $slide_id;
		}
		if ( ! empty( $thumb_id ) ) {
			$image_sizes       = isset( $view_options['bop_bopup_img_sizes'] ) ? $view_options['bop_bopup_img_sizes'] : 'medium';
			$post_image_width  = isset( $view_options['bop_bopup_image_crop_size']['top'] ) ? $view_options['bop_bopup_image_crop_size']['top'] : '';
			$post_image_height = isset( $view_options['bop_bopup_image_crop_size']['right'] ) ? $view_options['bop_bopup_image_crop_size']['right'] : '';
			$post_image_crop   = isset( $view_options['bop_bopup_image_crop_size']['style'] ) ? $view_options['bop_bopup_image_crop_size']['style'] : '';
			$thumb_full_src    = wp_get_attachment_image_src( $thumb_id, 'full' );
			$thumb_full_src    = is_array( $thumb_full_src ) ? $thumb_full_src : array( '', '', '' );
			$image_src         = wp_get_attachment_image_src( $thumb_id, $image_sizes );
			$image_src         = is_array( $image_src ) ? $image_src : array( '', '', '' );
			if ( ( 'custom' === $image_sizes ) && ( ! empty( $post_image_width ) && $thumb_full_src[1] >= $post_image_width ) && ( ! empty( $post_image_height ) && $thumb_full_src[2] >= $post_image_height ) ) {
				$hard_crop = 'Hard-crop' === $post_image_crop ? true : false;

				$image        = ta_bop_resize( $thumb_full_src[0], $post_image_width, $post_image_height, $hard_crop );
				$image_width  = $post_image_width;
				$image_height = $post_image_height;
			} else {
				$image        = ! empty( $image_src[0] ) ? $image_src[0] : '';
				$image_width  = ! empty( $image_src[1] ) ? $image_src[1] : 600;
				$image_height = ! empty( $image_src[2] ) ? $image_src[2] : 450;
			}
		}
		return array(
			'src'    => $image,
			'width'  => $image_width,
			'height' => $image_height,
		);
	}
	/**
	 * Thumb Sized function
	 *
	 * @param array   $post_thumb_setting Thumbnails options array.
	 * @param integer $slide_id The slide/post ID.
	 *
	 * @return string
	 */
	public static function bop_thumb_replace( $post_thumb_setting, $slide_id ) {
		$bop_thumb_src_replace = isset( $post_thumb_setting['bop_thumb_src_replace'] ) ? $post_thumb_setting['bop_thumb_src_replace'] : '';

		if ( is_array( $bop_thumb_src_replace ) ) {
			$image_src    = in_array( 'image', $bop_thumb_src_replace, true ) ? true : false;
			$video_src    = in_array( 'video', $bop_thumb_src_replace, true ) ? true : false;
			$audio_src    = in_array( 'audio', $bop_thumb_src_replace, true ) ? true : false;
			$content_post = get_post( $slide_id );
			$content      = $content_post->post_content;

			$test          = preg_match_all(
				'((https?|ftp|gopher|telnet|file|notes|ms-help):' .
					'((//)|(\\\\))+[\w\d:#@%/;$()~_?\+-=\\\.&]*)',
				$content,
				$matches,
				PREG_PATTERN_ORDER
			);
			$first_content = 'image';

			if ( ! empty( $matches[0][0] ) ) {
				if ( strpos( $matches[0][0], '.jpg' ) || strpos( $matches[0][0], '.jpeg' ) || strpos( $matches[0][0], '.gif' ) || strpos( $matches[0][0], '.png' ) || strpos( $matches[0][0], '.eps' ) ) {
					$first_content = 'image';
				}
				if ( strpos( $matches[0][0], 'video' ) || strpos( $matches[0][0], 'youtube' ) || strpos( $matches[0][0], 'vimeo' ) || strpos( $matches[0][0], '.mp4' ) ) {
					$first_content = 'video';
				}
				if ( strpos( $matches[0][0], 'audio' ) || strpos( $matches[0][0], 'soundcloud' ) ) {
					$first_content = 'audio';
				}
			}
			$image_id = 'image' === $first_content ? self::bop_get_img_from_post( $post_thumb_setting, $slide_id ) : '';
			$is_video = 'video' === $first_content ? self::bop_get_video_from_post( $slide_id ) : '';
			$is_audio = 'audio' === $first_content ? self::bop_get_audios_from_post( $slide_id ) : '';

			if ( $image_src && $video_src && $audio_src ) {
				$thumb_id    = $image_id;
				$video_thumb = $is_video;
				$audio_thumb = $is_audio;
			}
			if ( $image_src && $video_src ) {
				$thumb_id    = $image_id;
				$video_thumb = $is_video;
			}
			if ( $image_src && $audio_src ) {
				$thumb_id    = $image_id;
				$audio_thumb = $is_audio;
			}
			if ( $audio_src && $video_src ) {
				$video_thumb = $is_video;
				$audio_thumb = $is_audio;
			}
			if ( $image_src ) {
				$thumb_id = self::bop_get_img_from_post( $post_thumb_setting, $slide_id );
			}
			if ( $video_src && ( empty( $matches[1][0] ) || ! $image_src ) ) {
				$video_thumb = self::bop_get_video_from_post( $slide_id );
			}
			if ( $audio_src && empty( $video_thumb ) && ( empty( $matches[1][0] ) || ! $image_src ) ) {
				$audio_thumb = self::bop_get_audios_from_post( $slide_id );
			}
		}
		$bop_thumbs_replace_src = array(
			'id'         => ! empty( $thumb_id ) ? $thumb_id : '',
			'video'      => ! empty( $video_thumb ) ? $video_thumb : '',
			'audio'      => ! empty( $audio_thumb ) ? $audio_thumb : '',
			'aria_label' => ! empty( $first_content ) ? $first_content : '',
		);
		return $bop_thumbs_replace_src;
	}

	/**
	 * Get first image from post content
	 *
	 * @since 1.0
	 * @param array  $post_thumb_setting Thumbnails options array.
	 * @param  number $slide_id Post id.
	 * @return mixed
	 */
	public static function bop_get_img_from_post( $post_thumb_setting, $slide_id ) {
		$bop_thumb_src = isset( $post_thumb_setting['bop_thumb_src'] ) ? $post_thumb_setting['bop_thumb_src'] : 'featured_image';
		$content_post  = get_post( $slide_id );
		$content       = $content_post->post_content;
		$images        = preg_match_all( '/<img[^>]* src=\"([^\"]*)\"[^>]*>/i', $content, $matches );
		if ( $images ) {
			$img_url  = 'last_img_content' === $bop_thumb_src ? array_values( array_slice( $matches[1], -1 ) ) : $matches[1][0];
			$thumb_id = self::bop_image_id_by_url( $img_url, $slide_id );
		}
		if ( ! empty( $thumb_id ) ) {
			return $thumb_id;
		}
	}

	/**
	 * Get first video from post content
	 *
	 * @since 1.0
	 * @param  number $slide_id Post id.
	 * @return mixed
	 */
	public static function bop_get_video_from_post( $slide_id ) {

		$post    = get_post( $slide_id );
		$content = do_shortcode( apply_filters( 'the_content', $post->post_content ) );
		$embeds  = apply_filters( 'bop_get_post_video', get_media_embedded_in_content( $content ) );

		if ( empty( $embeds ) ) {
			return '';
		}

		// check what is the first embed containg video tag, youtube or vimeo.
		foreach ( $embeds as $embed ) {
			if ( strpos( $embed, 'video' ) || strpos( $embed, 'youtube' ) || strpos( $embed, 'vimeo' ) || strpos( $embed, '.mp4' ) ) {
				return $embed;
			}
		}
	}

	/**
	 * Get audio files from post content
	 *
	 * @param  number $slide_id Post id.
	 * @return mixed          Iframe.
	 */
	public static function bop_get_audios_from_post( $slide_id ) {
		// For audio post type - grab.
		$post    = get_post( $slide_id );
		$content = do_shortcode( apply_filters( 'ta_bop_the_content', $post->post_content ) );
		$embeds  = apply_filters( 'bop_get_post_audio', get_media_embedded_in_content( $content ) );
		if ( empty( $embeds ) ) {
			return '';
		}

		// check what is the first embed containg video tag, youtube or vimeo.
		foreach ( $embeds as $embed ) {
			if ( strpos( $embed, 'audio' ) || strpos( $embed, 'soundcloud' ) ) {
				return $embed;
			}
		}
	}

	/**
	 * Process all the post meta.
	 *
	 * @param object $post The selected post.
	 * @param array  $post_meta_fields The selected post meta to show.
	 * @param int    $visitor_count Number of visitor saw the post.
	 * @param string $meta_separator The post meta separator.
	 * @param string $is_table the table layout check.
	 * @return void
	 */
	public static function bop_get_post_meta( $post, $post_meta_fields, $visitor_count, $meta_separator, $is_table ) {

		$meta_wrapper_start_tag = ! $is_table ? apply_filters( 'bop_post_meta_wrapper_start', '<ul>' ) : '';
		$meta_wrapper_end_tag   = ! $is_table ? apply_filters( 'bop_post_meta_wrapper_end', '</ul>' ) : '';
		echo wp_kses_post( $meta_wrapper_start_tag );
		$i = 0;
		foreach ( $post_meta_fields as $each_meta ) {
			$selected_meta        = isset( $each_meta['select_post_meta'] ) ? $each_meta['select_post_meta'] : '';
			$taxonomy_name        = isset( $each_meta['post_meta_taxonomy'] ) ? $each_meta['post_meta_taxonomy'] : '';
			$author_avatar        = isset( $each_meta['post_meta_author_avatar'] ) ? $each_meta['post_meta_author_avatar'] : 'name_with_icon';
			$meta_date_format     = isset( $each_meta['post_meta_date_format'] ) ? $each_meta['post_meta_date_format'] : 'default';
			$custom_date_format   = isset( $each_meta['bop_custom_meta_date_format'] ) ? $each_meta['bop_custom_meta_date_format'] : 'F j, Y';
			$word_per_minute      = isset( $each_meta['bop_word_per_minute'] ) ? $each_meta['bop_word_per_minute'] : 300;
			$reading_time_postfix = isset( $each_meta['reading_time_postfix'] ) ? $each_meta['reading_time_postfix'] : ' Min Read';

			$meta_icon      = ! empty( $each_meta['select_meta_icon'] ) ? sprintf( '<i class="' . $each_meta['select_meta_icon'] . '"></i>' ) : '';
			$start_tag      = $is_table ? '<td class="ta-bop-post-meta">' : '<li>';
			$end_tag        = $is_table ? '</td>' : '</li>';
			$meta_tag_start = apply_filters( 'bop_post_meta_html_tag_start', $start_tag );
			$meta_tag_end   = apply_filters( 'bop_post_meta_html_tag_end', $end_tag );
			$allowed_html   = array(
				'a'    => array(
					'href'  => array(),
					'title' => array(),
				),
				'i'    => array(
					'class' => array(),
					'id'    => array(),
				),
				'span' => array(
					'class' => array(),
					'id'    => array(),
				),
				'div'  => array(
					'class' => array(),
					'id'    => array(),
				),
			);

			switch ( $selected_meta ) {
				case 'author':
					if ( 0 < $i ) {
						?>
						<span class="meta_separator"><?php echo wp_kses_post( $meta_separator ); ?></span>
						<?php
					}
					echo wp_kses_post( $meta_tag_start );
					if ( 'show_name' === $author_avatar ) {
						$author_output = esc_html( get_the_author_meta( 'display_name', $post->post_author ) );
					} elseif ( 'show_gravatar' === $author_avatar ) {
						$author_output = sprintf( '<img src="%1$s"  width="16"  height="16" title=" %2$s">', get_avatar_url( get_the_author_meta( 'ID', $post->post_author ) ), esc_html( get_the_author_meta( 'display_name', $post->post_author ) ) );
					} elseif ( 'name_with_gravatar' === $author_avatar ) {
						$author_output = sprintf( '<img src="%1$s"  width="16"  height="16" title=" %2$s">%3$s', get_avatar_url( get_the_author_meta( 'ID', $post->post_author ) ), esc_html( get_the_author_meta( 'display_name', $post->post_author ) ), esc_html( get_the_author_meta( 'display_name', $post->post_author ) ) );
					} elseif ( 'name_with_icon' === $author_avatar ) {

						$meta_icon     = ! empty( $meta_icon ) ? $meta_icon : '<i class="fas fa-user"></i>';
						$author_output = sprintf( '%1$s %2$s', wp_kses( $meta_icon, $allowed_html ), esc_html( get_the_author_meta( 'display_name', $post->post_author ) ) );
					}

					?>
					<a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>" rel="author"><?php echo wp_kses_post( $author_output ); ?></a>
					<?php
					echo wp_kses_post( $meta_tag_end );
					break;
				case 'date':
					if ( 0 < $i ) {
						?>
						<span class="meta_separator"><?php echo wp_kses_post( $meta_separator ); ?></span>
						<?php
					}
					echo wp_kses_post( $meta_tag_start );
					if ( 'default' === $meta_date_format ) {
						$post_date = esc_html( date_i18n( get_option( 'date_format' ), strtotime( $post->post_date ) ) );
					} elseif ( 'time_ago' === $meta_date_format ) {
						$post_date = human_time_diff( date_i18n( 'U', strtotime( $post->post_date ) ), current_time( 'timestamp' ) ) . esc_html__( ' ago', 'bookify-pro' );
					} elseif ( 'custom' === $meta_date_format ) {
						$post_date = esc_html( date_i18n( $custom_date_format, strtotime( $post->post_date ) ) );
					}
					?>
					<?php echo wp_kses( $meta_icon, $allowed_html ); ?>
					<time class="entry-date published updated">

						<?php echo wp_kses_post( $post_date ); ?></time>
					<?php
					echo wp_kses_post( $meta_tag_end );
					break;
				case 'taxonomy':
					if ( 'beside_meta' === $each_meta['bop_meta_position'] ) {
						$term = self::bop_taxonomy_terms( $taxonomy_name, $post->ID, $meta_icon );
						if ( ! empty( $term ) ) {
							if ( 0 < $i ) {
								?>
								<span class="meta_separator"><?php echo wp_kses_post( $meta_separator ); ?></span>
								<?php
							}
							echo wp_kses_post( $meta_tag_start );
							echo wp_kses_post( $term );
							echo wp_kses_post( $meta_tag_end );
						}
					}
					break;
				case 'view_count':
					if ( 0 < $i ) {
						?>
						<span class="meta_separator"><?php echo wp_kses_post( $meta_separator ); ?></span>
						<?php
					}
					echo wp_kses_post( $meta_tag_start );
					?>
					<?php echo wp_kses( $meta_icon, $allowed_html ); ?> <span><?php echo esc_html( $visitor_count ); ?></span>
					<?php
					echo wp_kses_post( $meta_tag_end );
					break;
				case 'like':
					if ( 0 < $i ) {
						?>
						<span class="meta_separator"><?php echo wp_kses_post( $meta_separator ); ?></span>
						<?php
					}
					echo wp_kses_post( $meta_tag_start );
					?>
					<?php
					echo wp_kses(
						BOP_User_Like::get_bop_likes_button( $post->ID ),
						array(
							'a'    => array(
								'href'           => true,
								'class'          => true,
								'data-nonce'     => true,
								'data-post-id'   => true,
								'data-iscomment' => true,
								'title'          => true,
							),
							'i'    => array( 'class' => true ),
							'span' => array( 'class' => true ),
						)
					);
					?>
					<?php
					echo wp_kses_post( $meta_tag_end );
					break;
				case 'reading_time':
					if ( 0 < $i ) {
						?>
						<span class="meta_separator"><?php echo wp_kses_post( $meta_separator ); ?></span>
						<?php
					}
					echo wp_kses_post( $meta_tag_start );
					?>
					<?php echo wp_kses( $meta_icon, $allowed_html ); ?> <span><?php self::bop_reading_time( $post->ID, $word_per_minute, $reading_time_postfix ); ?></span>
					<?php
					echo wp_kses_post( $meta_tag_end );
					break;
			}
			++$i;
		} // End Foreach.
		echo wp_kses_post( $meta_wrapper_end_tag );
	}
	/**
	 * Process all the book fildes.
	 *
	 * @param object $event The selected event.
	 * @param array  $book_fildes_fields The selected book fildes to show.
	 * @param int    $visitor_count Number of visitor saw the event.
	 * @param string $fildes_separator The book fildes separator.
	 * @param string $is_table the table layout check.
	 * @return void
	 */
	public static function bop_get_book_fildes( $sorter, $layout, $book_fildes_fields, $visitor_count, $meta_separator, $bookify_postmeta ) {
		$is_meta_not_empty = ! empty( $bookify_postmeta['bop_author'] ) || ! empty( $bookify_postmeta['bop_publisher'] ) || ! empty( $bookify_postmeta['bop_publish_date'] ) || ! empty( $bookify_postmeta['bop_book_isbn'] ) || ! empty( $bookify_postmeta['bop_book_isbn_10'] ) || ! empty( $bookify_postmeta['bop_book_isbn_13'] ) || ! empty( $bookify_postmeta['bop_book_asin'] ) || ! empty( $bookify_postmeta['bop_book_subject'] ) || ! empty( $bookify_postmeta['bop_book_genre'] );

		$show_book_column = isset( $sorter['bop_book_fildes']['show_book_column'] ) ? $sorter['bop_book_fildes']['show_book_column'] : '1';

		$meta_wrapper_start_tag = "<div class='bookify__book_fildes'><div class='book_fildes " . esc_attr( $layout != 'list_layout' ? "ta-fields-row column-$show_book_column" : '' ) . "'>";
		$meta_wrapper_end_tag   = apply_filters( 'bop_book_fildes_wrapper_end', '</div></div>' );
		if ( $is_meta_not_empty ) {
			echo wp_kses_post( $meta_wrapper_start_tag );
		}

		$i = 0;
		foreach ( $book_fildes_fields as $each_meta ) {
			$selected_meta      = isset( $each_meta['select_book_fildes'] ) ? $each_meta['select_book_fildes'] : '';
			$custom_date_format = isset( $each_meta['bop_custom_event_date_format'] ) ? $each_meta['bop_custom_event_date_format'] : 'j F, Y g:i A';

			$meta_icon      = ! empty( $each_meta['select_book_fildes_icon'] ) ? sprintf( '<i class="' . esc_attr( $each_meta['select_book_fildes_icon'] ) . '"></i>' ) : '';
			$start_tag      = "<div class='book_filde'>";
			$end_tag        = '</div>';
			$meta_tag_start = apply_filters( 'bop_book_fildes_html_tag_start', $start_tag );
			$meta_tag_end   = apply_filters( 'bop_book_fildes_html_tag_end', $end_tag );
			$allowed_html   = array(
				'a'    => array(
					'href'  => array(),
					'title' => array(),
				),
				'i'    => array(
					'class' => array(),
					'id'    => array(),
				),
				'span' => array(
					'class' => array(),
					'id'    => array(),
				),
				'div'  => array(
					'class' => array(),
					'id'    => array(),
				),
			);

			switch ( $selected_meta ) {

				case 'book_author':
					if ( $bookify_postmeta['bop_author'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_author'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}

					break;
				case 'publisher':
					if ( $bookify_postmeta['bop_publisher'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_publisher'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}

					break;
				case 'publish_date':
					if ( $bookify_postmeta['bop_publish_date'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_publish_date'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}

					break;
				case 'price':
					if ( $bookify_postmeta['bop_book_sale_price'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_book_sale_price'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}

					break;
				case 'isbn':
					if ( $bookify_postmeta['bop_book_isbn'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_book_isbn'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}

					break;
				case 'isbn_10':
					if ( $bookify_postmeta['bop_book_isbn_10'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_book_isbn_10'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}

					break;
				case 'isbn_13':
					if ( $bookify_postmeta['bop_book_isbn_13'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_book_isbn_13'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}

					break;
				case 'asin':
					if ( $bookify_postmeta['bop_book_asin'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_book_asin'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}

					break;
				case 'subject':
					if ( $bookify_postmeta['bop_book_subject'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_book_subject'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}

					break;
				case 'genre':
					if ( $bookify_postmeta['bop_book_genre'] ) {
						echo wp_kses_post( $meta_tag_start );
						echo wp_kses( $meta_icon, $allowed_html );
						if ( $each_meta['show_before_text'] ) {
							echo wp_kses_post( '<span>' . $each_meta['bop_before_text'] . '</span>' );
						}
						echo wp_kses_post( '<span>' . $bookify_postmeta['bop_book_genre'] . '</span>' );
						echo wp_kses_post( $meta_tag_end );
					}
					break;
			}
			++$i;
		} // End Foreach.
		if ( $is_meta_not_empty ) {
			echo wp_kses_post( $meta_wrapper_end_tag );
		}
	}
	/**
	 * Pcp_get_post_meta_on_table_heading
	 *
	 * @param  mixed $post_meta_fields The selected post meta to show.
	 * @return void
	 */
	public static function bop_get_post_meta_on_table_heading( $post_meta_fields ) {
		$i = 0;
		foreach ( $post_meta_fields as $each_meta ) {
			$selected_meta = isset( $each_meta['select_post_meta'] ) ? $each_meta['select_post_meta'] : '';
			$taxonomy_name = isset( $each_meta['post_meta_taxonomy'] ) ? $each_meta['post_meta_taxonomy'] : '';
			switch ( $selected_meta ) {
				case 'author':
					?>
					<th><?php esc_html_e( 'Author', 'bookify-pro' ); ?></th>
					<?php
					break;
				case 'date':
					?>
					<th><?php esc_html_e( 'Date', 'bookify-pro' ); ?></th>
					<?php
					break;
				case 'taxonomy':
					if ( 'beside_meta' === $each_meta['bop_meta_position'] ) {
						?>
						<th><?php echo esc_html( $taxonomy_name ); ?></th>
						<?php
					}
					break;
				case 'view_count':
					?>
					<th><?php esc_html_e( 'View count', 'bookify-pro' ); ?></th>
					<?php
					break;
				case 'like':
					?>
					<th><?php esc_html_e( 'Like', 'bookify-pro' ); ?></th>
					<?php
					break;
				case 'reading_time':
					?>
					<th><?php esc_html_e( 'Reading count', 'bookify-pro' ); ?></th>
					<?php
					break;
			}
			++$i;
		} // End Foreach.
	}
	/**
	 * Show reading time for the post.
	 *
	 * @param int    $post_id The post ID.
	 * @param int    $word_per_minute Number of word can be read.
	 * @param string $reading_time_postfix Text appear after the reading time.
	 *
	 * @return void
	 */
	public static function bop_reading_time( $post_id, $word_per_minute, $reading_time_postfix ) {
		$content      = get_post_field( 'post_content', $post_id );
		$word_count   = str_word_count( strip_tags( $content ) );
		$reading_time = ceil( $word_count / $word_per_minute );

		$total_reading_time = $reading_time . $reading_time_postfix;

		echo esc_html( $total_reading_time );
	}

	/**
	 * Process the taxonomy terms.
	 *
	 * @param array $taxonomy The taxonomy name to show terms from.
	 * @param mixed $id ids.
	 * @param mixed $meta_icon The meta icon html.
	 * @return statement
	 */
	public static function bop_taxonomy_terms( $taxonomy, $id, $meta_icon = null ) {
		$terms = get_the_term_list( $id, $taxonomy, '', ', ' );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			return wp_kses_post( $meta_icon . $terms );
		}
	}

	/**
	 * Show post thumb category.
	 *
	 * @param integer $post_id The post ID.
	 * @return statement.
	 */
	public static function bop_post_thumb_taxonomy( $taxonomy, $id, $meta_icon = null ) {
		$terms = get_the_terms( $id, $taxonomy );
		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			$first_term = reset( $terms ); // Get the first term

			if ( $first_term ) {
				$term_link = get_tag_link( $first_term->term_id );
				$term_name = $first_term->name;

				return '<a href="' . esc_url( $term_link ) . '">' . esc_html( $term_name ) . '</a>';
			}
		}
	}

	/**
	 * Show category.
	 *
	 * @param integer $post_id The post ID.
	 * @return statement.
	 */
	public static function bop_taxonomy( $taxonomy, $id, $meta_icon = null ) {
		$terms  = get_the_terms( $id, $taxonomy );
		$result = '';

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term ) {
				$term_link = esc_url( get_term_link( $term->term_id ) );
				$term_name = esc_html( $term->name );
				$result   .= '<a href="' . $term_link . '">' . $term_name . '</a> ';
			}
		}

		return wp_kses_post( $result );
	}

	/**
	 * Maximum pages.
	 *
	 * @param int $total_post Number of total posts.
	 * @param int $post_per_page Posts per page.
	 *
	 * @return void
	 */
	public static function bop_max_pages( $total_post, $post_per_page ) {
		if ( ! $total_post ) {
			return;
		}
		$max_num_pages = ceil( $total_post / $post_per_page );
		return wp_kses_post( $max_num_pages );
	}

	/**
	 * Post per page.
	 *
	 * @param int $limit Post Limit.
	 * @param int $post_per_page post per page.
	 * @param int $page paged number.
	 *
	 * @return int
	 */
	public static function bop_post_per_page( $limit, $post_per_page, $page ) {
		$limit               = ( empty( $limit ) || '-1' === $limit ) ? 10000000 : $limit;
		$offset              = (int) $post_per_page * ( $page - 1 );
		$final_post_per_page = $post_per_page;
		if ( intval( $post_per_page ) > $limit - $offset ) {
			$final_post_per_page = $limit - $offset;
		}
		return wp_kses_post( $final_post_per_page );
	}

	/**
	 * Pagination last page post
	 *
	 * @param [type] $limit total post limit.
	 * @param [type] $post_per_page post per page.
	 * @param [type] $total_page last post page.
	 *
	 * @return int.
	 */
	public static function bop_last_page_post( $limit, $post_per_page, $total_page ) {
		$limit              = ( empty( $limit ) || '-1' === $limit ) ? 10000000 : $limit;
		$offset             = $post_per_page * ( $total_page - 1 );
		$bop_last_page_post = $limit - $offset;
		return wp_kses_post( $bop_last_page_post );
	}

	/**
	 * Get view option from view ID
	 *
	 * @param string $bop_gl_id ID of custom field.
	 *
	 * @return array
	 */
	public static function view_options( $bop_gl_id ) {
		if ( ! $bop_gl_id ) {
			return;
		}
		$view_options = get_post_meta( $bop_gl_id, 'ta_bookify_options', true );
		return wp_kses_post( $view_options );
	}

	/**
	 * Get value of a setting from global settings array
	 *
	 * @param string     $field        The full name of setting to get value.
	 * @param array      $array_to_get Array to get values of wanted setting.
	 * @param mixed|null $assign       The value to assign if setting is not found.
	 */
	public static function bop_metabox_value( $field, $array_to_get = null, $assign = null ) {
		global $bop_gl_id;
		if ( empty( $array_to_get ) ) {
			$array_to_get = self::view_options( $bop_gl_id );
		}
		return isset( $array_to_get[ $field ] ) ? $array_to_get[ $field ] : $assign;
	}

	/**
	 * Convert the slug text to a name.
	 *
	 * @param string $slug The slug string.
	 * @return string
	 */
	public static function slug_string_to_name( $slug ) {
		$slug = preg_replace( '/[_\-]+/', ' ', $slug );

		return ucwords( $slug );
	}

	/**
	 * Custom Template locator .
	 *
	 * @param  mixed $template_name template name .
	 * @param  mixed $template_path template path .
	 * @param  mixed $default_path default path .
	 * @return string
	 */
	public static function bop_locate_template( $template_name, $template_path = '', $default_path = '' ) {
		if ( ! $template_path ) {
			$template_path = 'bookify-pro/templates';
		}

		if ( ! $default_path ) {
			$default_path = BOP_PATH . 'public/templates/';
		}
		$template = locate_template( trailingslashit( $template_path ) . $template_name );
		// Get default template.
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}
		// Return what we found.
		return wp_kses_post( $template );
	}
}
