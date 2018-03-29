<?php

	/*
	Thinglink Shortcode definition

	Can be used in the following ways:

	[thinglink 332179040200818688]

	OR

	[thinglink http://www.thinglink.com/scene/328464001878982656 w="320"]

	Shortcode emits single embed code for the linked Thinglink scene.

	Takes optional "w" parameter
    */


function ThinglinkShortCode($params = array()) {
    // default parameters
	$scene = $params[0];
	$parameters	= shortcode_atts( array(
		'w' => isset( $content_width ) ? $content_width : 640
		), $params );
	$w = $parameters['w'];

	// Check if param is scene id
	if ( !preg_match( "/^\d+$/" , $scene ) ) {
		// Check if param is of type http://www.thinglink.com/scene/<sceneid>
		$matches = array();
		if ( preg_match("/\/scene\/(\d+)(?:\D.*)?$/", $scene, $matches ) && count( $matches ) == 2 )
			$scene = $matches[1] ;
		else
			return "<p> unknown thinglink object " . esc_html($scene) . "</p>";
	}
	return '<img src="' . esc_url( '//cdn.thinglink.me/api/image/' . $scene . '/230/230/none#tl-' . $scene . ';' ) . '" width="' . esc_attr( $w ) . '" class="alwaysThinglink" />
<script async charset="utf-8" src="//cdn.thinglink.me/jse/embed.js"></script>';
}

add_shortcode('thinglink', 'ThinglinkShortCode');
?>
