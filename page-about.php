<?php get_header(); ?>

 <section class="content">
      <?php if(have_posts()): ?>
         <?php while(have_posts()): the_post(); ?>
            <section class="music-event-image">
               <?php the_post_thumbnail(); ?>
            </section>
               <article class="blog-post">
                  <section class="description">
                     <p><?php the_content(); ?></p>
                  </section>
               </article>
         <?php endwhile;?>
      <?php endif;?>
   </section>
	

<?php get_footer(); ?>