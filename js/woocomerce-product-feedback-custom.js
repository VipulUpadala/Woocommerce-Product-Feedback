/** This files Use Of Fancybox Open And Store Product Feedback Form */
var $ = jQuery;
$(document).on("click","#add_btn",function() {
    $('body').append('<div class="dailogBoxbackground"></div>');
    $('body').addClass('popupDailogBox');
    $("#divForm").dialog({ modal: true, autoOpen: false, closeText: '', width: 450, height: 500,close: CloseFunction, });
    $('#divForm').dialog('open');
});
// Product Feed Back Data Ajax Function
$(document).on("click","#custome_post_save",function(e) {
    e.preventDefault();
    var user_email = $( '#user_email' ).val();
    var radioStatus = $("input[name='rate']:checked").val();
    var counter = 0;
    var num = 0;
    $( ".pfb_input" ).each(function () {
        if ( $( this ).val() === "" ) {
            $( this ).addClass( "redClass" );
            $( this ).css("border", "red solid 2px");
            $( "#custome_post_save" ).prop( 'disabled', true );
            counter++;
        }
    });
    $("input[name='rating']").blur(function (){
        $( "#custome_post_save" ).prop( 'disabled', false );
    });
    $( ".pfb_input" ).blur( function () {
        if ( $( this ).val() ) {
            $( this ).removeClass( 'redClass' );
            $( this ).css("border", "");
            counter--;
        }
        if ( counter == 0 && num == 1 ) {
            $( "#custome_post_save" ).prop( 'disabled', false );
        }
    });
    /** Email ID Is Validate Or No...*/
    if ( /(.+)@(.+){2,}\.(.+){2,}/.test( user_email )) {
        num = 0;
    } else {
        if ( counter === 0 ) {
            $( '#user_email' ).css("border", "red solid 2px");
            counter = 1;
        }
        $( "#custome_post_save" ).prop( 'disabled', true );
        num = num + 1;
    }
    
    if ( counter > 0 || num > 0 ) {
        $( ".pfb_input" ).each(function () {
            if ( $( this ).val() === "" ) {
            }
        });
    } else {

        if( radioStatus != undefined ){
        var formData = $('#divForm form').serialize();
        $.ajax({
            url: ajaxurl.ajaxparams,
            type: 'POST',
            data: {
                action: 'woocomerce_feedback_insert_data_in_custome_post',
                formData: formData,
            },
            success: function ( data ) {
                $( '#register_data_msg' ).html( "Success Fully Insert Data !" ).fadeIn( 'slow' )
                $( '#register_data_msg' ).delay( 3000 ).fadeOut( 'slow' );
                $( "#custome_post_save" ).prop( 'disabled', true );
                $( '#user_name' ).val('');
                $( '#last_name' ).val('');
                $( '#user_email' ).val('');
                $( '#phone_number' ).val('');
                $( '#user_comment' ).val('');
                $("input[name='rate']:checked").val(false);
                
            },
        });
        $("div.dailogBoxbackground").remove();
        $('#divForm').dialog('close');

        }else{
            alert("Please select rating...");
        }

    }
    
});
function CloseFunction() {
    $('body').removeClass('popupDailogBox');
    $("div.dailogBoxbackground").remove();
    $('#divForm').dialog('close');
}