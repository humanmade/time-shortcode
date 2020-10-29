<?php

namespace HM\TimeShortcode;

/**
 * Register the shortcode.
 */
function register_shortcode() {
	add_shortcode( 'time', __NAMESPACE__ . '\\handle_time_shortcode' );
}

/**
 * Builds the time shortcode output.
 *
 * This implements the functionality of the Gallery Shortcode for displaying
 * WordPress images on a post.
 *
 * @param array $attr Attributes of the gallery shortcode.
 * @param string $content Shortcode content.
 * @return string HTML content to display time.
 */
function handle_time_shortcode( $attr, $content = '' ) {
	// Replace non-breaking spaces with a regular white space.
	$gmtcontent = preg_replace( '/\xC2\xA0|&nbsp;/', ' ', $content );

	// PHP understands "GMT" better than "UTC" for timezones.
	$gmtcontent = str_replace( 'UTC', 'GMT', $gmtcontent );

	// Remove the word "at" from the string, if present. Allows strings like "Monday, April 6 at 19:00 UTC" to work.
	$gmtcontent = str_replace( ' at ', ' ', $gmtcontent );

	// Try to parse the time, relative to the post time.
	// Or current time, if `relative` is specified.
	$is_relative = isset( $attr[0] ) && $attr[0] === 'relative';
	$timestamp = $is_relative ? time() : get_the_date( 'U' );
	$time = strtotime( $gmtcontent, $timestamp );

	// If that didn't work, give up.
	if ( false === $time || -1 === $time ) {
		return $content;
	}

	// Build the link and abbr microformat.
	$out = sprintf(
		'<time datetime="%s">%s</time>',
		gmdate( 'c', $time ),
		$content
	);

	// Return the new link.
	return $out;
}
