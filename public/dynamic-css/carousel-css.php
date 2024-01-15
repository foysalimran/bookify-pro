<?php
/**
 * The dynamic CSS for Carousel layout.
 *
 * @package Bookify_Pro
 * @subpackage Bookify_Pro/Public/dynamic-css
 */

	// Navigation options.
	$bop_navigation                = isset( $view_options['bop_navigation'] ) ? $view_options['bop_navigation'] : '';
	$carousel_mode                 = isset( $view_options['bop_carousel_mode'] ) ? $view_options['bop_carousel_mode'] : 'standard';
	$title_text                    = get_the_title( $bop_id );
	$view_options['section_title'] = empty( $title_text ) ? false : $view_options['section_title'];
	$_nav_colors                   = BOP_Functions::bop_metabox_value(
		'bop_nav_colors',
		$view_options,
		array(
			'color'              => '#aaa',
			'hover-color'        => '#fff',
			'bg'                 => '#fff',
			'hover-bg'           => '#263ad0',
			'border-color'       => '#aaa',
			'hover-border-color' => '#263ad0',
		)
	);
	$nav_color                     = BOP_Functions::bop_metabox_value( 'color', $_nav_colors );
	$nav_color_hover               = BOP_Functions::bop_metabox_value( 'hover-color', $_nav_colors );
	$nav_color_bg                  = BOP_Functions::bop_metabox_value( 'bg', $_nav_colors );
	$nav_color_bg_hover            = BOP_Functions::bop_metabox_value( 'hover-bg', $_nav_colors );
	$nav_color_border              = BOP_Functions::bop_metabox_value( 'border-color', $_nav_colors );
	$nav_color_border_hover        = BOP_Functions::bop_metabox_value( 'hover-border-color', $_nav_colors );
	$nav_icon_size                 = BOP_Functions::bop_metabox_value( 'bop_nav_icon_size', $view_options );
	$_nav_icon_radius              = BOP_Functions::bop_metabox_value(
		'navigation_icons_border_radius',
		$view_options,
		array(
			'all'  => '0',
			'unit' => 'px',
		)
	);

	// Pagination options.
	$bop_pagination                = isset( $view_options['bop_pagination'] ) ? $view_options['bop_pagination'] : 'show';
	$_pagination_color_set         = isset( $view_options['bop_pagination_color_set'] ) ? $view_options['bop_pagination_color_set'] : '';
	$_pagination_colors            = isset( $_pagination_color_set['bop_pagination_color'] ) ? $_pagination_color_set['bop_pagination_color'] : array(
		'color'        => '#cccccc',
		'active-color' => '#263ad0',
	);
	$pagination_color              = $_pagination_colors['color'];
	$pagination_color_active       = $_pagination_colors['active-color'];
	$_pagination_number_colors     = isset( $_pagination_color_set['bop_pagination_number_color'] ) ? $_pagination_color_set['bop_pagination_number_color'] : array(
		'color'       => '#ffffff',
		'hover-color' => '#ffffff',
		'bg'          => '#444444',
		'hover-bg'    => '#263ad0',
	);
	$pagination_number_color       = $_pagination_number_colors['color'];
	$pagination_number_hover_color = $_pagination_number_colors['hover-color'];
	$pagination_number_bg          = $_pagination_number_colors['bg'];
	$pagination_number_hover_bg    = $_pagination_number_colors['hover-bg'];

	$classes = get_body_class();
	if ( in_array( 'et_divi_builder', $classes, true ) ) {
		// DB Builder compatibility.
		if ( 'hide_on_mobile' === $bop_navigation ) {
			$custom_css .= "@media (max-width: 480px) { #et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-prev, #et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-next { display: none; } }";
		} $custom_css .= "#et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-prev, #et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-next{ background-image: none; background-size: auto; background-color: {$nav_color_bg}; font-size: {$nav_icon_size}px; height: 33px; width: 33px; margin-top: 8px; border: 1px solid {$nav_color_border}; text-align: center; line-height: 30px; -webkit-transition: 0.3s; border-radius: {$_nav_icon_radius['all']}{$_nav_icon_radius['unit']}; }";
		$custom_css   .= "#et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-prev:hover, #et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-next:hover{ background-color: {$nav_color_bg_hover}; border-color: {$nav_color_border_hover}; } #et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-prev .fa, #et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-next .fa{ color: {$nav_color}; } #et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-prev:hover .fa, #et-boc .et-l #bop_wrapper-{$bop_id} .bop-button-next:hover .fa{ color: {$nav_color_hover}; } #et-boc .et-l #bop_wrapper-{$bop_id}.bop-carousel-wrapper .bookify__item{ margin-top: 0; } ";
		if ( 'hide' !== $bop_navigation && ! $view_options['section_title'] && 'ticker' !== $carousel_mode ) {
			$custom_css .= "#et-boc .et-l #bop_wrapper-{$bop_id} .ta-bop-carousel.top_right, #et-boc .et-l #bop_wrapper-{$bop_id} .ta-bop-carousel.top_left, #et-boc .et-l #bop_wrapper-{$bop_id} .ta-bop-carousel.top_center {padding-top: 60px;}";
		}
		if ( 'hide' !== $bop_navigation && 'ticker' !== $carousel_mode ) {
			$custom_css .= "#et-boc .et-l #bop_wrapper-{$bop_id} .ta-bop-carousel.bottom_left, #et-boc .et-l #bop_wrapper-{$bop_id} .ta-bop-carousel.bottom_right, #et-boc .et-l #bop_wrapper-{$bop_id} .ta-bop-carousel.bottom_center {padding-bottom: 60px;}";
		}
		if ( 'hide_on_mobile' === $bop_pagination ) {
			$custom_css .= "@media (max-width: 480px) { #et-boc .et-l #bop_wrapper-{$bop_id} .bop-pagination{ display: none; } }";
		} $custom_css .= "#et-boc .et-l #bop_wrapper-{$bop_id} .dots .swiper-pagination-bullet{ background: {$pagination_color}; } #et-boc .et-l #bop_wrapper-{$bop_id} .dots .swiper-pagination-bullet-active { background: {$pagination_color_active}; } #et-boc .et-l #bop_wrapper-{$bop_id} .number .swiper-pagination-bullet{ color: {$pagination_number_color}; background: {$pagination_number_bg}; } #et-boc .et-l #bop_wrapper-{$bop_id} .number .swiper-pagination-bullet-active, #et-boc .et-l #bop_wrapper-{$bop_id} .number .swiper-pagination-bullet:hover{ color: {$pagination_number_hover_color}; background: {$pagination_number_hover_bg}; } #et-boc .et-l #bop_wrapper-{$bop_id} .bop-pagination{text-align:center;} #et-boc .et-l #bop_wrapper-{$bop_id} .bop-pagination .swiper-pagination-bullet{ border-radius: 50%; margin: 0 4px;}";

		$carousel_nav_position = BOP_Functions::bop_metabox_value( 'bop_carousel_nav_position', $view_options, 'top_right' );
		if ( 'vertically_center_outer' === $carousel_nav_position ) {
			$custom_css .= "#et-boc .et-l .bop-wrapper-{$bop_id} .swiper-container{ position: static; }";
		}
		if ( 'hide' !== $bop_pagination && 'ticker' !== $carousel_mode ) {
			$custom_css .= "#et-boc .et-l #bop_wrapper-{$bop_id} .ta-bop-carousel {padding-bottom: 60px;}";
		}
	} else {
		$custom_css .= "#bop_wrapper-{$bop_id} .swiper-container-fade:not(.swiper-container-rtl)  .swiper-slide .ta-bookify-pro-item:not(:last-child),  #bop_wrapper-{$bop_id} .swiper-container-cube:not(.swiper-container-rtl)  .swiper-slide [class~='ta-bookify-pro-item'], #bop_wrapper-{$bop_id} .swiper-container-flip:not(.swiper-container-rtl)  .swiper-slide [class~='ta-bookify-pro-item']{
			margin-right:{$margin_between_post}px;
		}
		#bop_wrapper-{$bop_id} .swiper-container-fade.swiper-container-rtl  .swiper-slide .ta-bookify-pro-item:not(:last-child),  #bop_wrapper-{$bop_id} .swiper-container-cube.swiper-container-rtl  .swiper-slide [class~='ta-bookify-pro-item'], #bop_wrapper-{$bop_id} .swiper-container-flip.swiper-container-rtl  .swiper-slide [class~='ta-bookify-pro-item']{
			margin-left:{$margin_between_post}px;
		}
		";
		
		if ( 'hide_on_mobile' === $bop_navigation ) {
			$custom_css .= "@media (max-width: 480px) { #bop_wrapper-{$bop_id} .bop-button-prev, #bop_wrapper-{$bop_id} .bop-button-next { display: none; } }";
		} $custom_css .= "#bop_wrapper-{$bop_id} .bop-button-prev, #bop_wrapper-{$bop_id} .bop-button-next{ background-image: none; background-size: auto; background-color: {$nav_color_bg}; font-size: {$nav_icon_size}px; height: 33px; width: 33px; margin-top: 8px; border: 1px solid {$nav_color_border}; text-align: center; line-height: 30px; -webkit-transition: 0.3s; border-radius: {$_nav_icon_radius['all']}{$_nav_icon_radius['unit']}; }";
		$custom_css   .= "#bop_wrapper-{$bop_id} .bop-button-prev:hover, #bop_wrapper-{$bop_id} .bop-button-next:hover{ background-color: {$nav_color_bg_hover}; border-color: {$nav_color_border_hover}; } #bop_wrapper-{$bop_id} .bop-button-prev .fa, #bop_wrapper-{$bop_id} .bop-button-next .fa{ color: {$nav_color}; } #bop_wrapper-{$bop_id} .bop-button-prev:hover .fa, #bop_wrapper-{$bop_id} .bop-button-next:hover .fa{ color: {$nav_color_hover}; } #bop_wrapper-{$bop_id}.bop-carousel-wrapper .bookify__item{ margin-top: 0; } ";
		if ( 'hide' !== $bop_navigation && ! $view_options['section_title'] && 'ticker' !== $carousel_mode ) {
			$custom_css .= "#bop_wrapper-{$bop_id} .ta-bop-carousel.top_right, #bop_wrapper-{$bop_id} .ta-bop-carousel.top_left, #bop_wrapper-{$bop_id} .ta-bop-carousel.top_center {padding-top: 60px;}";
		}
		if ( 'hide' !== $bop_navigation && 'ticker' !== $carousel_mode ) {
			$custom_css .= "#bop_wrapper-{$bop_id} .ta-bop-carousel.bottom_left, #bop_wrapper-{$bop_id} .ta-bop-carousel.bottom_right, #bop_wrapper-{$bop_id} .ta-bop-carousel.bottom_center {padding-bottom: 60px;}";
		}
		if ( 'hide_on_mobile' === $bop_pagination ) {
			$custom_css .= "@media (max-width: 480px) { #bop_wrapper-{$bop_id} .bop-pagination{ display: none; } }";
		} $custom_css .= "#bop_wrapper-{$bop_id} .dots .swiper-pagination-bullet{ background: {$pagination_color}; } #bop_wrapper-{$bop_id} .dots .swiper-pagination-bullet-active { background: {$pagination_color_active}; } #bop_wrapper-{$bop_id} .number .swiper-pagination-bullet{ color: {$pagination_number_color}; background: {$pagination_number_bg}; } #bop_wrapper-{$bop_id} .number .swiper-pagination-bullet-active, #bop_wrapper-{$bop_id} .number .swiper-pagination-bullet:hover{ color: {$pagination_number_hover_color}; background: {$pagination_number_hover_bg}; }";

		$custom_css .= "#bop_wrapper-{$bop_id} .bop-filter-bar ~ .ta-bop-carousel.top_right, #bop_wrapper-{$bop_id} .bop-filter-bar ~ .ta-bop-carousel.top_center, #bop_wrapper-{$bop_id} .bop-filter-bar ~ .ta-bop-carousel.top_left {padding-top: 0px;}";

		$carousel_nav_position = BOP_Functions::bop_metabox_value( 'bop_carousel_nav_position', $view_options, 'top_right' );
		if ( 'vertically_center_outer' === $carousel_nav_position ) {
			$custom_css .= ".bop-wrapper-{$bop_id} .swiper-container{ position: static; }";
		}
		if ( 'hide' !== $bop_pagination && 'ticker' !== $carousel_mode ) {
			$custom_css .= "#bop_wrapper-{$bop_id} .ta-bop-carousel {padding-bottom: 60px;}";
		}
	}
