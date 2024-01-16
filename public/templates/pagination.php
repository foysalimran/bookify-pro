<?php
/**
 * Pagination display provider
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/pagination.php
 *
 * @package    Bookify_pro
 * @subpackage Bookify_pro/public
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $show_pagination && ! $bop_query->is_main_query() ) {
	// Paged argument.
	if ( get_query_var( 'paged' ) ) {
		$bop_paged = get_query_var( 'paged' );
	} elseif ( get_query_var( 'page' ) ) {
		$bop_paged = get_query_var( 'page' );
	} else {
		$bop_paged = 1;
	}
	$load_more_button_text    = isset( $view_options['load_more_button_text'] ) ? $view_options['load_more_button_text'] : 'Load More';
	$load_more_ending_message = isset( $view_options['load_more_ending_message'] ) ? $view_options['load_more_ending_message'] : 'No more events available';
	?>
	<span class="ta-bop-pagination-data" style="display:none;" data-loadmoretext="<?php echo esc_attr( $load_more_button_text ); ?>" data-endingtext="<?php echo esc_attr( $load_more_ending_message ); ?>"></span>

		<nav class="bop-post-pagination bop-on-desktop <?php echo esc_attr( $pagination_type ); ?>">
		<?php BOP_HTML::bop_pagination_bar( $bop_query, $view_options, $layout, $bop_gl_id, $bop_paged ); ?>
		</nav>
		<?php if ( 'filter_layout' !== $layout_preset ) { ?>
			<nav class="bop-post-pagination bop-on-mobile <?php echo esc_attr( $pagination_type_mobile ); ?>">
				<?php BOP_HTML::bop_pagination_bar( $bop_query, $view_options, $layout, $bop_gl_id, $bop_paged, 'on_mobile' ); ?>
			</nav>
			<?php
		}
		?>
	<?php
}
?>
