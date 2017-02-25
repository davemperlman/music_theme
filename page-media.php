<?php get_header(); ?>
	
<?php 
	if(have_posts()) :
		while (have_posts() ) :
			the_post(); ?>
			<?php echo the_content(); ?> <!-- This needs to be styled -->
		<?php endwhile; ?>
	<?php endif; ?>
<?php get_footer(); ?>