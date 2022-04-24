<style>

ol {
  list-style: none;
  counter-reset: steps;
  margin-top: 1.5rem;
}
ol li {
  counter-increment: steps;
  font-size: 16px;
}
ol li::before {
  content: counter(steps);
  margin-right: 0.5rem;
  background: #fff;
  color: #1D2327;
  width: 2.2em;
  height: 2.2em;
  border-radius: 50%;
  display: inline-grid;
  place-items: center;
  line-height: 1.2em;
}

h2 {
  font-size: 24px;
  font-weight: normal;
  margin-top: 2rem;
}

p {
  font-size: 16px;
}


#embed_twine_status{
  margin-top: 1.5rem;
  font-weight: 100;
}

input[type=file]::file-selector-button {
  margin: 0rem .5rem;
}

input[type=file]::file-selector-button:hover {

}



</style>

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
  <input class='button-secondary inputfile' id="embed_twine_file_select" type='file' name='file' accept="text/html">
</form>

<div id="embed_twine_status">
</div>

<h2>3. Copy shortcode</h2>
<p>Copy this shortcode:</p>

<input type="text" value="" readonly="" id="embed_twine_shortcode" size="30">
<button class='button-primary' id="embed_twine_copy_shortcode">Copy to clipboard</button>

<h2>4. Paste the shortcode on a page</h2>
<p>Insert the shortcode to any page or post, save it and enjoy your embedded story.</p>

<p><i>Hope this plugin serves you well!<br> You can appreciate the effort put into it by <a target="_blank" href="https://wordpress.org/support/plugin/embed-twine/reviews/">rating it</a> and providing feedback, thank you.</i></p>
</div>

