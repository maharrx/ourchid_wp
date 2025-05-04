<?php get_header(); ?>

<main>      
	<div class="container mx-auto px3">

		<header class="hero">
			<?php the_archive_title( '<h1 class="mb3">', '</h1>' );?>
			<?php the_archive_description(); ?>	
		</header>

		<form method="get" class="mb2 flex flex-center mb1">
			
				<input type="text" name="s" class="flex-auto field" placeholder="Search resources..." value="<?php echo get_search_query(); ?>">
				
				<button type="submit" class="btn btn-primary ml2">Search</button>
			
		</form>

		<section class="clearfix mxn2">
			<table class="table-light">
				<thead>
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Owner</th>
						<th>Department</th>
						<th>Checked Out</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$meta_query = [];
					if (isset($_GET['orderby']) && $_GET['orderby'] === 'department') {
						$meta_query[] = [
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

							<tr>
								<td>
									<?php if( has_post_thumbnail() ):?>
										<figure class="circle mx-auto">                           
										<?php the_post_thumbnail('thumbnail', array('class' => 'block mx-auto circle')); ?>
										</figure>
									<?php else: ?>
										<span class="dashicons dashicons-images-alt"></span>
									<?php endif; ?>
								</td>
								<td><?php the_title(); ?></td>
								<td><?php echo get_the_author(); ?></td>
								<td><?php 
									$author_id = get_the_author_meta('ID');
									$department = get_user_meta($author_id, 'department', true);
									echo $department ? esc_html($department) : 'N/A';
								?></td>
								<td><?php 
									$checked_out = get_post_meta(get_the_ID(), '_resource_item_checked_out', true);
									echo $checked_out ? 'Yes' : 'No';
								?></td>
							</tr>

						<?php }
					} else {
						echo '<tr><td colspan="5">No resources found.</td></tr>';
					}
					wp_reset_postdata();
					?>
				</tbody>
			</table>
		</section>						

	</div>
</main> 

<?php get_footer(); ?>
