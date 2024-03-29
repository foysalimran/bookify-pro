<?php

/**
 * Item Title
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/subtitle.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

?>

<<?php echo esc_attr( $post_subtitle_tag ); ?> class="bookify__item--subtitle">

	<?php if ( 'none' === $bop_page_link_type ) { ?>
		<?php printf( '<a %2$s>%1$s</a>', wp_kses( trim( $bop_post_subtitle ), $allowed_html_tags ), esc_attr( $bop_link_rel_text ) ); ?>
	<?php } else { ?>
		<?php printf( '<a href="%1$s" %3$s target="%4$s">%2$s</a>', esc_url( get_the_permalink( $post ) ), wp_kses( trim( $bop_post_subtitle ), $allowed_html_tags ), esc_attr( $bop_link_rel_text ), esc_attr( $bop_link_target ) ); ?>
	<?php } ?>

</<?php echo esc_attr( $post_subtitle_tag ); ?>>
