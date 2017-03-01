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
			'editor',
			'thumbnail',
			'custom-fields'
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

function add_venue_metaboxes() {
	add_meta_box('event_venue', 'Venue', 'event_venue_post', 'Events', 'side', 'default');
}

function event_venue_post() {
	global $post;
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    $venue = get_post_meta($post->ID, '_Venue', true);

    echo '<input type="text" name="_Venue" value="' . $venue  . '" class="widefat" />';
}

//add_action( 'init', 'create_venue' );

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


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
