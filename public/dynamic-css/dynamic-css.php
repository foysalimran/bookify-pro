<?php

/**
 *  Dynamic CSS
 *
 * @package    Bookify_pro
 * @subpackage Bookify_pro/public
 */

if (!defined('ABSPATH')) {
	exit;
}

$view_options = get_post_meta($bop_id, 'ta_bookify_options', true);
$layouts      = get_post_meta($bop_id, 'ta_bookify_layouts', true);
$layout = isset($layouts['bop_layout_preset']) ? $layouts['bop_layout_preset'] : '';

$show_section_title        = isset($view_options['section_title']) ? $view_options['section_title'] : false;
if ($show_section_title) {
	$section_title_margin_top    = isset($view_options['section_title_margin']['top']) && $view_options['section_title_margin']['top'] > 0 ? $view_options['section_title_margin']['top'] . 'px' : 0;
	$section_title_margin_right  = isset($view_options['section_title_margin']['right']) && $view_options['section_title_margin']['right'] > 0 ? $view_options['section_title_margin']['right'] . 'px' : 0;
	$section_title_margin_bottom = isset($view_options['section_title_margin']['bottom']) && $view_options['section_title_margin']['bottom'] > 0 ? $view_options['section_title_margin']['bottom'] . 'px' : 0;
	$section_title_margin_left   = isset($view_options['section_title_margin']['left']) && $view_options['section_title_margin']['left'] > 0 ? $view_options['section_title_margin']['left'] . 'px' : 0;
	$_section_title_typography   = isset($view_options['section_title_typography']) && array_key_exists('font-size', $view_options['section_title_typography']) ? $view_options['section_title_typography'] : array(
		'color'              => '#444',
		'font-family'        => '',
		'font-weight'        => '',
		'subset'             => '',
		'font-size'          => '24',
		'tablet-font-size'   => '15',
		'mobile-font-size'   => '18',
		'line-height'        => '28',
		'tablet-line-height' => '24',
		'mobile-line-height' => '15',
		'letter-spacing'     => '0',
		'text-align'         => 'left',
		'text-transform'     => 'none',
		'type'               => '',
		'unit'               => 'px',
	);
	$section_title_font_weight   = !empty($_section_title_typography['font-weight']) ? $_section_title_typography['font-weight'] : '400';
	$section_title_font_style    = !empty($_section_title_typography['font-style']) ? $_section_title_typography['font-style'] : 'normal';
	$custom_css                 .= "#bop_wrapper-{$bop_id} .bop-section-title{";
	if (!empty($_section_title_typography['font-family'])) {
		$custom_css .= "font-family: {$_section_title_typography['font-family']};font-weight: {$section_title_font_weight};font-style: {$section_title_font_style};";
	}
	$custom_css .= "text-align: {$_section_title_typography['text-align']};text-transform: {$_section_title_typography['text-transform']};font-size: {$_section_title_typography['font-size']}px;line-height: {$_section_title_typography['line-height']}px;letter-spacing: {$_section_title_typography['letter-spacing']}px;color: {$_section_title_typography['color']};margin: {$section_title_margin_top} {$section_title_margin_right} {$section_title_margin_bottom} {$section_title_margin_left}}";
}

$margin_between_post      = isset($view_options['margin_between_post']['all']) ? (int) $view_options['margin_between_post']['all'] : 20;
$margin_between_post_half = $margin_between_post / 2;
$custom_css              .= "#bop_wrapper-{$bop_id} .ta-row{ margin-right: -{$margin_between_post_half}px;margin-left: -{$margin_between_post_half}px;}#bop_wrapper-{$bop_id} .ta-row [class*='ta-col-']{padding-right: {$margin_between_post_half}px;padding-left: {$margin_between_post_half}px;padding-bottom: {$margin_between_post}px;}";
if ('large_with_small' === $layouts['bop_layout_preset']) {
	$custom_css .= "#bop_wrapper-{$bop_id} .ta-bop-block-8, #bop_wrapper-{$bop_id} .ta-bop-block-4, #bop_wrapper-{$bop_id} .ta-bop-block-6, #bop_wrapper-{$bop_id} .ta-bop-block-3{padding-right: {$margin_between_post_half}px;padding-left: {$margin_between_post_half}px;}#bop_wrapper-{$bop_id} .ta-bop-block-4 .ta-bop-block-half,#bop_wrapper-{$bop_id} .ta-bop-block-8,#bop_wrapper-{$bop_id} .ta-bop-block-3 .ta-bop-block-half,#bop_wrapper-{$bop_id} .ta-bop-block-6{padding-bottom: {$margin_between_post}px;}";
}
$custom_css .= "#bop_wrapper-{$bop_id} .ta-row.book_fildes{margin-right: 0px;margin-left: 0px;}";
/**
 * Style for each slide/post.
 */
// Post Title.
$post_sorter     = isset($view_options['post_content_sorter']) ? $view_options['post_content_sorter'] : '';
$bop_book_fildes = isset($post_sorter['bop_book_fildes']) ? $post_sorter['bop_book_fildes'] : "";
$bop_post_title  = isset($post_sorter['bop_post_title']) ? $post_sorter['bop_post_title'] : '';
$show_post_title = isset($bop_post_title['show_post_title']) ? $bop_post_title['show_post_title'] : '';
// Post Subtitle
$bop_post_subtitle  = isset($post_sorter['bop_post_subtitle']) ? $post_sorter['bop_post_subtitle'] : '';
$show_post_subtitle = isset($bop_post_subtitle['show_post_subtitle']) ? $bop_post_subtitle['show_post_subtitle'] : '';
// PCP Post Content.
$bop_post_content  = isset($post_sorter['bop_post_content']) ? $post_sorter['bop_post_content'] : '';
$show_post_content = isset($bop_post_content['show_post_content']) ? $bop_post_content['show_post_content'] : '';


// Post Title.
if ($show_post_title) {
	$post_title_margin = isset($bop_post_title['post_title_margin']) ? $bop_post_title['post_title_margin'] : array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '9',
		'left'   => '0',
	);

	$_post_title_typography = isset($view_options['post_title_typography']) && array_key_exists('font-size', $view_options['post_title_typography']) ? $view_options['post_title_typography'] : array(
		'color'              => '#111',
		'hover_color'        => '#876585',
		'font-family'        => '',
		'font-weight'        => '',
		'subset'             => '',
		'font-size'          => '15',
		'tablet-font-size'   => '18',
		'mobile-font-size'   => '16',
		'line-height'        => '24',
		'tablet-line-height' => '22',
		'mobile-line-height' => '15',
		'letter-spacing'     => '0',
		'text-align'         => 'left',
		'text-transform'     => 'none',
		'type'               => '',
		'unit'               => 'px',
	);
	$post_title_font_weight = !empty($_post_title_typography['font-weight']) ? $_post_title_typography['font-weight'] : '400';
	$post_title_font_style  = !empty($_post_title_typography['font-style']) ? $_post_title_typography['font-style'] : 'normal';
	$custom_css            .= "#bop_wrapper-{$bop_id} .bookify__item--title a{";
	if (!empty($_post_title_typography['font-family'])) {
		$custom_css .= "font-family: {$_post_title_typography['font-family']};font-weight: {$post_title_font_weight};font-style: {$post_title_font_style};";
	}
	if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
		$custom_css .= "text-align: {$_post_title_typography['text-align']};";
	}
	$custom_css .= "text-transform: {$_post_title_typography['text-transform']};font-size: {$_post_title_typography['font-size']}px;line-height: {$_post_title_typography['line-height']}px;letter-spacing: {$_post_title_typography['letter-spacing']}px;color: {$_post_title_typography['color']};display: inherit;}#bop_wrapper-{$bop_id} .bookify__item--title {margin: {$post_title_margin['top']}px {$post_title_margin['right']}px {$post_title_margin['bottom']}px {$post_title_margin['left']}px;}#bop_wrapper-{$bop_id} .bop-collapse-header a{display: inline-block;}";
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--title a:hover,#bop_wrapper-{$bop_id} .bop-collapse-header:hover a{color: {$_post_title_typography['hover_color']};}";
}
if ($show_post_subtitle) {
	$post_subtitle_margin = isset($bop_post_subtitle['post_subtitle_margin']) ? $bop_post_subtitle['post_subtitle_margin'] : array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '9',
		'left'   => '0',
	);

	$_post_subtitle_typography = isset($view_options['post_subtitle_typography']) && array_key_exists('font-size', $view_options['post_subtitle_typography']) ? $view_options['post_subtitle_typography'] : array(
		'color'              => '#111',
		'hover_color'        => '#876585',
		'font-family'        => '',
		'font-weight'        => '',
		'subset'             => '',
		'font-size'          => '15',
		'tablet-font-size'   => '18',
		'mobile-font-size'   => '16',
		'line-height'        => '24',
		'tablet-line-height' => '22',
		'mobile-line-height' => '15',
		'letter-spacing'     => '0',
		'text-align'         => 'left',
		'text-transform'     => 'none',
		'type'               => '',
		'unit'               => 'px',
	);
	$post_subtitle_font_weight = !empty($_post_subtitle_typography['font-weight']) ? $_post_subtitle_typography['font-weight'] : '400';
	$post_subtitle_font_style  = !empty($_post_subtitle_typography['font-style']) ? $_post_subtitle_typography['font-style'] : 'normal';
	$custom_css            .= "#bop_wrapper-{$bop_id} .bookify__item--subtitle a{";
	if (!empty($_post_subtitle_typography['font-family'])) {
		$custom_css .= "font-family: {$_post_subtitle_typography['font-family']};font-weight: {$post_subtitle_font_weight};font-style: {$post_subtitle_font_style};";
	}
	if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
		$custom_css .= "text-align: {$_post_subtitle_typography['text-align']};";
	}
	$custom_css .= "text-transform: {$_post_subtitle_typography['text-transform']};font-size: {$_post_subtitle_typography['font-size']}px;line-height: {$_post_subtitle_typography['line-height']}px;letter-spacing: {$_post_subtitle_typography['letter-spacing']}px;color: {$_post_subtitle_typography['color']};display: inherit;}#bop_wrapper-{$bop_id} .bookify__item--subtitle {margin: {$post_subtitle_margin['top']}px {$post_subtitle_margin['right']}px {$post_subtitle_margin['bottom']}px {$post_subtitle_margin['left']}px;}#bop_wrapper-{$bop_id} .bop-collapse-header a{display: inline-block;}";
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--subtitle a:hover,#bop_wrapper-{$bop_id} .bop-collapse-header:hover a{color: {$_post_subtitle_typography['hover_color']};}";
}

// Post Content.
if ($show_post_content) {
	$post_content_margin      = isset($bop_post_content['post_content_margin']) ? $bop_post_content['post_content_margin'] : array(
		'top'    => '0',
		'right'  => '0',
		'bottom' => '15',
		'left'   => '0',
	);
	$_post_content_typography = isset($view_options['post_content_typography']) && array_key_exists('font-size', $view_options['post_content_typography']) ? $view_options['post_content_typography'] : array(
		'color'              => '#444',
		'font-family'        => '',
		'font-weight'        => '',
		'subset'             => '',
		'font-size'          => '16',
		'tablet-font-size'   => '14',
		'mobile-font-size'   => '12',
		'line-height'        => '20',
		'tablet-line-height' => '18',
		'mobile-line-height' => '18',
		'letter-spacing'     => '0',
		'text-align'         => 'left',
		'text-transform'     => 'none',
		'type'               => '',
		'unit'               => 'px',
	);
	$post_content_font_weight = !empty($_post_content_typography['font-weight']) ? $_post_content_typography['font-weight'] : '400';
	$post_content_font_style  = !empty($_post_content_typography['font-style']) ? $_post_content_typography['font-style'] : 'normal';
	$custom_css              .= "#bop_wrapper-{$bop_id} .bookify__item__content{";
	if (!empty($_post_content_typography['font-family'])) {
		$custom_css .= "font-family: {$_post_content_typography['font-family']};font-weight: {$post_content_font_weight};font-style: {$post_content_font_style};";
	}
	if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
		$custom_css .= "text-align: {$_post_content_typography['text-align']};";
	}
	$custom_css .= "text-transform: {$_post_content_typography['text-transform']};font-size: {$_post_content_typography['font-size']}px;line-height: {$_post_content_typography['line-height']}px;letter-spacing: {$_post_content_typography['letter-spacing']}px;margin: {$post_content_margin['top']}px {$post_content_margin['right']}px {$post_content_margin['bottom']}px {$post_content_margin['left']}px;color: {$_post_content_typography['color']}; }";
}

if ('carousel_layout' === $layout) {
	include BOP_PATH . '/public/dynamic-css/carousel-css.php';
}

// Post inner padding.
$post_content_orientation   = $view_options['post_content_orientation'];
$post_details_class         = 'overlay-box' === $post_content_orientation ? '.ta-bop-post-details' : '';
$post_details_content_class = 'overlay-box' === $post_content_orientation ? '.ta-bop-post-details-content' : '';
if ('overlay' !== $post_content_orientation) {
	$_post_inner_padding       = BOP_Functions::bop_metabox_value('post_inner_padding_property', $view_options);
	$post_inner_padding_unit   = $_post_inner_padding['unit'];
	$post_inner_padding_top    = $_post_inner_padding['top'] > 0 ? $_post_inner_padding['top'] . $post_inner_padding_unit : '0';
	$post_inner_padding_right  = $_post_inner_padding['right'] > 0 ? $_post_inner_padding['right'] . $post_inner_padding_unit : '0';
	$post_inner_padding_bottom = $_post_inner_padding['bottom'] > 0 ? $_post_inner_padding['bottom'] . $post_inner_padding_unit : '0';
	$post_inner_padding_left   = $_post_inner_padding['left'] > 0 ? $_post_inner_padding['left'] . $post_inner_padding_unit : '0';
	$custom_css               .= "#bop_wrapper-{$bop_id} .bookify__item {padding: {$post_inner_padding_top} {$post_inner_padding_right} {$post_inner_padding_bottom} {$post_inner_padding_left};}";
}

// Post border.
$_post_border      = $view_options['post_border'];
$post_border_width = (int) $_post_border['all'];
$post_border_style = $_post_border['style'];
$post_border_color = $_post_border['color'];
if ('none' !== $post_border_style) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item {border: {$post_border_width}px {$post_border_style} {$post_border_color};}";
}

// Post box shadow.
$show_post_box_shadow = BOP_Functions::bop_metabox_value('show_post_box_shadow', $view_options, false);
if ($show_post_box_shadow) {
	$post_box_shadow_property = BOP_Functions::bop_metabox_value(
		'post_box_shadow_property',
		$view_options,
		array(
			'horizontal' => '0',
			'vertical'   => '0',
			'blur'       => '8',
			'spread'     => '0',
			'color'      => 'rgb(187, 187, 187)',
		)
	);
	$box_shadow_h             = BOP_Functions::bop_metabox_value('horizontal', $post_box_shadow_property);
	$box_shadow_v             = BOP_Functions::bop_metabox_value('vertical', $post_box_shadow_property);
	$box_shadow_blur          = BOP_Functions::bop_metabox_value('blur', $post_box_shadow_property);
	$box_shadow_spread        = BOP_Functions::bop_metabox_value('spread', $post_box_shadow_property);
	$box_shadow_color         = BOP_Functions::bop_metabox_value('color', $post_box_shadow_property);
	$box_shadow_style         = 'outset' === $post_box_shadow_property['style'] ? '' : $post_box_shadow_property['style'];
	$box_shadow_margin_top    = 'inset' === $box_shadow_style ? '0' : ($box_shadow_spread - $box_shadow_v + 0.5 * $box_shadow_blur);
	$box_shadow_margin_right  = 'inset' === $box_shadow_style ? '0' : ($box_shadow_spread + $box_shadow_h + 0.5 * $box_shadow_blur);
	$box_shadow_margin_bottom = 'inset' === $box_shadow_style ? '0' : ($box_shadow_spread + $box_shadow_v + 0.5 * $box_shadow_blur);
	$box_shadow_margin_left   = 'inset' === $box_shadow_style ? '0' : ($box_shadow_spread - $box_shadow_h + 0.5 * $box_shadow_blur);
	$custom_css              .= "#bop_wrapper-{$bop_id} .bookify__item {$post_details_class} {$post_details_content_class}{box-shadow: {$box_shadow_h}px {$box_shadow_v}px {$box_shadow_blur}px {$box_shadow_spread}px {$box_shadow_color} {$box_shadow_style};margin: {$box_shadow_margin_top}px {$box_shadow_margin_right}px {$box_shadow_margin_bottom}px {$box_shadow_margin_left}px;}";
}

// Post background color.
$post_background_property = BOP_Functions::bop_metabox_value('post_background_property', $view_options);
$post_background_overlay = BOP_Functions::bop_metabox_value('post_background_overlay', $view_options);
$post_background_blur = BOP_Functions::bop_metabox_value('post_background_blur', $view_options);

$_post_border_radius         = BOP_Functions::bop_metabox_value(
	'post_border_radius_property',
	$view_options,
	array(
		'all' => '0',
	)
);
$post_border_radius_unit     = BOP_Functions::bop_metabox_value('unit', $_post_border_radius);
$post_border_radius_length   = BOP_Functions::bop_metabox_value('all', $_post_border_radius);
$post_border_radius_property = $post_border_radius_length > 0 ? $post_border_radius_length . $post_border_radius_unit : '0';
$custom_css              .= "#bop_wrapper-{$bop_id} .bookify__item {border-radius: {$post_border_radius_property};}";
if (!in_array($post_content_orientation, array('overlay', 'overlay-box'), true)) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item {background-color: {$post_background_property};}";
}

if (in_array($post_content_orientation, array('overlay'), true)) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item.ta-overlay::after {background-color: {$post_background_overlay}; opacity: 0.$post_background_blur;}";
}

/**
 * Post Thumbnail CSS.
 */
$post_thumb_css           = $post_sorter['bop_post_thumb'];
$post_thumb_margin        = isset($post_thumb_css['post_thumb_margin']) ? $post_thumb_css['post_thumb_margin'] : array(
	'top'    => '40',
	'right'  => '0',
	'bottom' => '11',
	'left'   => '0',
);
$post_thumb_border_radius = isset($post_thumb_css['post_thumb_border_radius']) ? $post_thumb_css['post_thumb_border_radius'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '0',
	'left'   => '0',
	'unit'   => 'px',
);
$post_thumb_border_radius_top = $post_thumb_border_radius['top'] . $post_thumb_border_radius['unit'];
$post_thumb_border_radius_left = $post_thumb_border_radius['left'] . $post_thumb_border_radius['unit'];
$post_thumb_border_radius_bottom = $post_thumb_border_radius['bottom'] . $post_thumb_border_radius['unit'];
$post_thumb_border_radius_right = $post_thumb_border_radius['right'] . $post_thumb_border_radius['unit'];
// Post thumb border radius.
$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item .bookify__item--thumbnail img{border-radius: {$post_thumb_border_radius_top} {$post_thumb_border_radius_right} {$post_thumb_border_radius_bottom} {$post_thumb_border_radius_left};} #bop_wrapper-{$bop_id} .bookify__item .bookify__item--thumbnail{margin: {$post_thumb_margin['top']}px {$post_thumb_margin['right']}px {$post_thumb_margin['bottom']}px {$post_thumb_margin['left']}px;}#bop_wrapper-{$bop_id} .ta-overlay.bookify__item .bookify__item--thumbnail,#bop_wrapper-{$bop_id} .left-thumb.bookify__item .bookify__item--thumbnail,#bop_wrapper-{$bop_id} .right-thumb.bookify__item .bookify__item--thumbnail,#bop_wrapper-{$bop_id} .ta-bop-content-box.bookify__item .bookify__item--thumbnail{margin: 0;}";

// Border for Post thumb.
$post_thumb_border = isset($post_thumb_css['bop_thumb_border']) ? $post_thumb_css['bop_thumb_border'] : array(
	'all'   => '0',
	'style' => 'solid',
	'color' => '#dddddd',
);
if (0 !== $post_thumb_border['all'] && 'none' !== $post_thumb_border['style']) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--thumbnail{border: {$post_thumb_border['all']}px {$post_thumb_border['style']} {$post_thumb_border['color']};}";
}

// Grayscale effect.
$post_thumb_gray_scale = isset($post_thumb_css['post_thumb_gray_scale']) ? $post_thumb_css['post_thumb_gray_scale'] : 'none';

if ('gray_and_normal' === $post_thumb_gray_scale) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--thumbnail img{-webkit-filter: grayscale(100%);filter: grayscale(100%);}#bop_wrapper-{$bop_id} .bookify__item:hover .bookify__item--thumbnail img{-webkit-filter: grayscale(0);filter: grayscale(0);}";
} elseif ('gray_on_hover' === $post_thumb_gray_scale) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--thumbnail img{-webkit-filter: grayscale(0);filter: grayscale(0);}#bop_wrapper-{$bop_id} .bookify__item:hover .bookify__item--thumbnail img{-webkit-filter: grayscale(100%);filter: grayscale(100%);}";
} elseif ('always_gray' === $post_thumb_gray_scale) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--thumbnail img,#bop_wrapper-{$bop_id} .bookify__item:hover .bookify__item--thumbnail img{-webkit-filter: grayscale(100%);filter: grayscale(100%);}";
}
// Zoom effect.
$post_thumb_zoom = isset($post_thumb_css['post_thumb_zoom']) ? $post_thumb_css['post_thumb_zoom'] : 'none';
if ('zoom_in' === $post_thumb_zoom) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--thumbnail:hover img{transform: scale(1.08);}";
} elseif ('zoom_out' === $post_thumb_zoom) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--thumbnail img{transform: scale(1.08);}
		#bop_wrapper-{$bop_id} .bookify__item--thumbnail:hover img{transform: scale(1.0);}";
}

// Custom Fields.
$_custom_fields_typography = isset($view_options['custom_fields_typography']) && array_key_exists('font-size', $view_options['custom_fields_typography']) ? $view_options['custom_fields_typography'] : array(
	'color'              => '#888',
	'font-family'        => '',
	'font-weight'        => '',
	'subset'             => '',
	'font-size'          => '14',
	'tablet-font-size'   => '14',
	'mobile-font-size'   => '12',
	'line-height'        => '18',
	'tablet-line-height' => '18',
	'mobile-line-height' => '16',
	'letter-spacing'     => '0',
	'text-align'         => 'left',
	'text-transform'     => 'none',
	'type'               => '',
	'unit'               => 'px',
);
$custom_fields_font_weight = !empty($_custom_fields_typography['font-weight']) ? $_custom_fields_typography['font-weight'] : '400';
$custom_fields_font_style  = !empty($_custom_fields_typography['font-style']) ? $_custom_fields_typography['font-style'] : 'normal';
$bop_custom_fields_margin  = isset($post_sorter['bop_custom_fields']['bop_custom_fields_margin']) ? $post_sorter['bop_custom_fields']['bop_custom_fields_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '15',
	'left'   => '0',
);
$custom_css               .= ".bop-wrapper-{$bop_id} .ta_bop_cf_list{";
if (!empty($_custom_fields_typography['font-family'])) {
	$custom_css .= "font-family: {$_custom_fields_typography['font-family']};font-weight: {$custom_fields_font_weight};font-style: {$custom_fields_font_style};";
}
if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
	$custom_css .= "text-align: {$_custom_fields_typography['text-align']};";
}
$custom_css .= "text-transform: {$_custom_fields_typography['text-transform']};font-size: {$_custom_fields_typography['font-size']}px;line-height: {$_custom_fields_typography['line-height']}px;letter-spacing: {$_custom_fields_typography['letter-spacing']}px;color: {$_custom_fields_typography['color']};margin: {$bop_custom_fields_margin['top']}px {$bop_custom_fields_margin['right']}px {$bop_custom_fields_margin['bottom']}px {$bop_custom_fields_margin['left']}px;}";


// Post Meta.
$_post_meta_typography    = isset($view_options['post_meta_typography']) && array_key_exists('font-size', $view_options['post_meta_typography']) ? $view_options['post_meta_typography'] : array(
	'color'              => '#888',
	'hover_color'        => '#876585',
	'font-family'        => '',
	'font-weight'        => '',
	'subset'             => '',
	'font-size'          => '14',
	'tablet-font-size'   => '14',
	'mobile-font-size'   => '12',
	'line-height'        => '16',
	'tablet-line-height' => '16',
	'mobile-line-height' => '16',
	'letter-spacing'     => '0',
	'text-align'         => 'left',
	'text-transform'     => 'none',
	'type'               => '',
	'unit'               => 'px',
);
$post_meta_font_weight    = !empty($_post_meta_typography['font-weight']) ? $_post_meta_typography['font-weight'] : '400';
$post_meta_font_style     = !empty($_post_meta_typography['font-style']) ? $_post_meta_typography['font-style'] : 'normal';
$bop_post_meta     = !empty($post_sorter['bop_post_meta']) ? $post_sorter['bop_post_meta'] : '';
$post_meta_margin         = isset($bop_post_meta['post_meta_margin']) ? $bop_post_meta['post_meta_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '9',
	'left'   => '0',
);
$post_meta_between_margin = isset($bop_post_meta['post_meta_between_margin']) ? $bop_post_meta['post_meta_between_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '0',
	'left'   => '0',
);
$custom_css              .= "#bop_wrapper-{$bop_id} .bookify__item .bop-category a,#bop_wrapper-{$bop_id}  .bookify__item .bookify__item--meta ul li{
	margin: {$post_meta_between_margin['top']}px {$post_meta_between_margin['right']}px {$post_meta_between_margin['bottom']}px {$post_meta_between_margin['left']}px;
}";
$meta_separator_color = isset($bop_post_meta['meta_separator_color']) ? $bop_post_meta['meta_separator_color'] : "";
$custom_css              .= "#bop_wrapper-{$bop_id} .bookify__item .meta_separator{
	color: {$meta_separator_color};
}";
$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--meta li,#bop_wrapper-{$bop_id} td.bookify__item--meta,#bop_wrapper-{$bop_id} .bookify__item--meta ul,#bop_wrapper-{$bop_id} .bookify__item--meta li a{";
if (!empty($_post_meta_typography['font-family'])) {
	$custom_css .= "font-family: {$_post_meta_typography['font-family']};font-weight: {$post_meta_font_weight};font-style: {$post_meta_font_style};";
}
$custom_css .= "text-transform: {$_post_meta_typography['text-transform']};font-size: {$_post_meta_typography['font-size']}px;line-height: {$_post_meta_typography['line-height']}px;letter-spacing: {$_post_meta_typography['letter-spacing']}px;color: {$_post_meta_typography['color']};}#bop_wrapper-{$bop_id} .bookify__item--meta{margin: {$post_meta_margin['top']}px {$post_meta_margin['right']}px {$post_meta_margin['bottom']}px {$post_meta_margin['left']}px;";
if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
	$custom_css .= "text-align: {$_post_meta_typography['text-align']};";
}
$custom_css .= '}';
$post_meta_alignment = isset($bop_post_meta['post_meta_alignment']) ? $bop_post_meta['post_meta_alignment'] : "";
$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--meta ul{justify-content:{$post_meta_alignment}}";


$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--meta li a:hover{color: {$_post_meta_typography['hover_color']};}";

// Post Pill Meta Color. ( button style meta ).
$post_meta_group = isset($post_sorter['bop_post_meta']['bop_post_meta_group']) ? $post_sorter['bop_post_meta']['bop_post_meta_group'] : '';
$title_above     = 1;
$over_thumb      = 1;
$show_post_meta  = isset($post_sorter['bop_post_meta']['show_post_meta']) ? $post_sorter['bop_post_meta']['show_post_meta'] : true;

if (is_array($post_meta_group) && $show_post_meta) {
	foreach ($post_meta_group as $key => $post_meta) {
		$selected_meta      = $post_meta['select_post_meta'];
		$meta_position      = isset($post_meta['bop_meta_position']) ? $post_meta['bop_meta_position'] : '';
		$meta_pill_color    = isset($post_meta['bop_meta_pill_color']) ? $post_meta['bop_meta_pill_color'] : array(
			'text' => '#fff',
			'bg'   => '#c27b7f',
		);
		$bop_taxonomy       = isset($post_meta['post_meta_taxonomy']) ? $post_meta['post_meta_taxonomy'] : '';
		$bop_taxonomy_class = !empty($bop_taxonomy) ? ".{$bop_taxonomy}" : '';
		$text_color         = $meta_pill_color['text'];
		$bg                 = $meta_pill_color['bg'];
		if ('taxonomy' === $selected_meta) {
			if ('over_thumb' === $meta_position) {
				$meta_over_thumb_position = isset($post_meta['bop_meta_over_thump_position']) ? $post_meta['bop_meta_over_thump_position'] : 'top_left';
				$custom_css              .= "#bop_wrapper-{$bop_id} .bookify__item-thumb-area {$bop_taxonomy_class}.bop-category.{$meta_over_thumb_position} a {color: {$text_color}; background: {$bg};";
				if (!empty($_post_meta_typography['font-family'])) {
					$custom_css .= "font-family: {$_post_meta_typography['font-family']};font-weight: {$post_meta_font_weight};font-style: {$post_meta_font_style};";
				}
				$custom_css .= "text-transform: {$_post_meta_typography['text-transform']};font-size: {$_post_meta_typography['font-size']}px;line-height: {$_post_meta_typography['line-height']}px;letter-spacing: {$_post_meta_typography['letter-spacing']}px;
			}";
				++$over_thumb;
			}
			if ('above_title' === $meta_position) {
				$custom_css .= "#bop_wrapper-{$bop_id} {$bop_taxonomy_class}.bop-category.above_title{
					text-align: {$_post_meta_typography['text-align']};
				}#bop_wrapper-{$bop_id} {$bop_taxonomy_class}.bop-category.above_title a{ color: {$text_color}; background: {$bg};";
				if (!empty($_post_meta_typography['font-family'])) {
					$custom_css .= "font-family: {$_post_meta_typography['font-family']};font-weight: {$post_meta_font_weight};font-style: {$post_meta_font_style};";
				}
				$custom_css .= "text-transform: {$_post_meta_typography['text-transform']};font-size: {$_post_meta_typography['font-size']}px;line-height: {$_post_meta_typography['line-height']}px;letter-spacing: {$_post_meta_typography['letter-spacing']}px;
			}";
				++$title_above;
			}
		}
	}
}
if (!empty($_post_meta_typography['font-family'])) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item-thumb-area .bop-category a{font-family: {$_post_meta_typography['font-family']};}";
}

// Book Meta.
$_book_fildes_typography    = isset($view_options['book_fildes_typography']) && array_key_exists('font-size', $view_options['book_fildes_typography']) ? $view_options['book_fildes_typography'] : array(
	'color'              => '#888',
	'hover_color'        => '#876585',
	'font-family'        => '',
	'font-weight'        => '',
	'subset'             => '',
	'font-size'          => '14',
	'tablet-font-size'   => '14',
	'mobile-font-size'   => '12',
	'line-height'        => '16',
	'tablet-line-height' => '16',
	'mobile-line-height' => '16',
	'letter-spacing'     => '0',
	'text-align'         => 'left',
	'text-transform'     => 'none',
	'type'               => '',
	'unit'               => 'px',
);
$book_fildes_font_weight    = !empty($_book_fildes_typography['font-weight']) ? $_book_fildes_typography['font-weight'] : '400';
$book_fildes_font_style     = !empty($_book_fildes_typography['font-style']) ? $_book_fildes_typography['font-style'] : 'normal';
$book_fildes_margin         = isset($bop_book_fildes['book_fildes_margin']) ? $bop_book_fildes['book_fildes_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '15',
	'left'   => '0',
);
$book_fildes_between_padding = isset($bop_book_fildes['book_fildes_between_padding']) ? $bop_book_fildes['book_fildes_between_padding'] : array(
	'top'    => '0',
	'right'  => '',
	'bottom' => '',
	'left'   => '0',
);

$book_fildes_alignment = isset($bop_book_fildes['book_fildes_alignment']) ? $bop_book_fildes['book_fildes_alignment'] : "left";
$custom_css              .= "#bop_wrapper-{$bop_id}  .bookify__item .bookify__book_fildes .book_filde{
	padding: {$book_fildes_between_padding['top']}px {$book_fildes_between_padding['right']}px {$book_fildes_between_padding['bottom']}px {$book_fildes_between_padding['left']}px;justify-content: {$book_fildes_alignment};
}";

$custom_css .= "#bop_wrapper-{$bop_id} .bookify__book_fildes .book_filde,#bop_wrapper-{$bop_id} td.bookify__book_fildes,#bop_wrapper-{$bop_id} .bookify__book_fildes book_fildes,#bop_wrapper-{$bop_id} .bookify__book_fildes .book_filde a{";
if (!empty($_book_fildes_typography['font-family'])) {
	$custom_css .= "font-family: {$_book_fildes_typography['font-family']};font-weight: {$book_fildes_font_weight};font-style: {$book_fildes_font_style};";
}

$custom_css .= "text-transform: {$_book_fildes_typography['text-transform']};font-size: {$_book_fildes_typography['font-size']}px;line-height: {$_book_fildes_typography['line-height']}px;letter-spacing: {$_book_fildes_typography['letter-spacing']}px;color: {$_book_fildes_typography['color']};}#bop_wrapper-{$bop_id} .bookify__book_fildes{margin: {$book_fildes_margin['top']}px {$book_fildes_margin['right']}px {$book_fildes_margin['bottom']}px {$book_fildes_margin['left']}px;";
if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
	$custom_css .= "text-align: {$_book_fildes_typography['text-align']};";
}
$custom_css .= '}';

$custom_css .= "#bop_wrapper-{$bop_id} .bookify__book_fildes .book_filde a:hover{color: {$_book_fildes_typography['hover_color']};}";

// Book Category
$_book_category    = isset($view_options['book_category']) && array_key_exists('font-size', $view_options['book_category']) ? $view_options['book_category'] : array(
	'color'              => '#ffffff',
	'hover_color'        => '#ffffff',
	'font-family'        => '',
	'font-weight'        => '',
	'subset'             => '',
	'font-size'          => '14',
	'tablet-font-size'   => '14',
	'mobile-font-size'   => '12',
	'line-height'        => '16',
	'tablet-line-height' => '16',
	'mobile-line-height' => '16',
	'letter-spacing'     => '0',
	'text-align'         => 'left',
	'text-transform'     => 'none',
	'type'               => '',
	'unit'               => 'px',
);
$book_fildes_font_weight    = !empty($_book_category['font-weight']) ? $_book_category['font-weight'] : '400';
$book_fildes_font_style     = !empty($_book_category['font-style']) ? $_book_category['font-style'] : 'normal';
$book_fildes_margin         = isset($bop_book_fildes['book_fildes_margin']) ? $bop_book_fildes['book_fildes_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '15',
	'left'   => '0',
);

$book_category_settings = isset($post_sorter['bop_book_category']) ? $post_sorter['bop_book_category'] : '';
$bop_category_margin      = isset($book_category_settings['bop_category_margin']) ? $book_category_settings['bop_category_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '15',
	'left'   => '0',
);
$bop_book_category_padding      = isset($post_content_settings['bop_book_category_padding']) ? $post_content_settings['bop_book_category_padding'] : array(
	'top'    => '3',
	'right'  => '10',
	'bottom' => '3',
	'left'   => '10',
);
$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item__category li,#bop_wrapper-{$bop_id} td.bookify__item__category,#bop_wrapper-{$bop_id} .bookify__item__category ul,#bop_wrapper-{$bop_id} .bookify__item__category li a{";
if (!empty($_book_category['font-family'])) {
	$custom_css .= "font-family: {$_book_category['font-family']};font-weight: {$book_fildes_font_weight};font-style: {$book_fildes_font_style};";
}
$post_meta_alignment = isset($bop_post_meta['post_meta_alignment']) ? $bop_post_meta['post_meta_alignment'] : "";
$custom_css .= "text-transform: {$_book_category['text-transform']};font-size: {$_book_category['font-size']}px;line-height: {$_book_category['line-height']}px;letter-spacing: {$_book_category['letter-spacing']}px;color: {$_book_category['color']};}#bop_wrapper-{$bop_id} .bookify__item__category{margin: {$bop_category_margin['top']}px {$bop_category_margin['right']}px {$bop_category_margin['bottom']}px {$bop_category_margin['left']}px; justify-content:{$post_meta_alignment};";
if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
	$custom_css .= "text-align: {$_book_category['text-align']};";
}
$custom_css .= '}';

$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item__category li a:hover{color: {$_book_category['hover_color']};}";

$_book_category_color  = isset($post_content_settings['bop_book_category_bg']) ? $post_content_settings['bop_book_category_bg'] : array(
	'standard'     => '#ffffff',
	'hover'        => '#ffffff',
	'bg'           => '#c27b7f',
	'hover_bg'     => '#876585',
	'border'       => '#876585',
	'hover_border' => '#876585',
);
$_book_category_border_radius = isset($book_category_settings['bop_category_button_radius']) ? $book_category_settings['bop_category_button_radius'] : array(
	'all'  => '0',
	'unit' => 'px',
);
$custom_css    .= "#bop_wrapper-{$bop_id} .bookify__item__category li a{ background: {$_book_category_color['bg']}; color: {$_book_category_color['standard']}; border-color: {$_book_category_color['border']}; border-radius: {$_book_category_border_radius['all']}{$_book_category_border_radius['unit']}; padding: {$bop_book_category_padding['top']}px {$bop_book_category_padding['right']}px {$bop_book_category_padding['bottom']}px {$bop_book_category_padding['left']}px; } #bop_wrapper-{$bop_id} .bookify__item__category li a:hover { background: {$_book_category_color['hover_bg']}; color: {$_book_category_color['hover']}; border-color: {$_book_category_color['hover_border']};  }";

// Book Price
$book_price_settings = isset($post_sorter['bop_book_price']) ? $post_sorter['bop_book_price'] : '';
$book_price_margin = isset($book_price_settings['book_fildes_margin']) ? $book_price_settings['book_fildes_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '15',
	'left'   => '0',
);
$show_book_price_alignment = isset($book_price_settings['show_book_price_alignment']) ? $book_price_settings['show_book_price_alignment'] : 'left';
$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item__price{margin: {$book_price_margin['top']}px {$book_price_margin['right']}px {$book_price_margin['bottom']}px {$book_price_margin['left']}px;text-align:{$show_book_price_alignment};justify-content:{$show_book_price_alignment};}";

// Post Pill Meta Color. ( button style meta ).
$book_fildes_group = isset($bop_book_fildes['bop_book_fildes_group']) ? $bop_book_fildes['bop_book_fildes_group'] : '';
$title_above     = 1;
$over_thumb      = 1;
$show_book_fildes  = isset($bop_book_fildes['show_book_fildes']) ? $bop_book_fildes['show_book_fildes'] : true;

if (is_array($book_fildes_group) && $show_book_fildes) {
	foreach ($book_fildes_group as $key => $book_fildes) {
		$selected_meta      = $book_fildes['select_book_fildes'];
		$meta_position      = isset($book_fildes['bop_meta_position']) ? $book_fildes['bop_meta_position'] : '';
		$meta_pill_color    = isset($book_fildes['bop_meta_pill_color']) ? $book_fildes['bop_meta_pill_color'] : array(
			'text' => '#fff',
			'bg'   => '#c27b7f',
		);
		$bop_taxonomy       = isset($book_fildes['book_fildes_taxonomy']) ? $book_fildes['book_fildes_taxonomy'] : '';
		$bop_taxonomy_class = !empty($bop_taxonomy) ? ".{$bop_taxonomy}" : '';
		$text_color         = $meta_pill_color['text'];
		$bg                 = $meta_pill_color['bg'];
		if ('taxonomy' === $selected_meta) {
			if ('over_thumb' === $meta_position) {
				$meta_over_thumb_position = isset($book_fildes['bop_meta_over_thump_position']) ? $book_fildes['bop_meta_over_thump_position'] : 'top_left';
				$custom_css              .= "#bop_wrapper-{$bop_id} .bookify__item-thumb-area {$bop_taxonomy_class}.bop-category.{$meta_over_thumb_position} a {color: {$text_color}; background: {$bg};";
				if (!empty($_book_fildes_typography['font-family'])) {
					$custom_css .= "font-family: {$_book_fildes_typography['font-family']};font-weight: {$book_fildes_font_weight};font-style: {$book_fildes_font_style};";
				}
				$custom_css .= "text-transform: {$_book_fildes_typography['text-transform']};font-size: {$_book_fildes_typography['font-size']}px;line-height: {$_book_fildes_typography['line-height']}px;letter-spacing: {$_book_fildes_typography['letter-spacing']}px;
			}";
				++$over_thumb;
			}
			if ('above_title' === $meta_position) {
				$custom_css .= "#bop_wrapper-{$bop_id} {$bop_taxonomy_class}.bop-category.above_title{
					text-align: {$_book_fildes_typography['text-align']};
				}#bop_wrapper-{$bop_id} {$bop_taxonomy_class}.bop-category.above_title a{ color: {$text_color}; background: {$bg};";
				if (!empty($_book_fildes_typography['font-family'])) {
					$custom_css .= "font-family: {$_book_fildes_typography['font-family']};font-weight: {$book_fildes_font_weight};font-style: {$book_fildes_font_style};";
				}
				$custom_css .= "text-transform: {$_book_fildes_typography['text-transform']};font-size: {$_book_fildes_typography['font-size']}px;line-height: {$_book_fildes_typography['line-height']}px;letter-spacing: {$_book_fildes_typography['letter-spacing']}px;
			}";
				++$title_above;
			}
		}
	}
}
if (!empty($_book_fildes_typography['font-family'])) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item-thumb-area .bop-category a{font-family: {$_book_fildes_typography['font-family']};}";
}

// Post ReadMore Settings.
$post_content_settings = isset($post_sorter['bop_post_content_readmore']) ? $post_sorter['bop_post_content_readmore'] : '';

$readmore_margin      = isset($post_content_settings['readmore_margin']) ? $post_content_settings['readmore_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '15',
	'left'   => '0',
);
$readmore_padding      = isset($post_content_settings['readmore_padding']) ? $post_content_settings['readmore_padding'] : array(
	'top'    => '6',
	'right'  => '20',
	'bottom' => '6',
	'left'   => '20',
);
$show_read_more        = isset($post_content_settings['show_read_more']) ? $post_content_settings['show_read_more'] : true;
if ($show_read_more) {
	$_read_more_typography = isset($view_options['read_more_typography']) && array_key_exists('font-size', $view_options['read_more_typography']) ? $view_options['read_more_typography'] : array(
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

	$read_more_font_weight = !empty($_read_more_typography['font-weight']) ? $_read_more_typography['font-weight'] : '400';
	$read_more_font_style  = !empty($_read_more_typography['font-style']) ? $_read_more_typography['font-style'] : 'normal';
	$read_more_type        = isset($post_content_settings['read_more_type']) ? $post_content_settings['read_more_type'] : 'button';
	$custom_css           .= "#bop_wrapper-{$bop_id} .bookify__item__btn{";
	if (!empty($_read_more_typography['font-family'])) {
		$custom_css .= "font-family: {$_read_more_typography['font-family']}; font-weight: {$read_more_font_weight}; font-style: {$read_more_font_style};";
	}
	$custom_css .= "text-transform: {$_read_more_typography['text-transform']}; font-size: {$_read_more_typography['font-size']}px; line-height: {$_read_more_typography['line-height']}px; letter-spacing: {$_read_more_typography['letter-spacing']}px; }";
	if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
		$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item__content__readmore{ text-align: {$_read_more_typography['text-align']}; }";
	}
	if ('button' === $read_more_type) {
		$_button_color  = isset($post_content_settings['readmore_color_button']) ? $post_content_settings['readmore_color_button'] : array(
			'standard'     => '#111',
			'hover'        => '#fff',
			'bg'           => 'transparent',
			'hover_bg'     => '#876585',
			'border'       => '#888',
			'hover_border' => '#876585',
		);
		$_border_radius = isset($post_content_settings['readmore_button_radius']) ? $post_content_settings['readmore_button_radius'] : array(
			'all'  => '0',
			'unit' => 'px',
		);
		$custom_css    .= "#bop_wrapper-{$bop_id} .bookify__item__btn{ background: {$_button_color['bg']}; color: {$_button_color['standard']}; border-color: {$_button_color['border']}; border-radius: {$_border_radius['all']}{$_border_radius['unit']}; margin: {$readmore_margin['top']}px {$readmore_margin['right']}px {$readmore_margin['bottom']}px {$readmore_margin['left']}px; padding: {$readmore_padding['top']}px {$readmore_padding['right']}px {$readmore_padding['bottom']}px {$readmore_padding['left']}px; } #bop_wrapper-{$bop_id} .bookify__item__btn:hover { background: {$_button_color['hover_bg']}; color: {$_button_color['hover']}; border-color: {$_button_color['hover_border']};  }";
	} else {
		$readmore_text_color = $post_content_settings['readmore_color_text'];
		$custom_css         .= "#bop_wrapper-{$bop_id} .bookify__item__btn{ color: {$readmore_text_color['standard']}; } #bop_wrapper-{$bop_id} .bookify__item__btn:hover{ color: {$readmore_text_color['hover']};margin: {$readmore_margin['top']}px {$readmore_margin['right']}px {$readmore_margin['bottom']}px {$readmore_margin['left']}px;color: {$_post_content_typography['color']};padding: {$readmore_padding['top']}px {$readmore_padding['right']}px {$readmore_padding['bottom']}px {$readmore_padding['left']}px; } ";
	}
}
// Post Buy Now Settings.
$post_content_settings = isset($post_sorter['bop_post_buy_now_button']) ? $post_sorter['bop_post_buy_now_button'] : '';

$buy_now_margin      = isset($post_content_settings['buy_now_margin']) ? $post_content_settings['buy_now_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '15',
	'left'   => '0',
);
$buy_now_padding      = isset($post_content_settings['buy_now_padding']) ? $post_content_settings['buy_now_padding'] : array(
	'top'    => '6',
	'right'  => '20',
	'bottom' => '6',
	'left'   => '20',
);

$show_buy_now        = isset($post_content_settings['show_bye_now_button']) ? $post_content_settings['show_bye_now_button'] : true;

if ($show_buy_now) {
	$_buy_now_typography = isset($view_options['buy_now_typography']) && array_key_exists('font-size', $view_options['buy_now_typography']) ? $view_options['buy_now_typography'] : array(
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

	$buy_now_font_weight = !empty($_buy_now_typography['font-weight']) ? $_buy_now_typography['font-weight'] : '400';
	$buy_now_font_style  = !empty($_buy_now_typography['font-style']) ? $_buy_now_typography['font-style'] : 'normal';
	$buy_now_type        = isset($post_content_settings['buy_now_type']) ? $post_content_settings['buy_now_type'] : 'button';
	$custom_css           .= "#bop_wrapper-{$bop_id} .bookify__item__content__buy_now .bookify__item__btn{";
	if (!empty($_buy_now_typography['font-family'])) {
		$custom_css .= "font-family: {$_buy_now_typography['font-family']}; font-weight: {$buy_now_font_weight}; font-style: {$buy_now_font_style};";
	}
	$custom_css .= "text-transform: {$_buy_now_typography['text-transform']}; font-size: {$_buy_now_typography['font-size']}px; line-height: {$_buy_now_typography['line-height']}px; letter-spacing: {$_buy_now_typography['letter-spacing']}px; }";
	if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
		$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item__content__buy_now{ text-align: {$_buy_now_typography['text-align']}; }";
	}
	$_button_color  = isset($post_content_settings['buy_now_color_button']) ? $post_content_settings['buy_now_color_button'] : array(
		'standard'     => '#111',
		'hover'        => '#fff',
		'bg'           => 'transparent',
		'hover_bg'     => '#876585',
		'border'       => '#888',
		'hover_border' => '#876585',
	);
	$_border_radius = isset($post_content_settings['buy_now_button_radius']) ? $post_content_settings['buy_now_button_radius'] : array(
		'all'  => '0',
		'unit' => 'px',
	);
	$custom_css    .= "#bop_wrapper-{$bop_id} .bookify__item__content__buy_now .bookify__item__btn{ background: {$_button_color['bg']}; color: {$_button_color['standard']}; border-color: {$_button_color['border']}; border-radius: {$_border_radius['all']}{$_border_radius['unit']}; margin: {$buy_now_margin['top']}px {$buy_now_margin['right']}px {$buy_now_margin['bottom']}px {$buy_now_margin['left']}px; padding: {$buy_now_padding['top']}px {$buy_now_padding['right']}px {$buy_now_padding['bottom']}px {$buy_now_padding['left']}px; } #bop_wrapper-{$bop_id} .bookify__item__content__buy_now .bookify__item__btn:hover { background: {$_button_color['hover_bg']}; color: {$_button_color['hover']}; border-color: {$_button_color['hover_border']};  }";
}
// Post Thumb Archive Settings.
$bop_post_thumb = isset($post_sorter['bop_post_thumb']) ? $post_sorter['bop_post_thumb'] : '';
$post_thumb_show = isset($bop_post_thumb['post_thumb_show']) ? $bop_post_thumb['post_thumb_show'] : '';
$post_thumb_meta = isset($bop_post_thumb['post_thumb_meta']) ? $bop_post_thumb['post_thumb_meta'] : '';

if ($post_thumb_show && $post_thumb_meta != 'none') {
	$_thumb_archive_typography = isset($view_options['thumb_archive_typography']) && array_key_exists('font-size', $view_options['thumb_archive_typography']) ? $view_options['thumb_archive_typography'] : array(
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

	$post_thumb_font_weight = !empty($_thumb_archive_typography['font-weight']) ? $_thumb_archive_typography['font-weight'] : '400';
	$post_thumb_font_style  = !empty($_thumb_archive_typography['font-style']) ? $_thumb_archive_typography['font-style'] : 'normal';
	$post_thumb_type        = isset($post_content_settings['post_thumb_type']) ? $post_content_settings['post_thumb_type'] : 'button';
	$custom_css           .= "#bop_wrapper-{$bop_id} .bookify__item--archive li{";
	if (!empty($_thumb_archive_typography['font-family'])) {
		$custom_css .= "font-family: {$_thumb_archive_typography['font-family']}; font-weight: {$post_thumb_font_weight}; font-style: {$post_thumb_font_style};";
	}
	$custom_css .= "text-transform: {$_thumb_archive_typography['text-transform']}; font-size: {$_thumb_archive_typography['font-size']}px; line-height: {$_thumb_archive_typography['line-height']}px; letter-spacing: {$_thumb_archive_typography['letter-spacing']}px; }";
	if ('button' === $post_thumb_type) {
		$_post_thumb_button  = isset($bop_post_thumb['post_thumb_meta_button']) ? $bop_post_thumb['post_thumb_meta_button'] : array(
			'standard'     => '#111',
			'hover'        => '#fff',
			'bg'           => 'transparent',
			'hover_bg'     => '#876585',
			'border'       => '#888',
			'hover_border' => '#876585',
		);
		$_border_radius = isset($post_content_settings['readmore_button_radius']) ? $post_content_settings['readmore_button_radius'] : array(
			'all'  => '0',
			'unit' => 'px',
		);
		$custom_css    .= "#bop_wrapper-{$bop_id} .bookify__item--archive li{ background: {$_post_thumb_button['bg']}; color: {$_post_thumb_button['standard']}; border-color: {$_post_thumb_button['border']}; border-radius: {$_border_radius['all']}{$_border_radius['unit']}; } #bop_wrapper-{$bop_id} .bookify__item--archive li:hover { background: {$_post_thumb_button['hover_bg']}; color: {$_post_thumb_button['hover']}; border-color: {$_post_thumb_button['hover_border']}; }";
	} else {
		$readmore_text_color = $post_content_settings['readmore_color_text'];
		$custom_css         .= "#bop_wrapper-{$bop_id} .bookify__item--archive li{ color: {$readmore_text_color['standard']}; } #bop_wrapper-{$bop_id} .bookify__item--archive li:hover{ color: {$readmore_text_color['hover']}; } ";
	}
}

// Pagination CSS and Live filter CSS.
$show_pagination = isset($view_options['show_post_pagination']) ? $view_options['show_post_pagination'] : false;
if ($show_pagination) {
	$pagination_btn_color   = isset($view_options['bop_pagination_btn_color']) ? $view_options['bop_pagination_btn_color'] : array(
		'text_color'        => '#5e5e5e',
		'text_acolor'       => '#ffffff',
		'border_color'      => '#bbbbbb',
		'border_acolor'     => '#876585',
		'background'        => '#ffffff',
		'active_background' => '#876585',
	);
	$bop_loadmore_btn_color = isset($view_options['bop_loadmore_btn_color']) ? $view_options['bop_loadmore_btn_color'] : array(
		'text_color'        => '#ffffff',
		'text_hcolor'       => '#5e5e5e',
		'background'        => '#876585',
		'active_background' => '#ffffff',
	);
	$pagination_alignment   = isset($view_options['pagination_alignment']) ? $view_options['pagination_alignment'] : 'left';
	$custom_css            .= "#bop_wrapper-{$bop_id} .bop-post-pagination .page-numbers.current, #bop_wrapper-{$bop_id} .bop-post-pagination a.active , #bop_wrapper-{$bop_id} .bop-post-pagination a:hover{ color: {$pagination_btn_color['text_acolor']}; background: {$pagination_btn_color['active_background']}; border-color: {$pagination_btn_color['border_acolor']}; }#bop_wrapper-{$bop_id} .bop-post-pagination,#bop_wrapper-{$bop_id} .bop-load-more,#bop_wrapper-{$bop_id} .bop-infinite-scroll-loader{ text-align: {$pagination_alignment};justify-content: {$pagination_alignment}; }#bop_wrapper-{$bop_id} .bop-post-pagination .page-numbers, .bop-post-pagination a{ background: {$pagination_btn_color['background']}; color:{$pagination_btn_color['text_color']}; border-color: {$pagination_btn_color['border_color']}; }#bop_wrapper-{$bop_id} .bop-load-more button{ background: {$bop_loadmore_btn_color['background']}; color: {$bop_loadmore_btn_color['text_color']}; border:1px solid transparent; }#bop_wrapper-{$bop_id} .bop-load-more button:hover{ background: {$bop_loadmore_btn_color['active_background']}; color: {$bop_loadmore_btn_color['text_hcolor']}; border:1px solid; cursor: pointer; }";

	$_pagination_border_radius = isset($view_options['bop_pagination_btn_border_radius']) ? $view_options['bop_pagination_btn_border_radius'] : array(
		'all'  => '0',
		'unit' => 'px',
	);
	$_pagination_margin_between = isset($view_options['bop_pagination_btn_margin_between']) ? $view_options['bop_pagination_btn_margin_between'] : array(
		'all'  => '0',
		'unit' => 'px',
	);
	$custom_css .= "#bop_wrapper-{$bop_id} .bop-post-pagination .page-numbers, #bop_wrapper-{$bop_id} .bop-post-pagination a{border-radius:{$_pagination_border_radius['all']}{$_pagination_border_radius['unit']};}";
	$custom_css .= "#bop_wrapper-{$bop_id} .bop-post-pagination .page-numbers, #bop_wrapper-{$bop_id} .bop-post-pagination{gap:{$_pagination_margin_between['all']}px};";
}

// $index          = 0;
$filter_by      = isset($view_options['bop_advanced_filter']) ? $view_options['bop_advanced_filter'] : array();
$taxonomy_types = isset($view_options['bop_filter_by_taxonomy']['bop_taxonomy_and_terms']) && !empty($view_options['bop_filter_by_taxonomy']['bop_taxonomy_and_terms']) ? $view_options['bop_filter_by_taxonomy']['bop_taxonomy_and_terms'] : '';
if (is_array($taxonomy_types) && !empty($taxonomy_types) && is_array($filter_by) && in_array('taxonomy', $filter_by)) {
	foreach ($taxonomy_types as $tax_type) {
		$filter_options            = isset($tax_type['ajax_filter_options']) ? $tax_type['ajax_filter_options'] : '';
		$add_filter                = isset($tax_type['add_filter_post']) ? $tax_type['add_filter_post'] : '';
		$bop_select_taxonomy       = isset($tax_type['bop_select_taxonomy']) ? $tax_type['bop_select_taxonomy'] : '';
		$bop_filter_btn_color      = isset($filter_options['bop_filter_btn_color']) ? $filter_options['bop_filter_btn_color'] : array(
			'text_color'        => '#5e5e5e',
			'text_acolor'       => '#ffffff',
			'border_color'      => '#bbbbbb',
			'border_acolor'     => '#876585',
			'background'        => '#ffffff',
			'active_background' => '#876585',
		);
		$bop_margin_between_button = isset($filter_options['bop_margin_between_button']) ? $filter_options['bop_margin_between_button'] : array(
			'top'    => '0',
			'right'  => '8',
			'bottom' => '8',
			'left'   => '0',
			'unit'   => 'px',
		);
		$ajax_filter_style         = isset($filter_options['ajax_filter_style']) ? $filter_options['ajax_filter_style'] : '';

		if ('fl_btn' === $ajax_filter_style && $add_filter) {
			if (!empty($bop_filter_btn_color)) {
				$custom_css .= "
			#bop_wrapper-{$bop_id} .bop-filter-bar .bop-filter-by.bop-bar.fl_button.filter-{$bop_select_taxonomy} label{
				margin: {$bop_margin_between_button['top']}px {$bop_margin_between_button['right']}px  {$bop_margin_between_button['bottom']}px {$bop_margin_between_button['left']}px;
			}
			#bop_wrapper-{$bop_id} .bop-filter-bar .bop-filter-by.bop-bar.fl_button.filter-{$bop_select_taxonomy} input~div{
				background: {$bop_filter_btn_color['background']};
				color: {$bop_filter_btn_color['text_color']};
				border-color: {$bop_filter_btn_color['border_color']};
			}
			#bop_wrapper-{$bop_id} .bop-filter-bar .bop-filter-by.bop-bar.fl_button.filter-{$bop_select_taxonomy} input:checked~div,
			.bop-order-by.bop-bar.fl-btn input:checked~div{
				color: {$bop_filter_btn_color['text_acolor']};
				background: {$bop_filter_btn_color['active_background']};
				border-color: {$bop_filter_btn_color['border_acolor']};
			}
			#bop_wrapper-{$bop_id} .bop-filter-bar .bop-filter-by.bop-bar.fl_button.filter-{$bop_select_taxonomy} input:hover~div,
			.bop-order-by.bop-bar.fl-btn input:hover~div{
				color: {$bop_filter_btn_color['text_acolor']};
				background: {$bop_filter_btn_color['active_background']};
				border-color: {$bop_filter_btn_color['border_acolor']};
			}";
			}
		}
	}
}

// Social Share.
$post_social_settings = $post_sorter['bop_social_share'];
$social_margin        = isset($post_social_settings['social_margin']) ? $post_social_settings['social_margin'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '0',
	'left'   => '0',
);
$icon_custom_color    = isset($post_social_settings['social_icon_custom_color']) ? $post_social_settings['social_icon_custom_color'] : false;
$social_icon_color    = isset($post_social_settings['social_icon_color']) ? $post_social_settings['social_icon_color'] : array(
	'icon_color'        => '#ffffff',
	'icon_hover_color'  => '#ffffff',
	'icon_bg'           => '#876585',
	'icon_bg_hover'     => '#c27b7f',
	'icon_border_hover' => '#c27b7f',
);
$social_position      = isset($post_social_settings['social_position']) ? $post_social_settings['social_position'] : 'left';
if ('zigzag_layout' !== $layouts['bop_layout_preset']) {
	$custom_css .= "#bop_wrapper-{$bop_id}  .bookify .bookify__item__socail-share{text-align: {$social_position};}";
}
$custom_css .= "#bop_wrapper-{$bop_id} .bookify .bookify__item__socail-share{margin: {$social_margin['top']}px {$social_margin['right']}px {$social_margin['bottom']}px {$social_margin['left']}px;}#bop_wrapper-{$bop_id} .bookify .bookify__item__socail-share a.icon_only i{background: transparent;border: none;}"; // start from here.

if ($icon_custom_color) {
	$social_icon_color        = $post_social_settings['social_icon_color'];
	$social_icon_border       = $post_social_settings['social_icon_border'];
	$social_icon_border_width = (int) $social_icon_border['all'];
	$social_line_height       = 30 - ($social_icon_border_width * 2);
	$custom_css              .= "#bop_wrapper-{$bop_id} .bookify .bookify__item__socail-share a i{ color: {$social_icon_color['icon_color']}; line-height: {$social_line_height}px; background: {$social_icon_color['icon_bg']}; border: {$social_icon_border_width}px {$social_icon_border['style']} {$social_icon_border['color']}; } #bop_wrapper-{$bop_id} .bookify .bookify__item__socail-share a:hover i{ color: {$social_icon_color['icon_hover_color']}; background: {$social_icon_color['icon_bg_hover']}; border-color: {$social_icon_color['icon_border_hover']}; }";
}

// Color for Sort by ajax live filter's orderby button.
$add_orderby_filter_post = isset($view_options['bop_filter_by_order']['add_orderby_filter_post']) ? $view_options['bop_filter_by_order']['add_orderby_filter_post'] : false;
$orderby_options         = isset($view_options['bop_filter_by_order']['orderby_ajax_filter_options']) && !empty($view_options['bop_filter_by_order']['orderby_ajax_filter_options']) ? $view_options['bop_filter_by_order']['orderby_ajax_filter_options'] : '';

$orderby_btn_color = isset($orderby_options['bop_orderby_filter_btn_color']) ? $orderby_options['bop_orderby_filter_btn_color'] : array(
	'text_color'        => '#5e5e5e',
	'text_acolor'       => '#ffffff',
	'border_color'      => '#bbbbbb',
	'border_acolor'     => '#876585',
	'background'        => '#ffffff',
	'active_background' => '#876585',
);

if (!empty($orderby_btn_color) && $add_orderby_filter_post && is_array($filter_by) && in_array('sortby', $filter_by)) {
	$order_margin_between_button = isset($orderby_options['order_margin_between_button']) ? $orderby_options['order_margin_between_button'] : array(
		'top'    => '0',
		'right'  => '8',
		'bottom' => '8',
		'left'   => '0',
		'unit'   => 'px',
	);
	$custom_css                 .= "#bop_wrapper-{$bop_id} .bop_ex_filter_bar .bop-order-by.bop-bar.fl-btn input~div  { background: {$orderby_btn_color['background']};color:{$orderby_btn_color['text_color']}; border-color: {$orderby_btn_color['border_color']}; }#bop_wrapper-{$bop_id} .bop_ex_filter_bar .bop-order-by.bop-bar.fl-btn input:checked~div{ color: {$orderby_btn_color['text_acolor']}; background: {$orderby_btn_color['active_background']}; border-color: {$orderby_btn_color['border_acolor']}; }#bop_wrapper-{$bop_id} .bop_ex_filter_bar .bop-order-by.bop-bar.fl-btn input:hover~div{ color: {$orderby_btn_color['text_acolor']}; background: {$orderby_btn_color['active_background']}; border-color: {$orderby_btn_color['border_acolor']}; }#bop_wrapper-{$bop_id} .bop_ex_filter_bar .bop-order-by.bop-bar.fl-btn .fl_radio{	margin: {$order_margin_between_button['top']}px {$order_margin_between_button['right']}px {$order_margin_between_button['bottom']}px {$order_margin_between_button['left']}px; }";
}

$add_author_filter_post = isset($view_options['bop_filter_by_author']['add_author_filter_post']) && !empty($view_options['bop_filter_by_author']['add_author_filter_post']) ? $view_options['bop_filter_by_author']['add_author_filter_post'] : '';
$ajax_filter_style      = isset($view_options['bop_filter_by_author']['ajax_filter_options']['ajax_filter_style']) ? $view_options['bop_filter_by_author']['ajax_filter_options']['ajax_filter_style'] : false;
if ($ajax_filter_style && $add_author_filter_post && is_array($filter_by) && in_array('author', $filter_by)) {
	$author_ajax_filter_options   = isset($view_options['bop_filter_by_author']['ajax_filter_options']) && !empty($view_options['bop_filter_by_author']['ajax_filter_options']) ? $view_options['bop_filter_by_author']['ajax_filter_options'] : array();
	$bop_author_btn_color         = isset($author_ajax_filter_options['bop_author_btn_color']) ? $author_ajax_filter_options['bop_author_btn_color'] : array(
		'text_color'        => '#5e5e5e',
		'text_acolor'       => '#ffffff',
		'border_color'      => '#bbbbbb',
		'border_acolor'     => '#876585',
		'background'        => '#ffffff',
		'active_background' => '#876585',
	);
	$author_margin_between_button = isset($author_ajax_filter_options['author_margin_between_button']) ? $author_ajax_filter_options['author_margin_between_button'] : array(
		'top'    => '0',
		'right'  => '8',
		'bottom' => '8',
		'left'   => '0',
		'unit'   => 'px',
	);
	$custom_css                  .= "#bop_wrapper-{$bop_id} .bop-author-filter.bop-bar.fl_button input~div { background: {$bop_author_btn_color['background']}; color:{$bop_author_btn_color['text_color']}; border-color: {$bop_author_btn_color['border_color']}; } #bop_wrapper-{$bop_id} .bop-author-filter.bop-bar.fl_button input:checked~div{ color: {$bop_author_btn_color['text_acolor']}; background: {$bop_author_btn_color['active_background']}; border-color: {$bop_author_btn_color['border_acolor']}; } #bop_wrapper-{$bop_id} .bop-author-filter.bop-bar.fl_button input:hover~div{ color: {$bop_author_btn_color['text_acolor']}; background: {$bop_author_btn_color['active_background']}; border-color: {$bop_author_btn_color['border_acolor']};#bop_wrapper-{$bop_id} .bop-author-filter.bop-bar.fl_button label { margin: {$author_margin_between_button['top']}px {$author_margin_between_button['right']}px {$author_margin_between_button['bottom']}px {$author_margin_between_button['left']}px; } }";
}
// Color for Sort by ajax live filter's order button(ASC/DESC).
$bop_order_options   = isset($view_options['bop_filter_by_order']['order_filter_options']) && !empty($view_options['bop_filter_by_order']['order_filter_options']) ? $view_options['bop_filter_by_order']['order_filter_options'] : '';
$bop_order_btn_color = isset($bop_order_options['bop_order_filter_button_color']) ? $bop_order_options['bop_order_filter_button_color'] : array(
	'text_color'        => '#5e5e5e',
	'text_acolor'       => '#ffffff',
	'border_color'      => '#bbbbbb',
	'border_acolor'     => '#876585',
	'background'        => '#ffffff',
	'active_background' => '#876585',
);
if (!empty($bop_order_btn_color)) {
	$custom_css .= "
		#bop_wrapper-{$bop_id} .bop_ex_filter_bar .bop-order.bop-bar.fl-btn input~div { background: {$bop_order_btn_color['background']};
		color:{$bop_order_btn_color['text_color']}; border-color: {$bop_order_btn_color['border_color']}; }
		#bop_wrapper-{$bop_id} .bop_ex_filter_bar .bop-order.bop-bar.fl-btn input:checked~div{ color: {$bop_order_btn_color['text_acolor']}; background: {$bop_order_btn_color['active_background']}; border-color: {$bop_order_btn_color['border_acolor']}; }
		#bop_wrapper-{$bop_id} .bop_ex_filter_bar .bop-order.bop-bar.fl-btn input:hover~div{ color: {$bop_order_btn_color['text_acolor']}; background: {$bop_order_btn_color['active_background']}; border-color: {$bop_order_btn_color['border_acolor']}; }";
}

// Filter Settings.
$filer_btn_bg            = isset($view_options['bop_filer_btn_bg']) ? $view_options['bop_filer_btn_bg'] : array(
	'text_color'        => '#444444',
	'text_acolor'       => '#ffffff',
	'border_color'      => '#bbbbbb',
	'border_acolor'     => '#876585',
	'background'        => 'transparent',
	'active-background' => '#876585',
);
$margin_between_button   = isset($view_options['bop_margin_between_button']) ? $view_options['bop_margin_between_button'] : array(
	'top'    => '0',
	'right'  => '8',
	'bottom' => '8',
	'left'   => '0',
	'unit'   => 'px',
);
$margin_between_taxonomy = isset($view_options['bop_margin_between_taxonomy']) ? $view_options['bop_margin_between_taxonomy'] : array(
	'top'    => '0',
	'right'  => '0',
	'bottom' => '30',
	'left'   => '0',
	'unit'   => 'px',
);

// Responsive.
$custom_css .= ' @media (max-width: 768px) {';
if ($show_section_title) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bop-section-title{ font-size: {$_section_title_typography['tablet-font-size']}px; line-height: {$_section_title_typography['tablet-line-height']}px; }";
}
if ($show_post_title) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--title a{ font-size: {$_post_title_typography['tablet-font-size']}px; line-height: {$_post_title_typography['tablet-line-height']}px; }";
}
if ($show_post_content) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item__content, #bop_wrapper-{$bop_id} .bookify__item__content p{ font-size: {$_post_content_typography['tablet-font-size']}px; line-height: {$_post_content_typography['tablet-line-height']}px; }";
}
// Post ReadMore Settings.

$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--meta li, #bop_wrapper-{$bop_id} .bookify__item--meta li a { font-size: {$_post_meta_typography['tablet-font-size']}px; line-height: {$_post_meta_typography['tablet-line-height']}px; } } @media (max-width: 420px) {";

if ($show_section_title) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bop-section-title{ font-size: {$_section_title_typography['mobile-font-size']}px; line-height: {$_section_title_typography['mobile-line-height']}px; }";
}
if ($show_post_title) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--title a{ font-size: {$_post_title_typography['mobile-font-size']}px; line-height: {$_post_title_typography['mobile-line-height']}px; }";
}
if ($show_post_content) {
	$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item__content, #bop_wrapper-{$bop_id} .bookify__item__content p{ font-size: {$_post_content_typography['mobile-font-size']}px; line-height: {$_post_content_typography['mobile-line-height']}px; }";
}
$custom_css .= "#bop_wrapper-{$bop_id} .bookify__item--meta li, #bop_wrapper-{$bop_id} .bookify__item--meta li a{ font-size: {$_post_meta_typography['mobile-font-size']}px; line-height: {$_post_meta_typography['mobile-line-height']}px; } }";

$options = get_option('ta_bookify_settings');

$bop_single_book_meta_typography   = isset($options['bop_single_book_meta_typography']) && array_key_exists('font-size', $options['bop_single_book_meta_typography']) ? $options['bop_single_book_meta_typography'] : array(
	'color'              => '#444',
	'font-family'        => '',
	'font-weight'        => '',
	'subset'             => '',
	'font-size'          => '24',
	'tablet-font-size'   => '15',
	'mobile-font-size'   => '18',
	'line-height'        => '28',
	'tablet-line-height' => '24',
	'mobile-line-height' => '15',
	'letter-spacing'     => '0',
	'text-align'         => 'left',
	'text-transform'     => 'none',
	'type'               => '',
	'unit'               => 'px',
);

$section_title_font_weight   = !empty($bop_single_book_meta_typography['font-weight']) ? $bop_single_book_meta_typography['font-weight'] : '400';
$section_title_font_style    = !empty($bop_single_book_meta_typography['font-style']) ? $bop_single_book_meta_typography['font-style'] : 'normal';
$custom_css                 .= ".bookify__single .bookify__details ul li{";
if (!empty($bop_single_book_meta_typography['font-family'])) {
	$custom_css .= "font-family: {$bop_single_book_meta_typography['font-family']};font-weight: {$section_title_font_weight};font-style: {$section_title_font_style};";
}
$custom_css .= "text-align: {$bop_single_book_meta_typography['text-align']};text-transform: {$bop_single_book_meta_typography['text-transform']};font-size: {$bop_single_book_meta_typography['font-size']}px;line-height: {$bop_single_book_meta_typography['line-height']}px;letter-spacing: {$bop_single_book_meta_typography['letter-spacing']}px;color: {$bop_single_book_meta_typography['color']}}";


$bop_single_button_color_button = $options['bop_single_button_color_button'];
$bop_single_button_color_button  = isset($options['bop_single_button_color_button']) ? $options['bop_single_button_color_button'] : array(
	'standard'     => '#ffffff',
	'hover'        => '#ffffff',
	'bg'           => '#c27b7f',
	'hover_bg'     => '#876585',
	'border'       => '#876585',
	'hover_border' => '#876585',
);
$bop_single_button_padding      = isset($options['bop_single_button_padding']) ? $options['bop_single_button_padding'] : array(
	'top'    => '6',
	'right'  => '20',
	'bottom' => '6',
	'left'   => '20',
);
$bop_single_button_radius = isset($options['bop_single_button_radius']) ? $options['bop_single_button_radius'] : array(
	'all'  => '0',
	'unit' => 'px',
);
$custom_css    .= ".bookify_single .bookify_purchase_btn{ background: {$bop_single_button_color_button['bg']}; color: {$bop_single_button_color_button['standard']}; border-color: {$bop_single_button_color_button['border']}; border-radius: {$bop_single_button_radius['all']}{$bop_single_button_radius['unit']}; margin: {$readmore_margin['top']}px {$readmore_margin['right']}px {$readmore_margin['bottom']}px {$readmore_margin['left']}px; padding: {$bop_single_button_padding['top']}px {$bop_single_button_padding['right']}px {$bop_single_button_padding['bottom']}px {$bop_single_button_padding['left']}px; } .bookify_single .bookify_purchase_btn:hover { background: {$bop_single_button_color_button['hover_bg']}; color: {$bop_single_button_color_button['hover']}; border-color: {$bop_single_button_color_button['hover_border']};  }";
$custom_css    .= ".bookify_single .bookify_purchase_btn a{ color: {$bop_single_button_color_button['standard']};}; .bookify_single .bookify_purchase_btn:hover a { color: {$bop_single_button_color_button['hover']};}";
$bop_single_button_typography   = isset($options['bop_single_button_typography']) && array_key_exists('font-size', $options['bop_single_button_typography']) ? $options['bop_single_button_typography'] : array(
	'color'              => '#444',
	'font-family'        => '',
	'font-weight'        => '',
	'subset'             => '',
	'font-size'          => '24',
	'tablet-font-size'   => '15',
	'mobile-font-size'   => '18',
	'line-height'        => '28',
	'tablet-line-height' => '24',
	'mobile-line-height' => '15',
	'letter-spacing'     => '0',
	'text-align'         => 'left',
	'text-transform'     => 'none',
	'type'               => '',
	'unit'               => 'px',
);

$section_title_font_weight   = !empty($bop_single_button_typography['font-weight']) ? $bop_single_button_typography['font-weight'] : '400';
$section_title_font_style    = !empty($bop_single_button_typography['font-style']) ? $bop_single_button_typography['font-style'] : 'normal';
$custom_css                 .= ".bookify_single .bookify_purchase_btn{";
if (!empty($bop_single_button_typography['font-family'])) {
	$custom_css .= "font-family: {$bop_single_button_typography['font-family']};font-weight: {$section_title_font_weight};font-style: {$section_title_font_style};";
}
$custom_css .= "text-align: {$bop_single_button_typography['text-align']};text-transform: {$bop_single_button_typography['text-transform']};font-size: {$bop_single_button_typography['font-size']}px;line-height: {$bop_single_button_typography['line-height']}px;letter-spacing: {$bop_single_button_typography['letter-spacing']}px;color: {$bop_single_button_typography['color']}}";

$bop_single_description_typography   = isset($options['bop_single_description_typography']) && array_key_exists('font-size', $options['bop_single_description_typography']) ? $options['bop_single_description_typography'] : array(
	'color'              => '#444',
	'font-family'        => '',
	'font-weight'        => '',
	'subset'             => '',
	'font-size'          => '24',
	'tablet-font-size'   => '15',
	'mobile-font-size'   => '18',
	'line-height'        => '28',
	'tablet-line-height' => '24',
	'mobile-line-height' => '15',
	'letter-spacing'     => '0',
	'text-align'         => 'left',
	'text-transform'     => 'none',
	'type'               => '',
	'unit'               => 'px',
);

$section_title_font_weight   = !empty($bop_single_description_typography['font-weight']) ? $bop_single_description_typography['font-weight'] : '400';
$section_title_font_style    = !empty($bop_single_description_typography['font-style']) ? $bop_single_description_typography['font-style'] : 'normal';
$custom_css                 .= ".bookify_single .bookify__description__content, .bookify_single .bookify__description__title{";
if (!empty($bop_single_description_typography['font-family'])) {
	$custom_css .= "font-family: {$bop_single_description_typography['font-family']};font-weight: {$section_title_font_weight};font-style: {$section_title_font_style};";
}
$custom_css .= "text-align: {$bop_single_description_typography['text-align']};text-transform: {$bop_single_description_typography['text-transform']};font-size: {$bop_single_description_typography['font-size']}px;line-height: {$bop_single_description_typography['line-height']}px;letter-spacing: {$bop_single_description_typography['letter-spacing']}px;color: {$bop_single_description_typography['color']}}";
