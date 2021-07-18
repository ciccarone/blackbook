<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package blackbook
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'blackbook' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<nav class="navbar navbar-expand-lg py-4">
			  <div class="container-fluid">
					<div class="site-branding">
						<?php
						the_custom_logo();
						?>
					</div><!-- .site-branding -->
			    <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			      <span class="navbar-toggler-icon"></span>
			    </button>
			    <div class="collapse navbar-collapse flex-grow-1 text-right" id="navbarSupportedContent">
						<?php
						wp_nav_menu(array(
								'theme_location' => 'main-menu',
								'container' => false,
								'menu_class' => '',
								'fallback_cb' => '__return_false',
								'items_wrap' => '<ul id="%1$s" class="navbar-nav  ms-auto flex-nowrap %2$s">%3$s</ul>',
								'depth' => 2,
								'walker' => new bootstrap_5_wp_nav_menu_walker()
						));
						?>
				</div>
			  </div>
			</nav>


		</div>
	</header><!-- #masthead -->
