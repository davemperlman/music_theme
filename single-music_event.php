<?php

get_header();
?>
<section class="music-event">
<?php if(have_posts()): ?>
	    <?php while(have_posts()): the_post(); ?>
<?php $venueId = get_post_meta( get_the_ID(), 'meta-box-venue')[0]; ?>
 	<?php $loop = new WP_Query( array( 'p' => $venueId, 'post_type' => 'venue')); ?>
 	<?php if ($loop->have_posts()): ?>
 		<?php while($loop->have_posts()) : $loop->the_post(); ?>
 			<section class="music-event-image">
 				<?php the_post_thumbnail(); ?>
 			</section>
				<h2><?php the_title(); ?></h2> 
				<ul class="meta venue-meta">
					<li><?php echo get_post_meta( get_the_ID(), 'Address')[0]; ?></li>
					<li><a href="<?php echo get_post_meta( get_the_ID(), 'Venue_url')[0]; ?>"><?php echo get_post_meta( get_the_ID(), 'Venue_url')[0]; ?></a></li>
				</ul>
	       	<section class="music-event-content">
		    	<section class="description">
		    		<?php the_content(); ?>
			<?php endwhile; ?>
 	<?php endif ?>
 	<?php wp_reset_postdata(); ?>
 						<?php if ( get_post_meta( get_the_ID(), 'gig-type')[0] == 'solo'): ?>
 							<p>Dave Perlman performing as a solo acoustic act, performing</p>
 						<?php elseif ( get_post_meta( get_the_ID(), 'gig-type')[0] == 'band'): ?>
 							<p>Dave perlman playing with a band</p>
 						<?php elseif ( get_post_meta( get_the_ID(), 'gig-type')[0] == 'custom'): ?>
 							<?php the_content(); ?>
 						<?php endif ?>
 					<ul class="meta">
				       	<li id="event-date">
				       		Date <span><?php echo date('D M d, Y',strtotime(get_post_meta( get_the_ID(), 'event-date' )[0])); ?></span>
				       	</li>
				       	<li id="event-time">
				       		Time <span><?php echo get_post_meta( get_the_ID(), 'event-time')[0]; ?></span>
				       		</li>
				       	<?php if ( get_post_meta( get_the_ID(), 'Admittance')[0] ): ?>
				       		<li id="event-admittance">
				       			Admittance: <span><?php echo get_post_meta( get_the_ID(), 'Admittance')[0]; ?></span>
				       		</li>
				       	<?php endif ?>	
	        		</ul>
					</section>
		       <div class="pagination"><span id="next"><?php next_post_link('%link', '') ?></span><span id="prev"><?php previous_post_link('%link', '') ?></span>
		       </div>
			</section>
	    <?php endwhile;?>
	<?php endif;?>
</section>

<?php get_footer(); ?>

							