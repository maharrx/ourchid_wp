<?php get_header(); ?>

<style>
/* Make the table responsive */
.table-light {
    width: 100%;
    border-collapse: collapse;
    overflow-x: auto;
    display: block;
}

.table-light th,
.table-light td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}

.table-light thead {
    background-color: #f9f9f9;
}

.table-light tr {
    display: flex;
    flex-wrap: wrap;
}

.table-light th,
.table-light td {
    flex: 1 1 auto;
    min-width: 120px;
}

@media (max-width: 768px) {
    .table-light tr {
        flex-direction: column;
    }

    .table-light th,
    .table-light td {
        text-align: center;
    }
}
</style>

<main>      
	<div class="container mx-auto px3">

		<header class="hero">
			<?php the_archive_title( '<h1 class="mb3">', '</h1>' );?>
			<?php the_archive_description(); ?>	
		</header>

		<form method="get" class="mb4 flex flex-center">
			
				<input type="text" name="s" class="flex-auto field" placeholder="Search resources..." value="<?php echo get_search_query(); ?>">
				
				<button type="submit" class="btn btn-primary ml2">Search</button>
			
		</form>

		<table class="table-light">
				<thead>
					<tr class="mb2">
						<th colspan=2>Item</th>
						<th>Available Qty.</th>
						<th>Contact</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$meta_query = [];
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
							$query->the_post(); 

							// Retrieve custom meta box values
							$description = get_post_meta(get_the_ID(), '_resources_description', true);
							$external_link = get_post_meta(get_the_ID(), '_resources_external_link', true);
							$availability = get_post_meta(get_the_ID(), '_resources_availability', true);

							//print_r($checked_out);
					?>

							<tr>
								<td>
									
									<figure style="width:80px; height:80px" class="m0 line-height-1 border text-center block"> 
										<?php if( has_post_thumbnail() ):?>                          
											<?php the_post_thumbnail('thumbnail', array('class' => 'mx-auto', 'style' => 'width: 80px; height:80px')); ?>
										<?php else: ?>
											<span style="padding:30px;" class="dashicons dashicons-images-alt"></span>
										<?php endif; ?>
									</figure>
																		
								</td>
								<td style="min-width: 500px;">
									<h3 class="m0 mb1 p0"><?php the_title(); ?></h3>
									
									
									<p class="mb1 block"><?php echo esc_html($description); ?></p>
									
									<?php if ($external_link): ?>
										<a class="underline" href="<?php echo esc_url($external_link); ?>" target="_blank"><small>Product Link</small></a>
									<?php endif; ?>

								</td>
								<td style="min-width: 120px;">
									<?php 
									
									if ($availability) {
										echo ($availability);
									} else {
										echo 'Not Available';
									}
										
									?>
								</td>
								<td style="min-width: 200px;">
									
									<?php //name
										echo get_the_author(); 
									?>
									<br>
									<?php //email
										echo get_the_author_email(); 
									?>
									<br>
									<?php //department
										//$author_id = get_the_author_meta('ID');
										//$department = get_user_meta($author_id, 'department', true);
										//echo $department ? esc_html($department) : '';
									?>
									
								</td>
								

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
