<?php get_header(); ?>
   <section class="content">
      <?php if(have_posts()): ?>
         <?php while(have_posts()): the_post(); ?>
            <section class="music-event-image">
               <?php the_post_thumbnail(); ?>
            </section>
            <h2><?php the_title(); ?></h2> 
               <article class="blog-post">
                  <section class="description">
                     <p><?php the_content(); ?></p>
                     <?php the_tags(); ?>
                  </section>
               </article>
              <div class="pagination"><span id="prev"><?php next_post_link('%link', '') ?></span><span id="next"><?php previous_post_link('%link', '') ?></span></div>
               </div>
         <?php endwhile;?>
      <?php endif;?>
   </section>
<?php get_footer(); ?>