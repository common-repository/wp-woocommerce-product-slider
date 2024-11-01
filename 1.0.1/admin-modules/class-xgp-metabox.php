<?php

/*
 * register all metabox needed for xg product slider
 *
 * */

Class xgp_metabox {
	/*
	 * set instance use this class
	 *
	 * */
	public $condition = array();
	public $condition_field = array();
	protected static $instance = null;

	/*
	 * set method instance use this class
	 *
	 * */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new xgp_metabox();
		}

		return self::$instance;
	}

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'xgp_product_slider_metabox' ) );
		add_action( 'save_post', array( $this, 'xgp_metabox_save_data' ) );
	}

	public function xgp_product_slider_metabox() {
		add_meta_box( 'xgp_product_metabox', __( 'Slider Shortcode', 'xg-product' ), array(
			$this,
			'xgp_product_slider_metabox_display'
		), 'xg-product-slider', 'side' );
		add_meta_box( 'xgp_product_settings_metabox', __( 'Slider Settings', 'xg-product' ), array(
			$this,
			'xgp_product_slider_settings_metabox_display'
		), 'xg-product-slider', 'advanced', 'high' );
	}

	/*
	 * get post object
	 * echo html for metabox
	 * */
	public function xgp_product_slider_metabox_display( $post ) {
		$id             = '[xgpp__slider id="' . $post->ID . '"]';
		$metabox_markup = '<div class="form-element has-text">
			<div class="xgp-input-field"  id="xgp_slider_shortcode" >' . $id . '</div>
			<div class="text" id="copy-btn">Copy</div>
		</div>';

		echo $metabox_markup;
	}

	public function xgp_product_slider_settings_metabox_display( $post ) {


		$animate_options = array(
			'bounce'             => __( 'bounce', 'xg-product' ),
			'flash'              => __( 'flash', 'xg-product' ),
			'pulse'              => __( 'pulse', 'xg-product' ),
			'rubberBand'         => __( 'rubberBand', 'xg-product' ),
			'shake'              => __( 'shake', 'xg-product' ),
			'swing'              => __( 'swing', 'xg-product' ),
			'tada'               => __( 'tada', 'xg-product' ),
			'wobble'             => __( 'wobble', 'xg-product' ),
			'jello'              => __( 'jello', 'xg-product' ),
			'bounceIn'           => __( 'bounceIn', 'xg-product' ),
			'bounceInDown'       => __( 'bounceInDown', 'xg-product' ),
			'bounceInLeft'       => __( 'bounceInLeft', 'xg-product' ),
			'bounceInRight'      => __( 'bounceInRight', 'xg-product' ),
			'bounceInUp'         => __( 'bounceInUp', 'xg-product' ),
			'bounceOut'          => __( 'bounceOut', 'xg-product' ),
			'bounceOutDown'      => __( 'bounceOutDown', 'xg-product' ),
			'bounceOutLeft'      => __( 'bounceOutLeft', 'xg-product' ),
			'bounceOutRight'     => __( 'bounceOutRight', 'xg-product' ),
			'bounceOutUp'        => __( 'bounceOutUp', 'xg-product' ),
			'fadeIn'             => __( 'fadeIn', 'xg-product' ),
			'fadeInDown'         => __( 'fadeInDown', 'xg-product' ),
			'fadeInDownBig'      => __( 'fadeInDownBig', 'xg-product' ),
			'fadeInLeft'         => __( 'fadeInLeft', 'xg-product' ),
			'fadeInLeftBig'      => __( 'fadeInLeftBig', 'xg-product' ),
			'fadeInRight'        => __( 'fadeInRight', 'xg-product' ),
			'fadeInRightBig'     => __( 'fadeInRightBig', 'xg-product' ),
			'fadeInUp'           => __( 'fadeInUp', 'xg-product' ),
			'fadeInUpBig'        => __( 'fadeInUpBig', 'xg-product' ),
			'fadeOut'            => __( 'fadeOut', 'xg-product' ),
			'fadeOutDown'        => __( 'fadeOutDown', 'xg-product' ),
			'fadeOutDownBig'     => __( 'fadeOutDownBig', 'xg-product' ),
			'fadeOutLeft'        => __( 'fadeOutLeft', 'xg-product' ),
			'fadeOutLeftBig'     => __( 'fadeOutLeftBig', 'xg-product' ),
			'fadeOutRight'       => __( 'fadeOutRight', 'xg-product' ),
			'fadeOutRightBig'    => __( 'fadeOutRightBig', 'xg-product' ),
			'fadeOutUp'          => __( 'fadeOutUp', 'xg-product' ),
			'fadeOutUpBig'       => __( 'fadeOutUpBig', 'xg-product' ),
			'flip'               => __( 'flip', 'xg-product' ),
			'flipInX'            => __( 'flipInX', 'xg-product' ),
			'flipInY'            => __( 'flipInY', 'xg-product' ),
			'flipOutX'           => __( 'flipOutX', 'xg-product' ),
			'flipOutY'           => __( 'flipOutY', 'xg-product' ),
			'lightSpeedIn'       => __( 'lightSpeedIn', 'xg-product' ),
			'lightSpeedOut'      => __( 'lightSpeedOut', 'xg-product' ),
			'rotateIn'           => __( 'rotateIn', 'xg-product' ),
			'rotateInDownLeft'   => __( 'rotateInDownLeft', 'xg-product' ),
			'rotateInDownRight'  => __( 'rotateInDownRight', 'xg-product' ),
			'rotateInUpLeft'     => __( 'rotateInUpLeft', 'xg-product' ),
			'rotateInUpRight'    => __( 'rotateInUpRight', 'xg-product' ),
			'rotateOut'          => __( 'rotateOut', 'xg-product' ),
			'rotateOutDownLeft'  => __( 'rotateOutDownLeft', 'xg-product' ),
			'rotateOutDownRight' => __( 'rotateOutDownRight', 'xg-product' ),
			'rotateOutUpLeft'    => __( 'rotateOutUpLeft', 'xg-product' ),
			'rotateOutUpRight'   => __( 'rotateOutUpRight', 'xg-product' ),
			'slideInUp'          => __( 'slideInUp', 'xg-product' ),
			'slideInDown'        => __( 'slideInDown', 'xg-product' ),
			'slideInLeft'        => __( 'slideInLeft', 'xg-product' ),
			'slideInRight'       => __( 'slideInRight', 'xg-product' ),
			'slideOutUp'         => __( 'slideOutUp', 'xg-product' ),
			'slideOutDown'       => __( 'slideOutDown', 'xg-product' ),
			'slideOutLeft'       => __( 'slideOutLeft', 'xg-product' ),
			'slideOutRight'      => __( 'slideOutRight', 'xg-product' ),
			'zoomIn'             => __( 'zoomIn', 'xg-product' ),
			'zoomInDown'         => __( 'zoomInDown', 'xg-product' ),
			'zoomInLeft'         => __( 'zoomInLeft', 'xg-product' ),
			'zoomInRight'        => __( 'zoomInRight', 'xg-product' ),
			'zoomInUp'           => __( 'zoomInUp', 'xg-product' ),
			'zoomOut'            => __( 'zoomOut', 'xg-product' ),
			'zoomOutDown'        => __( 'zoomOutDown', 'xg-product' ),
			'zoomOutLeft'        => __( 'zoomOutLeft', 'xg-product' ),
			'zoomOutRight'       => __( 'zoomOutRight', 'xg-product' ),
			'zoomOutUp'          => __( 'zoomOutUp', 'xg-product' ),
			'hinge'              => __( 'hinge', 'xg-product' ),
			'jackInTheBox'       => __( 'jackInTheBox', 'xg-product' ),
			'rollIn'             => __( 'rollIn', 'xg-product' ),
			'rollOut'            => __( 'rollOut', 'xg-product' ),
		);

		$output = '<div id="xgp_metabox_tabs">
			<ul class="xgp-tab-nav">
				<li><a href="#general"> ' . __( 'General Settings', 'xg-product' ) . ' </a></li>
				<li><a href="#slider"> ' . __( 'Slider Settings', 'xg-product' ) . '  </a></li>
				<li><a href="#styling"> ' . __( 'Styling Settings', 'xg-product' ) . '  </a></li>
				<li><a href="#typo"> ' . __( 'Typography Settings', 'xg-product' ) . ' </a></li>
			</ul>
			<div class="xgp-tab-container">';
		/*----------------------------------
			general tab content start
		 ------------------------------------*/

		$pd_terms             = get_terms( 'product_cat' );
		$product_caregory_arr = array();
		foreach ( $pd_terms as $terms ) {
			$product_caregory_arr[ $terms->term_id ] = $terms->name;
		}

		$output .= '<div id="general">';
		$output .= wp_nonce_field( 'xgp_metabox', 'xgp_metabox_nonce' );
		$output .= $this->_select( array(
			'label'         => __( 'Slider Type', 'xg-product' ),
			'name'          => 'slider_type',
			'description'   => __( 'Select slider type', 'xg-product' ),
			'has_condition' => true,
			'options'       => array(
				'product_slider'  => __( 'Product Slider', 'xg-product' ),
				'category_slider' => __( 'Category Slider', 'xg-product' ),
			)
		) );

		$output .= $this->_select( array(
			'label'           => __( 'Select Category', 'xg-product' ),
			'name'            => 'xgp_category',
			'description'     => __( 'Select Category For Slider', 'xg-product' ),
			'condition_field' => array( 'slider_type' => 'xgp_category' ),
			'condition'       => array(
				'slider_type' => 'category_slider'
			),
			'options'         => $product_caregory_arr
		) );

		$output .= '<div class="xgp-form-element">
						<label class="label" for="slider_theme">
							'.esc_html__('Slider Theme','xg-product').'
							<span class="help-text">'.esc_html__('Select slider theme','xg-product').'</span>
						</label>
						<select name="slider_theme" class="xgp-input-field" id="slider_theme">
						<option value="01" >'.esc_html__('Theme 01','xg-product').' </option>
						<option value="02" >'.esc_html__('Theme 02','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 03 (Pro)','xg-product').' </option>
						<option value="01" disabled>'.esc_html__('Theme 04 (Pro)','xg-product').' </option>
						<option value="01" disabled>'.esc_html__('Theme 05 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 06 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 07 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 08 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 09 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 10 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 11 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 12 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 13 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 14 (Pro)','xg-product').'</option>
						<option value="01" disabled>'.esc_html__('Theme 15 (Pro)','xg-product').'</option>
						</select>
						</div>';
		$output .= '<div class="xgp-form-element">
						<label class="label" for="product_type">
							'.esc_html__('Product Type','xg-product').'
							<span class="help-text">'.esc_html__('Select product type for slider','xg-product').'</span>
						</label>
						<select name="product_type" class="xgp-input-field" id="product_type">
						<option value="latest">'.esc_html__('Latest','xg-product').' </option>
						<option value="" disabled>'.esc_html__('Featured (Pro) ','xg-product').'</option>
						<option value="" disabled>'.esc_html__('Best Selling (Pro)','xg-product').'</option>
						<option value="" disabled>'.esc_html__('Upsells (Pro) ','xg-product').'</option>
						<option value="" disabled>'.esc_html__('Top Rated (Pro) ','xg-product').'</option>
						<option value="" disabled>'.esc_html__('On Sale (Pro)','xg-product').' </option>
						</select>
						</div>';
		$output .= $this->_text_field( array(
			'label'       => __( 'Number Of Column In Slider In Desktop', 'xg-product' ),
			'name'        => 'column_in_desktop',
			'description' => __( 'Set Number Of Column In Slider In Desktop', 'xg-product' ),
			'default'     => 4,
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Number Of Column In Slider In Tablet', 'xg-product' ),
			'name'        => 'column_in_tablet',
			'description' => __( 'Set Number Of Column In Slider In Tablet', 'xg-product' ),
			'default'     => 2
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Number Of Column In Slider In Mobile', 'xg-product' ),
			'name'        => 'column_in_mobile',
			'description' => __( 'Set Number Of Column In Slider In Mobile', 'xg-product' ),
			'default'     => 1
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Total Product', 'xg-product' ),
			'name'        => 'total_product',
			'description' => __( 'Enter how many item you want it slider . enter -1 for unlimited product', 'xg-product' ),
			'default'     => - 1
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Badge / Ribbon ', 'xg-product' ),
			'name'        => 'xgp_badge_status',
			'description' => __( 'enable disable badge/ribbon for slider', 'xg-product' ),
			'options'     => array(
				'true'  => __( 'Enable', 'xg-product' ),
				'false' => __( 'Disable', 'xg-product' ),
			)
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Enter Badge/Ribbon Text', 'xg-product' ),
			'name'        => 'xgp_badge',
			'description' => __( 'Enter badge/ribbon text to show as a badge in each item of slider', 'xg-product' ),
			'default'     => 'New'
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Order By', 'xg-product' ),
			'name'        => 'order_by',
			'description' => __( 'Select order by for slider', 'xg-product' ),
			'options'     => array(
				'ID'    => __( 'ID', 'xg-product' ),
				'date'  => __( 'Date', 'xg-product' ),
				'title' => __( 'Title', 'xg-product' ),
				'rand'  => __( 'Random', 'xg-product' ),
			),
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Order', 'xg-product' ),
			'name'        => 'order',
			'description' => __( 'Select order for slider', 'xg-product' ),
			'options'     => array(
				'ASC'  => __( 'Ascending', 'xg-product' ),
				'DESC' => __( 'Descending', 'xg-product' ),
			)
		) );
		$output .= '</div>';

		/*----------------------------------
			slider tab content start
		 ------------------------------------*/
		$output .= '<div id="slider">';

		$output .= $this->_select( array(
			'label'       => __( 'Auto play', 'xg-product' ),
			'name'        => 'autoplay',
			'description' => __( ' Enable / disable for autoplay', 'xg-product' ),
			'options'     => array(
				'true'  => __( 'Enable', 'xg-product' ),
				'false' => __( 'Disable', 'xg-product' ),
			)
		) );

		$output .= $this->_text_field( array(
			'label'       => __( 'Autoplay Speed', 'xg-product' ),
			'name'        => 'autoplay_speed',
			'description' => __( 'Enter autoplay speed . cunted as miliseconds', 'xg-product' ),
			'default'     => 5000
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Margin', 'xg-product' ),
			'name'        => 'margin',
			'description' => __( 'Enter margin for slider. enter only number don\'t need to enter px ', 'xg-product' ),
			'default'     => '30'
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Pause On Hover', 'xg-product' ),
			'name'        => 'pause_on_hover',
			'description' => __( ' Enable / disable pause on hover', 'xg-product' ),
			'options'     => array(
				'true'  => __( 'Enable', 'xg-product' ),
				'false' => __( 'Disable', 'xg-product' ),
			)
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Navigation', 'xg-product' ),
			'name'        => 'navigation',
			'description' => __( ' Enable / disable slider navigation', 'xg-product' ),
			'options'     => array(
				'true'  => __( 'Enable', 'xg-product' ),
				'false' => __( 'Disable', 'xg-product' ),
			)
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Loop', 'xg-product' ),
			'name'        => 'loop',
			'description' => __( ' Enable / disable slider loop', 'xg-product' ),
			'options'     => array(
				'true'  => __( 'Enable', 'xg-product' ),
				'false' => __( 'Disable', 'xg-product' ),
			)
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Center Mode', 'xg-product' ),
			'name'        => 'center_mode',
			'description' => __( ' Enable / disable slider loop', 'xg-product' ),
			'options'     => array(
				'false' => __( 'Disable', 'xg-product' ),
				'true'  => __( 'Enable', 'xg-product' ),
			)
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Animate In', 'xg-product' ),
			'name'        => 'animate_in',
			'description' => __( ' select animation for slider in', 'xg-product' ),
			'options'     => $animate_options
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Animate Out', 'xg-product' ),
			'name'        => 'animate_out',
			'description' => __( ' select animation for slider out', 'xg-product' ),
			'options'     => $animate_options
		) );
		$output .= $this->_select( array(
			'label'       => __( 'Pagination Dots', 'xg-product' ),
			'name'        => 'pagination',
			'description' => __( ' Enable / disable slider pagination', 'xg-product' ),
			'options'     => array(
				'true'  => __( 'Enable', 'xg-product' ),
				'false' => __( 'Disable', 'xg-product' ),
			)
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Navigation Background Color', 'xg-product' ),
			'name'        => 'nav_bg_color',
			'description' => __( 'Select navigation background color', 'xg-product' ),
			'default'     => '#F7875D'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Navigation Background Hover Color', 'xg-product' ),
			'name'        => 'nav_bg_hover_color',
			'description' => __( 'Select navigation background hover color', 'xg-product' ),
			'default'     => '#333'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Navigation Color', 'xg-product' ),
			'name'        => 'nav_color',
			'description' => __( 'Select navigation color', 'xg-product' ),
			'default'     => '#fff'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Navigation  Hover Color', 'xg-product' ),
			'name'        => 'nav_hover_color',
			'description' => __( 'Select navigation hover color', 'xg-product' ),
			'default'     => '#fff'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Pagination Dots Color', 'xg-product' ),
			'name'        => 'pagi_dot_color',
			'description' => __( 'Select pagination dots color', 'xg-product' ),
			'default'     => '#ddd'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Pagination Dots Active Color', 'xg-product' ),
			'name'        => 'pagi_dot_active_color',
			'description' => __( 'Select pagination dots active color', 'xg-product' ),
			'default'     => '#F7875D'
		) );
		$output .= '</div>';
		/*--------------------------------
			slider tab content end
		 --------------------------------*/

		/*----------------------------------
			styling tab content start
		 ------------------------------------*/
		$output .= '<div id="styling" class="styling xgp-overlay"> <div class="pro-area">
                                <div class="pro-inner">
                                    <a target="_blank" href="https://codecanyon.net/item/xg-woocommerce-product-slider-product-quick-view-product-wishlist-all-in-one-product-slider/22572845" class="pro-btn"> Go Pro</a>
                                </div>
                            </div>';

		$output .= $this->_color_picker( array(
			'label'       => __( 'Title Color', 'xg-product' ),
			'name'        => 'title_color',
			'description' => __( 'Change title color from here', 'xg-product' ),
			'default'     => '#333'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Title Hover Color', 'xg-product' ),
			'name'        => 'title_hover_color',
			'description' => __( 'Change title hover color from here', 'xg-product' ),
			'default'     => '#FE8761'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Price Color', 'xg-product' ),
			'name'        => 'price_color',
			'description' => __( 'Change price color from here', 'xg-product' ),
			'default'     => '#333'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Discount Price Color', 'xg-product' ),
			'name'        => 'discount_price_color',
			'description' => __( 'Change discount price color from here', 'xg-product' ),
			'default'     => '#777'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Badge Color', 'xg-product' ),
			'name'        => 'badge_color',
			'description' => __( 'Change badge/ribbon color from here', 'xg-product' ),
			'default'     => '#fff'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Badge Background Color', 'xg-product' ),
			'name'        => 'badge_bg_color',
			'description' => __( 'Change badge/ribbon background color from here', 'xg-product' ),
			'default'     => '#F7875D'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Rating Color', 'xg-product' ),
			'name'        => 'rating_color',
			'description' => __( 'Change rating color from here', 'xg-product' ),
			'default'     => '#FC7D37'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Icon Color', 'xg-product' ),
			'name'        => 'icon_Color',
			'description' => __( 'Change icon color from here', 'xg-product' ),
			'default'     => '#333'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Icon Background Color', 'xg-product' ),
			'name'        => 'icon_bg_Color',
			'description' => __( 'Change icon background color from here', 'xg-product' ),
			'default'     => '#fff'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Icon Border Color', 'xg-product' ),
			'name'        => 'icon_border_Color',
			'description' => __( 'Change icon border color from here', 'xg-product' ),
			'default'     => '#f2f2f2'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Icon Hover Color', 'xg-product' ),
			'name'        => 'icon_hover_Color',
			'description' => __( 'Change icon hover color from here', 'xg-product' ),
			'default'     => '#fff'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Icon Hover Background Color', 'xg-product' ),
			'name'        => 'icon_hover_bg_Color',
			'description' => __( 'Change icon hover background color from here', 'xg-product' ),
			'default'     => '#FE8761'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Icon Hover Border Color', 'xg-product' ),
			'name'        => 'icon_hover_border_Color',
			'description' => __( 'Change icon hover border color from here', 'xg-product' ),
			'default'     => '#FE8761'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Button Color', 'xg-product' ),
			'name'        => 'btn_Color',
			'description' => __( 'Change button color from here', 'xg-product' ),
			'default'     => '#333'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Button Hover Color', 'xg-product' ),
			'name'        => 'btn_hover_Color',
			'description' => __( 'Change button hover color from here', 'xg-product' ),
			'default'     => '#fff'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Button  Background Color', 'xg-product' ),
			'name'        => 'btn_bg_Color',
			'description' => __( 'Change button background color from here', 'xg-product' ),
			'default'     => '#333'
		) );
		$output .= $this->_color_picker( array(
			'label'       => __( 'Button Hover Background Color', 'xg-product' ),
			'name'        => 'btn_hover_bg_Color',
			'description' => __( 'Change button hover background color from here', 'xg-product' ),
			'default'     => '#FE8761'
		) );

		$output .= '</div>';
		/*------------------------------------
			typography tab content start
		 ------------------------------------*/
		$output .= '<div id="typo">';
		$output .= $this->_text_field( array(
			'label'       => __( 'Ribbon/Badge Font Size', 'xg-product' ),
			'name'        => 'badge_font_size',
			'description' => __( 'Change ribbon font size from here', 'xg-product' ),
			'default'     => '12px'
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Title Font Size', 'xg-product' ),
			'name'        => 'title_font_size',
			'description' => __( 'Change title font size from here', 'xg-product' ),
			'default'     => '20px'
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Price Font Size', 'xg-product' ),
			'name'        => 'price_font_size',
			'description' => __( 'Change price font size from here', 'xg-product' ),
			'default'     => '16px'
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Rating Font Size', 'xg-product' ),
			'name'        => 'rating_font_size',
			'description' => __( 'Change rating font size from here', 'xg-product' ),
			'default'     => '14px'
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Icon Font Size', 'xg-product' ),
			'name'        => 'icon_font_size',
			'description' => __( 'Change icon font size from here', 'xg-product' ),
			'default'     => '14px'
		) );
		$output .= $this->_text_field( array(
			'label'       => __( 'Button Font Size', 'xg-product' ),
			'name'        => 'btn_font_size',
			'description' => __( 'Change button font size from here', 'xg-product' ),
			'default'     => '12px'
		) );
		$output .= '</div>';

		/*----------------------------------
			styling tab content end
		------------------------------------*/

		$output .= '<div></div>';

		echo $output;

	}

	/*
	 * select
	 * render select field
	 * */
	public function _select( $attr = array() ) {
		global $post;
		$attr['label']           = ( $attr['label'] ) ? $attr['label'] : '';
		$attr['select_2']        = ( isset( $attr['select_2'] ) && $attr['select_2'] ) ? $attr['select_2'] : false;
		$attr['multiple']        = ( isset( $attr['multiple'] ) && $attr['multiple'] ) ? $attr['multiple'] : false;
		$attr['has_condition']   = ( isset( $attr['has_condition'] ) && $attr['has_condition'] ) ? $attr['has_condition'] : false;
		$attr['name']            = ( $attr['name'] ) ? $attr['name'] : '';
		$attr['description']     = ( $attr['description'] ) ? $attr['description'] : '';
		$attr['condition']       = ( isset( $attr['condition'] ) && is_array( $attr['condition'] ) && $attr['condition'] ) ? $attr['condition'] : false;
		$attr['condition_field'] = ( isset( $attr['condition_field'] ) && is_array( $attr['condition_field'] ) && $attr['condition_field'] ) ? $attr['condition_field'] : false;
		$attr['options']         = ( is_array( $attr['options'] ) && ! empty( $attr['options'] ) ) ? $attr['options'] : array();

		$value           = get_post_meta( $post->ID, $attr['name'], true );
		$attr['default'] = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
		$attr['value']   = ! empty( $value ) ? $value : $attr['default'];
		$select2         = ( $attr['select_2'] == true ) ? 'xgp-select-2' : '';
		$multiple        = ( $attr['multiple'] == true ) ? 'multiple="multiple"' : '';
		$xgp_condition   = ( $attr['condition'] == false ) ? '' : 'xgp_condition_field';
		$has_condition   = ( $attr['has_condition'] == false ) ? '' : 'xgp_has_condition';
		$display_none    = ( $xgp_condition != '' ) ? 'xgp_display_none' : '';

		$condition_field = ( $attr['condition_field'] != false ) ? $attr['condition_field'] : '';

		if ( $condition_field != '' ) {
			array_push( $this->condition_field, $condition_field );
		}

		if ( $attr['multiple'] != false ) {
			array_push( $this->condition, $attr['condition'] );
		}

		wp_localize_script( 'xgp-metabox-js', 'xgpCon', array(
			'condition'       => $this->condition,
			'condition_field' => $this->condition_field
		) );

		$output = '<div class="xgp-form-element"  >
						<label class="label" for="' . esc_attr( $attr['name'] ) . '">
							' . esc_html( $attr['label'] ) . '
							<span class="help-text">' . esc_html( $attr['description'] ) . '</span>
						</label>
						<select name="' . $attr['name'] . '" class="xgp-input-field ' . $xgp_condition . ' ' . $has_condition . ' ' . $select2 . ' " ' . $multiple . ' id="' . $attr['name'] . '" >';

		foreach ( $attr['options'] as $key => $value ) {
			$checked = $attr['value'] == $key ? "selected='selected'" : '';
			$output  .= '<option value="' . esc_attr( $key ) . '" ' . $checked . ' >' . esc_html( $value ) . ' </option>';
		}

		$output .= '</select></div>';

		return $output;
	}

	/*
	 * text field
	 * render text field
	 * */
	public function _text_field( $attr = array() ) {
		global $post;
		$attr['label']       = ( $attr['label'] ) ? $attr['label'] : '';
		$attr['name']        = ( $attr['name'] ) ? $attr['name'] : '';
		$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
		$value               = get_post_meta( $post->ID, $attr['name'], true );
		$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
		$attr['value']       = ! empty( $value ) ? $value : $attr['default'];
		$output              = '<div class="xgp-form-element ">
						<label class="label" for="">' . esc_html( $attr['label'] ) . ' <span class="help-text">' . esc_html( $attr['description'] ) . '</span></label>
						<input type="text" name="' . esc_attr( $attr['name'] ) . '" id="' . esc_attr( $attr['name'] ) . '" class="xgp-input-field" value="' . $attr['value'] . '">
					</div>';

		return $output;
	}

	/*
	 * color picker
	 * color picker field
	 * */
	public function _color_picker( $attr = array() ) {
		global $post;
		$attr['label']       = ( $attr['label'] ) ? $attr['label'] : '';
		$attr['name']        = ( $attr['name'] ) ? $attr['name'] : '';
		$attr['description'] = ( $attr['description'] ) ? $attr['description'] : '';
		$value               = get_post_meta( $post->ID, $attr['name'], true );
		$attr['default']     = ( isset( $attr['default'] ) && ! empty( $attr['default'] ) ) ? $attr['default'] : '';
		$attr['value']       = ! empty( $value ) ? $value : $attr['default'];
		$output              = '<div class="xgp-form-element ">
						<label class="label" for="">' . esc_html( $attr['label'] ) . ' <span class="help-text">' . esc_html( $attr['description'] ) . '</span></label>
						<input type="text" name="' . esc_attr( $attr['name'] ) . '" id="' . esc_attr( $attr['name'] ) . '" class="xgp-input-field xgp_color_picker" value="' . $attr['value'] . '">
					</div>';

		return $output;
	}

	/*
	 * metabox save data
	 * @method
	 * */
	public function xgp_metabox_save_data( $post_id ) {
		$validation = $this->_metabox_vaildation( 'xgp_metabox_nonce', 'xgp_metabox', $post_id );
		if ( $validation == false ) {
			return $post_id;
		}

		$field_list = array(
			'nav_bg_color',
			'nav_bg_hover_color',
			'nav_color',
			'nav_hover_color',
			'pagi_dot_color',
			'pagi_dot_active_color',
			'badge_font_size',
			'title_font_size',
			'price_font_size',
			'rating_font_size',
			'rating_font_size',
			'btn_font_size',
			'column_in_desktop',
			'column_in_tablet',
			'column_in_mobile',
			'total_product',
			'autoplay_speed',
			'margin',
			'xgp_badge',
			'icon_font_size',
			'rating_color'
		);
		foreach ( $field_list as $field ) {
			$value = isset( $_POST[ $field ] ) ? $_POST[ $field ] : '';
			$value = sanitize_text_field( $value );

			if ( $value == '' ) {
				continue;
			}
			update_post_meta( $post_id, $field, $value );
		}
		$trfl_arr      = array( 'true', 'false' );
		$animate_class = array(
			'bounce',
			'flash',
			'pulse',
			'rubberBand',
			'shake',
			'swing',
			'tada',
			'wobble',
			'jello',
			'bounceIn',
			'bounceInDown',
			'bounceInLeft',
			'bounceInRight',
			'bounceInUp',
			'bounceOut',
			'bounceOutDown',
			'bounceOutLeft',
			'bounceOutRight',
			'bounceOutUp',
			'fadeIn',
			'fadeInDown',
			'fadeInDownBig',
			'fadeInLeft',
			'fadeInLeftBig',
			'fadeInRight',
			'fadeInRightBig',
			'fadeInUp',
			'fadeInUpBig',
			'fadeOut',
			'fadeOutDown',
			'fadeOutDownBig',
			'fadeOutLeft',
			'fadeOutLeftBig',
			'fadeOutRight',
			'fadeOutRightBig',
			'fadeOutUp',
			'fadeOutUpBig',
			'flip',
			'flipInX',
			'flipInY',
			'flipOutX',
			'flipOutY',
			'lightSpeedIn',
			'lightSpeedOut',
			'rotateIn',
			'rotateInDownLeft',
			'rotateInDownRight',
			'rotateInUpLeft',
			'rotateInUpRight',
			'rotateOut',
			'rotateOutDownLeft',
			'rotateOutDownRight',
			'rotateOutUpLeft',
			'rotateOutUpRight',
			'slideInUp',
			'slideInDown',
			'slideInLeft',
			'slideInRight',
			'slideOutUp',
			'slideOutDown',
			'slideOutLeft',
			'slideOutRight',
			'zoomIn',
			'zoomInDown',
			'zoomInLeft',
			'zoomInRight',
			'zoomInUp',
			'zoomOut',
			'zoomOutDown',
			'zoomOutLeft',
			'zoomOutRight',
			'zoomOutUp',
			'hinge',
			'jackInTheBox',
			'rollIn',
			'rollOut'
		);
		$select_array  = array(
			'slider_type'      => array( 'category_slider', 'product_slider' ),
			'slider_theme'     => array(
				'01',
				'02',
			),
			'product_type'     => array(
				'latest',
				'featured',
				'best_selling',
				'upsells',
				'top_rated',
				'on_sale',
				'products_from_sku',
				'products_from_attribute',
				'free_products'
			),
			'order_by'         => array( 'ID', 'date', 'title', 'rand' ),
			'order'            => array( 'ASC', 'DESC' ),
			'autoplay'         => $trfl_arr,
			'pause_on_hover'   => $trfl_arr,
			'navigation'       => $trfl_arr,
			'loop'             => $trfl_arr,
			'center_mode'      => $trfl_arr,
			'animate_in'       => $animate_class,
			'animate_out'      => $animate_class,
			'pagination'       => $trfl_arr,
			'xgp_badge_status' => $trfl_arr,
		);

		foreach ( $select_array as $key => $field ) {
			$value = isset( $_POST[ $key ] ) ? $_POST[ $key ] : '';
			if ( in_array( $value, $field ) ) {
				update_post_meta( $post_id, $key, $value );
			}

		}
		if ( isset( $_POST['xgp_category'] ) && $_POST['xgp_category'] != '' ) {
			update_post_meta( $post_id, 'xgp_category', $_POST['xgp_category'] );
		}

	}

	private function _metabox_vaildation( $nonce_field, $action, $post_id ) {
		$nonce = isset( $_POST[ $nonce_field ] ) ? $_POST[ $nonce_field ] : '';

		if ( $nonce == '' ) {
			return false;
		}
		if ( ! wp_verify_nonce( $nonce, $action ) ) {
			return false;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return false;
		}
		if ( wp_is_post_autosave( $post_id ) ) {
			return false;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return false;
		}

		return true;
	}
}

new xgp_metabox();















