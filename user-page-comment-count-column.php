<?php
/*
Plugin Name: User Page Comment Count Column
Description: Displays a comment count column on the manage users admin page
Plugin URI:  http://www.fightingreality.com/blog
Version:     1.0
Author:      Bradley Jacobs
Author URI:  http://www.fightingreality.com/blog

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

------------------------------------------------------------------------------------
 ACKNOWLEDGEMENT
------------------------------------------------------------------------------------
This plugin is based loosely on the Comment Count Admin seen here:
http://www.crazytoast.de/plugin-comment-count-admin-kommentarzaehler.html
Authored by Crazy Girl at http://www.crazytoast.de/
------------------------------------------------------------------------------------
*/

if ( is_admin() ) {
	// Add column
	add_filter('manage_users_columns', 'add_custom_column');
	// Add values to new column
	add_filter('manage_users_custom_column', 'comment_counter', 10, 3);
}

function comment_counter($filler, $column_name, $user_id) {
	global $wpdb;
	
	$queryString="SELECT COUNT(*) as comments FROM $wpdb->comments WHERE user_id=".($user_id);
	$comments_count = $wpdb->get_var($queryString);
	$comments_count = "&nbsp;$comments_count"; 
	return $comments_count;
}

function add_custom_column( $cols ) {
	$cols['comment_count'] = 'Comment Count';
	return $cols;
}

?>