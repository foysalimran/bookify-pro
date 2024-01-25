<?php

/**
 * Buy now button
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/read-more.php
 *
 * @package    Bookify_pro_Pro
 * @subpackage Bookify_pro_Pro/public
 */

if ( $bookify_postmeta['bop_book_buy_button_text'] ) {
	?>
	<div class="bookify__item__content__buy_now">
		<a href="<?php echo esc_attr( $bookify_postmeta['bop_book_buy_button_link'] ); ?>" class="bookify__item__btn"><?php echo esc_html( $bookify_postmeta['bop_book_buy_button_text'] ); ?></a>
	</div>
	<?php
}
