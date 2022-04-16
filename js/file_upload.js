jQuery(document).ready(function(){
  jQuery("#embed_twine_file_submit").click(function(e){
    e.preventDefault();

    console.log("jq post");

    jQuery.ajax({
        type: 'POST',
        url: MyAjax.ajaxurl,
        data: {"action": "embed_twine_upload", data:{"BLEM":100}},
        success: function(data){
            //alert(data);
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