<?php
//embed_twine_TESTaddFooterPassage();
//embed_twine_TESTuploadPath();

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
}

function embed_twine_your_custom_callback($dir, $name, $ext){
    return $name;
}

?>
<div class="wrap">
<h1>Upload Twine story</h1>

<!-- Form -->
<form method='post' action='' name='myform' enctype='multipart/form-data'>
  <ul>
      <li><label for="embed_twine_file_select">Select file</label>
      <input class='button-secondary' id="embed_twine_file_select" type='file' name='file' accept="text/html"></li>
      <li><label for="embed_twine_file_submit">Upload it</label>
      <input class='button-primary' id="embed_twine_file_submit" type='submit' name='but_submit' value='Submit'></li>
  </ul>
</form>

<p>Original Twine story file is uploaded and stored in the uploads directory. <br>
  Processed and modified version for embedding is stored in plugin subfolder in the uploads directory.<br>
  Upon completion, you'll be provided with a shortcode. Insert this shortcode into post or page to embed your story.<br>
</p>
<br>
<br>
<p><i>Hope this plugin serves you well!<br> You can appreciate the effort put into it by <a target="_blank" href="https://wordpress.org/support/plugin/embed-twine/reviews/">rating it</a> and providing feedback, thank you.</i></p>
</div>
