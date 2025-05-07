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


	<main>        
        <div class="container mx-auto px3">
		
		<?php if ( is_front_page() ) : ?>
			<header class="hero pb3">
				<h1 class="title mb0"><?php echo get_bloginfo( 'name' ); ?></h1>
				<h2 class="subtitle m0 mb2 p0"><?php echo get_bloginfo( 'description' ); ?></h2>
			</header>    

			<section class="clearfix">	
				<?php the_content();?>
			</section>


		<?php else: ?>
			
			<header class="hero">
				<?php the_title('<h1>', '</h1>'); ?>
			</header>
				
			<section class="clearfix">	
				<?php the_content();?>
			</div>
		<?php endif; ?>

        </div>    
	</main>   

<?php endwhile; ?>  
<!-- End of the loop. -->


<?php get_footer();?>
