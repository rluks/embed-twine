jQuery(document).ready(function(){
    jQuery("#embed_twine_copy_shortcode").on("click", function(e){

        var copyText = jQuery("#embed_twine_shortcode");
        copyText.select();

        var shortcode = copyText.val();
        navigator.clipboard.writeText(shortcode);

        var copyBtn = jQuery("#embed_twine_copy_shortcode");
        var btnText = copyBtn.text();
        copyBtn.text("Copied!");

        var temp = setInterval( function(){
            copyBtn.text(btnText);
            clearInterval(temp);
          }, 600 );
        

    });
});