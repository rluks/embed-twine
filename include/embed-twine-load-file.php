<?php

function embed_twine_loadFile($path){

    $contents = file_get_contents($path);

    if ( $contents === false )
    {
       echo "<div class='error notice'></p>", basename(__FILE__), " - " , __FUNCTION__, "(): " , "Error: Unable to load file ", $path, "</p></div>" , "<br>", PHP_EOL;
       throw new Exception('Unable to load file.');
    }

    return $contents;
}
