jQuery(document).ready(function(){
  jQuery("#embed_twine_form").on("submit", function(e){

    e.preventDefault();

    //const data = new FormData(this);
    //console.log(data);

    jQuery.ajax({
        type: 'POST',
        url: MyAjax.ajaxurl,
        //contentType: "multipart/form-data",       //When sending data to the server, use this content type.
        //dataType : "text",                        //The type of data that you're expecting back from the server. If none is specified, jQuery will try to infer it based on the MIME type of the response
        data: {"action": "embed_twine_upload", data:{kk:"kkk"}},
        //contentType: false,
        //processData:false,
        success: function(data){
            console.log("SUCCESS");
            console.log(data);
        },
        error: function(jqXHR, textStatus, errorThrown) { 
          console.log("ERROR");
          console.log(textStatus);
        }
    });

  });
});