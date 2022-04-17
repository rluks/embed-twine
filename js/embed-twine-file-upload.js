jQuery(document).ready(function(){
  jQuery("#embed_twine_form").on("change", function(e){

    e.preventDefault();

    var formData = new FormData(this);
    formData.append("action", "embed_twine_upload");

    var status = jQuery("#embed_twine_status");
    status.empty();
    status.removeClass("error");

    var shortcode = jQuery("#embed_twine_shortcode");
    shortcode.val("");

    jQuery.ajax({
        type: 'POST',
        url: MyAjax.ajaxurl,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            status.append("Upload complete.<br>");

            var msgObj = JSON.parse(data);
            console.log(msgObj);    
            status.append("Unmodified file is stored in " + msgObj.originalfile + "<br>");

            if(msgObj.twineerror){
              status.append("Twine story processing error: " + msgObj.twineerror + "<br>");
              status.addClass("error");
              return;
            }
       
            shortcode.val(msgObj.shortcode);
            shortcode.focus();
        },
        error: function(jqXHR, textStatus, errorThrown) { 
          status.append("Error: " + errorThrown);
          status.addClass("error");
        }
    });

  });
});