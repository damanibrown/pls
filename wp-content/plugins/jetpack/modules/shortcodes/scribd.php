<?php

/* Scribd Short Code
Author: Nick Momrik

[scribd id=DOCUMENT_ID key=DOCUMENT_KEY mode=MODE]
DOCUMENT_ID is an integer (also used as an object_id)
DOCUMENT_KEY is an alphanumeric hash ('-' character as well)
MODE can be 'list', 'book', 'slide', 'slideshow', or 'tile'

[scribd id=39027960 key=key-3kaiwcjqhtipf25m8tw mode=list]
*/

function scribd_shortcode_handler( $atts ) {
	$atts = shortcode_atts( array(
		'id'   => 0,
		'key'  => 0,
		'mode' => "",
	), $atts );

	$modes = array( 'list', 'book', 'slide', 'slideshow', 'tile' );

	$atts['id'] = (int) $atts['id'];
	if ( preg_match( '/^[A-Za-z0-9-]+$/', $atts['key'], $m ) ) {
		$atts['key'] = $m[0];

		if ( !in_array( $atts['mode'], $modes ) )
			$atts['mode'] = '';

		return scribd_shortcode_markup( $atts );
	} else {
		return '';
	}
}

function scribd_shortcode_markup( $atts ) {
	$markup = <<<EOD
<iframe class="scribd_iframe_embed" src="http://www.scribd.com/embeds/$atts[id]/content?start_page=1&view_mode=$atts[mode]&access_key=$atts[key]" data-auto-height="true" scrolling="no" id="scribd_$atts[id]" width="100%" height="500" frameborder="0"></iframe>
<div style="font-size:10px;text-align:center;width:100%"><a href="http://www.scribd.com/doc/$atts[id]">View this document on Scribd</a></div>
EOD;

	return $markup;
}

add_shortcode( 'scribd', 'scribd_shortcode_handler' );