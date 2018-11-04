<?php
/*
Plugin Name: rFactor Hotlaps
Plugin URI: http://cyberspeed.es
Description: 
Version: 0.01
Author: Jorge López Seijas
Author URI: https://github.com/Jorginho211/
License: GPLv3
*/

require_once('api.php');

add_shortcode('hotlaps', 'generate_view');

function generate_view($atts){
    $attributes = shortcode_atts( array(
		'src' => plugin_dir_path( __FILE__ ).'hotlapsData.xml',
    ), $atts );
    
    $data = get_data($attributes['src']);

    $content = "";
    if(count(data) > 0){
        ob_start();  
        include 'view.php';
        $content = ob_get_clean();
    }

    return $content;
}
?>
