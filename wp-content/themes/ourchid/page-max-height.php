<?php
/**
 * Template Name: Max-height
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
	

		<section class="max-width-4 mx-auto px3">        
            
				<?php if ( is_front_page() ) : ?>
			<div id="" class="max-height clearfix mxn3 md-flex items-center">
                <div class="md-col md-col-5 center px3">
                    <div class="profile-picture mx-auto">
					<?php
						echo get_the_post_thumbnail($post->ID, 'large', array('title' => 'Raju Maharjan', 'class' => 'profile-picture circle',));
					?>
                    </div>
                </div>
                <div class="md-col md-col-7 px3">
					<?php the_content(); ?>
                </div>
			</div>
				<?php else: ?>
			<div id="" class="max-height clearfix mxn3 flex items-center">				
					<div class="md-col md-col-12 mx-auto center px3">
					<?php the_content(); ?>
					</div>
				<?php endif; ?>
            </div>
		</section>   
	

<?php endwhile; ?>  
<!-- End of the loop. -->

<?php get_footer();?>
