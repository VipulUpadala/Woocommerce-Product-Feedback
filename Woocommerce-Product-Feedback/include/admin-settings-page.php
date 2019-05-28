<html>
<body>
<div class="cls-head">
	Settings for Product Feedback.
</div>
<div class="feedback">
<?php
$pop_status = get_option( 'popup_status' );
$btn_lbl = get_option( 'button_label' );
?>
	<form action="" method="post" class="feedback-form">
		<input id="pop_option" type="checkbox" name="popup" <?php if ( 1 == $pop_status ) { echo 'checked'; } else { echo ''; } ?> /> Do You Want Disable Popup Product Feedback From.<br/><br/>
		You Can Change Add To cart Below Button Label.
		<input id="button_lbl" type="text" class="feedback-lbl" name="btnlbl" value="<?php if ( isset( $btn_lbl ) ) { echo $btn_lbl; } ?>" /><br/><br/>
	</form>
	<input type="button" name="settings" class="feedback-btn" value="Submit" onclick="woocommerce_product_feedback_option_setting()">
	<div id="option_msg"></div>
</div>
</body>
</html>
<script>
 function woocommerce_product_feedback_option_setting() {
		var pop_status;
		var btn_label = jQuery('#button_lbl').val();
		if (jQuery('#pop_option').is(":checked")) {
			pop_status = 1;
		} else {
			pop_status = 0;
		}
		jQuery.ajax({
			url: ajaxurl.ajaxparams,
			type: 'POST',
			data: {
				action: 'woocommerce_product_feedback_setting_data_save',
				pop_status: pop_status, btn_label: btn_label
			},
			success: function (data) {
				jQuery('#option_msg').html(" Successfully Save Data ! ").fadeIn('slow');
				jQuery('#option_msg').delay(3000).fadeOut('slow');
			}
		});
	}
</script>
<?php $_POST['test'];?>