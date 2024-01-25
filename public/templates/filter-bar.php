<?php
/**
 *  Shuffle filter bar file
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/filter-bar.php
 *
 * @package    Bookify_pro
 * @subpackage Bookify_pro/public/template
 */

if ( is_array( $advanced_filter ) && ! $bop_query->is_main_query() ) {
	ob_start();
		BOP_Live_Filter::bop_live_filter( $view_options, $query_args, $bop_gl_id );
		BOP_Live_Filter::bop_author_filter( $view_options, $query_args );
		BOP_Live_Filter::bop_custom_filter_filter( $view_options, $query_args, $bop_gl_id );
	$filter_bar = ob_get_clean();

	ob_start();
		BOP_Live_Filter::bop_orderby_filter_bar( $view_options, $bop_query, $bop_gl_id );
		BOP_Live_Filter::bop_order_filter_bar( $view_options, $bop_gl_id );
		BOP_Live_Filter::bop_live_search_bar( $view_options, $bop_gl_id );
	$ex_filter_bar = ob_get_clean();


	if ( ! empty( $filter_bar ) ) { ?>
		<div class="bop-filter-bar">
			<?php echo esc_html( $filter_bar ); ?>
		</div>
	<?php } if ( ! empty( $ex_filter_bar ) ) { ?>
			<div class="bop_ex_filter_bar">
			<?php echo esc_html( $ex_filter_bar ); ?>
			</div>
	<?php }
} ?>
