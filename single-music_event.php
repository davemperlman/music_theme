<?php

get_header();
?>
<section class="music-event">
	<?php if(have_posts()): ?>
	    <?php while(have_posts()): the_post(); ?>
	    	<section class="music-event-image"><?php the_post_thumbnail(); ?></section> 
	       	<h2><?php the_title(); ?></h2> 
	       	<section class="music-event-content">
		       <section class="description">
		       <ul class="meta">
			       	<li id="event-date">
			       		Date <span><?php echo date('D M d, Y',strtotime(get_post_meta( get_the_ID(), 'date' )[0])); ?></span>
			       	</li>
			       	<li id="event-time">
			       		Time <span><?php echo get_post_meta( get_the_ID(), 'time')[0]; ?></span>
			       		</li>
			       	<li id="event-location">
			       		Location <span><?php echo get_post_meta(get_the_ID(), 'location')[0]; ?></span>
			       	</li>
			       	<?php if ( get_post_meta( get_the_ID(), 'Admittance')[0] ): ?>
			       		<li id="event-admittance">
			       			Admittance: <span><?php echo get_post_meta( get_the_ID(), 'Admittance')[0]; ?></span>
			       		</li>
			       	<?php endif ?>	
		       </ul>
		       		<p><?php the_content(); ?></p>
		       		<?php the_tags(); ?>
		       </section>
		       <div class="pagination"><span id="next"><?php next_post_link('%link', '') ?></span><span id="prev"><?php previous_post_link('%link', '') ?></span></div>
					</div>
		  	</section>
		  	
	    <?php endwhile;?>
	<?php endif;?>
</section>

<?php get_footer(); ?>