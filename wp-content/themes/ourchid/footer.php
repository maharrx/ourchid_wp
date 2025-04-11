<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>


	<?php //get_template_part( 'template-parts/footer/footer-widgets' ); ?>

	<footer class="container mx-auto p3 pb4" role="contentinfo">	
		<div class="mxn3">
			<div class="copyright px3">&copy; <?php echo get_bloginfo( 'name' ); ?> Lab <?php echo date('Y'); ?></div>
		</div>
	</footer><!-- #colophon -->


<?php wp_footer(); ?>

</body>
</html>
