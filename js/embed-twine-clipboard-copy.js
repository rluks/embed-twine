jQuery(document).ready(function(){
    jQuery("#embed_twine_copy_shortcode").on("click", function(e){

        var copyText = jQuery("#embed_twine_shortcode");
        copyText.select();

        var shortcode = copyText.val();
        navigator.clipboard.writeText(shortcode);

    });
});