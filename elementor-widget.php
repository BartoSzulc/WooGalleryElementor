<?php
/**
 * Plugin Name: WooGallery
 * Description: Custom Elementor Widget with Woocommerce product gallery.
 * Version: 1.0
 * Author: Bartosz Szulc
 * Author URI: https://www.linkedin.com/in/bartoszulc/
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Register Widgets.
 */
function register_my_custom_elementor_widget( $widgets_manager ) {

    require_once( __DIR__ . '/src/widgets/custom-widget.php' );

    $widgets_manager->register( new \WooGallery() ); // Register the widget

}

add_action( 'elementor/widgets/register', 'register_my_custom_elementor_widget' );

// Enqueue app.css app.js
function woogallery_enqueue_scripts() {
    $plugin_dir_url = plugin_dir_url(__FILE__);
        $read = fn ($endpoint) => file_get_contents(plugin_dir_path(__FILE__) . 'dist/' . $endpoint);
      
        $entrypoints = json_decode($read('entrypoints.json'));
      
        foreach ($entrypoints->app->js as $js_file) {
            $js_file_url = $js_file;
            wp_enqueue_script(
                'woogallery-' . $js_file,
                $js_file_url,
                [],
                null,
                true
            );
        }
        if (isset($entrypoints->app->css) && is_array($entrypoints->app->css)) {
            foreach ($entrypoints->app->css as $css_file) {
                $css_file_url = $css_file;
                wp_enqueue_style(
                    'woogallery-' . basename($css_file, '.css'), // Unique style handle
                    $css_file_url,
                    [],
                    null
                );
            }
        }
}
add_action('wp_enqueue_scripts', 'woogallery_enqueue_scripts');