jQuery(document).ready(function(){
  jQuery("#embed_twine_form").on("change", function(e){

    e.preventDefault();

    var formData = new FormData(this);
    formData.append("action", "embed_twine_upload");

    var status = jQuery("#embed_twine_status");
    status.empty();
    status.removeClass("error");

    jQuery.ajax({
        type: 'POST',
        url: MyAjax.ajaxurl,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            status.append("Upload complete.");
            var msgObj = JSON.parse(data);
            console.log(msgObj);    
            var shortcode = jQuery("#embed_twine_shortcode")
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