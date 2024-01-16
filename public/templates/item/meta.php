<?php
/**
 * Meta
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/meta.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

 echo '<div class="bookify__item--meta">';

BOP_Functions::bop_get_post_meta( $post, $post_meta_fields, $visitor_count, $_meta_separator, $is_table );

echo '</div>';
