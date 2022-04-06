<?php

function embed_twine_buildParentPage($storyName, $aheight, $autoscroll, $ascroll){

    $storyPath = embed_twine_getRelativeStoryPathFromName($storyName);

    $beginJS = "<script type=\"text/javascript\">" . PHP_EOL;

    //shortcode parameters
    $aheightVar = "var heightAdjustment = " . $aheight . ";" . PHP_EOL;
    $autoscrollVar = "var autoscroll = " . $autoscroll . ";" . PHP_EOL;
    $ascrollVar = "var scrollAdjustment = " . $ascroll . ";" . PHP_EOL;

    $parentJS = embed_twine_loadFile(plugin_dir_path(__DIR__) . "js/embed-twine-parent-page.js");
    $endJS = PHP_EOL . "</script>" . PHP_EOL;

    $pageJS = $beginJS . $aheightVar . $autoscrollVar . $ascrollVar . $parentJS . $endJS;

    $beginHTML = "<div><iframe id=\"my_iframe\" src=\"";
    $endHTML = "\" scrolling=\"yes\" width=\"100%\"></iframe></div>";

    $pageHTML = $beginHTML . $storyPath . $endHTML;

    $parentPage = $pageJS . $pageHTML;

    return $parentPage;
}
