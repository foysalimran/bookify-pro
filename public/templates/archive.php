<?php
/*
Template Name: Category Archive
*/
get_header();

$options                = get_option( 'ta_bookify_settings' );
$title                  = $options['bop_title']; // Title
$subtitle               = $options['bop_subtitle'];
$bop_single_book_fildes = $options['bop_single_book_fildes'];
?>

<div class="bookify_category">
	<div class="container">
		<div class="ta-row">
			<?php
			$show_pagination = true;
			$args            = array(
				'post_type'      => 'bookify',
				'posts_per_page' => 6,
				'post_status'    => 'publish',
				'paged'          => $paged,
			);
			$bookify_query   = new WP_Query( $args );
			if ( $bookify_query->have_posts() ) :
				while ( $bookify_query->have_posts() ) :
					$bookify_query->the_post();
					$bookify_postmeta = get_post_meta( get_the_ID(), 'ta_bookify_postmeta', true );

					// Get the permalink for the post/page
					$permalink = get_permalink();
					?>

					<div class="ta-col-xs-1 ta-col-sm-2 ta-col-md-2 ta-col-lg-3 ta-col-xl-3 bop-added">
						<div class="bookify__item bop-item-1701" data-id="1701">
							<div class="bookify__item--thumbnail">
								<?php
								if ( has_post_thumbnail() ) {
									// Wrap the image in an anchor tag with the permalink
									echo '<a href="' . esc_url( $permalink ) . '">';
									the_post_thumbnail( 'large' ); // You can change 'large' to other image sizes
									echo '</a>';
								}
								?>

							</div>
							<?php
							if ( $title ) {
								// Output the title with a link
								echo '<h2 class="bookify__item--title"><a href="' . esc_url( $permalink ) . '">' . esc_html( get_the_title() ) . '</a></h2>';
							}

							?>

							<h4 class="bookify__item--subtitle">
								<?php
								if ( $subtitle ) :
									?>
									<div class="bookify__subtitle">
										<?php echo esc_html( $bookify_postmeta['bop_subtitle'] ); ?>
									</div>
								<?php endif; ?>
							</h4>
							<div class="bookify__item__category">
								<?php

								$categories = get_the_terms( get_the_ID(), 'bookify_category' );
								if ( $categories && ! is_wp_error( $categories ) ) {
									echo '<ul>';
									foreach ( $categories as $category ) {
										echo '<li><a href="' . esc_url( get_term_link( $category ) ) . '">' . esc_html( $category->name ) . ',' . '</a></li>';
									}
									echo '</ul>';
								}

								?>

							</div>
							<div class="bookify__item--meta">
								<ul>
									<li><i class="fas fa-user"></i><?php echo esc_html( $bookify_postmeta['bop_author'] ); ?></li>
									<li><i class="far fa-calendar-alt"></i><?php echo esc_html( $bookify_postmeta['bop_publish_date'] ); ?></li>
									<li><i class="fas fa-language"></i><?php echo esc_html( $bookify_postmeta['bop_book_language'] ); ?></li>
								</ul>
							</div>
							<div class="bookify__item__content">
							<?php echo esc_html( get_the_excerpt() ); ?>
							</div>
							<div class="bookify__item__content__readmore">
								<a class="bookify__item__btn" target="_self" href="<?php echo esc_url( get_permalink() ); ?>" rel="nofollow">
									<?php echo esc_html__( 'Read More', 'bookify-pro' ); ?>
								</a>
							</div>
						</div>
					</div>
					<?php
				endwhile;
			else :
				echo esc_html__( 'None', 'bookify-pro' );
			endif;

			$bop_query     = $bookify_query;
			$view_options  = '';
			$layout        = array( 'bop_layout_preset' => 'grid_layout' );
			$layout_preset = 'grid_layout';

			if ( is_archive() ) {
				require BOP_Functions::bop_locate_template( 'pagination.php' );
			}
			?>


		</div>
	</div>
</div>
<?php





get_footer();
