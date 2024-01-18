<?php
/**
 * Meta
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/event-fildes.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

 echo '<div class="bookify__item--meta event_meta">';

BOP_Functions::bop_get_book_fildes( $post, $book_fildes_fields, $visitor_count, $_event_meta_separator, $bookify_postmeta, $is_table );

echo '</div>';
