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


<nav class="navbar px3 z4 sticky">
	<div class="container mx-auto flex items-center" >	
		
		<div class="navbar-brand flex-auto">		
			<a class="h2 block py2" href="<?php echo get_bloginfo( 'url' ); ?>"><?php echo get_bloginfo( 'name' ); ?> Lab</a>
		</div>		
		
		<div class="nav-container">
			<ul class="navbar-nav list-reset m0 py2 mxn2 sm-show">
				<?php
					if ( has_nav_menu( 'primary-menu' ) ) {

						wp_nav_menu(
							array(
								'container'  => '',
								'items_wrap' => '%3$s',
								'theme_location' => 'primary-menu',
								'add_li_class'  => 'inline-block m0 mx2'
							)
						);
					} 
				?>
			</ul>
		</div>	
		
		<!-- mobile navigation toggle -->
		<div role="button" aria-label="open sidebar" on="tap:sidebar.toggle" tabindex="0" class="sm-hide py2">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="36" viewBox="0 0 24 24" class="block"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z"></path></svg>
		</div>

	</div>	
</nav>



	<!-- mobile navigation sidebar -->
	<amp-sidebar id="sidebar" layout="nodisplay" side="right" class="">
							
		<div role="button" aria-label="close sidebar" on="tap:sidebar.toggle" tabindex="0" class="col-12 py4 center white">✕</div>
						
			<ul class="sidebar primary-menu list-reset m0 col-12">
				<?php
					if ( has_nav_menu( 'primary-menu' ) ) {
						wp_nav_menu(
							array(
								'container'  => '',
								'items_wrap' => '%3$s',
								'theme_location' => 'primary-menu',
								'add_li_class'  => 'block py1 m0 center'
							)
						);
					} 
				?>
			</ul>
			
	</amp-sidebar>