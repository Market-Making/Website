!(function ($) {

    function tabs($scope) {

        $('#geekfolio-tabs .tab-links').on('click', '.item-link', function () {

            var tab_id = $(this).attr('data-tab');

            $('#geekfolio-tabs .tab-links .item-link').removeClass('current');
            $(this).addClass('current');

            $('.tab-content').hide();
            $("#" + tab_id).show();

        });

        $('#geekfolio-tabs-fade .tab-links').on('click', '.item-link', function () {

            var tab2_id = $(this).attr('data-tab');

            $('#tabs-fade .tab-links .item-link').removeClass('current');
            $(this).addClass('current');

            $('.tab-content').fadeOut();
            $("#" + tab2_id).fadeIn();

        });

    };

    jQuery(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-toggle-tabs.default', tabs);

    });

})(jQuery);