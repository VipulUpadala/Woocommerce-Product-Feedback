<?php
/**
 * description : create product_feedback custome post type
 * function name : woocommerce_product_feedback_post_type()
 *
 * @hook : init.
 */
function woocommerce_product_feedback_post_type() {
	register_post_type('Product_Feedback', array(
		'labels' => array(
			'name' => 'Product Feedback',
			'singular_name' => 'Product_Feedback',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Product_Feedback',
			'edit' => 'Edit',
			'edit_item' => 'Edit Product_Feedback',
			'new_item' => 'New Product_Feedback',
			'view' => 'View',
			'view_item' => 'View Product_Feedback',
			'search_items' => 'Search Product_Feedback',
			'not_found' => 'No Product_Feedback found',
			'not_found_in_trash' => 'No Product_Feedback found in Trash',
			'parent' => 'Parent Product_Feedback',
		),
		'show_in_rest' => true,
		'public' => true,
		'menu_position' => 15,
		'supports' => array( 'title', 'editor', 'comments', 'thumbnail', 'custom-fields' ),
		'taxonomies' => array( '' ),
		'menu_icon' => plugins_url( 'images/site-icon-crop.jpg' , dirname(__FILE__) ),
		'has_archive' => true,
	));
}
add_action( 'init', 'woocommerce_product_feedback_post_type' )

