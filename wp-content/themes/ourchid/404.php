<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>
<main>        
	<div class="max-width-4 mx-auto px3">
		
		<header class="intro">
			<h1><?php esc_html_e( 'Nothing here', 'twentytwentyone' ); ?></h1>
		</header>
		
		<section class="clearfix py3">	
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentytwentyone' ); ?></p>
			<?php get_search_form(); ?>
		</section>

	</div>
</main>


<?php
get_footer();
