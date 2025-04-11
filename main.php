<?php
/*
Plugin Name: WP Publications
Description: Adds a Publications tab to wordpress. Allows authors to add a list of academic publications to the blog.
Version: 0.2.13.2024
Author: UFS
*/

function wpap_required_scripts()
{
    wp_enqueue_style('wpap-css', plugins_url('/css/stylesheet.css', __FILE__), array(), '0.2.13.2024.7');
    wp_enqueue_script('search-wpap-js', plugins_url('/js/search.js', __FILE__), array(), '0.2.13.2024.3');
}
wpap_required_scripts();

function wpap_scripts()
{
    wp_enqueue_media();
    wp_register_script('wpap-js', plugins_url('/js/wpap.js', __FILE__), array('jquery'));
    wp_enqueue_script('wpap-js');
}

function wpap_styles()
{
    wp_enqueue_style('thickbox');
}

function wpap_loadtextdomain()
{
    load_plugin_textdomain('wpap', false, basename(dirname(__FILE__)) . '/languages/');
}

add_filter('template_include', 'single_template');
function single_template($template)
{
    $post_types = array('publication');

    if (is_singular($post_types)) {
        $template = __DIR__ . '/wpap-single.php';
    }

    return $template;
}

add_action('admin_print_scripts', 'wpap_scripts');
add_action('admin_print_styles', 'wpap_styles');

require_once('wpap-functions.php');
require_once('wpap-publication.php');

add_filter('upload_mimes', 'wpap_add_bib_to_mimes');
add_filter('manage_edit-publication_columns', 'wpap_show_publication_column');
add_filter('wp_sprintf', function ($fragment) {
    $fragment = ('%z' === $fragment) ? '' : $fragment;
    return $fragment;
});

add_action('save_post', 'wpap_save_option_meta');
add_action('init', 'wpap_create_publication');
add_action('manage_posts_custom_column', 'wpap_publication_custom_columns');
add_action('add_meta_boxes', 'wpap_add_publication_options');

add_shortcode('academicpubs', 'wpap_shortcode');
add_shortcode('academicpubs-search', 'wpap_search_shortcode');

add_action('plugins_loaded', 'wpap_loadtextdomain');

?>