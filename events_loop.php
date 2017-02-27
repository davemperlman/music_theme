<?php
$loop = new WP_Query( array(
	'post_type'      => 'music_event',
	'posts_per_page' => '15', 
	'category_name'  => 'shows',
	'meta_query'     => array(
		array(
			'key'       => 'date',
			'value'     => date('Ymd'),
			'compare'   => '>=',
		)
	),
	'orderby'  => 'meta_value',
	'meta_key' => 'date',
	'order'    => 'ASC'
	)
);

global $wp_query;
$temp_wp_query = $wp_query;
$wp_query = null;
$wp_query = $loop;



if($loop->have_posts()) :
	while ( $loop->have_posts() ) :
		$loop->the_post(); ?>
	<a id="event-link" href="<?php the_permalink(); ?>">
		<table class="event">
			<tr>
				<td><?php echo date('jS F', strtotime(get_post_meta(get_the_ID(), 'date')[0])); ?></td>
				<td><?php the_title(); ?></td>
				<td><?php echo get_post_meta(get_the_ID(), 'location')[0]; ?></td>
			</tr>
		</table>
	</a>
<?php endwhile; ?>
<?php endif; ?>
<?php $wp_query = $temp_wp_query ?>