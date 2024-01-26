<?php

/**
 * Thumb taxonomy
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/over-thumb-taxonomy.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

?>
<div class="bookify__item--archive <?php echo esc_attr( $post_thumb_meta_position ); ?>">
	<?php
	$term           = BOP_Functions::bop_post_thumb_taxonomy( $taxonomy_name, $post->ID );
	$start_tag      = $is_table ? '<td class="ta-bop-post-meta">' : '<li>';
	$end_tag        = $is_table ? '</td>' : '</li>';
	$meta_tag_start = apply_filters( 'bop_post_meta_html_tag_start', $start_tag );
	$meta_tag_end   = apply_filters( 'bop_post_meta_html_tag_end', $end_tag );

	if ( ! empty( $term ) ) {
		echo wp_kses_post( $meta_tag_start );
		echo wp_kses_post( $term );
		echo wp_kses_post( $meta_tag_end );
	}
	?>
</div>
