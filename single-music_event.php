<?php

get_header();
?>
<section class="music-event">
	<?php if(have_posts()): ?>
	    <?php while(have_posts()): the_post(); ?>
	       	<h2><?php the_title(); ?></h2> 
	       	<section class="music-event-content">
		       <ul class="meta">
			       	<li>
			       		Date: <?php echo date('D M d, Y',strtotime(get_post_meta( get_the_ID(), 'date' )[0])); ?>
			       	</li>
			       	<li>Time: <?php echo get_post_meta( get_the_ID(), 'time')[0]; ?></li>
			       	<li>Location: <?php echo get_post_meta(get_the_ID(), 'location')[0]; ?></li>
			       	<?php if ( get_post_meta( get_the_ID(), 'Admittance')[0] ): ?>
			       		<li>Admittance: <?php echo get_post_meta( get_the_ID(), 'Admittance')[0]; ?></li>
			       	<?php endif ?>	
		       </ul>
		       <section class="description">
		       		<p><?php the_content(); ?></p>
		       		<?php the_tags(); ?>
		       </section>
		  	</section>
		  	<section class="music-event-image"><?php the_post_thumbnail(); ?></section> 
	    <?php endwhile;?>
	<?php endif;?>
</section>

<?php get_footer(); ?>