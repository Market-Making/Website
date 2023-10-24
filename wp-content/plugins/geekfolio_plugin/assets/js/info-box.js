(function($) {
    "use strict";

    $(window).on("load", function() {

        $('.geekfolio-info-box.style-10 .items').each(function () {
            $(this).on('mouseenter', function () {
                $(this).addClass("active");
                $('.geekfolio-info-box.style-10 .items').not(this).removeClass("active");
            });
        });
        
    });

})(jQuery);