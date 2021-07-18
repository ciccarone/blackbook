<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blackbook
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="container py-5">
			<div class="row">
				<div class="col-md-5">
					<img src="/wp-content/uploads/2021/07/the-black-book-logo@3x.png" alt="" class="logo">
					<p>The Black Book was created with the purpose of finding a way for the public to locate Black crafters in our community. The idea was to help consumers find and support Black crafters in the community.</p>
					<?php
					wp_nav_menu(array(
							'theme_location' => 'main-menu',
							'container' => false,
							'menu_class' => '',
							'fallback_cb' => '__return_false',
							'items_wrap' => '%3$s',
							'depth' => 2,
							// 'walker' => new bootstrap_5_wp_nav_menu_walker()
					));
					?>
				</div>
				<div class="col-md-6">

				</div>
			</div>
		</div>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
