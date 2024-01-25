<?php
/**
 * Social share
 *
 * This template can be overridden by copying it to yourtheme/bookify-pro-pro/templates/item/social-share.php
 *
 * @package    Bookify_Pro
 * @subpackage Bookify_Pro/public
 */

?>
<div class="bookify__item__socail-share">
<?php
do_action( 'bop_add_first_socials' );
foreach ( $social_share_media as $style_key => $style_value ) {
	switch ( $style_value ) {
		case 'facebook':
			?>
			<a title="<?php echo esc_html( 'Facebook', 'bookify-pro' ); ?>"  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url(get_the_permalink( $post )); ?>" class="bop-social-icon bop-facebook <?php echo esc_attr( $social_icon_shape ); ?>" onClick="window.open('https://www.facebook.com/sharer.php?u=<?php echo esc_url(get_the_permalink( $post )); ?>','Facebook','width=450,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" ><i class="fab fa-facebook-f"></i></a>
			<?php
			break;
		case 'twitter':
			?>
			<a title="<?php echo esc_html( 'Twitter', 'bookify-pro' ); ?>" onClick="window.open('https://twitter.com/share?url=<?php echo esc_url(get_the_permalink( $post )); ?>&amp;text=<?php echo esc_html(get_the_title( $post )); ?>','Twitter share','width=450,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://twitter.com/share?url=<?php echo esc_url(get_the_permalink( $post )); ?>&amp;text=<?php echo esc_html(get_the_title( $post )); ?>" class="bop-social-icon bop-twitter <?php echo esc_attr( $social_icon_shape ); ?>"> <i class="fab fa-twitter"></i></a>
			<?php
			break;
		case 'linkedIn':
			?>
			<a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(get_the_permalink( $post )); ?>" title="<?php echo esc_html( 'linkedIn', 'bookify-pro' ); ?>" class="bop-social-icon bop-linkedin <?php echo esc_attr( $social_icon_shape ); ?>" onClick="window.open('https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(get_the_permalink( $post )); ?>','Linkedin','width=450,height=300,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo esc_url(get_the_permalink( $post )); ?>"> <i class="fab fa-linkedin-in"></i></a>
			<?php
			break;
		case 'pinterest':
			?>
			<a href='javascript:void((function()%7Bvar%20e=document.createElement(&apos;script&apos;);e.setAttribute(&apos;type&apos;,&apos;text/javascript&apos;);e.setAttribute(&apos;charset&apos;,&apos;UTF-8&apos;);e.setAttribute(&apos;src&apos;,&apos;https://assets.pinterest.com/js/pinmarklet.js?r=&apos;+Math.random()*99999999);document.body.appendChild(e)%7D)());' class="bop-social-icon bop-pinterest <?php echo esc_attr( $social_icon_shape ); ?>" title="<?php echo esc_html( 'Pinterest', 'bookify-pro' ); ?>"> <i class="fab fa-pinterest"></i></a>
			<?php
			break;
		case 'email':
			?>
			<a href="mailto:?Subject=<?php echo esc_html(get_the_title( $post )); ?>&amp;Body=<?php echo esc_url(get_the_permalink( $post )); ?>" title="<?php echo esc_html( 'Email', 'bookify-pro' ); ?>" class="bop-social-icon bop-envelope <?php echo esc_attr( $social_icon_shape ); ?>"> <i class="far fa-envelope"></i></a>
			<?php
			break;
		case 'instagram':
			?>
				<a title="<?php echo esc_html( 'Instagram', 'bookify-pro' ); ?>" onClick="window.open('https://instagram.com/?url=<?php echo esc_url(get_the_permalink( $post )); ?>&amp;text=<?php echo esc_html(get_the_title( $post )); ?>','Twitter share','width=450,height=300,left='+(screen.availWidth/2-300)+',top='+(screen.availHeight/2-150)+''); return false;" href="https://instagram.com/?url=<?php echo esc_url(get_the_permalink( $post )); ?>&amp;text=<?php echo esc_html(get_the_title( $post )); ?>" class="bop-social-icon bop-instagram <?php echo esc_attr( $social_icon_shape ); ?>"> <i class="fab fa-instagram" aria-hidden="true"></i></a>
				<?php
			break;
		case 'whatsapp':
			?>
			<a href="https://api.whatsapp.com/send?text=<?php echo esc_html(get_the_title( $post )); ?>%20<?php echo esc_url(get_the_permalink( $post )); ?>" onClick="window.open('https://api.whatsapp.com/send?text=<?php echo esc_html(get_the_title( $post )); ?>%20<?php echo esc_url(get_the_permalink( $post )); ?>','whatsapp','width=450,height=300,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" title="<?php echo esc_html( 'WhatsApp', 'bookify-pro' ); ?>" class="bop-social-icon bop-whatsapp <?php echo esc_attr( $social_icon_shape ); ?>"> <i class="fab fa-whatsapp"></i></a>
			<?php
			break;
		case 'reddit':
			?>
			<a href="https://reddit.com/submit?url=<?php echo esc_url(get_the_permalink( $post )); ?>&amp;title=<?php echo esc_html(get_the_title( $post )); ?>" onClick="window.open('https://reddit.com/submit?url=<?php echo esc_url(get_the_permalink( $post )); ?>&amp;title=<?php echo esc_html(get_the_title( $post )); ?>','reddit','width=450,height=300,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" title="<?php echo esc_html( 'Reddit', 'bookify-pro' ); ?>"  class="bop-social-icon bop-reddit <?php echo esc_attr( $social_icon_shape ); ?>"> <i class="fab fa-reddit"></i></a>
			<?php
			break;
		case 'tumblr':
			?>
			<a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo esc_url(get_the_permalink( $post )); ?>&amp;title=<?php echo esc_html(get_the_title( $post )); ?>" title="<?php echo esc_html( 'tumblr', 'bookify-pro' ); ?>" onClick="window.open('https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo esc_url(get_the_permalink( $post )); ?>&amp;title=<?php echo esc_html(get_the_title( $post )); ?>','tumblr','width=450,height=300,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" class="bop-social-icon bop-tumblr <?php echo esc_attr( $social_icon_shape ); ?>"><i class="fab fa-tumblr"></i></a>
			<?php
			break;
		case 'digg':
			?>
			<a href="https://digg.com/submit?url=<?php echo esc_url(get_the_permalink( $post )); ?>%&amp;title=<?php echo esc_html(get_the_title( $post )); ?>" onClick="window.open('https://digg.com/submit?url=<?php echo esc_url(get_the_permalink( $post )); ?>%&amp;title=<?php echo esc_html(get_the_title( $post )); ?>','Digg','width=450,height=300,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" title="<?php echo esc_html( 'digg', 'bookify-pro' ); ?>" class="bop-social-icon bop-digg <?php echo esc_attr( $social_icon_shape ); ?>"><i class="fab fa-digg"></i></a>
			<?php
			break;
		case 'vk':
			?>
			<a href="https://vk.com/share.php?url=<?php echo esc_url(get_the_permalink( $post )); ?>&amp;title=<?php echo esc_html(get_the_title( $post )); ?>&amp;comment="  title="<?php echo esc_html( 'VK', 'bookify-pro' ); ?>" onClick="window.open('https://vk.com/share.php','VK','width=450,height=300,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;" class="bop-social-icon bop-vk <?php echo esc_attr( $social_icon_shape ); ?>"> <i class="fab fa-vk"></i></a>
			<?php
			break;
		case 'xing':
			?>
			<a href="https://www.xing.com/spi/shares/new?url=<?php echo esc_url(get_the_permalink( $post )); ?>" onClick="window.open('https://www.xing.com/spi/shares/new?url=<?php echo esc_url(get_the_permalink( $post )); ?>','xing','width=450,height=300,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;"  title="<?php echo esc_html( 'Xing', 'bookify-pro' ); ?>" class="bop-social-icon bop-xing <?php echo esc_attr( $social_icon_shape ); ?>"><i class="fab fa-xing"></i></a>
			<?php
			break;
		case 'pocket':
			?>
			<a href="https://getpocket.com/edit?url=<?php echo esc_url(get_the_permalink( $post )); ?>" onClick="window.open('https://getpocket.com/edit?url=<?php echo esc_url(get_the_permalink( $post )); ?>','ocket','width=450,height=300,left='+(screen.availWidth/2-431)+',top='+(screen.availHeight/2-250)+''); return false;"  title="<?php echo esc_html( 'Pocket', 'bookify-pro' ); ?>" class="bop-social-icon bop-pocket <?php echo esc_attr( $social_icon_shape ); ?>"> <i class="fab fa-get-pocket"></i></a>
			<?php
			break;
	}
}
do_action( 'bop_add_last_socials' );
?>
</div>
<?php
