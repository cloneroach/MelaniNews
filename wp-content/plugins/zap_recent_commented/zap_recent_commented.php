<?php

/*
Plugin Name: Zap_Recent_Commented
Version: 1.0
Plugin URI: http://www.zappelfillip.de/index.php/2005-12-19/zap_recent_commented-wordpress-plugin/
Author: Tom Koehler
Author URI: http://www.zappelfillip.de
Description: This plugin shows recent commented posts in the sidebar, not the comment itself but the post title. Number of shown posts can be specified.
*/

function zap_recent_commented() {

	// number of shown posts
	$show_commented = 10;

	// the word "today" in your language
	$today = "Heute";

	// the word "yesterday" in your language
	$yesterday = "Gestern";
	
	// Show pingbacks and trackbacks, too? default: no
	$show_pingtrack = false;

//--------------------------------------------------------------------------------------------------------------

	global $wpdb,$tablecomments,$tableposts;
	$commented = array();
	$jetzt = time();
	
	if($show_pingtrack) $kommentartyp = "";
	else $kommentartyp = "AND comment_type = '' ";
	
	$query = "SELECT $tableposts.*, $tablecomments.* FROM $tableposts JOIN $tablecomments WHERE $tableposts.ID=$tablecomments.comment_post_ID AND (post_status = 'publish' OR post_status = 'static') AND comment_approved= '1' AND  post_password = '' " . $kommentartyp . "ORDER BY comment_date DESC";
	$results = $wpdb->get_results($query);

	foreach ($results as $result) {
		$einfuegen = true;
		foreach ($commented as $comm) {
			if ($comm->ID == $result->ID) $einfuegen = false;
		}
		if($einfuegen) array_push($commented, $result);
		if(count($commented) == $show_commented) break;
	}

	foreach ($commented as $comm) {
		$post_link = get_permalink($comm->comment_post_ID);
		$comment_link = $post_link . "#comment-$comm->comment_ID";
		$comment_date = mysql2date(get_settings('date_format'),$comm->comment_date);
		$comment_time = mysql2date(get_settings('time_format'),$comm->comment_date);
		
		if(mysql2date('d.m.',$comm->comment_date) == date('d.m.',$jetzt))
			$zeit = $today.", ".$comment_time;
		else if (mysql2date('d.m.',$comm->comment_date) == date('d.m.',$jetzt-(24*60*60)))
			$zeit = $yesterday.", ".$comment_time;
		else
			$zeit = $comment_date.", ".$comment_time;

		echo '<li title="'.$zeit.'"><a href="'.$comment_link.'" title="'.$zeit.'">'.$comm->post_title.'</a></li>';
	}

}

?>