<?php
 /**
 * Plugin Name:	Woocommerce Product Feedback
 * Plugin URI:  https://about.me/vipulupadala
 * Description:	This plugin main use for user can easily sent product feedback.
 * Version:	2.0.0
 * Author:	VipulUpadala
 * Author URI:	https://about.me/vipulupadala
 * License:	GPL-2.0+
 * Text Domain:	woocommerce-product-feedback
 * Domain Path:	/languages
 */
if ( ! DEFINED( 'ABSPATH' ) ) {
	exit;
}
/**
 * Description : Add Admin penal in add menu
 * Function Name : woocommerce_product_feedback_menu_pages()
 *
 * @hook : admin_menu
 */

function woocommerce_product_feedback_menu_pages() {
	add_menu_page( 'Product Feedback', 'Feedback Settings', 'manage_options', 'Settings', 'woocommerce_product_feedback_menu_output', plugins_url( 'images/if_feedback_88405.png' , __FILE__ ),10 );
}
/**
 * Callable Function For woocommerce_product_feedback_menu_output
 */
function woocommerce_product_feedback_menu_output() {
	require plugin_dir_path( __FILE__ ) . 'include/admin-settings-page.php';
}
add_action( 'admin_menu', 'woocommerce_product_feedback_menu_pages' );

require plugin_dir_path( __FILE__ ) . 'include/prouduct-feedback-button-add.php';
require plugin_dir_path( __FILE__ ) . 'include/main-functionality-code-file.php';
/**
 * Display Default Review Comment Display None
 */
// add_filter( 'woocommerce_product_tabs', 'wcs_woo_remove_reviews_tab', 98 );
// function wcs_woo_remove_reviews_tab($tabs) {
//         unset($tabs['reviews']);
//         return $tabs;
// }

/**
 * Enqueue StyleSheet & Script required. 
 */

function woocommerce_product_feedback_script()
{
    wp_register_style('woocomerce-product-custom-style', plugin_dir_url(__FILE__) . 'css/woocomerce-product-custom-style.css');
    wp_enqueue_style( 'woocomerce-product-custom-style' );
    wp_register_script('woocomerce-product-feedback-custom-js', plugins_url('js/woocomerce-product-feedback-custom.js', __FILE__), array( 'jquery', 'jquery-ui-dialog' ));
    wp_localize_script('woocomerce-product-feedback-custom-js', 'ajaxurl', array('ajaxparams' => admin_url('admin-ajax.php')));
    wp_enqueue_script('woocomerce-product-feedback-custom-js');
}
add_action( 'init', 'woocommerce_product_feedback_script' );
