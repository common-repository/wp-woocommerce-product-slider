<?php
// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

	global $wpdb;

	$table_items = $wpdb->prefix .'xgp_wishlist';
	$table_wishlists = $wpdb->prefix .'xgp_wishlist_lists';

	$sql_query = "DROP TABLE IF EXISTS {$table_items}";
	$sql_query_2 = "DROP TABLE IF EXISTS {$table_wishlists}";
	if (!function_exists('dbDelta')) {
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	}
	dbDelta($sql_query);
	dbDelta($sql_query_2);

