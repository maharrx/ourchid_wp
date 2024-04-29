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
				
				<section class="clearfix mxn3">	
					
					<div class="sm-col sm-col-12 md-col-12 lg-col-9 px3 pb3">
						<?php the_content(); ?>
					</div>

					<!-- show the investigators of this research project -->
					<div class="sm-col sm-col-12 md-col-12 lg-col-3 px3 pb3">
						<?php
							$entries = get_post_meta( get_the_ID(), 'investigators_select', true );
							$the_query = new WP_Query(array('post_type' => 'members','post__in' => $entries));
						?>

						<?php if ( $the_query->have_posts() ):?>
							<div class="clearfix">
								<h2 class="m0 p0 pb3">Investigators</h2>
							</div>
							
							<!-- // Load posts loop. -->
							<div class="investigators clearfix mxn3 pb3">
								<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>	
									
									<div class="center col col-sm-4 col-md-12 px3">

										<div class="bg-default shadow p3 center">
						
											<div class="">
												<figure class="circle mx-auto">                           
													<?php if( has_post_thumbnail() ):?>
														<?php the_post_thumbnail('medium', array('class' => 'block mx-auto circle')); ?>
													<?php else: ?>
														<p class="mx-auto flex-auto block"><?php the_title(); ?></p>
													<?php endif; ?>
												</figure>
											</div>
												
											<div class=" center">
												<h4 class="m0 mb2"><?php the_title(); ?></h4>
												<?php the_content(); ?>
											</div>
											
										</div>	

									</div>

								<?php endwhile; ?>				
							</div>		

						<?php  else: ?>
							<?php echo "No content found!"; ?>								
						<?php endif; ?>

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
