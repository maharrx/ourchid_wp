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

<main>        
	<div class="container mx-auto px3">
		
		<?php if ( have_posts() ):?>
			<!-- // Load posts loop. -->
			<?php while ( have_posts() ) : the_post(); ?>	
				
				<header class="hero">
					<?php if( has_post_thumbnail() ):?>
						<div class="featured-image fullwidth">
							<figure class="clearfix">
								<?php the_post_thumbnail('full', array('class' => 'block mx-auto')); ?>
							</figure>
						</div>
					<?php endif; ?>

					<?php the_title('<h1>', '</h1>'); ?>
				</header>
				
				<section class="clearfix mxn3">	
					
					<div class="sm-col sm-col-12 md-col-12 lg-col-9 px3 pb3">
						<?php the_content(); ?>
					</div>

					<div class="sm-col sm-col-12 md-col-12 lg-col-3 px3 pb3">
						<!-- ger research sidebar-->
						<?php include get_template_directory() . '/_sidebar_research.php'; ?>
					</div>

				</section>	
				
			<?php endwhile; ?>				
			
		<?php  else: ?>
			
			<section class="clearfix">	
				<?php echo "No content found!"; ?>
			</section>

		<?php endif; ?>


	</div>	
</main>

<?php get_footer(); ?>
