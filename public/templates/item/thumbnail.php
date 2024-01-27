<?php

/**
 * Item thumbnail
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/thumbnail.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

$lazy_load = isset( $_post_thumb_setting['bop_img_lazy_load'] ) ? $_post_thumb_setting['bop_img_lazy_load'] : true;
$lazy_load = apply_filters( 'bop_img_lazy_load', $lazy_load );

if ( 'carousel_layout' !== $layout && $lazy_load && ! is_admin() ) {

	wp_enqueue_script( 'bop-lazy' );
	$image = sprintf( '<img data-bop_src="%1$s" %5$s class="bop-lazyload" width="%2$s"  height="%3$s" alt="%4$s">', $thumb_url, $bop_image_attr['width'], $bop_image_attr['height'], $alter_text, $retina_img_attr );
} else {

	$image = sprintf(
		'<img %5$s src="%1$s" width="%2$s" height="%3$s" alt="%4$s">',
		$thumb_url,
		$bop_image_attr['width'],
		$bop_image_attr['height'],
		$alter_text,
		$retina_img_attr
	);
}



?>
<div class="bookify__item--thumbnail">
	<?php if ( 'none' === $bop_page_link_type ) { ?>
		<a class="ta-bop-thumb" aria-label="<?php echo esc_attr( $bop_image_attr['aria_label'] ); ?>" <?php echo esc_attr( $bop_link_rel_text ); ?>>
		<?php } else { ?>
			<a class="ta-bop-thumb" aria-label="<?php echo esc_attr( $bop_image_attr['aria_label'] ); ?>" href="<?php the_permalink( $post ); ?>" target="<?php echo esc_attr( $bop_link_target ); ?>" <?php echo esc_attr( $bop_link_rel_text ); ?>>
			<?php
		}
		if ( empty( $bop_image_attr['video'] ) && empty( $bop_image_attr['audio'] ) ) {
			echo wp_kses_post( $image );
		} elseif ( $bop_image_attr['video'] ) {
			?>
				<div class='ta-bop-post-video-thumb-area'><?php echo wp_kses_post( $bop_image_attr['video'] ); ?></div>
			<?php
		} elseif ( $bop_image_attr['audio'] ) {
			?>
				<div class='ta-bop-post-audio-thumb-area'><?php echo wp_kses_post( $bop_image_attr['audio'] ); ?></div>
			<?php } ?>
			</a>
			<?php

			// Taxonomy terms over thumbnail.
			self::over_thumb_meta_taxonomy( $post_meta_fields, $show_post_meta, $post );

			if ( $post_thumb_meta == 'category' ) {
				ob_start();
				echo wp_kses( $td['start'], $allow_tag );
				include BOP_Functions::bop_locate_template( 'item/post-thumb-taxonomy.php' );
				echo wp_kses( $td['end'], $allow_tag );
				$item_thumb = apply_filters( 'bop_thumb_taxonomy', ob_get_clean() );
				echo wp_kses(
					$item_thumb,
					array(
						'div' => array( 'class' => true ),
						'li'  => array( 'class' => true ),
						'a'   => array( 'href' => true ),
					)
				);
			} elseif ( $post_thumb_meta == 'date' ) {
				ob_start();
				echo wp_kses( $td['start'], $allow_tag );
				include BOP_Functions::bop_locate_template( 'item/post-thumb-date.php' );
				echo wp_kses( $td['end'], $allow_tag );
				$item_thumb = apply_filters( 'bop_thumb_archive', ob_get_clean() );
				echo wp_kses(
					$item_thumb,
					array(
						'div'  => array( 'class' => true ),
						'li'   => array(),
						'time' => array( 'class' => true ),
					)
				);
			}
			?>

</div>