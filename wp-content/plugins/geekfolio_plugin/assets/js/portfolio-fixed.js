(function ($) {
	"use strict";

    function portfolioFixed() {

        var pageSection = $(".bg-img, section");
		pageSection.each(function (indx) {

			if ($(this).attr("data-background")) {
				$(this).css("background-image", "url(" + $(this).data("background") + ")");
			}
		});

        $("#sticky_item").stick_in_parent();

        var width = $(window).width();
        if (width > 991) {

            var wind = $(window);

            wind.on('scroll', function () {
                $(".geekfolio-portfolio.portfolio-fixed .sub-bg .cont").each(function () {
                    var bottom_of_object =
                        $(this).offset().top + $(this).outerHeight();
                    var bottom_of_window =
                        $(window).scrollTop() + $(window).height();
                    var tab_id = $(this).attr('data-tab');
                    if (bottom_of_window > bottom_of_object) {
                        $("#" + tab_id).addClass('current');
                        $(this).addClass('current');
                    } else {
                        $("#" + tab_id).removeClass('current');
                        $(this).removeClass('current');
                    }
                });
            });

        }
    }

    jQuery(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-portfolio.default', portfolioFixed);
    });

})(jQuery);