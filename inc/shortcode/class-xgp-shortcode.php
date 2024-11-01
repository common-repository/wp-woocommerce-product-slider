<?php
/**
 * @package Product Carusel
 * @version 1.0.0
 *
 **/
if ( ! defined( 'ABSPATH' ) ) {
	header( 'HTTP/1.0 403 Forbidden' );
	exit;
}

class xgp_shotcode {
	public function __construct() {
		add_shortcode('xgp-wishlist-content',array($this,'wishlist_view_shortcode'));
		add_shortcode('xgpp__slider',array($this,'xgp_slider_shortcode'));
	}

	/*
	 * shortcode for rendering wishlist view
	 * */
	public function wishlist_view_shortcode($attrs,$content=null){
		global $wpdb;

		$user_id = is_user_logged_in() ? get_current_user_id() : false;
		$query_var = (isset($_GET['xgetw']) && !empty($_GET['xgetw'])) ? $_GET['xgetw'] : false;


		$output = '<div class="xgp-wishlist-container"><div id="xgp-message-show"></div>';
		$output .= '<div class="xgp-wishlist-header-area"><h2 class="title">'.esc_html(get_option('xgpw_title')).'</h2>';
		$output .= '<div class="xgp-wishlist-table-area"><table class="xghp-wishlist-table">';
		$output .= '<thead>
			<tr>
			<th></th>
			<th>'.__('Product Name','wp-woocommerce-product-slider').'</th>
			<th>'.__('Unit Price','wp-woocommerce-product-slider').'</th>
			<th>'.__('Stock Status','wp-woocommerce-product-slider').'</th>
			<th></th>
			<th></th>
</tr>
</thead>';
		$output .= '<tbody>';

		if ( $user_id == false && empty($query_var)){
			$output .= '<tr><td colspan="6"><div class="xgp_wishlist-not-found"><h4 class="title">'.__('You Have No Wishlist At The Moment .','wp-woocommerce-product-slider').'</h4></div></td></tr>';
		}elseif (!empty($user_id) && $query_var == false ){

			$user_wishlist_obj = xgp_user_wishlist_array($user_id);
			$wishlist_id = $user_wishlist_obj['ID'];
			$user_wishlist_item = xgp_user_wishlist($wishlist_id,$user_id);
			if (count($user_wishlist_item) > 0){

				foreach ($user_wishlist_item as $witem){
					global $product;
					$product = wc_get_product($witem['prod_id']);
					$avilability = $product->get_availability();
					$stock_status = isset($avilability['class']) ? $avilability['class'] : false;
					if ($stock_status == 'out-of-stock'){
						$stock_markkup = ' <span class="xgp-wishlist-out-of-stock">'.__('Out of Stock','wp-woocommerce-product-slider').' </span>  ';
						$add_to_cart_markup = '';
					}else{
						$stock_markkup = ' <span class="xgp-wishlist-in-stock">'.__('In Stock','wp-woocommerce-product-slider').'</span>  ';
						$add_to_cart_markup = ' <a href="" data-quantity="1" class=" product_type_simple add_to_cart_button ajax_add_to_cart xgp_add_to_cart_wish_page" data-product_id="'.$witem["prod_id"].'" data-product_sku="'.$product->get_sku().'" aria-label="Add “'.$product->get_title().'” to your cart" rel="nofollow"> '.__('Add to Cart','wp-woocommerce-product-slider').'</a>';
					}
					$base_product = $product->is_type( 'variable' ) ? $product->get_variation_regular_price( 'max' ) : $product->get_price();

					$pric_markup = $base_product ? $product->get_price_html() : __('Free!', 'wp-woocommerce-product-slider' );

					if ( is_user_logged_in() && get_current_user_id() == $witem['user_id'] ){
						$remove_markup = '<div><a href="#" class="xg_remove_from_wishlist" title="Remove this product" data-product_id="'.$witem["prod_id"].'">×</a></div>';
					}else{
						$remove_markup = '';
					}

					$output .='<tr id="xgp-wishlist-row-'.$witem['prod_id'].'" data-row-id="'.$witem['prod_id'].'">
					<td class="xgp-product-remove">
				        '.$remove_markup.'
				    </td>
				     <td class="xgp-product-thumbnail">
				       <a href="'.get_permalink($witem['prod_id']).'">'.$product->get_image().'</a>
				        <a class="xgp-product-name" href="'.get_permalink($witem['prod_id']).'">'.$product->get_title().' </a>
				    </td>
				    <td class="xgp-product-price">
				                   '.$pric_markup.'               
				    </td>
				    <td class="xgp-product-stock-status">
				        '.$stock_markkup.'                          
				    </td>
				    <td class="xgp-product-add-to-cart">
					      <span class="xgp-dateadded">'.__('Added On ','wp-woocommerce-product-slider'). date('jS F, Y',strtotime( $witem['dateadded'])).'</span>
					     '.$add_to_cart_markup.'
					      
				    </td>
				</tr>';

				}


			}else{
				$output .= '<tr><td colspan="6"><div class="xgp_wishlist-not-found"><h4 class="title">'.__('You Have No Wishlist At The Moment .','wp-woocommerce-product-slider').'</h4></div></td></tr>';
			}

		}elseif (!empty($query_var)){
			//have to write code for get query var
			$user_wishlist_obj = xgp_user_wishlist_array(null,$query_var);
			$wishlist_id = $user_wishlist_obj['ID'];
			$user_wishlist_item = xgp_user_wishlist($wishlist_id,$user_wishlist_obj['user_id']);

			if (count($user_wishlist_item) > 0){

				foreach ($user_wishlist_item as $witem){
					global $product;
					$product = wc_get_product($witem['prod_id']);
					$avilability = $product->get_availability();
					$stock_status = isset($avilability['class']) ? $avilability['class'] : false;
					if ($stock_status == 'out-of-stock'){
						$stock_markkup = ' <span class="xgp-wishlist-out-of-stock">'.__('Out of Stock','wp-woocommerce-product-slider').' </span>  ';
						$add_to_cart_markup = '';
					}else{
						$stock_markkup = ' <span class="xgp-wishlist-in-stock">'.__('In Stock','wp-woocommerce-product-slider').'</span>  ';
						$add_to_cart_markup = ' <a href="" data-quantity="1" class=" product_type_simple add_to_cart_button ajax_add_to_cart xgp_add_to_cart_wish_page" data-product_id="'.$witem["prod_id"].'" data-product_sku="'.$product->get_sku().'" aria-label="Add “'.$product->get_title().'” to your cart" rel="nofollow"> '.__('Add to Cart','wp-woocommerce-product-slider').'</a>';
					}
					$base_product = $product->is_type( 'variable' ) ? $product->get_variation_regular_price( 'max' ) : $product->get_price();

					$pric_markup = $base_product ? $product->get_price_html() : __('Free!', 'wp-woocommerce-product-slider' );

					if ( is_user_logged_in() && get_current_user_id() == $witem['user_id'] ){
						$remove_markup = '<div><a href="#" class="xg_remove_from_wishlist" title="Remove this product" data-product_id="'.$witem["prod_id"].'">×</a></div>';
					}else{
						$remove_markup = '';
					}

					$output .='<tr id="xgp-wishlist-row-'.$witem['prod_id'].'" data-row-id="'.$witem['prod_id'].'">
						<td class="xgp-product-remove">
					        '.$remove_markup .'
					    </td>
					     <td class="xgp-product-thumbnail">
					       <a href="'.get_permalink($witem['prod_id']).'">'.$product->get_image().'</a>
					        <a class="xgp-product-name" href="'.get_permalink($witem['prod_id']).'">'.$product->get_title().' </a>
					    </td>
					    <td class="xgp-product-price">
					                   '.$pric_markup.'               
					    </td>
					    <td class="xgp-product-stock-status">
					        '.$stock_markkup.'                          
					    </td>
					    <td class="xgp-product-add-to-cart">
						      <span class="xgp-dateadded">'.__('Added On ','wp-woocommerce-product-slider'). date('jS F, Y',strtotime( $witem['dateadded'])).'</span>
						     '.$add_to_cart_markup.'
						      
					    </td>
					</tr>';

				}


			}else{
				$output .= '<tr><td colspan="6"><div class="xgp_wishlist-not-found"><h4 class="title">'.__('You Have No Wishlist At The Moment .','wp-woocommerce-product-slider').'</h4></div></td></tr>';
			}

		}


	$output .= '</tbody>';

		
		
		$output .= '</table></div></div></div>';
		
		return $output;
	}


	public function xgp_slider_shortcode($attributes){
		extract( shortcode_atts( array(
			'id' => '',
		), $attributes, 'xgpp__slider' ) );

		$post_id = $attributes['id'];



		//general settings
		$slider_type = get_post_meta($post_id,'slider_type',true);
		$xgp_category = get_post_meta($post_id,'xgp_category',true);
		$slider_theme = get_post_meta($post_id,'slider_theme',true);
		$product_type = get_post_meta($post_id,'product_type',true);
		$column_in_desktop = get_post_meta($post_id,'column_in_desktop',true);
		$column_in_tablet = get_post_meta($post_id,'column_in_tablet',true);
		$column_in_mobile = get_post_meta($post_id,'column_in_mobile',true);
		$total_product = get_post_meta($post_id,'total_product',true);
		$order_by = get_post_meta($post_id,'order_by',true);
		$order = get_post_meta($post_id,'order',true);
		$xgp_badge_status = get_post_meta($post_id,'xgp_badge_status',true);
		$badge_text = ( $xgp_badge_status == true ) ? get_post_meta($post_id,'xgp_badge',true) : false;
		$badge_markup = ($badge_text != false) ? '<span class="tag">'.$badge_text.'</span>' : '';

		//slider settings
		$autoplay = get_post_meta($post_id,'autoplay',true);
		$autoplay_speed = get_post_meta($post_id,'autoplay_speed',true);
		$margin = get_post_meta($post_id,'margin',true);
		$pause_on_hover = get_post_meta($post_id,'pause_on_hover',true);
		$navigation = get_post_meta($post_id,'navigation',true);
		$loop = get_post_meta($post_id,'loop',true);
		$center_mode = get_post_meta($post_id,'center_mode',true);
		$animate_in = get_post_meta($post_id,'animate_in',true);
		$animate_out = get_post_meta($post_id,'animate_out',true);
		$pagination = get_post_meta($post_id,'pagination',true);
		$nav_bg_color = get_post_meta($post_id,'nav_bg_color',true);
		$nav_bg_hover_color = get_post_meta($post_id,'nav_bg_hover_color',true);
		$nav_color = get_post_meta($post_id,'nav_color',true);
		$nav_hover_color = get_post_meta($post_id,'nav_hover_color',true);
		$pagi_dot_color = get_post_meta($post_id,'pagi_dot_color',true);
		$pagi_dot_active_color = get_post_meta($post_id,'pagi_dot_active_color',true);
		
		//typography settings
		$typography['badge_font_size'] = get_post_meta($post_id,'badge_font_size',true);
		$typography['title_font_size'] = get_post_meta($post_id,'title_font_size',true);
		$typography['price_font_size'] = get_post_meta($post_id,'price_font_size',true);
		$typography['rating_font_size'] = get_post_meta($post_id,'rating_font_size',true);
		$typography['icon_font_size'] = get_post_meta($post_id,'icon_font_size',true);
		$typography['btn_font_size'] = get_post_meta($post_id,'btn_font_size',true);
		$typography['rating_color'] = get_post_meta($post_id,'rating_color',true);

		if ( 'category_slider' == $slider_type){
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => $total_product,
				'post_status' => 'publish',
				'order_by' => $order_by,
				'ignore_sticky_posts' => true,
				'order' => $order,
				'tax_query' => array(
					array(
						'taxonomy'=> 'product_cat',
						'field' => 'term_id',
						'terms' => intval($xgp_category),
						'operator'      => 'IN'
					),
					array(
						'taxonomy'      => 'product_visibility',
						'field'         => 'slug',
						'terms'         => 'exclude-from-catalog', // Possibly 'exclude-from-search' too
						'operator'      => 'NOT IN'
					)
				),
			);
		}else{
			//all product no filter
			$args = array(
				'post_type' => 'product',
				'posts_per_page' => $total_product,
				'post_status' => 'publish',
				'order_by' => $order_by,
				'order' => $order,
				'meta_query' => array(
						array(
							'key' => '_stock_status',
							'value' => 'instock',
							'compare' => '=',
						)
					),
			);

		}

		$all_prodcut = new WP_Query($args);
		ob_start();
		?>
		<style>
            #xg_product_slider_<?php echo esc_attr($post_id);?>.owl-theme .owl-dots .owl-dot span{
                background: <?php echo esc_attr($pagi_dot_color);?>;
            }
            #xg_product_slider_<?php echo esc_attr($post_id);?>.owl-theme .owl-dots .owl-dot.active span, .owl-theme .owl-dots .owl-dot:hover span{
                background: <?php echo esc_attr($pagi_dot_active_color);?>;
            }
            #xg_product_slider_<?php echo esc_attr($post_id);?> .owl-nav div{
                background-color: <?php echo esc_attr($nav_bg_color);?> !important;
                color: <?php echo esc_attr($nav_color);?> !important;
            }
            #xg_product_slider_<?php echo esc_attr($post_id);?> .owl-nav div:hover{
                background-color: <?php echo esc_attr($nav_bg_hover_color);?> !important;
                color: <?php echo esc_attr($nav_hover_color);?> !important;
            }

            <?php echo $this->theme_stylesheet($typography,$slider_theme);?>
		</style>
		<script>
            jQuery(document).ready(function(){
                jQuery("#xg_product_slider_<?php echo esc_attr($post_id);?>").owlCarousel({
                    loop:<?php echo $loop;?>,
                    dots:<?php echo $pagination; ?>,
                    nav:<?php echo $navigation; ?>,
	                navText:['<i class="fa fa-angle-left"></i>','<i class="fa fa-angle-right"></i>'],
	                center:<?php echo $center_mode;?>,
                    autoplay:<?php echo $autoplay; ?>,
                    autoplayTimeout:5000,
                    autoplaySpeed:<?php echo $autoplay_speed; ?>,
                    margin:<?php echo $margin;?>,
                    responsiveClass:true,
                    autoplayHoverPause: <?php echo $pause_on_hover; ?>,
                    animateOut: <?php echo '"'.$animate_out.'"' ;?>,
                    animateIn: <?php echo '"'.$animate_in.'"' ;?>,
                    responsive : {
                        0 : {
                            items: <?php echo $column_in_mobile; ?>
                        },
                        768 : {
                            items: <?php echo $column_in_tablet;?>
                        },
                        960 : {
                            items: <?php echo $column_in_tablet;?>
                        },
                        1200 : {
                            items: <?php echo $column_in_desktop ;?>
                        },
                        1920 : {
                            items: <?php echo $column_in_desktop; ?>
                        }
                    }
                });
            });
		</script>
        <?php

        ?>
		<div class="xg_product_slider" id="xg_product_slider_<?php echo esc_attr($post_id);?>">
		<?php

        while ($all_prodcut->have_posts()):
            $all_prodcut->the_post();
        global $product;

        $get_theme_function = 'theme_'.$slider_theme;
                 echo $this->$get_theme_function($product,$badge_markup);

        ?>


		<?php endwhile; wp_reset_query();?>
		</div>

<?php
		return ob_get_clean();
	}




	//all theme function will be here
    public function theme_stylesheet($typography,$slider_theme){
	    ob_start();
	    //no style tag needded

        // all theme dynamic stylesheet will be here
        ?>
        <?php if ( $slider_theme == 01):?>
            .single-product-item-1 .thumb .tag{
                font-size:<?php echo esc_attr($typography['badge_font_size']) ?> !important;
            }
            .single-product-item-1 .content .title{
                font-size:<?php echo esc_attr($typography['title_font_size']) ?> !important;
            }

            .single-product-item-1 .content .price{
                font-size:<?php echo esc_attr($typography['price_font_size']) ?> !important;
            }
            .single-product-item-1 .star-rating {
                font-size: <?php echo esc_attr($typography['rating_font_size']) ?> !important;
                text-align: center;
                margin: 0 auto;
                margin-bottom: 15px;
            }
            .single-product-item-1 .content .meta-icons li a{
                font-size:<?php echo esc_attr($typography['icon_font_size']) ?> !important;
            }
            .single-product-item-1 .star-rating span:before, .quantity .plus, .quantity .minus, p.stars a:hover:after, p.stars a:after, .star-rating span:before, #payment .payment_methods li input[type=radio]:first-child:checked+label:before{
                color:<?php echo esc_attr($typography['rating_color']) ?> !important;
            }


        <?php elseif ($slider_theme == 02):?>
            .single-product-item-2 .thumb .tag{
            font-size:<?php echo esc_attr($typography['badge_font_size']) ?> !important;
            }
            .single-product-item-2 .star-rating span:before, .quantity .plus,
            .quantity .minus, p.stars a:hover:after, p.stars a:after,
            .star-rating span:before,
            #payment .payment_methods li input[type=radio]:first-child:checked+label:before{
            color:<?php echo esc_attr($typography['rating_color']) ?> !important;
            }

            .single-product-item-2 .content .title{
            font-size:<?php echo esc_attr($typography['title_font_size']) ?> !important;
            }

            .single-product-item-2 .content .price{
            font-size:<?php echo esc_attr($typography['price_font_size']) ?> !important;
            }
            .single-product-item-2 .star-rating {
                font-size: <?php echo esc_attr($typography['rating_font_size']) ?> !important;
                text-align: center;
                margin: 0 auto;
            }
            .single-product-item-2 .thumb .meta-icons li a{
                font-size:<?php echo esc_attr($typography['icon_font_size']) ?> !important;
            }

        <?php endif;?>


        <?php

        return ob_get_clean();
    }
    public function theme_01($product,$badge_markup){
	    ob_start();
	    ?>
        <div class="single-product-item-1" >
            <div class="thumb"  style="height: 270px;">
                <a href="<?php the_permalink(get_the_ID())?>">
                    <div class="img-wrapper">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'xgp_slider_thumb') ?>" style="height: 270px;" alt="">
                    </div>
                </a>
			    <?php echo wp_kses_post($badge_markup) ?>
            </div>
            <div class="content">
                <a href="<?php the_permalink(get_the_ID())?>">
                    <h4 class="title"><?php the_title();?></h4>
                </a>
			    <?php
			    $base_product = $product->is_type( 'variable' ) ? $product->get_variation_regular_price( 'max' ) : $product->get_price();
			    $pric_markup = $base_product ? $product->get_price_html() : __('Free!', 'wp-woocommerce-product-slider' );

			    ?>
                <div class="price"><?php echo wp_kses_post($pric_markup);?></div>
                <?php

                $average = $product->get_average_rating();
                if ( $average > 0 ) :?>
	                <div class="star-rating" title="<?php echo esc_html__( 'Rated', 'woo-product-slider' ) . ' ' . $average . '' . esc_html__( ' out of 5', 'woo-product-slider' ) ;?>"><span style="width:<?php echo  ( ( $average / 5 ) * 100 ) ;?>%"><strong itemprop="ratingValue" class="rating"><?php echo $average ;?></strong> <?php echo  esc_html__( 'out of 5', 'woo-product-slider' ) ;?></span></div>

               <?php endif; ?>
                <ul class="meta-icons">
                    <li><a href="#" class="addtocart ajax_add_to_cart add_to_cart_button" rel=" nofollow" data-product_id="<?php echo esc_attr( get_the_ID() ); ?>"
                           data-product_sku="<?php esc_attr( $product->get_sku() ) ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                    <li><a href="#" class="xgp-quick-view-button" data-product_id="<?php echo esc_attr(get_the_ID());?>"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                    <li><a href="#" data-product-id="<?php echo esc_attr(get_the_ID())?>"  class="xgp_add_to_wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                </ul>
            </div>
        </div>
<?php
        return ob_get_clean();
    }
    public function theme_02($product,$badge_markup){
	    ob_start();
	    ?>
        <div class="single-product-item-2">
            <div class="thumb">
                <a href="<?php the_permalink(get_the_ID())?>">
                    <div class="img-wrapper">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(),'xgp_slider_thumb') ?>" style="height: 270px;" alt="">
                    </div>
                </a>
	            <?php echo wp_kses_post($badge_markup) ?>
                <div class="meta-extra">
                    <ul class="meta-icons">
                        <li><a href="#" class="addtocart ajax_add_to_cart add_to_cart_button" rel=" nofollow" data-product_id="<?php echo esc_attr( get_the_ID() ); ?>"
                               data-product_sku="<?php esc_attr( $product->get_sku() ) ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="xgp-quick-view-button" data-product_id="<?php echo esc_attr(get_the_ID());?>"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                        <li><a href="#" data-product-id="<?php echo esc_attr(get_the_ID())?>"  class="xgp_add_to_wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <a href="<?php the_permalink(get_the_ID())?>">
                    <h4 class="title"><?php the_title();?></h4>
                </a>
	            <?php
	            $base_product = $product->is_type( 'variable' ) ? $product->get_variation_regular_price( 'max' ) : $product->get_price();
	            $pric_markup = $base_product ? $product->get_price_html() : __('Free!', 'wp-woocommerce-product-slider' );

	            ?>
                <div class="price"><?php echo wp_kses_post($pric_markup);?></div>
	            <?php

	            $average = $product->get_average_rating();
	            if ( $average > 0 ) :?>
                    <div class="star-rating" title="<?php echo esc_html__( 'Rated', 'woo-product-slider' ) . ' ' . $average . '' . esc_html__( ' out of 5', 'woo-product-slider' ) ;?>"><span style="width:<?php echo  ( ( $average / 5 ) * 100 ) ;?>%"><strong itemprop="ratingValue" class="rating"><?php echo $average ;?></strong> <?php echo  esc_html__( 'out of 5', 'woo-product-slider' ) ;?></span></div>

	            <?php endif; ?>
            </div>
        </div>

<?php
        return ob_get_clean();
    }


}
new xgp_shotcode();
