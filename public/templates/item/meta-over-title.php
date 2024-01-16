<?php
/**
 * Meta over title
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/meta-over-title.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

?>
<div class="bop-category above_title <?php echo esc_attr( $taxonomy ); ?>">
	<?php echo wp_kses_post( $terms ); ?>
</div>
