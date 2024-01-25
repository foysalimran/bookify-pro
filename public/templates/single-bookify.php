<?php
get_header(); // Include your header template
$options                = get_option( 'ta_bookify_settings' );
$title                  = $options['bop_title']; // Title
$subtitle               = $options['bop_subtitle']; // Title
$bop_single_book_fildes = $options['bop_single_book_fildes']; // Title
?>

<section class="bookify bookify_single bookify__single">
	<div class="container">
		<?php
		while ( have_posts() ) :
			the_post();
			$bookify_postmeta = get_post_meta( get_the_ID(), 'ta_bookify_postmeta', true );
			?>
			<div class="ta-row">
				<div class="ta-col-xl-2 col-xs-1">
					<div class="bookify__item__img">
						<?php
						if ( has_post_thumbnail() ) {
							echo '<div class="featured-image">';
							the_post_thumbnail( 'large' ); // You can change 'large' to other image sizes
							echo '</div>';
						}
						?>
					</div>
				</div>
				<div class="ta-col-xl-2 col-xs-1">
					<div class="bookify__content">
						<?php
						if ( $title ) {
							the_title( '<h3 class="bookify__title">', '</h3>' );
						}
						if ( $bookify_postmeta['bop_subtitle'] && $subtitle ) :
							?>
							<div class="bookify__subtitle">
								<?php echo esc_html( $bookify_postmeta['bop_subtitle'] ); ?>
							</div>
						<?php endif; ?>
						<div class="bookify__details">
							<ul>
								<?php
								foreach ( $bop_single_book_fildes as $bop_single_book_filde ) {
									$book_fildes = $bop_single_book_filde['select_single_book_fildes'];
									$before_text = isset( $bop_single_book_filde['bop_before_text'] ) ? $bop_single_book_filde['bop_before_text'] : '';

									$meta_icon = ! empty( $bop_single_book_filde['select_single_book_fildes_icon'] ) ? sprintf( '<i class="' . $bop_single_book_filde['select_single_book_fildes_icon'] . '"></i>' ) : '';

									$allowed_html = array(
										'a'    => array(
											'href'  => array(),
											'title' => array(),
										),
										'i'    => array(
											'class' => array(),
											'id'    => array(),
										),
										'span' => array(
											'class' => array(),
											'id'    => array(),
										),
										'div'  => array(
											'class' => array(),
											'id'    => array(),
										),
									);

									switch ( $book_fildes ) {

										case 'book_author':
											if ( $bookify_postmeta['bop_author'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_author'] );
												echo '</li>';
											}
											break;
										case 'publisher':
											if ( $bookify_postmeta['bop_publisher'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_publisher'] );
												echo '</li>';
											}

											break;
										case 'publish_date':
											if ( $bookify_postmeta['bop_publish_date'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_publish_date'] );
												echo '</li>';
											}

											break;
										case 'price':
											if ( $bookify_postmeta['bop_book_regular_price'] || $bookify_postmeta['bop_book_sale_price'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo '<del>' . esc_html( $bookify_postmeta['bop_book_sale_price'] ) . '</del>';
												echo '-';
												echo esc_html( $bookify_postmeta['bop_book_regular_price'] );

												echo '</li>';
											}
											break;

										case 'category':
											$categories = get_the_terms( get_the_ID(), 'bookify_category' );
											if ( $categories && ! is_wp_error( $categories ) ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo '<ul>';
												foreach ( $categories as $category ) {
													echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . ',' . '</a></li>';
												}
												echo '</ul>';
												echo '</li>';
											}

											break;
										case 'isbn':
											if ( $bookify_postmeta['bop_book_isbn'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_book_isbn'] );
												echo '</li>';
											}

											break;
										case 'isbn_10':
											if ( $bookify_postmeta['bop_book_isbn_10'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_book_isbn_10'] );
												echo '</li>';
											}

											break;
										case 'isbn_13':
											if ( $bookify_postmeta['bop_book_isbn_13'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_book_isbn_13'] );
												echo '</li>';
											}

											break;
										case 'asin':
											if ( $bookify_postmeta['bop_book_asin'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_book_asin'] );
												echo '</li>';
											}

											break;
										case 'subject':
											if ( $bookify_postmeta['bop_book_subject'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_book_subject'] );
												echo '</li>';
											}

											break;
										case 'genre':
											if ( $bookify_postmeta['bop_book_genre'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_book_genre'] );
												echo '</li>';
											}

											break;
										case 'country':
											if ( $bookify_postmeta['bop_country'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_country'] );
												echo '</li>';
											}

											break;
										case 'book_language':
											if ( $bookify_postmeta['bop_book_language'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_book_language'] );
												echo '</li>';
											}

											break;
										case 'translator_name':
											if ( $bookify_postmeta['bop_book_translator_name'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['bop_book_translator_name'] );
												echo '</li>';
											}

											break;
										case 'book_format':
											if ( $bookify_postmeta['book_format']['bop_book_format'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												echo esc_html( $bookify_postmeta['book_format']['bop_book_format'] );
												echo '</li>';
											}

											break;
										case 'rating':
											if ( $bookify_postmeta['bop_book_rating'] ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												// echo esc_html($bookify_postmeta['bop_book_rating']);
												?>
												<div class="bookify__abarage__rating">
													<div class="bookify__rating">
														<?php if ( 1 == $bookify_postmeta['bop_book_rating'] ) : ?>
															<i class="fas fa-star"></i>
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
														<?php endif; ?>
														<?php if ( 2 == $bookify_postmeta['bop_book_rating'] ) : ?>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
														<?php endif; ?>
														<?php if ( 3 == $bookify_postmeta['bop_book_rating'] ) : ?>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
															<i class="far fa-star"></i>
															<i class="far fa-star"></i>
														<?php endif; ?>
														<?php if ( 4 == $bookify_postmeta['bop_book_rating'] ) : ?>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
															<i class="far fa-star"></i>
														<?php endif; ?>
														<?php if ( 5 == $bookify_postmeta['bop_book_rating'] ) : ?>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
															<i class="fas fa-star"></i>
														<?php endif; ?>
													</div>
													<span><?php echo esc_html( $bookify_postmeta['bop_book_rating'] ); ?> reviews</span>
												</div>
												<?php
												echo '</li>';
											}

											break;
										case 'book_multiple_purchase_link':
											$purchase_links = $bookify_postmeta['bop_book_multiple_purchase_link'];
											if ( $purchase_links ) {
												echo '<li>';
												echo '<b>';
												echo wp_kses( $meta_icon, $allowed_html );
												if ( $before_text ) {
													echo esc_html( $before_text );
												}
												echo '</b>';
												foreach ( $purchase_links as $purchase_link ) {
													echo '<div>';
													echo '<button class="bookify_purchase_btn">';
													echo '<a href="' . esc_url( $purchase_link['bop_website_link'] ) . '">';
													if ( 'icon' == $purchase_link['bop_website_icon_or_image'] ) {
														echo '<i class="' . esc_attr( $purchase_link['bop_website_icon'] ) . '"></i>';
													} else {
														echo '<img src="' . esc_url( $purchase_link['bop_website_image']['url'] ) . '" alt="' . esc_html( $purchase_link['bop_website_image']['alt'] ) . '" />';
													}
													echo '<span>' . esc_html( $purchase_link['bop_website_text'] ) . '</span>';
													echo '</a>';
													echo '</button>';
													echo '</div>';
												}
												echo '</li>';
											}

											break;
									}
									?>


									<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-12 col-md-12 col-sm-12">
					<div class="bookify__description">
						<div class="bookify__description__title">
							<b><i class="fa-solid fa-pencil"></i><?php echo __( 'Description:', 'bookify-pro' ); ?></b>
						</div>
						<hr />
						<div class="bookify__description__content">
							<?php the_content(); ?>
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
