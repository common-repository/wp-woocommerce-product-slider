(function ($) {
    "use strict"

    $(document).ready(function () {
            //loaclize vaiable xgpWishlist
        /*-------------------------------

        * Click event for wishlist
        * ---------------------------*/
        $(document).on('click','.xgp_add_to_wishlist',function (e) {
            e.preventDefault();
            var element = $(this);
            CallxgpWishListAjaxCall(element);
        });
        /*--------------------------
         add to cart wishlist page
        ---------------------------*/
        $(document).on('click','.xgp_add_to_cart_wish_page',function (e) {
            e.preventDefault();
            var el = $(this);
            xgpAjaxItemRemoveFormWislist(el);
        });
        /*-----------------------------------
        remove button in wishlist page
        ------------------------------------*/
        $(document).on('click','.xg_remove_from_wishlist',function (e) {
           e.preventDefault();
           var el = $(this);
            $(this).addClass('loading');
            xgpAjaxItemRemoveFormWislist(el);
        });
        function CallxgpWishListAjaxCall(element) {
            var productId = element.data('product-id');
            var el_wrap = $( '.xgp_add_to_wishlist');
            var $body = $('body');
            var data = {
                    product_id: productId,
                    product_type: element.data( 'product-type' ),
                    action: xgpWishlist.actions.add_to_wishlist_action
                };
            $.ajax({
                type:"POST",
                url : xgpWishlist.ajax_url,
                data: data,
                dataType: 'json',
                beforeSend:function () {
                    element.children('i').removeClass('fa-eye').addClass('fa-spinner fa-pulse');
                },
                complete:function () {
                    element.children('i').addClass('fa-eye').removeClass('fa-spinner fa-pulse');
                },
                success:function (resData) {
                    var message = resData.message;
                    var topHeight = element.offset().top;
                    var leftWidth = element.offset().left;
                    var msgClass = resData.class;
                    var wishlistLink = '<a href="'+resData.wishlist_url+'" class="xgp-wishlist-link"> '+xgpWishlist.browse_wishlist_text+'</a>';
                    if ( msgClass == 'error' ) {
                        var wishlistLink = '';
                    }
                    $('#xgp-wishlist-notice').remove();
                    if ( $('#xgp-wishlist-notice').length > 1 ){
                        $('#xgp-wishlist-notice').addClass(msgClass).css({'top':topHeight,'left' : leftWidth,}).children('title').text(message).fadeIn(2000);
                    }else{
                        $body.append('<div class="xgp-wishlist-notice" id="xgp-wishlist-notice"><span class="title">'+message+' &nbsp;</span>'+wishlistLink+'</div>');
                        $('#xgp-wishlist-notice').addClass(msgClass).css({'top':topHeight,'left' : leftWidth,}).fadeIn(2000);
                    }
                    $('#xgp-wishlist-notice').fadeOut(3000);
                }
            })
        }
        
        function xgpAjaxItemRemoveFormWislist(element) {
            var productId = element.data('product_id');
            var data = {
                action : 'xgp_remove_from_wishlist',
                product_id : productId
            };
            if (element.attr('class') == 'xg_remove_from_wishlist loading'){
                var data = {
                    action : 'xgp_remove_from_wishlist',
                    product_id : productId,
                    rmv_btn : 'true'
                };
            }
            $.ajax({
                type : "POST",
                url: xgpWishlist.ajax_url,
                data:data,
                dataType: 'json',
                success:function (responsed) {
                    if (responsed.result == 'true'){
                        $('#xgp-wishlist-row-'+productId).remove();
                        $('#xgp-message-show').html();
                        $('#xgp-message-show').html('<div class="xgp-show-message"><span class="message '+responsed.class+'">'+responsed.message +'</span></div>');
                    }
                }
            });
        }

    });
})(jQuery);