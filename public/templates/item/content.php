<?php
/**
 * Content
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/content.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

?>
<div class="bookify__item__content">
	<?php
	if ( $show_post_content ) {

		echo wp_kses( BOP_Functions::bop_content( $post_content_setting, $bop_content_type, $post ), apply_filters( 'ta_wp_bop_allowed_tags', BOP_Functions::allowed_tags() ) );
	}
	?>
</div>
