<?php
/*
Plugin Name: rFactor Hotlaps
Plugin URI: http://cyberspeed.es
Description: 
Version: 0.1
Author: Jorge López Seijas
Author URI: https://github.com/Jorginho211/
License: GPLv3
*/

require_once('api.php');

function rfactor_hotlaps_load_scripts(){
    wp_register_script('vue-chunk-vendors', $src = plugins_url( '/web/js/chunk-vendors.js', __FILE__ ));
    wp_register_script('vue-app', $src = plugins_url( '/web/js/app.js', __FILE__ ) );

    wp_enqueue_script('vue-chunk-vendors');
    wp_enqueue_script('vue-app');
}

function rfactor_hotlaps_load_styles(){
    wp_register_style('vue-app', plugins_url( '/web/css/app.css', __FILE__ ));

    wp_enqueue_style('vue-app');
}

add_shortcode('hotlaps', 'generate_view');
function generate_view($atts){
    rfactor_hotlaps_load_scripts();
    rfactor_hotlaps_load_styles();

    $attributes = shortcode_atts( array(
		'src' => plugin_dir_path( __FILE__ ).'hotlapsData.xml',
    ), $atts );

    ob_start();  
    include 'view.php';
    $content = ob_get_clean();

    return $content;
}
?>
