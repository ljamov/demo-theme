<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Demo_Theme
 */

?>

	<footer id="colophon" class="site-footer section--padding">
		<div class="site-footer__top">
			<div class="container">
				<div class="row align-items-center">

					<div class="col-lg-3">
						<?php if ( is_active_sidebar( 'footer_logo_widget' ) ) : ?>
							
							<?php dynamic_sidebar( 'footer_logo_widget' ); ?>
							
						<?php endif; ?>
					</div>

					<div class="col-lg-6">
						<nav class="primary-menu primary-menu--silver footer-menu">
							<?php
								wp_nav_menu(
									array(
										'theme_location' => 'footer-menu',
										'menu_id'        => 'primary-menu',
									)
								);
							?>
						</nav>
					</div>

					<div class="col-lg-3">
						<?php demo_theme_social_bottom_menu(); ?>
					</div>

				</div>
			</div>	
		</div>
		
		<div class="site-footer__bottom">
			<div class="container">
				<?php if ( is_active_sidebar( 'footer_copyright_widget' ) ) : ?>
	
					<?php dynamic_sidebar( 'footer_copyright_widget' ); ?>

				<?php endif; ?>
			</div>				
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
