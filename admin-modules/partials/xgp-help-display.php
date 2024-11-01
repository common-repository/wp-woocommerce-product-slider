<?php

    $args = array(
            'post_type' => 'xg-product-slider',
            'posts_per_page' => -1
    );
    $allshortcode = new WP_Query($args);

    $sort_array ='';

    while ($allshortcode->have_posts()){
        $allshortcode->the_post();
        $selected = (get_option('xgp_upsells_shortcode') == get_the_ID()) ? 'selected' : '';
	    $sort_array.='<option value="'.esc_attr(get_the_ID()).'" '.$selected.' >'.esc_html(get_the_title()).'</option>';
    }

?>


<div class="content-wrap">
	<div class="xgp-product-quick-view-settings">
		<div class="xgp-heading-area">
			<h1 class="page-title"><?php _e('XG WooCommerce Product Slider','xg-product')?></h1>
			<p><?php _e('Xg Product Slider is a collection of WooCommerce Product Slider with 15 unique style. it help you to create beautifully slider layout in  couple of minutes. In Slider you have Quick view options , Wishlist options and also compare options. It super easy to use.','xg-product')?></p>
		</div>
		<div class="settings-area-wrapper">

			<div id="tabs" class="">
				<div class="xgp-tab-container">

					<div id="styling">
						<div class="styling-content-wrapper">
							<div class="help-block-wrapper">
                                <div class="main-row">
                                    <div class="col-lg-4">
                                        <div class="xgp-panel">
                                            <div class="icon">
                                                <i class="flaticon-support"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php esc_html_e('Need Any Help ?','xg-product')?></h4>
                                                <p><?php esc_html_e('We are always ready to support you and solved your problem as soon as possible.','xg-product')?></p>
                                                <a href="<?php echo esc_url('https://codecanyon.net/user/xgenious')?>" class="action-btn" target="_blank"><?php esc_html_e('Contact Support','xg-product')?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="xgp-panel">
                                            <div class="icon">
                                                <i class="flaticon-writing"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php esc_html_e('Read Documentation ?','xg-product')?></h4>
                                                <p><?php esc_html_e('We have detailed documentation on every aspects of XG Product Slider.'.'xg-product')?></p>
                                                <a href="<?php echo esc_url('https://plugins.xgenious.com/xg-product/docs')?>" target="_blank" class="action-btn"><?php esc_html_e('Read Documentation','xg-product')?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="xgp-panel">
                                            <div class="icon">
                                                <i class="flaticon-application-window-with-text"></i>
                                            </div>
                                            <div class="content">
                                                <h4 class="title"><?php esc_html_e('Live Demo ?','xg-product')?></h4>
                                                <p><?php esc_html_e('If you want to see live demo of xg product slider.click below and see all live demo .','xg-product')?></p>
                                                <a href="<?php echo esc_url('https://codecanyon.net/item/xg-woocommerce-product-slider-product-quick-view-product-wishlist-all-in-one-product-slider/22572845')?>" target="_blank" class="action-btn"><?php esc_html_e('View Demo','xg-product')?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="xgp-panel text-left" style="text-align: left">
                                            <div class="content">
                                                <h4 class="title"><?php esc_html_e('Pro Feature','xg-product')?></h4>
                                                <ul>
                                                    <li> <strong><?php echo esc_html__('15 Unique Design','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Ajax Add To Cart','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Ajax Quick View','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Ajax wishlist','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Category Wise slider','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Featured Product Slider','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Latest Product Slider','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Top Rated Product Slider','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Upsells Product Slider','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Top Selling Product Slider','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Typhography Options','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Slider Styling Options','xg-product')?></strong></li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div> <div class="col-lg-4">
                                        <div class="xgp-panel text-left"  style="text-align: left">
                                            <div class="content">
                                                <h4 class="title"><?php esc_html_e('Pro Feature','xg-product')?></h4>
                                                <ul>

                                                    <li> <strong><?php echo esc_html__('Clean & Organised Code','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Translate Ready','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('WpBakery Support','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Elementor Support','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Animataion Library Included','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Easily Manageable Settings Panel','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Shortcode Generator','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Fully Respnosive','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Fully Cusotomizeable','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Step by step Video Tutorial','xg-product')?></strong></li>
                                                    <li> <strong><?php echo esc_html__('Step by step Written Doc','xg-product')?></strong></li>
                                                    <li> <strong> <?php echo esc_html__('Dedicated Support','xg-product')?></strong></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="quick-setup-video">
                                    <h2 class="title"><?php esc_html_e('Quick Setup For Xg Product Slider Video Tutorial','xg-product')?></h2>
                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/p-R9rlUn2zg" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>