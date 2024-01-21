<?php

/**
 *  Carousel view
 *
 * @package    Bookify_pro
 * @subpackage Bookify_pro/public/template
 */
if (!defined('ABSPATH')) {
	exit;
}
?>
<div id="bop_wrapper-<?php echo esc_attr($bop_gl_id); ?>" class="<?php self::bop_wrapper_classes($layout_preset, $bop_gl_id, $grid_style, $item_same_height_class); ?>" <?php self::wrapper_data( $pagination_type, $pagination_type_mobile, $bop_gl_id ); ?> data-lang="<?php echo esc_attr( $spta_lang ); ?>">

	<?php
	BOP_HTML::bop_section_title($section_title, $show_section_title);
	BOP_HTML::bop_preloader($show_preloader);
	?>
	<?php require BOP_Functions::bop_locate_template('filter-bar.php'); ?>
	<div class="bookify">
		<div class="ta-row">
			<?php self::bop_get_posts($options, $layout_preset, $post_content_sorter, $bop_query, $bop_gl_id); ?>
		</div>
	</div>
	<?php require BOP_Functions::bop_locate_template( 'pagination.php' ); ?>
</div>