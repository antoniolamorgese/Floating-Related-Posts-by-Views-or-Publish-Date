<?php
/**
 * Floating Related Posts by Views or Publish Date
 *
 * Uninstalling deletes options.
 *
 */
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) 
	exit();

// Delete option plugin
if (is_multisite()) {
	$blogs = wp_list_pluck( get_sites(), 'blog_id' );
	if ($blogs) {
		foreach($blogs as $blog) {
			switch_to_blog($blog['blog_id']);
			delete_option( 'floating_related_posts_by_views_or_date_option_name' );
		}
		restore_current_blog();
	}
} else {	
	delete_option( 'floating_related_posts_by_views_or_date_option_name' );
}
