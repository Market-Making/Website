(function($) {
    "use strict";

    $(window).on("load", function () {
        $('.geekfolio-portfolio-grid.geekfolio-masonry .gallery').isotope({
            itemSelector: '.items'
        });

        var $gallery = $('.geekfolio-portfolio-grid.geekfolio-masonry .gallery').isotope();

        $('.geekfolio-portfolio-grid .filtering').on('click', 'span', function () {
            var filterValue = $(this).attr('data-filter');
            $gallery.isotope({ filter: filterValue });
        });

        $('.geekfolio-portfolio-grid .filtering').on('click', 'span', function () {
            $(this).addClass('active').siblings().removeClass('active');
        });
    });


})(jQuery);