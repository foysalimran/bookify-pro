<?php
/**
 * Section title
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/section-title.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public/template
 */

if ( ! empty( $section_title_text ) ) {
	?>
<h2 class="bop-section-title"><?php echo esc_html( $section_title_text ); ?> </h2>
<?php } ?>
