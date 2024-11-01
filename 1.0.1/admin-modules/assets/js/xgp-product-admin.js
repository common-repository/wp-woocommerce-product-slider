;(function($) {
    $(document).on('click','#xgp_shotcode_wrapper',function () {
        var el = $(this);
        el.select();
        document.execCommand("copy");
        el.siblings('.icon').text('Copied');
    })
    $(document).on('click','.xgp-shortcode-element-field .icon',function () {
        var el = $(this).siblings('#xgp_shotcode_wrapper');
        el.select();
        document.execCommand("copy");
        $(this).text('Copied');
    })
})(jQuery);