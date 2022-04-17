jQuery(document).ready(function(){
  jQuery("#embed_twine_form").on("submit", function(e){

    e.preventDefault();

    var formData = new FormData(this);
    formData.append("action", "embed_twine_upload");

    jQuery.ajax({
        type: 'POST',
        url: MyAjax.ajaxurl,
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data){
            var msgObj = JSON.parse(data);
            console.log(msgObj);    
            var shortcode = jQuery("#embed_twine_shortcode")
            shortcode.val(msgObj.shortcode);
            shortcode.focus();
        },
        error: function(jqXHR, textStatus, errorThrown) { 
          console.log("ERROR");
          console.log(textStatus);
          console.log(errorThrown);
        }
    });

  });
});