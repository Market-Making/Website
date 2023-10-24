(function ($) {
    "use strict";

    jQuery(document).ready(function ($) {

        var width = $(window).width();
        if (width > 991 && ($('.geekfolio-hscroll-start')[0] || $('.geekfolio-portfolio-carousel.geekfolio-thecontainer')[0])) {

            if($('.geekfolio-hscroll-start') && $('.geekfolio-hscroll-end')) {
                $('body').css('overflow-x', 'hidden')
                $('.geekfolio-hscroll-start').addClass('intro-pan geekfolio-hscroll-panel')
                $('.geekfolio-hscroll-end').addClass('geekfolio-hscroll-panel')
                $('.geekfolio-hscroll-start').nextUntil('.geekfolio-hscroll-end').addClass('geekfolio-hscroll-panel');
                $('<div class="geekfolio-thecontainer"></div>').insertBefore('.geekfolio-hscroll-start').append($('.geekfolio-hscroll-start, .geekfolio-hscroll-panel, .geekfolio-hscroll-end'));

                /* ===============================  scroll  =============================== */

                gsap.registerPlugin(ScrollTrigger);

                let sections = gsap.utils.toArray(".geekfolio-hscroll-panel");

                gsap.to(sections, {
                    xPercent: -100 * (sections.length - 1),
                    ease: "none",
                    scrollTrigger: {
                        trigger: ".geekfolio-thecontainer",
                        pin: true,
                        scrub: 1,
                        // snap: 1 / (sections.length - 1),
                        end: () => "+=" + document.querySelector(".geekfolio-thecontainer").offsetWidth
                    }
                });
            }

        }
    });

})(jQuery);