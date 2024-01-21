<?php

/**
 * Meta
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/meta.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

echo '<div class="bookify__item__price">';
if ('price' == $show_book_price) {
    echo esc_html($bookify_postmeta['bop_book_regular_price']);
} else {
?>
    <del>$<?php echo esc_html($bookify_postmeta['bop_book_regular_price']) ?></del>
<?php
    echo '$' . esc_html($bookify_postmeta['bop_book_regular_price']);
}
echo '</div>';
