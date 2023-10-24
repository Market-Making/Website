(function ($) {
    "use strict";

    jQuery(document).ready(function($){
        if($('.geekfolio-sticky-bottom')[0] && !$('body').hasClass("elementor-editor-active")){
            gsap.set('.geekfolio-custom-footer', { yPercent: -50 })
            const uncover = gsap.timeline({ paused: true })
            uncover
                .to('.geekfolio-custom-footer', { yPercent: 0, ease: 'none' })
                ;

            ScrollTrigger.create({
                trigger: '.blank-builder',
                start: 'bottom bottom',
                end: '+=50%',
                animation: uncover,
                scrub: true,
            });
            $('.blank-builder').addClass('geekfolio-fixed-container');
        }
    });
  
})(jQuery);