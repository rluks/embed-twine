<?php

function embed_twine_buildFooterPassageElementOpen($footerPID){

  $passageOpenTagBegin = "<tw-passagedata pid=\"";
  $passageOpenTagEnd = "\" name=\"PassageFooter\" tags=\"footer\" position=\"174,80\" size=\"100,100\">";

  $passageOpenTag = $passageOpenTagBegin . $footerPID . $passageOpenTagEnd . PHP_EOL;

  return $passageOpenTag;
}

function embed_twine_buildFooterPassageJS($sugarCube){

    $beginPassageJS = "";

    if($sugarCube)
      $beginPassageJS = "&lt;&lt;script&gt;&gt;" . PHP_EOL;
    else
      $beginPassageJS = "&lt;script&gt;" . PHP_EOL;

    $passageJScode = embed_twine_loadFile(plugin_dir_path(__DIR__) . "js/embed-twine-footer-passage.js");
    $passageJScode = htmlentities($passageJScode);

    $endPassageJS = "";
    if($sugarCube)
      $endPassageJS = PHP_EOL . "&lt;&lt;/script&gt;&gt" . PHP_EOL;
    else
      $endPassageJS = PHP_EOL . "&lt;/script&gt;" . PHP_EOL;

    $passageJS = $beginPassageJS . $passageJScode . $endPassageJS;

    return $passageJS;
}

function embed_twine_buildFooterPassage($footerPID, $sugarCube){

  $passageOpenTag = embed_twine_buildFooterPassageElementOpen($footerPID);
  $passageJS = embed_twine_buildFooterPassageJS($sugarCube);
  $passageCloseTag = "</tw-passagedata>";

  $footerPassage = $passageOpenTag . $passageJS . $passageCloseTag;

  return $footerPassage;
}

function embed_twine_getRelativeStoryPathFromName($name){

    $contentPath = wp_make_link_relative(wp_upload_dir()['baseurl']);
    $storyPath = $contentPath . "/embed-twine/" . $name . ".html";

    //echo  $storyPath, "<br>", PHP_EOL;
    //path: /wp-content/uploads/embed-twine/Story.html

    return $storyPath;
}

function embed_twine_getFullStoryPathFromName($name){

    $dir = trailingslashit( wp_upload_dir()['basedir'] ) . 'embed-twine';
    $storyPath = $dir ."/" . $name . ".html";

    //echo $storyPath, "<br>", PHP_EOL;
    //path: /var/www/html/wp-content/uploads/embed-twine/Story.html

    return $storyPath;
}

function embed_twine_getFilenameFromPath($path){

   $path_parts = pathinfo($path);
   $filename = $path_parts['filename'];

   return $filename;
}

function embed_twine_createPublicFolder(){

  $path = embed_twine_getFullStoryPathFromName("Story");
  $path_parts = pathinfo($path);
  $dir = $path_parts['dirname'];

  if (!file_exists($dir)) {
      if(!mkdir($dir, 0755, true)){
        echo "<div class='error notice'></p>", basename(__FILE__), " - " , __FUNCTION__, "(): " , "Error: Couldn't create public folder for stories ", $dir ,". Please create \"Public\" folder manually. Set public permissions to read and execute for both the folder and files within.", "</p></div>" , "<br>", PHP_EOL;
      }
  }
}

// Process file
function embed_twine_addFooterPassage($path, &$message){

    //$message = array();

    $contents = embed_twine_loadFile($path);

    //find maxPID tw-passagedata pid="NUM"
    if(!preg_match_all('/(tw-passagedata pid=")(\d+)/', $contents, $matches)){
        //echo "<div class='error notice'></p>", basename(__FILE__), " - " , __FUNCTION__, "(): " , "Error: Couldn't find passagedata.", "</p></div>" , "<br>", PHP_EOL;
        $message['twine-error'] = "Couldn't find passagedata.";
        return;
    }

    $maxPID = max($matches[2]);
    $footerPID = $maxPID + 1;

    //find </tw-storydata>
    $pos = strpos($contents, "</tw-storydata>");
    if ($pos === false) {
        //echo "<div class='error notice'></p>", basename(__FILE__), " - " , __FUNCTION__, "(): " , "Error: tw-storydata not found.", "</p></div>" , "<br>", PHP_EOL;
        $message['twine-error'] = "tw-storydata not found.";
        return;
    }

    //check for SugarCube
    $sugarCube = null;
    if(preg_match_all('/(SugarCube)/', $contents, $matches) > 2){//licence, consolehack licenced, SugarCube JS
      $sugarCube = true;
    }else{
      $sugarCube = false;
    }

    //is there already a footer passage? (SugarCube)
    $posFooter = strpos($contents, "name=\"PassageFooter\"");
    if ($posFooter === false) {

      //add footer passage with maxPID++
      $str_to_insert = embed_twine_buildFooterPassage($footerPID, $sugarCube);
      $contentsFooter = substr($contents, 0, $pos) . $str_to_insert . substr($contents, $pos);

    }else{
      //footer exists
      $posFooterEnd = strpos($contents, "</tw-passagedata>", $posFooter);
      if ($posFooterEnd === false) {
        //echo "<div class='error notice'></p>", basename(__FILE__), " - " , __FUNCTION__, "(): " , "Error:  PassageFooter missing closing tag.", "</p></div>" , "<br>", PHP_EOL;
        $message['twine-error'] = "PassageFooter missing closing tag.";
        return;
      }else{
        $passageJS = embed_twine_buildFooterPassageJS($sugarCube);
        $contentsFooter = substr($contents, 0, $posFooterEnd) . $passageJS . substr($contents, $posFooterEnd);
      }

    }

    $storyName = embed_twine_getFilenameFromPath($path);
    $responsiveStoryPath = embed_twine_getFullStoryPathFromName($storyName);

    embed_twine_createPublicFolder();
    file_put_contents($responsiveStoryPath, $contentsFooter);

    $message['processed-file'] = $responsiveStoryPath;
    $message['shortcode'] = "[embed_twine story=\"" . $storyName . "\"]";//[embed_twine story="SugarCubeStoryFooter"]
    //$message['php'] = phpversion();

    //return $message;
    //echo "<div class='updated notice is-dismissible'><p>", "Processed and modified version is stored in ", $responsiveStoryPath, "</p></div>" , "<br>", PHP_EOL;
    //echo "<div class='updated notice is-dismissible'><p>", "Processing Twine story complete. <br>Add shortcode [embed_twine story=\"", $storyName, "\"] into post or page." , "</p></div>" , "<br>", PHP_EOL;
}
