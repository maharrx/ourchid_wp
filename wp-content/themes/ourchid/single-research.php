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
	<div class="max-width-4 mx-auto px3">
		
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
				
				<section class="clearfix">	
					<div class="clearfix">
						<div class="sm-col sm-col-12 md-col-8">
							<?php the_content(); ?>
						</div>
						<div class="sm-col sm-col-12 md-col-4">
							<?php
								$entries = get_post_meta( get_the_ID(), 'investigators_select', true );
								// print_r($entries);
								$the_query = new WP_Query(array('post_type' => 'members','post__in' => $entries));

								// The Loop.
								if ( $the_query->have_posts() ) {
									
									while ( $the_query->have_posts() ) {
										$the_query->the_post();
										// echo '<li>' . esc_html( get_the_title() ) . '</li>';
										
										echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
										echo get_the_post_thumbnail( get_the_ID(), 'full' );
										$content = apply_filters( 'the_content', get_the_content() );
										echo $content;

									}
									
								} else {
									esc_html_e( 'Sorry, no posts matched your criteria.' );
								}
								// Restore original Post Data.
								wp_reset_postdata();

							?>
						</div>

					</div>
				</section>	
				<!-- // get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) ); -->
				<!-- // the_title(); -->
			<?php endwhile; ?>				
			<!-- // Previous/next page navigation.
			// twenty_twenty_one_the_posts_navigation(); -->
		<?php  else: ?>
			<!-- // If no content, include the "No posts found" template.
			// get_template_part( 'template-parts/content/content-none' ); -->
			<section class="clearfix">	
				<?php echo "No content found!"; ?>
			</section>
		<?php endif; ?>

	</div>	
</main>

<?php get_footer(); ?>
