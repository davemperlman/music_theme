<?php get_header(); ?>
	
	<!-- <section class="shows">
	<h2>Schedule</h2>
		<?php get_template_part('events_loop'); ?>
	</section> -->
<?php 
	if(have_posts()) :
		while (have_posts() ) :
			the_post(); ?>
			<div class="content_wrap">
				<?php echo the_content(); ?> <!-- This needs to be styled -->
			</div>
		<?php endwhile; ?>
	<?php endif; ?>
<?php get_footer(); ?>