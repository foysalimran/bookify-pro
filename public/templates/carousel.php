<?php

/**
 *  Carousel view
 *
 * @package    Bookify_pro
 * @subpackage Bookify_pro/public/template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$carousel_mode     = isset( $view_options['bop_carousel_mode'] ) ? $view_options['bop_carousel_mode'] : 'standard';
$carousel_autoplay = ( isset( $view_options['bop_autoplay'] ) && ( $view_options['bop_autoplay'] ) ) ? 'true' : 'false';
$autoplay_speed    = isset( $view_options['bop_autoplay_speed'] ) ? $view_options['bop_autoplay_speed'] : '2000';
$carousel_speed    = isset( $view_options['bop_carousel_speed'] ) ? $view_options['bop_carousel_speed'] : '600';
$ticker_speed      = isset( $view_options['bop_ticker_speed'] ) ? $view_options['bop_ticker_speed'] : '3000';
$pause_hover       = ( isset( $view_options['bop_pause_hover'] ) && ( $view_options['bop_pause_hover'] ) ) ? 'true' : 'false';
$slide_effect      = isset( $view_options['bop_slide_effect'] ) ? $view_options['bop_slide_effect'] : 'slide';
$_slides_to_scroll = isset( $view_options['bop_slides_to_scroll'] ) ? $view_options['bop_slides_to_scroll'] : array(
	'lg_desktop'       => '1',
	'desktop'          => '1',
	'tablet'           => '1',
	'mobile_landscape' => '1',
	'mobile'           => '1',
);



$infinite_loop        = ( isset( $view_options['bop_infinite_loop'] ) && ( $view_options['bop_infinite_loop'] ) ) ? 'true' : 'false';
$carousel_auto_height = ( isset( $view_options['bop_adaptive_height'] ) && ( $view_options['bop_adaptive_height'] ) ) ? 'true' : 'false';
$number_of_columns    = isset( $view_options['bop_number_of_columns'] ) ? $view_options['bop_number_of_columns'] : array(
	'lg_desktop'       => '4',
	'desktop'          => '4',
	'tablet'           => '3',
	'mobile_landscape' => '2',
	'mobile'           => '1',
);
$ticker_slide_width   = isset( $view_options['bop_ticker_slide_width'] ) ? $view_options['bop_ticker_slide_width'] : '250';
$lazy_load            = ( isset( $view_options['bop_lazy_load'] ) && ( $view_options['bop_lazy_load'] ) ) ? 'true' : 'false';
if ( 'cube' === $slide_effect || 'flip' === $slide_effect ) {
	$carousel_auto_height = 'false';
	$lazy_load            = 'false';
}
$spta_fade_class = '';
if ( 'fade' === $slide_effect ) {
	$spta_fade_class = ' bop-carousel-fade';
}
// Direction.
$carousel_direction = ( isset( $view_options['bop_carousel_direction'] ) ) ? $view_options['bop_carousel_direction'] : 'ltr';
if ( 'ticker' === $carousel_mode ) {
	$carousel_direction = 'rtl' === $carousel_direction ? 'prev' : 'next';
}
$is_carousel_accessibility            = ( isset( $bop_settings['accessibility'] ) && ( $bop_settings['accessibility'] ) ) ? 'true' : 'false';
$accessibility_prev_slide_text        = isset( $bop_settings['prev_slide_message'] ) ? $bop_settings['prev_slide_message'] : '';
$accessibility_next_slide_text        = isset( $bop_settings['next_slide_message'] ) ? $bop_settings['next_slide_message'] : '';
$accessibility_first_slide_text       = isset( $bop_settings['first_slide_message'] ) ? $bop_settings['first_slide_message'] : '';
$accessibility_last_slide_text        = isset( $bop_settings['last_slide_message'] ) ? $bop_settings['last_slide_message'] : '';
$accessibility_pagination_bullet_text = isset( $bop_settings['pagination_bullet_message'] ) ? $bop_settings['pagination_bullet_message'] : '';

$bop_responsive_screen_setting = isset( $bop_settings['bop_responsive_screen_setting'] ) ? $bop_settings['bop_responsive_screen_setting'] : '';
$desktop_screen_size           = isset( $bop_responsive_screen_setting ['desktop'] ) ? $bop_responsive_screen_setting ['desktop'] : '1200';
$tablet_screen_size            = isset( $bop_responsive_screen_setting ['tablet'] ) ? $bop_responsive_screen_setting ['tablet'] : '980';
$mobile_land_screen_size       = isset( $bop_responsive_screen_setting ['mobile_landscape'] ) ? $bop_responsive_screen_setting ['mobile_landscape'] : '736';
$mobile_screen_size            = isset( $bop_responsive_screen_setting ['mobile'] ) ? $bop_responsive_screen_setting ['mobile'] : '576';
// Row.
$carousel_row = ( isset( $view_options['bop_number_of_row'] ) ) ? $view_options['bop_number_of_row'] : array(
	'lg_desktop'       => '1',
	'desktop'          => '1',
	'tablet'           => '1',
	'mobile_landscape' => '1',
	'mobile'           => '1',
);

if ( $bop_settings['bop_swiper_js'] ) {
	wp_enqueue_script( 'bop_swiper' );
}
if ( $bop_settings['bop_bx_js'] ) {
	wp_enqueue_script( 'bop_bxslider' );
}
// Navigation.
$_navigation = isset( $view_options['bop_navigation'] ) ? $view_options['bop_navigation'] : '';
switch ( $_navigation ) {
	case 'show':
		$navigation        = 'true';
		$navigation_mobile = 'true';
		break;
	case 'hide':
		$navigation        = 'false';
		$navigation_mobile = 'false';
		break;
	case 'hide_on_mobile':
		$navigation        = 'true';
		$navigation_mobile = 'false';
		break;
}

$navigation_icons      = isset( $view_options['navigation_icons'] ) ? $view_options['navigation_icons'] : 'fa-angle';
$carousel_nav_position = isset( $view_options['bop_carousel_nav_position'] ) ? $view_options['bop_carousel_nav_position'] : 'top_right';

// Pagination Settings.
$_pagination = isset( $view_options['bop_pagination'] ) ? $view_options['bop_pagination'] : '';
switch ( $_pagination ) {
	case 'show':
		$pagination        = 'true';
		$pagination_mobile = 'true';
		break;
	case 'hide':
		$pagination        = 'false';
		$pagination_mobile = 'false';
		break;
	case 'hide_on_mobile':
		$pagination        = 'true';
		$pagination_mobile = 'false';
		break;
}
$dynamic_bullets    = ( isset( $view_options['bop_dynamicBullets'] ) && ( $view_options['bop_dynamicBullets'] ) ) ? 'true' : 'false';
$bullet_types       = ( isset( $view_options['bullet_types'] ) ) ? $view_options['bullet_types'] : '';
$bop_accessibility  = ( isset( $view_options['bop_accessibility'] ) && ( $view_options['bop_accessibility'] ) ) ? 'true' : 'false';
$touch_swipe        = ( isset( $view_options['touch_swipe'] ) && ( $view_options['touch_swipe'] ) ) ? 'true' : 'false';
$slider_draggable   = ( isset( $view_options['slider_draggable'] ) && ( $view_options['slider_draggable'] ) ) ? 'true' : 'false';
$slider_mouse_wheel = ( isset( $view_options['slider_mouse_wheel'] ) && ( $view_options['slider_mouse_wheel'] ) ) ? 'true' : 'false';
$center_mode        = 'false';
$mobile_landscape   = isset( $number_of_columns['mobile_landscape'] ) ? $number_of_columns['mobile_landscape'] : '2';
if ( 'center' === $carousel_mode ) {
	$center_mode = 'true';
}

?>
<!-- Markup Starts -->
<div id="bop_wrapper-<?php echo esc_html( $bop_gl_id ); ?>" class="<?php self::bop_wrapper_classes( $layout_preset, $bop_gl_id, $pagination_type, $item_same_height_class ); ?> <?php self::wrapper_data( $pagination_type, $pagination_type_mobile, $bop_gl_id ); ?> <?php echo esc_html( $carousel_mode ); ?>" data-sid="<?php echo esc_html( $bop_gl_id ); ?>">

<?php
	BOP_HTML::bop_section_title( $section_title, $show_section_title );
	BOP_HTML::bop_preloader( $show_preloader );
?>
<?php require BOP_Functions::bop_locate_template( 'filter-bar.php' ); ?>
	<div class="bookify">
		<div id="ta-bop-id-<?php echo esc_attr( $bop_gl_id ); ?>" class="swiper-container ta-bop-carousel <?php echo esc_attr( $carousel_nav_position . $spta_fade_class ); ?>" dir="<?php echo esc_attr( $carousel_direction ); ?>" data-carousel='{"mode":"<?php echo esc_attr( $carousel_mode ); ?>", "speed":<?php echo esc_attr( $carousel_speed ); ?>, "ticker_speed":<?php echo esc_attr( $ticker_speed ); ?>, "ticker_width":<?php echo esc_attr( $ticker_slide_width ); ?>, "items":<?php echo esc_attr( $number_of_columns['lg_desktop'] ); ?>, "spaceBetween":<?php echo esc_attr( $margin_between_post ); ?>, "navigation":<?php echo esc_attr( $navigation ); ?>, "pagination": <?php echo esc_attr( $pagination ); ?>, "autoplay": <?php echo esc_attr( $carousel_autoplay ); ?>, "autoplay_speed": <?php echo esc_attr( $autoplay_speed ); ?>, "loop": <?php echo esc_attr( $infinite_loop ); ?>, "autoHeight": <?php echo esc_attr( $carousel_auto_height ); ?>, "lazy":  <?php echo esc_attr( $lazy_load ); ?>, "effect": "<?php echo esc_attr( $slide_effect ); ?>", "simulateTouch": <?php echo esc_attr( $slider_draggable ); ?>, "slider_mouse_wheel": <?php echo esc_attr( $slider_mouse_wheel ); ?>, "allowTouchMove": <?php echo esc_attr( $touch_swipe ); ?>, "dynamicBullets": <?php echo esc_attr( $dynamic_bullets ); ?>, "bullet_types": "<?php echo esc_attr( $bullet_types ); ?>", "center_mode": <?php echo esc_attr( $center_mode ); ?>, "slidesRow": {"lg_desktop": <?php echo esc_attr( $carousel_row['lg_desktop'] ); ?>, "desktop": <?php echo esc_attr( $carousel_row['desktop'] ); ?>, "tablet": <?php echo esc_attr( $carousel_row['tablet'] ); ?>, "mobile_landscape": <?php echo esc_attr( $carousel_row['mobile_landscape'] ); ?>, "mobile": <?php echo esc_attr( $carousel_row['mobile'] ); ?>}, "responsive": {"lg_desktop": <?php echo esc_attr( $desktop_screen_size ); ?>, "desktop": <?php echo esc_attr( $tablet_screen_size ); ?>, "tablet": <?php echo esc_attr( $mobile_land_screen_size ); ?>, "mobile_landscape": <?php echo esc_attr( $mobile_screen_size ); ?>}, "slidesPerView": {"lg_desktop": <?php echo esc_attr( $number_of_columns['lg_desktop'] ); ?>, "desktop": <?php echo esc_attr( $number_of_columns['desktop'] ); ?>, "tablet": <?php echo esc_attr( $number_of_columns['tablet'] ); ?>, "mobile_landscape": <?php echo esc_attr( $mobile_landscape ); ?>, "mobile": <?php echo esc_attr( $number_of_columns['mobile'] ); ?>}, "slideToScroll": {"lg_desktop": <?php echo esc_attr( $_slides_to_scroll['lg_desktop'] ); ?>, "desktop": <?php echo esc_attr( $_slides_to_scroll['desktop'] ); ?>, "tablet": <?php echo esc_attr( $_slides_to_scroll['tablet'] ); ?>, "mobile_landscape": <?php echo esc_attr( $_slides_to_scroll['mobile_landscape'] ); ?>, "mobile": <?php echo esc_attr( $_slides_to_scroll['mobile'] ); ?> }, "navigation_mobile": <?php echo esc_attr( $navigation_mobile ); ?>, "pagination_mobile": <?php echo esc_attr( $pagination_mobile ); ?>, "stop_onHover": <?php echo esc_attr( $pause_hover ); ?>, "enabled": <?php echo esc_attr( $is_carousel_accessibility ); ?>, "prevSlideMessage": "<?php echo esc_attr( $accessibility_prev_slide_text ); ?>", "nextSlideMessage": "<?php echo esc_attr( $accessibility_next_slide_text ); ?>", "firstSlideMessage": "<?php echo esc_attr( $accessibility_first_slide_text ); ?>", "lastSlideMessage": "<?php echo esc_attr( $accessibility_last_slide_text ); ?>","keyboard": "<?php echo esc_attr( $bop_accessibility ); ?>", "paginationBulletMessage": "<?php echo esc_attr( $accessibility_pagination_bullet_text ); ?>" }'>
			<div class="swiper-wrapper">
				<?php self::bop_get_posts( $options, $layout_preset, $post_content_sorter, $bop_query, $bop_gl_id ); ?>
			</div>
			<?php
			if ( 'true' === $pagination && 'ticker' !== $carousel_mode ) {
				?>
				<div class="bop-pagination swiper-pagination <?php echo esc_attr( $bullet_types ); ?>"></div>
			<?php } ?>
			<?php if ( 'true' === $navigation && 'ticker' !== $carousel_mode ) { ?>
				<div class="bop-button-next swiper-button-next <?php echo esc_attr( $carousel_nav_position ); ?>"><i class="fa <?php echo esc_attr( $navigation_icons ); ?>-right"></i></div>
				<div class="bop-button-prev swiper-button-prev <?php echo esc_attr( $carousel_nav_position ); ?>"><i class="fa <?php echo esc_attr( $navigation_icons ); ?>-left"></i></div><?php } ?>
		</div>
	</div>
</div>
