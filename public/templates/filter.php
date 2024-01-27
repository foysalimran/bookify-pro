<?php

/**
 *  Shuffle filter view file
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/filter.php
 *
 * @package    Bookify_pro
 * @subpackage Bookify_pro/public/template
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div id="bop_wrapper-<?php echo esc_attr( $bop_gl_id ); ?>" class="<?php esc_attr( self::bop_wrapper_classes( $layout_preset, $bop_gl_id, $pagination_type, $item_same_height_class ) ); ?>" data-sid="<?php echo esc_attr( $bop_gl_id ); ?>" <?php esc_attr( self::wrapper_data( $pagination_type, $pagination_type_mobile, $bop_gl_id ) ); ?> data-grid="<?php echo esc_attr( $grid_style ); ?>" data-lang="<?php echo esc_attr( $spta_lang ); ?>">
	<?php
	BOP_HTML::bop_section_title( $section_title, $show_section_title );
	BOP_HTML::bop_preloader( $show_preloader );
	$categories = get_categories(
		array(
			'orderby' => 'name',
			'parent'  => 0,
		)
	);
	if ( is_array( $advanced_filter ) && ! $bop_query->is_main_query() ) {
		?>
		<div class="bop-shuffle-filter">
			<?php
			$filter_type = isset( $view_options['bop_filter_type'] ) ? $view_options['bop_filter_type'] : '';
			Bookify_Pro_Shuffle_Filter::bop_shuffle_filter( $view_options, $layout_preset, $bop_query, $filter_type );
			?>
		</div>
	<?php } ?>
	<div class="ta-row grid">
		<?php self::bop_get_posts( $options, $layout_preset, $post_content_sorter, $bop_query, $bop_gl_id ); ?>
	</div>
	<?php require BOP_Functions::bop_locate_template( 'pagination.php' ); ?>
</div>
