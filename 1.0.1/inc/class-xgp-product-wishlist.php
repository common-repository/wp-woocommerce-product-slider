<?php

/*
 * xgp product wishlist class
 * */

Class xgp_product_wishlist {
	/*
	 * single instance of this class
	 * */
	protected static $instance;
	/*
	 * Errors Array
	 * */
	public $errors;
	/*
	 * last operation token
	 * */
	public $last_operation_token;
	/*
	 * details array
	 * */
	public $details;
	/*
	 * message array
	 * */
	public $message;

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self( $_REQUEST );
		}

		return self::$instance;
	}

	public function __construct( $details ) {
		$this->details = $details;
		add_action( 'wp_ajax_add_to_wishlist_ajax', array( $this, 'xgp_add_to_wishlist_ajax' ) );

		add_action( 'wp_ajax_nopriv_add_to_wishlist_ajax', array( $this, 'xgp_nopriv_add_to_wihlist_ajax' ) );
		add_action( 'wp_ajax_xgp_remove_from_wishlist', array( $this, 'xgp_remove_from_wishlist_ajax' ) );
	}
	public function xgp_nopriv_add_to_wihlist_ajax(){
		if ( !is_user_logged_in() ){
			wp_send_json(array('message' => __('Please Login To Create A wishlist','wp-woocommerce-product-slider'),'class' => 'error'));
			wp_die();
		}
		wp_die();
	}
	/*
	 * xgp add to wishlist ajax
	 * */
	public function xgp_add_to_wishlist_ajax() {
		//have to write code for add to wish list via ajax
		if (isset($_POST['product_id'])){
			$this->details['product_id'] = $_POST['product_id'];
		}

		$return = $this->add();
		$message = '';
		$user_id = isset($this->details['user_id']) ? $this->details['user_id'] : false;
		$wishlists = array();
		if ( $return == 'true' ){
			$message = apply_filters('xgp_product_added_to_wishlist_message',get_option('xgpw_added_in_wishlist_text','product added to wish list'));

		}elseif ( $return == 'exists' ){
			$message = apply_filters('xgp_product_already_in_wishlist_massage',get_option('xgpw_already_in_wishlist_text','product is already in wishlist'));

		}elseif(count($this->errors) > 0){
			$message = apply_filters('xgp_product_error_adding_to_wishlist_message',$this->get_errors());
		}

		wp_send_json(array(
			'result'=> $return,
			'message' => $message,
			'wishlist_url' => $this->get_wishlist_url( $this->last_operation_token),
		));
		wp_die();
	}
	public function get_wishlist_url($token){
		$wishlist_page_url = get_the_permalink(get_option('xgpw_wishlist_page'));
		$wishlist_url = add_query_arg('xgetw',$token,$wishlist_page_url);

		return $wishlist_url;
	}
	/**
	 * @return int wishlist id
	 */
	public function check_user_has_wishlist(){
		global $wpdb;
		$user_id = $this->details['user_id'] = ( is_user_logged_in()) ? get_current_user_id() : '';
		$wishlist_table = $wpdb->prefix . 'xgp_wishlist_lists';

		$sql = "SELECT * FROM `{$wishlist_table}` where user_id = {$user_id}";
		$result = $wpdb->get_results($sql,ARRAY_A);
		if (!empty($result)){
			$this->last_operation_token = $result[0]['wishlist_token'];
			return $result[0]['ID'];
		}else{
			$data = array(
				'user_id' => $this->details['user_id'],
				'wishlist_slug' => '',
				'wishlist_name' => '',
				'wishlist_token' => $this->generate_wishlist_token(),
				'wishlist_privacy' => 0,
				'is_default' => 1
			);
			$table = $wpdb->prefix .'xgp_wishlist_lists';
			$format = array('%d','%s','%s','%s','%d','%d');
			$wpdb->insert($table,$data,$format);

			return $wpdb->insert_id;
		}


	}
	/*
	 * add product to wishlist
	 *
	 * return string "error","true" or "exists"
	 * */
	public function add(){
		global $wpdb;

		$wishlist_id = $this->check_user_has_wishlist();
		if (!empty($wishlist_id )){

			$check_product_in_wishlist = $this->is_product_in_wishlist( $this->details['product_id'],$wishlist_id );

			if ($check_product_in_wishlist == 'exists'){
				return 'exists';
			}else{
				return 'true';
			}

		}

	}
/*
 * Retrieve all the wishlist matching specified arguments
 * */
//
	/*
	 * get errors
	 * */
	public function get_errors( $html = true ){
		return implode( ( $html ? '<br/>' : ', '),$this->errors );
	}

	/*
	 * check if the proeuct exists in the wishlist
	 *
	 * @param int $product_id Product id to check
	 * @param int|bool $wishlist_id wishlist where to search ( use false to search in default wishlist )
	 * @return $result bool
	 * */
	public function is_product_in_wishlist($product_id, $wishlist_id ){
		global $wpdb;

		if ( is_user_logged_in() ){
			// have to write query code to check user has wishlist or not
			$user_id = get_current_user_id();
			$table = $wpdb->prefix .'xgp_wishlist';
			$sql = "SELECT * FROM `{$table}` WHERE user_id = {$user_id} AND prod_id = {$product_id} AND wishlist_id ={$wishlist_id}";
			$result = $wpdb->get_results($sql,ARRAY_A);
			if ( empty($result) ){
				$ttable = $wpdb->prefix .'xgp_wishlist';
				$data = array(
					'prod_id' => $product_id,
					'quantity' => 1,
					'user_id' => get_current_user_id(),
					'wishlist_id' => $wishlist_id
				);
				$format = array('%s','%d','%d','%s');
				$wpdb->insert($ttable,$data,$format);

			}else{
				return 'exists';
			}
		}

	}

	/**
	 * Generate a token to visit wishlist
	 *
	 * @return string token
	 */
	public function generate_wishlist_token(){
		global $wpdb;
		$count = 0;
		$table = $wpdb->prefix .'xgp_wishlist_lists';
		$sql = "SELECT COUNT(*) FROM `{$table}` WHERE `wishlist_token` = %d";

		do{
			$directory = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
			$charts = 12;
			$token = '';
			for ( $i =0; $i <= $charts - 1; $i++ ){
				$token .= $directory[mt_rand(0,strlen($directory) -1)];
			}
			$count = $wpdb->get_var($wpdb->prepare($sql,$token));

		}while( $count != 0 );

		return $token;
	}
	/*
	 * remove form wishlist ajax action
	 * */
	public function xgp_remove_from_wishlist_ajax(){
		$product_id = (isset($_POST['product_id']) && !empty($_POST['product_id'])) ? $_POST['product_id'] : '';
		$rmv_btn = (isset($_POST['rmv_btn']) && !empty($_POST['rmv_btn'])) ? $_POST['rmv_btn'] : '';

 		$user_id = is_user_logged_in() ? get_current_user_id() : false;
		$return = $this->xgp_remove_item_form_wishlist($user_id,$product_id);
		if ($return == 'false'){
			$message = __('','wp-woocommerce-product-slider');
			$return_status = 'false';
		}else{
			if (!empty($rmv_btn)){
				$message = __('Remove From Wishlist Success','wp-woocommerce-product-slider');
				$class = 'xgp-remove';
			}else{
				$message = __('Added To Cart Success And Removed From Wishlist','wp-woocommerce-product-slider');
				$class = 'xgp-success';
			}

			$return_status = 'true';
		}

		wp_send_json(
			array(
				'message' => $message,
				'result' => $return_status,
				'class' => $class
			)
		);

		wp_die();
	}
	/*
	 * remove wishlist item form database
	 * */
	public function xgp_remove_item_form_wishlist($user_id,$product_id){
		global $wpdb;
		//"DELETE FROM `wp_xgp_wishlist` WHERE `wp_xgp_wishlist`.`ID` = 21";
		$table = $wpdb->prefix . 'xgp_wishlist';
		$sql = "DELETE FROM `{$table}` WHERE prod_id = {$product_id} AND user_id = {$user_id}";
			if ($wpdb->query($sql) != false){
				$return = 'true';
			}else{
				$return = 'false';
			}
		return $return;

	}

}
