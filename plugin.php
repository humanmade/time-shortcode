<?php
/**
 * Plugin Name: Time Shortcode
 * Description: Adds a [time] shortcode to parse and format times.
 * Author: Human Made
 */

namespace HM\TimeShortcode;

require __DIR__ . '/inc/namespace.php';

add_action( 'init', __NAMESPACE__ . '\\register_shortcode' );
