<?php

get_header();
?>

<section id='posts'>
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<section class="post">
		<p class="post-date"><?php echo get_the_date(); ?></p>
			<h2 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php the_excerpt(); ?>
		</section>
	<?php endwhile; endif; ?>
</section>

			<section class="shows">
				<div class="fb-like" data-href="http://www.facebook.com/entertainmentmaine" data-width="100px" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true">
        		</div>
				<h2>Upcoming Shows <?php echo isset($_GET['more']) ? '<a id="amount" href="?">-</a>' : '<a id="amount" href="?more=true">+</a>'; ?></h2>
				<?php get_template_part('events_loop'); ?>
				<section id='instagram'>
					<h2>Instagram Photos</h2>
					<?php echo do_shortcode('[instagram-feed]'); ?>
				</section>
			</section>
	<?php get_footer(); ?>
