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
			$meta_query = [];
			if (isset($_GET['orderby']) && $_GET['orderby'] === 'department') {
				$meta_query = [
					'relation' => 'OR',
					[
						'key' => 'department',
						'compare' => 'EXISTS',
					],
					[
						'key' => 'department',
						'compare' => 'NOT EXISTS',
					],
				];
			}

			$args = array(
				'post_type' => 'resources',
				's' => isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '',
				'cat' => isset($_GET['category']) ? intval($_GET['category']) : '',
				'orderby' => isset($_GET['orderby']) && $_GET['orderby'] !== 'department' ? sanitize_text_field($_GET['orderby']) : 'title',
				'order' => 'ASC',
				'meta_query' => $meta_query,
			);
			$query = new WP_Query($args);

			if ($query->have_posts()) {
				while ($query->have_posts()) {
					$query->the_post(); ?>

					<div class="md-col md-col-12 lg-col-12 px2">
						<div class="profile bg-default p2 flex items-center border">
							<div class="p2">
								
									<?php if( has_post_thumbnail() ):?>
										<figure class="circle mx-auto">                           
										<?php the_post_thumbnail('thumbnail', array('class' => 'block mx-auto circle')); ?>
										</figure>
									<?php else: ?>
										<p class="mx-auto flex-auto block"><span class="dashicons dashicons-images-alt
"></span></p>
									<?php endif; ?>
								
							</div>
							<div class="ml3">
								<h3 class="m0 mb2"><?php the_title(); ?></h3>
								<p><strong>Author:</strong> <?php echo get_the_author(); ?></p>
								<p><strong>Department:</strong> <?php 
									$author_id = get_the_author_meta('ID');
									$department = get_user_meta($author_id, 'department', true);
									echo $department ? esc_html($department) : 'N/A';
								?></p>
								<p><strong>Checked Out:</strong> <?php 
									$checked_out = get_post_meta(get_the_ID(), '_resource_item_checked_out', true);
									echo $checked_out ? 'Yes' : 'No';
								?></p>
								<?php //the_content(); ?>
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
