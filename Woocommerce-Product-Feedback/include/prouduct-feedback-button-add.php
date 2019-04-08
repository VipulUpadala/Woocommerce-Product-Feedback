<?php
/**
 * Descripion : Add to cart button after new button add
 * Function Name :woocommerce_product_feedback_add_button()
 *
 * @hook : woocommerce_after_add_to_cart_button.
 */

function woocommerce_product_feedback_add_button() {
    global $product;
    $current_user = wp_get_current_user();
    $user_emails = $current_user->user_email;
    $display_name = $current_user->display_name;
    $user_email = (!empty($user_emails))? $user_emails:'';
    $display_name = (!empty($display_name))? $display_name:'';
    $product_id = $product->get_id();
    $pop_status = get_option( 'popup_status' );
    $butoon_label = get_option( 'button_label' );
    if ( ! empty( $butoon_label ) ) {
        $btn_label = $butoon_label;
    } else {
        $btn_label = 'Add Feedback';
    }
    if ( '1' === $pop_status || ! empty( $pop_status ) ) {
       
        add_filter( 'woocommerce_product_tabs', 'woocommerce_product_feedback_new_tab' );
        
    } else {
            echo "<br /><br /><input type='button' id='add_btn' value='" . esc_attr( $btn_label ) . "'/>";
        $html_code = '';
        $html_code .= '<div id="divForm" style="display:none;color: Black;">
							<form method="post">
								<lable>First Name</lable> <input type="text" id="user_name" value="'.$display_name.'" class="pfb_input"  name="user_name"  placeholder="Enter First Name"  style="color: #1e36ed;border: 1px solid #141010;border-radius: 5px;padding: 5px;width:100%"/>
								<br />Email ID  <input type="email" value="'.$user_email.'" id="user_email" class="pfb_input" name="user_email" placeholder="Enter Your Email id" style="color: #1e36ed;border: 1px solid #141010;border-radius: 5px;padding: 5px;width:100%" />
                                <br />Comment  <textarea id="user_comment" class="pfb_input" name="user_comment" placeholder="Enter Your Comment Please" style="color: #1e36ed;border: 1px solid #141010;border-radius: 5px;padding: 5px;width:100%"></textarea><br />
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>                          
								<input type="hidden" id="product_popup_id" name="product_id" value="'.$product_id.'">    
								<input type="button" id="custome_post_save" name="submit_btn" value="Submit Data" />
							</form>
						</div>';
        echo $html_code;
    }
}
add_action( 'woocommerce_after_add_to_cart_form', 'woocommerce_product_feedback_add_button' );
/**
 * Add New Tab Form have Product Information & Description.
 */
function woocommerce_product_feedback_new_tab( $tabs ) {
    $tabs['test_tab'] = array(
        'title' => __( 'Product Feedback', 'woocommerce' ),
        'priority' => 50,
        'callback' => 'woocomerce_product_feedback_add_tab',
    );
    return $tabs;
}
/**
 * Callable Function Cretaed New Tagb
 */
function woocomerce_product_feedback_add_tab() {
    global $product;
    $current_user = wp_get_current_user();
    $user_emails = $current_user->user_email;
    $display_name = $current_user->display_name;
    $user_email = (!empty($user_emails))? $user_emails:'';
    $display_name = (!empty($display_name))? $display_name:'';
    $product_id = $product->get_id();
    $html_code = '';
    $html_code .= '<div id="divForm" style="background-color:#aab7b8;color:black;padding:40px 40px 0px 40px">
			<div id="register_data_msg" align="center" style="color:green"></div>
				<form action="" method="post">
					First Name <br/> <input type="text" value="'.$display_name.'" id="user_name" class="pfb_input"  name="user_name"  placeholder="Enter First Name"  style="color: #1e36ed;border: 1px solid #141010;border-radius: 5px;padding: 5px;width:100%" />
					<br />Email ID <br/> <input type="email" value="'.$user_email.'" id="user_email" class="pfb_input" name="user_email" placeholder="Enter Your Email id" style="color: #1e36ed;border: 1px solid #141010;border-radius: 5px;padding: 5px;width:100%" />
                    <br />Comment <br/> <textarea id="user_comment" class="pfb_input" name="user_comment" placeholder="Enter Your Comment Please" style="color: #1e36ed;border: 1px solid #141010;border-radius: 5px;padding: 5px;width:100%" ></textarea><br /><br />
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" />
                        <label for="star1" title="text">1 star</label>
                    </div>     
					<input type="hidden" id="tab_product_id" name="product_id" value="' . $product_id . '">     
					<input type="button" id="custome_post_save" name="submit_btn" value="Submit Data" style="width: 100%;height: 50px;margin-top: 15px;font-weight: bold;background-color: blue;color:white;border: double white;margin-bottom:20px;font-size:20px;font-family : time new roman;" >
				</form>
			</div>';
    echo $html_code;
}