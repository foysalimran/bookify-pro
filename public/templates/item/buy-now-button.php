<?php

/**
 * Buy now button
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/read-more.php
 *
 * @package    Bookify_pro_Pro
 * @subpackage Bookify_pro_Pro/public
 */
?>

<?php
if ($bookify_postmeta['bop_book_buy_button_text']) {
?>
    <a href="<?php echo esc_attr($bookify_postmeta['bop_book_buy_button_link']); ?>" class="bookify__item__btn"><?php echo esc_html($bookify_postmeta['bop_book_buy_button_text']); ?></a>
<?php
}


