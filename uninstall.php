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
delete_option( 'floating_related_posts_by_views_or_date_option_name' );
