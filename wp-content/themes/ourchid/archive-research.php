<?php get_header(); ?>

<main>        
	<div class="container mx-auto px3">

		<header class="hero">
			<?php the_archive_title( '<h1 class="mb3">', '</h1>' );?>
			<?php the_archive_description(); ?>	
		</header>

		<section class="research clearfix">
			<?php while ( have_posts() ) { the_post(); ?>

				<div class="project mt3">
					<div class=" bg-default shadow">
						
						<div class="lg-flex">
							<div class="lg-col-6 flex border-box">
								<div class="col-12">
									<?php if( has_post_thumbnail() ):?>
										<a class="" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full', array('class' => 'block mx-auto')); ?></a>
									<?php else: ?>
										<p class="mx-auto flex-auto block"><?php the_title(); ?></p>
									<?php endif; ?>
								</div>
							</div>
							<div class="lg-col-6 border-box ">
								<div class="excerpt p3">
									<a class="" href="<?php the_permalink(); ?>"><?php the_title('<h2 class="mt0">', '</h2>'); ?></a>
									<?php the_excerpt( '<p class="m0">', '</p>' );?>
								</div>
							</div>
						</div>

					</div>
				</div>

				


			<?php } ?>
		</section>

	</div>
</main> 

<?php get_footer(); ?>
