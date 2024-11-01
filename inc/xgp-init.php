<?php

/**
 * Install file
 *
 * @author xgenious
 * @package xg-product
 * @version 1.0.0
 */

class xgp_init {
	/*
	 * single instance for this class
	 *
	 * */
	protected static $instance;
	/*
	 * item table name
	 * */
	private $table_items;
	/*
	 * item table name
	 * */
	private $table_wishlists;

	/*
	 * return single instance of the class
	 * */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/*
	 * define constructor
	 */
	public function __construct() {
		global $wpdb;
		//define local private attribute
		$this->table_items     = $wpdb->prefix . 'xgp_wishlist';
		$this->table_wishlists = $wpdb->prefix . 'xgp_wishlist_lists';

		//add custom field to global $wpdb
		$wpdb->xgp_wishlist_items = $this->table_items;
		$wpdb->xgp_all_wisthlists = $this->table_wishlists;
		//define constant to use this all over the plugin
		define( 'XGP_WISHTLIST_ITEMS_TABLE', $this->table_items );
		define( 'XGP_WISHLISTS_TABLE', $this->table_wishlists );
		$this->init();
	}

	/*
	 * add function for init the plugin
	 * */
	public function init() {
		$this->_add_tables();
	}

	/*
	 * update function
	 * */
	public function update() {
		$this->_add_tables();
	}

	/*
	 * this function for set default optiona value
	 * */
	function default_options( $options ) {
		foreach ( $options as $section ) {
			foreach ( $section as $value ) {
				if ( isset( $value['std'] ) && isset( $value['id'] ) ) {
					add_option( $value['id'], $value['std'] );
				}
			}
		}
	}

	/*
	 * add tables for a fresh installation
	 * */
	public function _add_tables() {
		$this->_add_wishlists_table();
		$this->add_items_table();
	}

	/*
	 * add the wishlists table to the database
	 * */
	public function _add_wishlists_table() {
		//have to write table sql here;
		global $wpdb;
			$sql_query = "CREATE TABLE  IF NOT EXISTS {$this->table_wishlists} (
				ID INT ( 11 ) NOT NULL AUTO_INCREMENT,
				user_id INT ( 11 ) NOT NULL,
				wishlist_slug VARCHAR ( 191 ) NOT NULL,
				wishlist_name TEXT,
				wishlist_token VARCHAR ( 64 ) NOT NULL UNIQUE ,
				wishlist_privacy TINYINT( 1 ) NOT NULL DEFAULT 0,
				is_default TINYINT( 1 ) NOT NULL DEFAULT 0,
				dateadded timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ,
				PRIMARY KEY ( ID ),
				KEY (wishlist_slug)
			) {$wpdb->get_charset_collate()}";
		if (!function_exists('dbDelta')) {
			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		}
			dbDelta( $sql_query );
		return;
	}

	/*
	 * add the wishlists items table to the database
	 * */
	public function add_items_table() {
		global $wpdb;
			$sql_query = "CREATE TABLE IF NOT EXISTS {$this->table_items}(
				ID INT ( 11 ) NOT NULL AUTO_INCREMENT,
				prod_id INT ( 11 ) NOT NULL,
				quantity INT ( 11 ) NOT NULL,
				user_id INT ( 11 ) NOT NULL,
				wishlist_id INT ( 11 ) NOT NULL,
				dateadded TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
				PRIMARY KEY ( ID ),
				KEY (prod_id)
			) {$wpdb->get_charset_collate()}";
			if (! function_exists('dbDelta')){
				require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
			}
			dbDelta($sql_query);
	}

}
