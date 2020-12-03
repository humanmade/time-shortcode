<?php
/**
 * Plugin Name: Time Shortcode
 * Description: Adds a [time] shortcode to parse and format times.
 * Author: Human Made
 */

namespace HM\TimeShortcode;

require __DIR__ . '/inc/namespace.php';

add_action( 'init', __NAMESPACE__ . '\\register_shortcode' );
add_filter( 'strip_shortcodes_tagnames', __NAMESPACE__ . '\\do_not_strip_time_shortcode', 10, 2 );
