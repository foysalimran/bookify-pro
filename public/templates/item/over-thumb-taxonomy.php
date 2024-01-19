<?php
/**
 * Section title
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/over-thumb-taxonomy.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

?>
<div class="bop-category <?php echo esc_attr( $meta_over_thumb_position ) . ' ' . esc_attr( $taxonomy ); ?>">
	<?php echo wp_kses_post( $terms ); ?>
</div>
