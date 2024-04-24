<?php
/**
 * The template for displaying all single posts
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
      
<?php while ( have_posts() ) : the_post(); ?>
	
	<main class="max-width-4 mx-auto px3">        
            
		<?php if ( is_front_page() ) : ?>			
			<h1 class="huge"><?php echo get_bloginfo( 'name' ); ?></h1>
			<h2><?php echo get_bloginfo( 'description' ); ?></h2>
                
		<?php else: ?>
			<div class="md-col md-col-12 mx-auto center px3">
				<?php the_title('<h1>', '</h1>'); ?>
				<?php the_content( '<h2>', '</h2>' );?>
			</div>
		<?php endif; ?>
            
	</main>   

<?php endwhile; ?>  
<!-- End of the loop. -->


<?php get_footer();?>
