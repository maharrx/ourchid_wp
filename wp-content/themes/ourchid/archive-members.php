<?php get_header(); ?>


<main>      
	<div class="container mx-auto px3">

		<header class="hero">
			<?php the_archive_title( '<h1 class="mb3">', '</h1>' );?>
			<?php the_archive_description(); ?>	
		</header>

		<section class="clearfix mxn2">	


		<?php
		// Get all terms from the custom taxonomy "type"
		$types = get_terms(array(
			'taxonomy' => 'type',
			'hide_empty' => false, // Set to true if you only want terms with posts
		));

		if (!empty($types) && !is_wp_error($types)) {
			foreach ($types as $type) {
				echo '<div class="mb4 clearfix"> 
						<h2 class="my2 px2">' . esc_html($type->name) . '</h2>';

				// Query members with current taxonomy term
				$members = new WP_Query(array(
					'post_type' => 'members',
					'tax_query' => array(
						array(
							'taxonomy' => 'type',
							'field'    => 'slug',
							'terms'    => $type->slug,
						),
					),
					'posts_per_page' => -1, // All posts
				));

				if ($members->have_posts()) {
					
					while ($members->have_posts()) {
						$members->the_post();
				?>		
						
						
				<div class="md-col md-col-6 lg-col-4 px2 mt3">
					<div class="profile bg-default shadow p3 center">
						
						<div class="p2">
							<figure class="circle mx-auto">                           
								<?php if( has_post_thumbnail() ):?>
									<?php the_post_thumbnail('medium', array('class' => 'block mx-auto circle')); ?>
								<?php else: ?>
									<p class="mx-auto flex-auto block"><?php the_title(); ?></p>
								<?php endif; ?>
							</figure>
						</div>
						
						<div class=" center">
							<h3 class="m0 mb2"><?php the_title(); ?></h3>
							<?php the_content(); ?>
						</div>
					
					</div>	

				</div>    
				
				
				<?php
					}
					
				} else {
					echo '<p>No members found under this type.</p>';
				}

				wp_reset_postdata();
				
				echo '</div>'; // Close the clearfix div
			}
		}
		?>


		</section>						

	</div>
</main> 

<?php get_footer(); ?>
