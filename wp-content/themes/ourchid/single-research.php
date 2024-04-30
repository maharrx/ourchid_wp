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

					

					

					
					<div class="sidebar sm-col sm-col-12 md-col-12 lg-col-3 px3 pb3">
						
						
						<div class="funding clearfix mxn2 pb4">
							
							<h2 class="m0 px2 pb3">Funding</h2>
							<?php 
								$entries = get_post_meta( get_the_ID(), 'funding_repeat_group', true );

								foreach ( (array) $entries as $key => $entry ) {

									$img = $title = $desc = $caption = '';

									if ( isset( $entry['title'] ) ) {
										$title = esc_html( $entry['title'] );
									}

									if ( isset( $entry['url'] ) ) {
										$url = esc_html( $entry['url'] );
									}

									if ( isset( $entry['image_id'] ) ) {
										$img = wp_get_attachment_image( $entry['image_id'], 'share-pick', null, array(
											'class' => 'thumb block',
										) );
										
									}

									$caption = isset( $entry['image_caption'] ) ? wpautop( $entry['image_caption'] ) : '';
								?>		
								
								<div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb3">
									<a class="block border border-light" href="<?php echo $url; ?>" target="_blank">
										<?php echo ($img); ?>
									</a>
								</div>



							<?php	
								}
							?>

						</div>


						<!-- show the investigators of this research project -->
						<div class="investigators clearfix mxn2 pb4">
						<h2 class="m0 px2 pb3">Investigators</h2>

							<?php 
								//the PI
								$pi = get_post_meta( get_the_ID(), 'PI_select', true );							
								$pi_query = new WP_Query(array('post_type' => 'members','post__in' => array ($pi)) );
							?>
							<?php if ( $pi_query->have_posts() ):?>
								
								<?php while ( $pi_query->have_posts() ) : $pi_query->the_post(); ?>	
									
									<div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb3">

										<div class="profile bg-default shadow py3 px2 center pi">
																	
											<figure class="circle mx-auto">                           
												<?php if( has_post_thumbnail() ):?>
													<?php the_post_thumbnail('medium', array('class' => 'block mx-auto circle')); ?>
												<?php else: ?>
													<p class="mx-auto flex-auto block"><?php the_title(); ?></p>
												<?php endif; ?>
											</figure>											
												
											<div class=" center">
												<h4 class="m0 mb2"><?php the_title(); ?></h4>
												<?php the_content(); ?>
											</div>
											
											<?php //if (get_the_id() == $pi) {echo '<span class="pi"> </span>';}?>

										</div>	

									</div>

								<?php 
									endwhile; 
									wp_reset_query();  
								?>				

							<?php  else: ?>
								<?php echo "No content found!"; ?>							
							<?php endif; ?>



							<?php 
								//Co-PIs
								$co_pis = get_post_meta( get_the_ID(), 'investigators_select', true );							
								$co_pis_query = new WP_Query(array('post_type' => 'members','post__in' => $co_pis));
							?>

							<?php if ( $co_pis_query->have_posts() ):?>
								
								<?php while ( $co_pis_query->have_posts() ) : $co_pis_query->the_post(); ?>	
									
									<div class="center sm-col sm-col-6 md-col-4 lg-col-12 px2 mb3">

										<div class="profile bg-default shadow py3 px2 center">
																	
											<figure class="circle mx-auto">                           
												<?php if( has_post_thumbnail() ):?>
													<?php the_post_thumbnail('medium', array('class' => 'block mx-auto circle')); ?>
												<?php else: ?>
													<p class="mx-auto flex-auto block"><?php the_title(); ?></p>
												<?php endif; ?>
											</figure>											
												
											<div class=" center">
												<h4 class="m0 mb2"><?php the_title(); ?></h4>
												<?php the_content(); ?>
											</div>
											
											<?php //if (get_the_id() == $pi) {echo '<span class="pi"> </span>';}?>

										</div>	

									</div>

								<?php 
									endwhile; 
									wp_reset_query();
								?>				

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
