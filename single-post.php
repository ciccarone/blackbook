<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package blackbook
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php if ( have_posts() ) : ?>
		<?php $category = get_queried_object(); ?>
		<header class="page-header frame d-flex py-5" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')">
			<div class="container d-flex">
				<div class="row align-items-center align-content-center">
					<?php

					the_title( '<h1 class="page-title giant">', '</h1>' );
					echo '<div class="entry-meta">';
						blackbook_posted_on();

					echo '</div>';
					?>
				</div>

			</div>

		</header><!-- .page-header -->

		<div class="container py-5">
			<div class="row">
				<div class="col-md-9">
					<?php
					the_content();

					?>

				</div>
				<div class="col-md-3">
					<?php if ( is_active_sidebar( 'blog_widgets' ) ) : ?>
						<div id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
							<?php dynamic_sidebar( 'blog_widgets' ); ?>
						</div><!-- #primary-sidebar -->
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="container py-5">
			<div class="row row-cols-1 row-cols-md-3 g-4">



		<?php
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			/*
			 * Include the Post-Type-specific template for the content.
			 * If you want to override this in a child theme, then include a file
			 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
			 */
			get_template_part( 'template-parts/content-archive', get_post_type() );

		endwhile;

		the_posts_navigation();

	else :

		get_template_part( 'template-parts/content', 'none' );

	endif;
	?>

</div></div>

</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
