<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package blackbook
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function blackbook_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'blackbook_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function blackbook_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'blackbook_pingback_header' );

function category_cards()
{
	$categories = get_categories();
	$ret .= '<div class="container">';
	$ret .= '<div class="row">';
	foreach($categories as $category) {
		 $cat_image = get_field('category_image', 'category_'.$category->term_id)['url'] ? get_field('category_image', 'category_'.$category->term_id)['url'] : '/wp-content/uploads/2021/07/beauty-accessories-black-made.jpg';
	   $ret .= '<div class="col-md-4 py-2">';
			 $ret .= '<div class="card">';
				 $ret .= '<div class="frame" style="background-image: url('.$cat_image.')"></div>';

				 $ret .= '<div class="card-body">';
					 $ret .= '<h5 class="card-title">'.$category->name.'</h5>';
					 $ret .= '<p class="card-text">'.$category->description.'</p>';
				 $ret .= '</div>';
				 $ret .= '<div class="card-footer">';
					 $ret .= '<a href="' . get_category_link($category->term_id) . '">See Listings</a>';
				 $ret .= '</div>';
			 $ret .= '</div>';
		 $ret .= '</div>';
	}
	$ret .= '</div>';
	$ret .= '</div>';
	return $ret;
}

add_shortcode('category_cards', 'category_cards');

function listing_card()
{
	$term_list = wp_get_post_terms(get_the_ID(), 'category', ['fields' => 'all']);
	foreach($term_list as $term) {
		$term_slugs[] = 'cat-' . $term->slug;
	}
	// $header_image = get_field('header_image') ? get_field('header_image') : false;
	$ret .= '<div class="kitty-cat col-md-4 '.join($term_slugs, ' ').'">';
		$ret .= '<a class="card h-100" href="'.get_the_permalink().'">';
		$ret .= '<div class="card-header"><div class="logo text-center mx-auto py-2"><img src="'.get_the_post_thumbnail_url().'" alt="'.get_the_title().'" /></div></div>';



			$ret .= '<div class="card-body">';
				$ret .= '<h5 class="card-title text-center">'.get_the_title().'</h5>';
				$ret .= '<p class="card-text">'.get_the_excerpt().'</p>';
			$ret .= '</div>';
			// $ret .= '<div class="card-footer">';
				// $ret .= '<a href="' . get_the_permalink() . '">View</a>';
			// $ret .= '</div>';
		$ret .= '</a>';
	$ret .= '</div>';
	return $ret;
}

add_shortcode('listing_card', 'listing_card');

function listing_post()
{
	$term_list = wp_get_post_terms(get_the_ID(), 'category', ['fields' => 'all']);
	foreach($term_list as $term) {
		$term_slugs[] = 'cat-' . $term->slug;
	}
	// $header_image = get_field('header_image') ? get_field('header_image') : false;
	$ret .= '<div class="kitty-cat col-md-4 '.join($term_slugs, ' ').'">';
		$ret .= '<a class="card h-100" href="'.get_the_permalink().'">';
		$ret .= '<div class="card-header"><div class=""><img src="'.get_the_post_thumbnail_url().'" alt="'.get_the_title().'" /></div></div>';



			$ret .= '<div class="card-body">';

				$ret .= '<h5 class="card-title">'.get_the_title().'</h5>';
				$ret .= blackbook_posted_on_var();
				$ret .= '<p class="card-text">'.get_the_excerpt().'</p>';
			$ret .= '</div>';
			// $ret .= '<div class="card-footer">';
				// $ret .= '<a href="' . get_the_permalink() . '">View</a>';
			// $ret .= '</div>';
		$ret .= '</a>';
	$ret .= '</div>';
	return $ret;
}

add_shortcode('listing_post', 'listing_post');

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
	if( is_archive() && (is_category() || is_tag()) && empty( $query->query_vars['suppress_filters'] ) ) {
        $query->set('post_type','listing');
        return $query;
    }
}


function listing_info()
{
	$ret .= '<div class="card h-100">';
	$ret .= '<div class="card-header"><div class="logo text-center mx-auto py-2"><img src="'.get_the_post_thumbnail_url().'" alt="'.get_the_title().'" /></div></div>';



		$ret .= '<div class="card-body">';
			// $ret .= '<h5 class="card-title text-center">'.get_the_title().'</h5>';
			if ($excerpt = get_the_excerpt()) {
				$ret .= '<p class="card-text">'.$excerpt.'</p>';
			}

			if ($address = get_field('address')) {
				$ret .= '<p class="card-text">'.$address.'</p>';
				$ret .= '<iframe
  width="600"
  height="450"
  style="border:0"
  loading="lazy"
  allowfullscreen
  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB-Nnnf-aV6pHMDebklDYZRIEXWdrKfSOY
    &q='.$address.'">
</iframe>';
			}

		$ret .= '</div>';
		$ret .= '<div class="card-footer">';
			if ($url = get_field('url')) {
				$ret .= '<a href="' . $url . '" target="_blank">Visit Site</a>';
			}

		$ret .= '</div>';
	$ret .= '</div>';
	return $ret;
}

add_shortcode('listing_info', 'listing_info');


function all_listings()
{
	$args = array(
	    'post_type'      => 'listing',
	    'posts_per_page' => -1,
	);
	$loop = new WP_Query($args);
	$listings = [];
	while ( $loop->have_posts() ) {
	    $loop->the_post();
			$listings[] = listing_card();
	}
	$ret .= '<div class="container">';
		$ret .= '<div class="row">';
			$ret .= join($listings);
		$ret .= '</div>';
	$ret .= '</div>';
	return $ret;
}

add_shortcode('all_listings', 'all_listings');

function all_posts()
{
	$args = array(
	    'post_type'      => 'post',
	    'posts_per_page' => -1,
	);
	$loop = new WP_Query($args);
	$listings = [];
	while ( $loop->have_posts() ) {
	    $loop->the_post();
			$listings[] = listing_post();
	}
	$ret .= '<div class="container">';
		$ret .= '<div class="row">';
			$ret .= join($listings);
		$ret .= '</div>';
	$ret .= '</div>';
	return $ret;
}

add_shortcode('all_posts', 'all_posts');


function category_filter()
{
	$categories = get_categories();
	$options[] = '<option value="all" selected>All categories</option>';
	foreach($categories as $category) {
		$options[] = '<option value="'.$category->slug.'">'.$category->name.'</option>';
	}
	return '<div class="container pb-4"><select id="cat_filter">'.join($options).'</select></div>';
}

add_shortcode('category_filter', 'category_filter');


/**
 * Register our sidebars and widgetized areas.
 *
 */
function blackbook_blog_widget() {

	register_sidebar( array(
		'name'          => 'Blog Widgets',
		'id'            => 'blog_widgets',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'blackbook_blog_widget' );

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}


add_filter( 'wpseo_breadcrumb_links', 'wpse_100012_override_yoast_breadcrumb_trail' );

function wpse_100012_override_yoast_breadcrumb_trail( $links ) {
    global $post;

    if ( is_home() || is_singular( 'post' ) || is_archive() ) {
        $breadcrumb[] = array(
            'url' => '/blog',
            'text' => 'Blog',
        );

        array_splice( $links, 1, -2, $breadcrumb );
    }

    return $links;
}
