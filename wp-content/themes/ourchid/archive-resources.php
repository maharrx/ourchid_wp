<?php get_header(); ?>

<main>      
	<div class="container mx-auto px3">

		<header class="hero">
			<?php the_archive_title( '<h1 class="mb3">', '</h1>' );?>
			<?php the_archive_description(); ?>	
		</header>

		<form method="get" class="mb4">
			<div class="flex items-center">
				<input type="text" name="s" class="input-reset ba b--black-20 pa2 mb2 db w-100" placeholder="Search resources..." value="<?php echo get_search_query(); ?>">
				<select name="category" class="ml2 pa2">
					<option value="">All Categories</option>
					<?php 
					$categories = get_categories();
					foreach ($categories as $category) {
						$selected = (isset($_GET['category']) && $_GET['category'] == $category->term_id) ? 'selected' : '';
						echo '<option value="' . $category->term_id . '" ' . $selected . '>' . $category->name . '</option>';
					}
					?>
				</select>
				<button type="submit" class="ml2 pa2 bg-black white">Filter</button>
			</div>
		</form>

		<section class="clearfix mxn2">	
			<?php 
			$args = array(
				'post_type' => 'resources',
				's' => isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '',
				'cat' => isset($_GET['category']) ? intval($_GET['category']) : '',
			);
			$query = new WP_Query($args);

			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post(); ?>

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

				<?php }
			} else {
				echo '<p>No resources found.</p>';
			}
			wp_reset_postdata();
			?>
		</section>						

	</div>
</main> 

<?php get_footer(); ?>
