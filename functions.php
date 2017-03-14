<?php

add_theme_support( 'post-thumbnails' );

function addStyle() {
	wp_enqueue_style('reset', get_template_directory_uri() . '/_css/reset.css');
	wp_enqueue_style('normalize', get_template_directory_uri() . '/_css/normalize.css');
	wp_enqueue_style('wp_icons', get_template_directory_uri() . '/_css/icons/wp_icons.css');
	wp_enqueue_style('main-style', get_template_directory_uri() . '/_css/main.css', array(), 'all');
}

add_action( 'wp_enqueue_scripts', 'addStyle' );

function create_post_types() {
	register_post_type( 'music_event',
		array(
			'labels' => array(
			  'name'          => __( 'Events' ),
			  'singular_name' => __( 'Event' ),
			  'add_new'		  => 'Add New',
			  'edit_item'     => 'Edit'
		),
		'description' => 'Post type for Events',
		'public'      => true,
		'has_archive' => true,
		'taxonomies'    => array('category'),
		'register_meta_box_cb' => 'add_venue_metaboxes',
		'supports'    => array(
			'title',
			'editor'
			)
		)
	);
		register_post_type( 'venue',
		array(
			'labels' => array(
				'name'			=> __( 'Venues' ),
				'singular_name' => __( 'Venue' ),
				'add_new'		=> 'Add Venue',
				'edit_item'		=> 'Edit Venue'
				),
		'description'	=> 'Venue Information',
		'public'		=> true,
		'has_archive'	=> true,
		'supports'		=> array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields'
			)
		)
	);
}

add_action( 'init', 'create_post_types' );

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


function filter_ptags_on_images($content)
{
    // do a regular expression replace...
    // find all p tags that have just
    // <p>maybe some white space<img all stuff up to /> then maybe whitespace </p>
    // replace it with just the image tag...
    return preg_replace('/<p>(\s*)(<img .* \/>)(\s*)<\/p>/iU', '\2', $content);
}

// we want it to be run after the autop stuff... 10 is default.
add_filter('the_content', 'filter_ptags_on_images');


// Meta Box Stuff

	function custom_meta_box_markup($object) {
		global $post;
		$tmp_post = $post;
		$previous_value = get_post_meta($object->ID, 'meta-box-venue', true);
		$loop = new WP_Query( array('post_type' => 'venue', 'posts_per_page' => -1) );
		wp_nonce_field(basename(__FILE__), 'meta_box_nonce');
		?>
		<select name="meta-box-venue" id="meta-box-venue" value='<?php echo $previous_value; ?>'>
			<?php if ( $loop->have_posts() ) : ?>
				<?php while( $loop->have_posts() ) : $loop->the_post(); ?>
					<option <?php if( get_the_ID() == $previous_value) { echo 'selected'; } ?> value="<?php echo get_the_ID(); ?>"><?php the_title(); ?></option>
				<?php endwhile; ?>
			<?php endif ?>
		</select>
	<?php $post = $tmp_post;
	 }

	 function date_meta_box_markup($object) {
	 	$previous_date_value = get_post_meta($object->ID, 'event-date', true);
	 	$previous_time_value = get_post_meta($object->ID, 'event-time', true);
	 	wp_nonce_field(basename(__FILE__), 'meta_box_nonce');
	 	echo '<input name="event-date" id="event-date-input" value="' . $previous_date_value . '" type="date" data-date-inline-picker="true" />';
	 	echo '<input type="text" name="event-time" id="event-time-input" value="' . $previous_time_value . '">';
	 }

	function add_custom_meta_box() {
		add_meta_box('venue_meta_box', 'Venue', 'custom_meta_box_markup', 'music_event', 'side', 'low');
		add_meta_box('date_meta_box', 'Date and Time', 'date_meta_box_markup', 'music_event', 'side', 'low');
	}

	add_action('add_meta_boxes', 'add_custom_meta_box');

	function save_venue_meta_box($post_id, $post, $update) {
		if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		$slug = 'music_event';
		if ($slug != $post->post_type) {
			return $post_id;
		}

		$meta_box_venue_value = '';
		if (isset($_POST['meta-box-venue'])) {
			$meta_box_venue_value = $_POST['meta-box-venue'];
		}

		update_post_meta($post_id, 'meta-box-venue', $meta_box_venue_value);
	}

	function save_date_meta_box($post_id, $post, $update) {
		if (!isset($_POST['meta_box_nonce']) || !wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}

		if (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}

		$slug = 'music_event';
		if ($slug != $post->post_type) {
			return $post_id;
		}

		$meta_box_date_value = '';
		if (isset($_POST['event-date'])) {
			$meta_box_date_value = $_POST['event-date'];
		}

		update_post_meta($post_id, 'event-date', $meta_box_date_value);

		$meta_box_time_value = '';
		if (isset($_POST['event-time'])) {
			$meta_box_time_value = $_POST['event-time'];
		}
		update_post_meta($post_id, 'event-time', $meta_box_time_value);
	}

	add_action('save_post', 'save_venue_meta_box', 10, 3);
	add_action('save_post', 'save_date_meta_box', 10, 3);




// // Save the Metabox Data

// function wpt_save_events_meta($post_id, $post) {
	
// 	// verify this came from the our screen and with proper authorization,
// 	// because save_post can be triggered at other times
// 	if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
// 	return $post->ID;
// 	}

// 	// Is the user allowed to edit the post or page?
// 	if ( !current_user_can( 'edit_post', $post->ID ))
// 		return $post->ID;

// 	// OK, we're authenticated: we need to find and save the data
// 	// We'll put it into an array to make it easier to loop though.
	
// 	$events_meta['_location'] = $_POST['_location'];
	
// 	// Add values of $events_meta as custom fields
	
// 	foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
// 		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
// 		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
// 		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
// 			update_post_meta($post->ID, $key, $value);
// 		} else { // If the custom field doesn't have a value
// 			add_post_meta($post->ID, $key, $value);
// 		}
// 		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
// 	}

// }

// add_action('save_post', 'wpt_save_events_meta', 1, 2); // save the custom fields
