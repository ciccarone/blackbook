<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blackbook
 */

?>
<header class="page-header frame d-flex py-5 mb-5" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')">
	<div class="container d-flex">
		<div class="row align-items-center align-content-center">
			<?php

			the_title( '<h1 class="page-title giant">', '</h1>' );
			the_excerpt( '<div class="archive-description">', '</div>' );
			echo '<div class="entry-meta">';
				blackbook_posted_on();

			echo '</div>';
			?>
		</div>

	</div>

</header><!-- .page-header -->
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'blackbook' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blackbook' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php blackbook_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
