;(function ($) {
    "use strict"

    $(document).ready(function () {
        $('#xgp_badge_status').on('change',function () {

            alert('working');

            var el = $(this);
            if ( 'true' == el.val() ) {
                $('#xgp_badge').parent().removeClass('xgp_display_none');
            }else{
                $('#xgp_badge').parent().addClass('xgp_display_none');
            }
        });
        $('#navigation').on('change',function () {
            var el = $(this);
            if ( 'true' == el.val() ) {
                $('#nav_bg_color,#nav_bg_hover_color,#nav_color,#nav_hover_color').parent().parent().parent().parent().removeClass('xgp_display_none');
            }else{
                $('#nav_bg_color,#nav_bg_hover_color,#nav_color,#nav_hover_color').parent().parent().parent().parent().addClass('xgp_display_none');
            }
        });
        $('#pagination').on('change',function () {
            var el = $(this);
            if ( 'true' == el.val() ) {
                $('#pagi_dot_color,#pagi_dot_active_color').parent().parent().parent().parent().removeClass('xgp_display_none');
            }else{
                $('#pagi_dot_color,#pagi_dot_active_color').parent().parent().parent().parent().addClass('xgp_display_none');
            }
        });

        if ($('#slider_type').val() != 'category_slider'){
            $('#xgp_category').parent().addClass('xgp_display_none');
        }
        if ($('#xgp_badge_status').val() != 'true'){
            $('#xgp_badge').parent().addClass('xgp_display_none');
        }
        if ($('#slider_type').val() == 'category_slider'){
            $('#product_type').parent().addClass('xgp_display_none');
        }
        if ($('#navigation').val() == 'false'){
           $('#nav_bg_color,#nav_bg_hover_color,#nav_color,#nav_hover_color').parent().addClass('xgp_display_none');
        }
        if ($('#pagination').val() == 'false'){
           $('#pagi_dot_color,#pagi_dot_active_color').parent().addClass('xgp_display_none');
        }

        $(document).off().on('change','#slider_type',function () {

            var el = $(this);

           if ( 'category_slider' == el.val() ) {
               $('#xgp_category').parent().removeClass('xgp_display_none');
           }else{
               $('#xgp_category').parent().addClass('xgp_display_none');
           }

        });
        $(document).off().on('change','#slider_type',function () {

            var el = $(this);

           if ( 'category_slider' != el.val() ) {
               $('#product_type').parent().removeClass('xgp_display_none');
           }else{
               $('#product_type').parent().addClass('xgp_display_none');
           }

        });

        $(document).on('click','#copy-btn',function () {
            var value = $(this).siblings('#xgp_slider_shortcode').text();
            value.select();
            document.execCommand('copy');
            $(this).text('Copied');
        });


    /*--------------------------------
    * init wordpress color picker
    * ------------------------------*/
        $('.xgp_color_picker').wpColorPicker();


        /*--------------------------------
        * init wordpress jquery ui tabs
        * ------------------------------*/
        $('#tabs').tabs();
        $('#xgp_metabox_tabs').tabs();

        /*  */
        function matchCondition(array, key,value) {

           var $result =  null;
               $.each(array,function (index,val) {

                    var keyy = Object.keys(val)[0];

                    if ( keyy == key && val[keyy] == value ) {
                        $result = 'match';
                    }else{
                        $result = 'not-matched';
                    }
                });

           return $result;
        }
        /*  */
        function getConditionField(array,id) {
            var $return = null;

            $.each(array,function (index,val) {
                var keyy = Object.keys(val)[0];
                if ( keyy == id) {
                    $return = val[keyy];
                }else{
                    $return = 'not-found';
                }
            });
            return $return;
        }
    });

})(jQuery);


