<?php
/*
Plugin Name: Comments Count Filter
Plugin URI: http://wp-project.nazieb.com/plugins/comments-count-filter/
Description: Makes the comments from post author not to be counted
Version: 1.0
Author: Ainun Nazieb
Author URI: http://nazieb.com/
*/
add_filter('get_comments_number','post_comment_count');
function post_comment_count($oldcount) {
	global $wpdb, $id;
    
	$post_id = (int) $post_id;
	if ( !$post_id )
		$post_id = (int) $id;
	
	$post = get_post($post_id);
	$post_owner = $post->post_author;
	$request = "SELECT COUNT(*) FROM $wpdb->comments WHERE comment_post_ID = '$id' AND comment_approved = '1' AND user_id != '$post_owner'";

	$newcount = $wpdb->get_var($request);
	
	return $newcount;
}
?>