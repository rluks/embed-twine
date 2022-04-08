function createQuote(data) {
  console.log("createQuote");
  console.log(ajax_url);
    
  jQuery.ajax({
    type: "POST",
    url: ajax_url,
    data: {action: "embed_twine_upload", data:data}
  }).then(data => {
    console.log("SUCCESS");
    document.getElementById("embed_twine_shortcode").value = data;
  }).catch(error => {
    alert("error");
    console.log("ERROR", error);
    document.getElementById("embed_twine_shortcode").value = "eroooooor";
  });
}
  
jQuery("#embed_twine_form").on("submit", function(event) {
  event.preventDefault();
  const data = $(this).serialize();
  createQuote(data);
});