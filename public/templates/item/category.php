<?php

/**
 * Category
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/content.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

$term = BOP_Functions::bop_taxonomy($bop_book_category_taxonomy, $post->ID);
if (!empty($term)) {
?>
    <div class="bookify__item__category">
        <?php
        $start_tag      = $is_table ? '<td class="ta-bop-post-meta">' : '<li>';
        $end_tag        = $is_table ? '</td>' : '</li>';
        $meta_tag_start = apply_filters('bop_post_meta_html_tag_start', $start_tag);
        $meta_tag_end   = apply_filters('bop_post_meta_html_tag_end', $end_tag);

        if (!empty($term)) {
            echo wp_kses_post($meta_tag_start);
            echo wp_kses_post($term);
            echo wp_kses_post($meta_tag_end);
        }
        ?>
    </div>
<?php
}
