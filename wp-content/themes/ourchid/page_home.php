

<?php
/* Template Name: Home Page */ 
/**
 * The template for displaying home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>

<!-- Start the Loop -->

<!-- Start the Loop -->

<!-- Start the Loop -->

<!-- Start the Loop -->
<!-- Start the Loop -->
<?php while ( have_posts() ) : the_post(); ?>

	<!-- <div class="light z4">
	    <div class="wire"></div>
	    <div class="bulb">
	        <span></span>
	        <span></span>
	    </div>
	</div> -->

	<main id="about" class="max-width-4 mx-auto px3 flex items-center">  
		
		<section>
			
			<h1 class="m0 p0 huge"><?php echo get_bloginfo( 'name' ); ?> </h1>
			<h2 class="p0"><?php echo get_bloginfo( 'description' ); ?></h2>        
			
			<?php the_content(); ?>

		</section>

	</main>

<?php endwhile; ?>  
<!-- End of the loop. -->

<?php get_footer();?>
