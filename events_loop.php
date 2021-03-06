<?php
$loop = new WP_Query( array(
	'post_type'      => 'music_event',
	'posts_per_page' => '10',
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



if($loop->have_posts()) :
	while ( $loop->have_posts() ) :
		$loop->the_post(); ?>
	<table class="event">
		<tr>
			<td><?php echo date('d M', strtotime(get_post_meta(get_the_ID(), 'date')[0])); ?></td>
			<td><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
			<td><?php echo get_post_meta(get_the_ID(), 'location')[0]; ?></td>
		</tr>
	</table>
<?php endwhile; ?>
<?php endif; ?>