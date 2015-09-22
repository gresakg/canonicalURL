<?php
/**
 * @package Canonical URL
 * @version 0.1 
 */
/*
Plugin Name: Canonical URL
Plugin URI: https://github.com/polhec/canonicalURL
Description: Canonical URL
Author: Tine Dolžan
Version: 0.2 
Author URI: https://github.com/polhec
*/

add_action('init', 'rm_rel_canonical');

function rm_rel_canonical() {
	remove_action( 'wp_head', 'rel_canonical' );
	add_action( 'wp_head', 'canURL_rel_canonical' );
}
 
function canURL_rel_canonical() 
{
	if ( !is_singular() )
    	return;
	global $wp_the_query;

  	if ( !$id = $wp_the_query->get_queried_object_id() )
    	return;
 
  	$canonical = get_post_meta( $id, 'canonical_URL', TRUE );
  	if( $canonical ) 
	{
	    	echo "<link rel='canonical' href='$canonical' />\n";
	    	return;
	}
 
	$link = get_permalink( $id );
	if ( $page = get_query_var('cpage') )
		$link = get_comments_pagenum_link( $page );

	echo "<link rel='canonical' href='$link' />\n";
}

?>
