(function ($) {

    $(document).ready(function () {
        //check xgp localize variable load or not
        if ( xgp == 'undefined' ) {
            return;
        }

        /*-----------------------
        *   Modal Open function
        * ----------------------*/
        $(document).off('click','.xgp-quick-view-button').on('click','.xgp-quick-view-button',function (e) {
            e.preventDefault();
            var $this = $(this);
            var productID = $this.data('product_id');


            $this.addClass('loading');
            $this.children('i').removeClass('fa-eye').addClass('fa-spinner fa-pulse');
            ajaxCall( $this, productID );
        });
        function ajaxCall($this,product_id){
            $.ajax({
                url: xgp.ajaxurl,
                data:{
                    action:'xgp_load_product_quick_view',
                    product_id: product_id,
                    lang:xgp.lang
               },
                dataType: 'html',
                type: 'POST',
                success:function (data) {
                    $('#xgp-quick-view-content').html(data);
                    $('#xgp-quick-view-modal').addClass('open');
                    $this.removeClass('loading');
                    $this.children('i').addClass('fa-eye').removeClass('fa-spinner fa-pulse');
                    $('.xgp-product-slider').owlCarousel({
                        loop: true,
                        autoplay: true, //true if you want enable autoplay
                        autoPlayTimeout: 1000,
                        margin: 30,
                        dots: true,
                        nav: false,
                        responsive: {
                            0: {
                                items: 1
                            },

                            768: {
                                items: 1
                            },
                            960: {
                                items: 1
                            },
                            1200: {
                                items: 1
                            },
                            1920: {
                                items: 1
                            }
                        }
                    });
                }
            });
        }
    });
    $(document).on('click','#xgp-quick-view-close',function () {
        $('#xgp-quick-view-modal').removeClass('open');

    });
    $(document).on('click','.xgp-quick-view-overlay',function () {
        $('#xgp-quick-view-modal').removeClass('open');

    });

})(jQuery);