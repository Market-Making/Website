(function($) {
    "use strict";
    $(window).on("load", function() {
        
    var parallaxSlider;
    var parallaxSliderOptions = {
        speed: 1500,
        autoplay: {
            delay: 5000,
        },
        parallax: true,
        loop: true,

        on: {
            init: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    $(swiper.slides[i])
                        .find('.bg-img')
                        .attr({
                            'data-swiper-parallax': 0.75 * swiper.width
                        });
                }
            },
            resize: function () {
                this.update();
            }
        },

        pagination: {
            el: '.slider-prlx .parallax-slider .swiper-pagination',
            type: 'fraction',
            clickable: true
        },

        navigation: {
            nextEl: '.slider-prlx .parallax-slider .next-ctrl',
            prevEl: '.slider-prlx .parallax-slider .prev-ctrl'
        }
    };
    parallaxSlider = new Swiper('.slider-prlx .parallax-slider', parallaxSliderOptions);

    var parallaxShowCase;
    var parallaxShowCaseOptions = {
        speed: 1500,
        autoplay: {
            delay: 5000,
        },
        parallax: true,
        mousewheel: true,
        loop: true,

        on: {
            init: function () {
                var swiper = this;
                for (var i = 0; i < swiper.slides.length; i++) {
                    $(swiper.slides[i])
                        .find('.bg-img')
                        .attr({
                            'data-swiper-parallax': 0.75 * swiper.width
                        });
                }
            },
            resize: function () {
                this.update();
            }
        },

        pagination: {
            el: '.showcase-full .parallax-slider .swiper-pagination',
            clickable: true
        },

        navigation: {
            nextEl: '.showcase-full .parallax-slider .swiper-button-next',
            prevEl: '.showcase-full .parallax-slider .swiper-button-prev'
        }
    };
    parallaxShowCase = new Swiper('.showcase-full .parallax-slider', parallaxShowCaseOptions);

    console.log(5)
    });
})(jQuery);