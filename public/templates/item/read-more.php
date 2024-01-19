<?php

/**
 * Read more
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro/templates/item/read-more.php
 *
 * @package    Bookify_pro_Pro
 * @subpackage Bookify_pro_Pro/public
 */

if ('text_link' === $read_more_type) {
?>

    <?php if ('none' === $bop_page_link_type) { ?>
        <a class="bookify__item__btn" target="<?php echo esc_attr($readmore_target); ?>" <?php echo esc_html($bop_link_rel_text); ?>>
        <?php } else { ?>
            <a class="bookify__item__btn" target="<?php echo esc_attr($readmore_target); ?>" ta rel="<?php echo esc_attr($bop_link_rel); ?>" href="<?php the_permalink($post); ?>" <?php echo esc_html($bop_link_rel_text); ?>>
            <?php } ?>

            <?php echo esc_html($bop_read_label); ?> </a>

        <?php
    } else {
        ?>
            <div class="bookify__item__content__readmore">
                <?php if ('none' === $bop_page_link_type) { ?>
                    <a class="bookify__item__btn" target="<?php echo esc_attr($readmore_target); ?>" <?php echo esc_html($bop_link_rel_text); ?>>
                    <?php } else { ?>
                        <a class="bookify__item__btn" target="<?php echo esc_attr($readmore_target); ?>" href="<?php the_permalink($post); ?>" <?php echo esc_html($bop_link_rel_text); ?>>
                        <?php } ?>
                        <?php echo esc_html($bop_read_label); ?> </a>
            </div>
        <?php
    }
