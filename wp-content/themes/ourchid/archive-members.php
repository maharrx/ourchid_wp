<?php get_header(); ?>

<main>      
	<div class="container mx-auto px3">

		<header class="hero">
			<?php the_archive_title( '<h1 class="mb3">', '</h1>' );?>
			<?php the_archive_description(); ?>	
		</header>

		<section class="clearfix mxn2">	
			<?php while ( have_posts() ) { the_post(); ?>

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
				
			<?php } ?>
		</section>						

	</div>
</main> 

<?php get_footer(); ?>
