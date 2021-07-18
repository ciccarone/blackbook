<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package blackbook
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php

		$header_image = get_field('header_image') ? get_field('header_image') : false;
		if (!$header_image) {
			$term_list = wp_get_post_terms($post->ID, 'category', ['fields' => 'all']);
			foreach($term_list as $term) {
			   if( get_post_meta($post->ID, '_yoast_wpseo_primary_category',true) == $term->term_id ) {
					 $header_image = get_field('category_image', 'category_'.$term->term_id)['url'];
			   } else {
					 $header_image = get_field('category_image', 'category_'.$term_list[0]->term_taxonomy_id)['url'];
				 }
			}
		}
	?>
	<header class="page-header frame d-flex py-5" style="background-image: url('<?php echo $header_image ?>')">
		<div class="container d-flex">
			<div class="row align-items-center align-content-center">
				<?php

				the_title( '<h1 class="page-title giant">', '</h1>' );
				the_excerpt( '<div class="archive-description">', '</div>' );
				if ( function_exists('yoast_breadcrumb') ) {
    			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
				}
				?>
			</div>

		</div>

	</header><!-- .page-header -->

	<div class="container py-5">
		<div class="row">
			<div class="col-md-9">
				<h3>About</h3>
				<?php
				the_content();

				if ($photo_gallery = get_field('photo_gallery')) {?>
					<h3 class="mt-5">Image Gallery</h3>
					<div class="grid">
						<?php foreach ($photo_gallery as $key => $value): ?>
							<a href="<?php echo $value['sizes']['large'];?>" class="grid__item frame" style="background-image: url('<?php echo $value['sizes']['medium'] ?>')">
							<!-- <img src="<?php echo $value['sizes']['medium_large'] ?>" class="d-block w-100" alt="..."> -->
						</a>
						<?php endforeach; ?>
					</div>

				<?php }

				?>

			</div>
			<div class="col-md-3">
				<?php get_sidebar();?>
			</div>
		</div>
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
