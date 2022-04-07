<?php

/*
// Upload file
if(isset($_POST['but_submit'])){

  if($_FILES['file']['name'] != ''){
    $uploadedfile = $_FILES['file'];
    $upload_overrides = array( 'test_form' => false, 'unique_filename_callback' => 'embed_twine_your_custom_callback' );

    $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );

    $filepath = "";
    if ( $movefile && ! isset( $movefile['error'] ) ) {
       $filepath = $movefile['file'];
       echo "<div class='updated notice is-dismissible'><p>", "Original Twine story uploaded to ", $movefile['file'], "</p></div>" , "<br>", PHP_EOL;
       embed_twine_addFooterPassage($filepath);
    } else {
       echo "<div class='error notice'></p>", basename(__FILE__), " - " , $movefile['error'], "</p></div>" , "<br>", PHP_EOL;
       throw new Exception('Unable to upload file.');
    }
  }
}*/

function embed_twine_your_custom_callback($dir, $name, $ext){
    return $name;
}

?>

<div class="wrap">
<h1>Embed your story in 4 steps</h1>

<ol>
  <li>Export story from Twine</li>
  <li>Upload it</li>
  <li>Copy shortcode</li>
  <li>Paste shortcode on a page</li>
</ol> 

<h2>1. Export story from Twine</h2>
<p>Open your story in Twine and select "Publish to File".</p>

<h2>2. Upload it</h2>
<p>Upload the exported .html file here: </p>

<form method='post' action='' name='myform' id="embed_twine_form" enctype='multipart/form-data'>
  <ul>
      <li><input class='button-secondary' id="embed_twine_file_select" type='file' name='file' accept="text/html"></li>
      <li><input class='button-primary' id="embed_twine_file_submit" type='submit' name='but_submit' value='Upload'></li>
  </ul>
</form>

<h2>3. Copy shortcode</h2>
<p>Copy this shortcode:</p>

<input type="text" value="" readonly="" id="embed_twine_shortcode" size="30">
<button class='button-primary' id="embed_twine_copy_shortcode">Copy</button>

<h2>4. Paste the shortcode on a page</h2>
<p>Insert the shortcode to any page or post, save it and enjoy your embedded story.</p>

<p><i>Hope this plugin serves you well!<br> You can appreciate the effort put into it by <a target="_blank" href="https://wordpress.org/support/plugin/embed-twine/reviews/">rating it</a> and providing feedback, thank you.</i></p>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
function createQuote(data) {

  $.ajax({
    type: "POST",
    url: "admin-ajax.php",
    data: {action: "embed_twine_upload", data:data}
  }).then(data => {
    document.getElementById("embed_twine_shortcode").value = data;
  }).catch(error => {
    alert("error");
    console.log("ERROR", error);
    document.getElementById("embed_twine_shortcode").value = "eroooooor";
  });
}

$("#embed_twine_form").on("submit", function(event) {
  event.preventDefault();
  const data = $(this).serialize();
  createQuote(data);
});
</script>

