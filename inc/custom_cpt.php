<?php
// Create Slider Custom Post type
function mpc_cpt() {
    $args = array(
        'public'   => true,
        'label'    => 'Carousel',
        'menu_icon'=> 'dashicons-book',
        'supports' => array('title','thumbnail')
    );
    register_post_type( 'mpc_carousel', $args );
}
add_action( 'init', 'mpc_cpt' );






// Remove Default Feature Image box and add new Image box under the post title.
add_action('do_meta_boxes', 'mpc_custom_image_box');
function mpc_custom_image_box() {
	remove_meta_box( 'postimagediv', 'mpc_carousel', 'side' );
	add_meta_box('postimagediv', __('Carousel Image'), 'post_thumbnail_meta_box', 'mpc_carousel', 'normal', 'high');
}







// Create Taxonomy for Carousel
function add_mpc_cpt_txonomy(){
$tax_arg = array(
		'name'                 => _x( 'Category', 'taxonomy general name' ),
	);
	$mpc_tax = array(
		'hierarchical'          => true,
		"public" 				=> true,
		'labels'                => $tax_arg,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'mpc-carousel-category' ),
	);
register_taxonomy('mpc_carousel_cat', 'mpc_carousel', $mpc_tax);
}
add_action("init","add_mpc_cpt_txonomy");
