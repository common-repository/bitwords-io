<?php

/**
 * Get data for shortcode
 */
function bitwordsShortcodePublisher($atts) {
    extract(shortcode_atts(array(
        'posts_count' => '4'
    ), $atts));

    // switch ($id) {
    //     case 1: $shortCodeContent = 'Publisher1'; break;
    //     case 2: $shortCodeContent = 'Publisher2'; break;
    //     case 3: $shortCodeContent = 'Publisher3'; break;
    //     default: break;
    // }

    $pluginLogo = plugin_dir_url(__FILE__) . '../assets/logo.png';

    // process the php view file and capture the output in a variable
    ob_start();
    include(plugin_dir_path(__FILE__) . '../views/publisher.php');
    $output = ob_get_contents();
    ob_end_clean(); // Clear the buffer.

    // require_once(plugin_dir_path(__FILE__) . '../views/publisher.php' );
    return $output;
}


/**
 * Define publisher shortcode name
 */
function bitwordsRegisterShortcode() {
    add_shortcode('bitwords', 'bitwordsShortcodePublisher');
}
add_action('init', 'bitwordsRegisterShortcode');