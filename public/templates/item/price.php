<?php

/**
 * Meta
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/meta.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */
$show_book_price_text = isset( $sorter['bop_book_price']['show_book_price_text'] ) ? $sorter['bop_book_price']['show_book_price_text'] : '';
if ( $bookify_postmeta['bop_book_regular_price'] ) {
	echo '<div class="bookify__item__price">';
	if ( 'price' == $show_book_price ) {
		?>
		<span><?php echo esc_html( $show_book_price_text ); ?> <?php echo esc_html( $bookify_postmeta['bop_book_sale_price'] ); ?></span>
		<?php
	} else {
		?>
		<span><?php echo esc_html( $show_book_price_text ); ?> <del><?php echo esc_html( $bookify_postmeta['bop_book_regular_price'] ); ?></del></span>
		<span>-</span>
		<span><?php echo esc_html( $bookify_postmeta['bop_book_sale_price'] ); ?></span>
		<?php
	}
	echo '</div>';
}
