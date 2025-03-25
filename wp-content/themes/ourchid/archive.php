<?php get_header(); ?>

<main class="max-width-4 mx-auto p3"> 

	<div class="col-12 pb3">
		<?php the_archive_title( '<h1>', '</h1>' );?>
		<?php the_archive_description(); ?>
	</div>

    <div class="px3 mxn1">
		<?php while ( have_posts() ) { the_post(); ?>
			
			<div class="mxn3 clearfix sm-flex flex-center my2">			
				<div class="sm-col sm-col-6 px1">
					<a class="cover border block p2 center flex flex-auto items-center flex-center" href="<?php the_permalink(); ?>">
						<?php if( has_post_thumbnail() ):?>
							<?php the_post_thumbnail('full', array('class' => 'mx-auto')); ?>
						<?php else: ?>
							<h3 class="mx-auto flex-auto block"><?php the_title(); ?></h3>
						<?php endif; ?>
					</a>
				</div>	

				<div class="sm-col sm-col-6 px1 py2">
					<h2 class="m0 p0"><a class="block" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					<p class="mt0 mb1"><?php echo get_the_excerpt(); ?></p>
					<a href="<?php the_permalink(); ?>">Read More</a>
				</div>
			</div>
		
		<?php } ?>		
    </div>

</main> 

<?php get_footer(); ?>
