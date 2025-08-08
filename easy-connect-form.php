<?php
/**
 * Plugin Name: Easy Connect Form
 * Description: Simple contact form for beginners.
 * Version: 1.0.0
 * Author: Nasheeg Abrahams
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function ecf_enqueue_styles() {
    wp_enqueue_style( 'ecf-style', plugin_dir_url( __FILE__ ) . 'css/easy-connect-form.css' );
}

add_action( 'wp_enqueue_scripts', 'ecf_enqueue_styles' );

function ecf_contact_form_shortcode() {
    ob_start(); // Start capturing output
    include plugin_dir_path( __FILE__ ) . 'contact-form.php'; // This echoes HTML
    return ob_get_clean(); // Return all captured output as a string
}

add_shortcode('ecf_contact_form', 'ecf_contact_form_shortcode');