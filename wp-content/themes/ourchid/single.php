<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header(); ?>

<main class="max-width-4 mx-auto px3 pb3">        
<?php if ( have_posts() ):?>
	<!-- // Load posts loop. -->
	<?php while ( have_posts() ) : the_post(); ?>
	
		<div class="relative">

			<button class=" btn btn-back right circle center z4 sticky" on="tap:AMP.goBack(navigate=true)">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
			</button>

			<?php the_content(); ?>
		</div>
		<!-- // get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) ); -->
		<!-- // the_title(); -->
	<?php endwhile; ?>
	<!-- // Previous/next page navigation.
	// twenty_twenty_one_the_posts_navigation(); -->
	<?php  else: ?>
	<!-- // If no content, include the "No posts found" template.
	// get_template_part( 'template-parts/content/content-none' ); -->
	<?php echo "No content found!"; ?>

<?php endif; ?>
</main>

<?php get_footer(); ?>
