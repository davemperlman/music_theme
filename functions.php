<?php

add_theme_support( 'post-thumbnails' );

function addStyle() {
	wp_enqueue_style('reset', get_template_directory_uri() . '/_css/reset.css');
	wp_enqueue_style('normalize', get_template_directory_uri() . '/_css/normalize.css');
	wp_enqueue_style('wp_icons', get_template_directory_uri() . '/_css/icons/wp_icons.css');
	wp_enqueue_style('main-style', get_template_directory_uri() . '/_css/main.css', array(), 'all');
}

add_action( 'wp_enqueue_scripts', 'addStyle' );

function create_post_type() {
	register_post_type( 'music_event',
		array(
			'labels' => array(
			  'name'          => __( 'Events' ),
			  'singular_name' => __( 'Event' )
		),
		'public'      => true,
		'has_archive' => true,
		'taxonomies'    => array('category'),
		'supports'    => array(
			'title',
			'editor',
			'thumbnail',
			'custom-fields'
			)
		)
	);
}

add_action( 'init', 'create_post_type' );

add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}