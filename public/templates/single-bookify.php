<?php
get_header(); // Include your header template
?>

<section class="bookify bookify__single">
    <div class="container">
        <?php
        while (have_posts()) : the_post();
            $bookify_postmeta = get_post_meta(get_the_ID(), 'ta_bookify_postmeta', true);
            echo "<pre>";
            print_r($bookify_postmeta);
            echo "</pre>";
        ?>
            <div class="ta-row">
                <div class="ta-col-xl-2 col-xs-1">
                    <div class="bookify__item__img">
                        <?php
                        if (has_post_thumbnail()) {
                            echo '<div class="featured-image">';
                            the_post_thumbnail('large'); // You can change 'large' to other image sizes
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
                <div class="ta-col-xl-2 col-xs-1">
                    <div class="bookify__content">
                        <?php
                        the_title('<h3 class="bookify__title">', '</h3>');
                        if ($bookify_postmeta['bop_subtitle']) :
                        ?>
                            <div class="bookify__subtitle">
                                <?php echo esc_html($bookify_postmeta['bop_subtitle']) ?>
                            </div>
                        <?php endif; ?>
                        <div class="bookify__price">
                            <span>$<?php echo esc_html($bookify_postmeta['bop_book_sale_price']) ?></span>
                            $<?php echo esc_html($bookify_postmeta['bop_book_regular_price']) ?>
                        </div>
                        <div class="bookify__details">
                            <ul>
                                <li>
                                    <b><i class="fa-regular fa-object-ungroup"></i>Format:</b>
                                    <?php echo esc_html($bookify_postmeta['book_format']['bop_book_format']) ?>
                                </li>

                                <li>
                                    <b><i class="fa-solid fa-bars"></i>Series:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_book_regular_price']) ?>
                                </li>

                                <li>
                                    <b><i class="fa-solid fa-circle-user"></i>Author:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_author']) ?>
                                </li>

                                <li>
                                    <b><i class="fa-solid fa-list-ul"></i>Category:</b>
                                    <?php
                                    $categories = get_the_terms(get_the_ID(), 'bookify_category'); // Replace 'your_custom_taxonomy' with your actual custom taxonomy name
                                    if ($categories && !is_wp_error($categories)) {
                                        echo '<ul>';
                                        foreach ($categories as $category) {
                                            echo '<li><a href="' . esc_url(get_term_link($category)) . '">' . esc_html($category->name).',' . '</a></li>';
                                            // You can customize the output as needed
                                        }
                                        echo '</ul>';
                                    }
                                    ?>

                                </li>

                                <li>
                                    <b><i class="fa-solid fa-book-open-reader"></i>Reading Age:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_book_regular_price']) ?>
                                </li>

                                <li>
                                    <b><i class="fa-solid fa-building"></i>Publisher:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_publisher']) ?>
                                </li>

                                <li>
                                    <b><i class="fa-solid fa-calendar-days"></i>Published:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_publish_date']) ?>
                                </li>

                                <li>
                                    <b><i class="fa-solid fa-barcode"></i>ISBN:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_book_isbn']) ?>
                                </li>
                                <li>
                                    <b><i class="fa-solid fa-barcode"></i>ISBN 10:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_book_isbn_10']) ?>
                                </li>
                                <li>
                                    <b><i class="fa-solid fa-barcode"></i>ISBN 13:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_book_isbn_13']) ?>
                                </li>

                                <li>
                                    <b><i class="fa-solid fa-barcode"></i>ASIN:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_book_asin']) ?>
                                </li>
                                <li>
                                    <b><i class="fa-solid fa-globe"></i>Language:</b>
                                    <?php echo esc_html($bookify_postmeta['bop_book_language']) ?>
                                </li>
                                <?php if ('text' == $bookify_postmeta['book_format']['bop_book_format']) : ?>
                                    <li>
                                        <b><i class="fa-solid fa-file-lines"></i>Pages:</b>
                                        <?php echo esc_html($bookify_postmeta['book_format']['bop_book_page']) ?>
                                    </li>
                                <?php endif; ?>
                                <?php if ('text' == $bookify_postmeta['book_format']['bop_book_format']) : ?>
                                    <li>
                                        <b><i class="fa-solid fa-file-lines"></i>Dimension:</b>
                                        <?php echo esc_html($bookify_postmeta['book_format']['bop_book_dimension']) ?>
                                    </li>
                                <?php endif; ?>
                                <?php if ('text' == $bookify_postmeta['book_format']['bop_book_format']) : ?>
                                    <li>
                                        <b><i class="fa-solid fa-file-lines"></i>Weight:</b>
                                        <?php echo esc_html($bookify_postmeta['book_format']['bop_book_weight']) ?>
                                    </li>
                                <?php endif; ?>
                                <?php if ('text' != $bookify_postmeta['book_format']['bop_book_format']) : ?>
                                    <li>
                                        <b><i class="fa-solid fa-file"></i>File Size:</b>
                                        <?php echo esc_html($bookify_postmeta['book_format']['bop_book_file_size']) ?>
                                    </li>
                                <?php endif; ?>
                                <?php if ('text' != $bookify_postmeta['book_format']['bop_book_format']) : ?>
                                    <li>
                                        <b><i class="fa-solid fa-file"></i>File Format: </b>
                                        <?php echo esc_html($bookify_postmeta['book_format']['bop_book_file_format']) ?>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="bookify__description">
                        <div class="bookify__description__title">
                            <b><i class="fa-solid fa-pencil"></i>Description:</b>
                        </div>
                        <hr />
                        <div class="bookify__description__content">
                            <?php the_content(); ?>
                        </div>
                        <div class="bookify__item__name">
                            Book Gallery
                        </div>
                        <div class="bookify__abarage__rating">
                            <span>Average rating:</span>
                            <div class="bookify__rating">
                                <?php if (1 == $bookify_postmeta['bop_book_rating']) : ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                                <?php if (2 == $bookify_postmeta['bop_book_rating']) : ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                                <?php if (3 == $bookify_postmeta['bop_book_rating']) : ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="far fa-star"></i>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                                <?php if (4 == $bookify_postmeta['bop_book_rating']) : ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="far fa-star"></i>
                                <?php endif; ?>
                                <?php if (5 == $bookify_postmeta['bop_book_rating']) : ?>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                <?php endif; ?>
                            </div>
                            <span><?php echo esc_html($bookify_postmeta['bop_book_rating']) ?> reviews</span>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
        ?>
    </div>
</section>


<?php
get_footer(); // Include your footer template
