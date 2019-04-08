<?php
/**
 * Description Admin Option Setting Save Ajax call
 * Function Name : woocommerce_product_feedback_setting_data_save()
 *
 * @hook :wp_ajax_woocommerce_product_feedback_setting_data_save
 * @hook :wp_ajax_nopriv_woocommerce_product_feedback_setting_data_save.
 */
function woocommerce_product_feedback_setting_data_save() {
	$p_status = sanitize_text_field($_REQUEST['pop_status']);
	$btn_label = sanitize_text_field($_REQUEST['btn_label']);
	update_option( 'popup_status', $p_status );
	update_option( 'button_label', $btn_label );
}
add_action( 'wp_ajax_woocommerce_product_feedback_setting_data_save', 'woocommerce_product_feedback_setting_data_save' );
add_action( 'wp_ajax_nopriv_woocommerce_product_feedback_setting_data_save', 'woocommerce_product_feedback_setting_data_save' );
/**
 * Description : Custome Post Type Data Store Function.
 * Function Name : woocomerce_feedback_insert_data_in_custome_post()
 *
 * @hook : wp_ajax_woocomerce_feedback_insert_data_in_custome_post
 * @hook : wp_ajax_nopriv_woocomerce_feedback_insert_data_in_custome_post
 */
function woocomerce_feedback_insert_data_in_custome_post() {
	parse_str($_POST['formData'], $Allvalue);
	$user_name = sanitize_text_field($Allvalue['user_name']);
	$user_email = sanitize_email($Allvalue['user_email']);
	$product_comment = sanitize_text_field($Allvalue['user_comment']);
	$product_id = sanitize_text_field($Allvalue['product_id']);
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$user_author_url = $current_user->user_url;
	$user_author_url = (!empty($user_author_url))? $user_author_url:'';
	$author_ip = $_SERVER['REMOTE_ADDR'];
	$agent = $_SERVER['HTTP_USER_AGENT'];
	if ( is_user_logged_in() ) {
		$comment_status = 1;
	}else{
		$comment_status = 0;
	}
	$time = current_time('mysql');

	$data = array(
		'comment_post_ID' => $product_id,
		'comment_author' => $user_name,
		'comment_author_email' => $user_email,
		'comment_author_url' => $user_author_url,
		'comment_content' => $product_comment,
		'comment_type' => 'review',
		'comment_parent' => 0,
		'user_id' => $user_id,
		'comment_author_IP' => $author_ip,
		'comment_agent' => $agent,
		'comment_date' => $time,
		'comment_approved' => $comment_status,
	);
	$comment_id = wp_insert_comment($data);
	add_comment_meta( $comment_id, 'rating', $Allvalue['rate']);
	die();
}
add_action( 'wp_ajax_woocomerce_feedback_insert_data_in_custome_post', 'woocomerce_feedback_insert_data_in_custome_post' );
add_action( 'wp_ajax_nopriv_woocomerce_feedback_insert_data_in_custome_post', 'woocomerce_feedback_insert_data_in_custome_post' );
