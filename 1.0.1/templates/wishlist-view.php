<?php

//retrive user wishlist
global $user_wishlist_item;
global $output;
if (count($user_wishlist_item) > 0){

	foreach ($user_wishlist_item as $witem){
		global $product;
		$product = wc_get_product($witem['prod_id']);
		$avilability = $product->get_availability();
		$stock_status = isset($avilability['class']) ? $avilability['class'] : false;
		if ($stock_status == 'out-of-stock'){
			$stock_markkup = ' <span class="xgp-wishlist-out-of-stock">'.__('Out of Stock','xg-product').' </span>  ';
			$add_to_cart_markup = '';
		}else{
			$stock_markkup = ' <span class="xgp-wishlist-in-stock">'.__('In Stock','xg-product').'</span>  ';
			$add_to_cart_markup = ' <a href="" data-quantity="1" class=" product_type_simple add_to_cart_button ajax_add_to_cart xgp_add_to_cart_wish_page" data-product_id="'.$witem["prod_id"].'" data-product_sku="'.$product->get_sku().'" aria-label="Add “'.$product->get_title().'” to your cart" rel="nofollow"> '.__('Add to Cart','xg-product').'</a>';
		}
		$base_product = $product->is_type( 'variable' ) ? $product->get_variation_regular_price( 'max' ) : $product->get_price();

		$pric_markup = $base_product ? $product->get_price_html() : __('Free!', 'xg-product' );



		$output .='<tr id="xgp-wishlist-row-'.$witem['prod_id'].'" data-row-id="'.$witem['prod_id'].'">
	<td class="xgp-product-remove">
        <div>
            <a href="#" class="xg_remove_from_wishlist" title="Remove this product" data-product_id="'.$witem["prod_id"].'">×</a>
        </div>
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
	      <span class="xgp-dateadded">'.__('Added On ','xg-product'). date('jS F, Y',strtotime( $witem['dateadded'])).'</span>
	     '.$add_to_cart_markup.'
	      
    </td>
</tr>';

	}


}else{
	$output .= '<tr><td colspan="6"><div class="xgp_wishlist-not-found"><h4 class="title">'.__('You Have No Wishlist At The Moment .','xg-product').'</h4></div></td></tr>';
}