<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
<!doctype html>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> >

<?php wp_body_open(); ?>

<header class="sticky py1 z4">

	<div class="max-width-4 mx-auto px3">
	<nav class="flex justify-start flex-center mxn3">
		
		<!-- desktop navigation if not homepage-->
	
		<div class="header-site-title flex-auto px3">
			<?php if ( !is_front_page() ) : ?><!-- <h1 class="my2"></h1> -->		
				<a class="h1 title m0" href="<?php echo get_bloginfo( 'url' ); ?>"><?php echo get_bloginfo( 'name' ); ?></a>
			<?php endif; ?>
		</div>
		
		
		<div class="navigation-wrapper lg-show px3">
			<ul class="primary-menu list-reset m0 p0">
				<?php
					if ( has_nav_menu( 'primary-menu' ) ) {

						wp_nav_menu(
							array(
								'container'  => '',
								'items_wrap' => '%3$s',
								'theme_location' => 'primary-menu',
							)
						);
					} 
				?>
			</ul>
		</div>	

		
		<!-- mobile navigation toggle -->
		<div role="button" aria-label="open sidebar" on="tap:sidebar.toggle" tabindex="0" class="lg-hide p2 px3">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" class="block"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path></svg>
		</div>

	</nav>
	</div>
		

</header>

	<!-- mobile navigation sidebar -->
	<amp-sidebar id="sidebar" layout="nodisplay" side="right" class="">
							
		<div role="button" aria-label="close sidebar" on="tap:sidebar.toggle" tabindex="0" class="col-12 py4 center white">✕</div>
						
			<ul class="primary-menu list-reset m0 col-12">
				<?php
					if ( has_nav_menu( 'primary-menu' ) ) {
						wp_nav_menu(
							array(
								'container'  => '',
								'items_wrap' => '%3$s',
								'theme_location' => 'primary-menu',
							)
						);
					} 
				?>
			</ul>
			
	</amp-sidebar>