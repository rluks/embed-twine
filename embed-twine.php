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

wp_enqueue_script('eventism', plugins_url( '/js/file_upload.js' , __FILE__ ) , array( 'jquery' ));
wp_localize_script( 'eventism', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php')));
wp_register_script( "eventism", plugins_url( '/js/file_upload.js' , __FILE__ ), array('jquery') );
wp_enqueue_script( 'jquery' );

add_action( 'wp_ajax_nopriv_embed_twine_upload', 'embed_twine_ajax_upload');
add_action( 'wp_ajax_embed_twine_upload', 'embed_twine_ajax_upload' );
function embed_twine_ajax_upload() {

    $message = array();

    if($_FILES['file']['name'] != ''){
        $uploadedfile = $_FILES['file'];
        $upload_overrides = array( 'test_form' => false, 'unique_filename_callback' => 'embed_twine_your_custom_callback' );
    
        $movefile = wp_handle_upload( $uploadedfile, $upload_overrides );
    
        $filepath = "";
        if ( $movefile && ! isset( $movefile['error'] ) ) {
           $filepath = $movefile['file'];
           $message['original-file'] = $movefile['file'];
           embed_twine_addFooterPassage($filepath, $message);
        } else {
           $message['move-error'] = $movefile['error'];
           throw new Exception('Unable to upload file.');
        }
    }

    echo json_encode($message);
    wp_die();
}

function embed_twine_your_custom_callback($dir, $name, $ext){
    return $name;
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
