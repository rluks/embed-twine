<?php

/**
* Plugin Name: Embed Twine
* Description: Insert Twine stories into WordPress
* Version: 0.0.6
* Author: Roman Luks
* Author URI: https://romanluks.eu/
* License: GPLv2 or later
*/

require_once('include/embed-twine-load-file.php');
require_once('include/embed-twine-parent-page.php');
require_once('include/embed-twine-process-story.php');

// Add plugin to WP menu
add_action("admin_menu", "embed_twine_customplugin_menu");
function embed_twine_customplugin_menu() {

    $menu = add_menu_page("Embed Twine", "Embed Twine","manage_options", __FILE__, "embed_twine_uploadfile");
}

function embed_twine_uploadfile(){
    include "include/embed-twine-upload-file.php";
}

add_action( 'wp_ajax_embed_twine_upload', 'embed_twine_ajax_upload' );
 
function embed_twine_ajax_upload() {

    echo "[embed_twine story=\"Story\"]";
    wp_die(); // All ajax handlers die when finished
}

// Add shortcode
function embed_twine_shortcodes_init()
{
    function embed_twine_shortcode($atts = [], $content = null)
    {
        // Attributes
        $atts = shortcode_atts(
            array(
                'story' => 'Story',
                'aheight' => 112,       //adjust for style.height (30) and margins of tw-story (2x41)
                'autoscroll' => true,   //autoscroll enabled by default
                'ascroll' => 100,       //adjust for autoscroll
            ),
            $atts,
            'embed_twine'
        );

        $content = embed_twine_buildParentPage($atts['story'], $atts['aheight'], $atts['autoscroll'], $atts['ascroll']);

        return $content;
    }
    add_shortcode('embed_twine', 'embed_twine_shortcode');
}
add_action('init', 'embed_twine_shortcodes_init');
