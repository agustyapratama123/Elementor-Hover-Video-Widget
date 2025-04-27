<?php
/*
Plugin Name: Elementor Hover Video Widgettt
Description: A custom Elementor widget to display an image that turns into a video on hover.
Version: 1.0
Author: Your Name
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Register Widget
function register_hover_video_widget( $widgets_manager ) {
    require_once __DIR__ . '/widgets/hover-video-widget.php';
    $widgets_manager->register( new \Elementor_Hover_Video_Widget() );
}
add_action( 'elementor/widgets/register', 'register_hover_video_widget' );

// Enqueue Styles and Scripts
function enqueue_hover_video_widget_assets() {
    wp_enqueue_style( 'hover-video-widget-style', plugins_url( 'assets/css/style.css', __FILE__ ) );
    wp_enqueue_script( 'hover-video-widget-script', plugins_url( 'assets/js/script.js', __FILE__ ), array( 'jquery' ), null, true );
}
add_action( 'wp_enqueue_scripts', 'enqueue_hover_video_widget_assets' );