
!(function ($) {

    function showcases($scope) {

        var swiper = new Swiper('.geekfolio-showcases .columns-carousel .swiper-container', {
            slidesPerView: 2,
            spaceBetween: 80,
            loop: true,
            speed: 1000,
            centeredSlides: true,
            mousewheel: true,
            pagination: {
                el: ".geekfolio-showcases .columns-carousel .swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: '.geekfolio-showcases .columns-carousel .swiper-button-next',
                prevEl: '.geekfolio-showcases .columns-carousel .swiper-button-prev'
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 2,
                },
                787: {
                    slidesPerView: 2,
                },
                991: {
                    slidesPerView: 2,
                },
                1200: {
                    slidesPerView: 2,
                }
            }
        });

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
                el: '.geekfolio-showcases .full-width-parallax .swiper-pagination',
                clickable: true
            },

            navigation: {
                nextEl: '.geekfolio-showcases .full-width-parallax .swiper-button-next',
                prevEl: '.geekfolio-showcases .full-width-parallax .swiper-button-prev'
            }
        };
        var parallaxShowCase = new Swiper('.geekfolio-showcases .full-width-parallax .swiper-container', parallaxShowCaseOptions);

    }

    function testimonials($scope) {
        // ------------ blog sliders -----------
        var swiper = new Swiper('.geekfolio-testimonials .swiper-container', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 1000,
            navigation: {
                nextEl: '.geekfolio-testimonials .swiper-button-next',
                prevEl: '.geekfolio-testimonials .swiper-button-prev'
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 1,
                },
                787: {
                    slidesPerView: 1,
                },
                991: {
                    slidesPerView: 1,
                },
                1200: {
                    slidesPerView: 1,
                }
            }
        });
    }

    function postsCarousel($scope) {
        // ------------ blog sliders -----------
        var swiper = new Swiper('.geekfolio-posts-carousel .swiper-container', {
            slidesPerView: 3,
            spaceBetween: 10,
            loop: true,
            navigation: {
                nextEl: '.geekfolio-posts-carousel .swiper-button-next',
                prevEl: '.geekfolio-posts-carousel .swiper-button-prev',
            },
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 2,
                },
                787: {
                    slidesPerView: 2,
                },
                991: {
                    slidesPerView: 3,
                },
                1200: {
                    slidesPerView: 3,
                }
            }
        });
    }

    function geekfolioImagesCarousel($scope, $) {
        $scope.find('.geekfolio-images-carousel .swiper-container').each(function () {
            var space = $(this).data('space');
            var items = $(this).data('items');
            var center = $(this).data('center') == 'yes' ? true : false;
            let swiper = new Swiper(this, {
                spaceBetween: space,
                slidesPerView: items,
                centeredSlides: center,
                loop: true,
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                    },
                    480: {
                        slidesPerView: 2,
                    },
                    787: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: items,
                    },
                    1200: {
                        slidesPerView: items,
                    }
                }
            });
        });
    }

    function geekfolioServices($scope, $) {
        $scope.find('.geekfolio-services .swiper-container').each(function () {
            let swiper = new Swiper(this, {
                spaceBetween: 0,
                slidesPerView: 5,
                loop: true,
                speed: 1000,
                navigation: {
                    nextEl: '.geekfolio-services .swiper-button-next',
                    prevEl: '.geekfolio-services .swiper-button-prev'
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                    },
                    480: {
                        slidesPerView: 2,
                    },
                    787: {
                        slidesPerView: 3,
                    },
                    991: {
                        slidesPerView: 4,
                    },
                    1200: {
                        slidesPerView: 5,
                    }
                }
            });
        });
    }

    function geekfolioCardsSlider($scope, $) {
        $scope.find('.geekfolio-cards-slider .swiper-container').each(function () {
            let swiper = new Swiper(this, {
                spaceBetween: 0,
                slidesPerView: 4,
                speed: 1000,
                loop: false,
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                    },
                    480: {
                        slidesPerView: 1,
                    },
                    787: {
                        slidesPerView: 2,
                    },
                    991: {
                        slidesPerView: 4,
                    },
                    1200: {
                        slidesPerView: 4,
                    }
                }
            })
        });
    }

    function geekfolioBrandsSlider() {
        let SwiperBottom = new Swiper('.geekfolio-brands-slider .swiper-container', {
            spaceBetween: 30,
            centeredSlides: true,
            slidesPerView: 5,
            speed: 1000,
            loop: true,
            //   allowTouchMove: false,
            disableOnInteraction: true,
            breakpoints: {
                0: {
                    slidesPerView: 5,
                },
                480: {
                    slidesPerView: 5,
                },
                787: {
                    slidesPerView: 5,
                },
                991: {
                    slidesPerView: 5,
                },
                1200: {
                    slidesPerView: 5,
                }
            }
        });
    }

    function geekfolioProgress() {

        $(".skills-circle .skill").each(function () {

            c4.circleProgress({
                startAngle: -Math.PI / 2 * 1,
                value: myVal,
                thickness: 4,
                size: 140,
                fill: { color: "#ff5e57" }
            });

        });

        var wind = $(window);
        wind.on('scroll', function () {
            $(".skill-progress .progres").each(function () {
                var myVal = $(this).attr('data-value');
                var bottom_of_object =
                    $(this).offset().top + $(this).outerHeight();
                var bottom_of_window =
                    $(window).scrollTop() + $(window).height();
                var myVal = $(this).attr('data-value');
                if (bottom_of_window > bottom_of_object) {
                    $(this).css({
                        width: myVal
                    });
                }

            });
        });

    }

    function geekfolioMasonry($scope, $){
    
        $('.filtering span').on('click', function () {
            var filterValue = $(this).attr('data-filter');
            console.log(filterValue);
            $('.gallery .gridss').isotope({ filter: filterValue });
        });

        $('.filtering span').on('click', function () {
            $(this).addClass('active').siblings().removeClass('active');
        });

    }


    function geekfolioTestimonialsCards($scope, $) {
        $scope.find('.geekfolio-testimonials-cards .swiper-container').each(function () {
            var items = $(this).data('items');
            var centeredSlides = $(this).data('centered') == 'yes' ? true : false;
            var spaceBetween = $(this).data('space');
            var swiper = new Swiper(this, {
                slidesPerView: items,
                centeredSlides: centeredSlides,
                spaceBetween: spaceBetween,
                speed: 1000,
                loop: true,
                mousewheel: false,
                navigation: {
                    nextEl: '.geekfolio-testimonials-cards .swiper-button-next',
                    prevEl: '.geekfolio-testimonials-cards .swiper-button-prev'
                },
                breakpoints: {
                    0: {
                        slidesPerView: 1,
                    },
                    480: {
                        slidesPerView: 2,
                    },
                    787: {
                        slidesPerView: 2,
                    },
                    991: {
                        slidesPerView: items,
                    },
                    1200: {
                        slidesPerView: items,
                    }
                }
            });
        });
    }

    function geekfolioTeamCarousel($scope, $) {
        var swiper = new Swiper('.geekfolio-team-carousel .swiper-container', {
            slidesPerView: 4,
            centeredSlides: true,
            spaceBetween: 60,
            speed: 1000,
            loop: true,
            mousewheel: false,
            keyboard: true,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 1,
                },
                787: {
                    slidesPerView: 1,
                },
                1200: {
                    slidesPerView: 4,
                }
            }
        });
    }

    function geekfolioPortfolioCarousel($scope, $) {
        var swiper = new Swiper('.geekfolio-portfolio-carousel.geekfolio-port-slider .swiper-container', {
            slidesPerView: 3,
            centeredSlides: true,
            spaceBetween: 40,
            speed: 1000,
            loop: true,
            navigation: {
                nextEl: '.geekfolio-portfolio-carousel.geekfolio-port-slider .swiper-button-next',
                prevEl: '.geekfolio-portfolio-carousel.geekfolio-port-slider .swiper-button-prev',
            },
            mousewheel: false,
            keyboard: true,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 1,
                },
                787: {
                    slidesPerView: 1,
                },
                991: {
                    slidesPerView: 1,
                },
                1200: {
                    slidesPerView: 3,
                }
            }
        });
    }

    /* Related portfolio */
    function geekfolioRelatedPortfolios($scope, $) {
        var swiper = new Swiper('.slider-3items .swiper-container', {
            slidesPerView: 3,
            spaceBetween: 0,
            speed: 1000,
            pagination: {
                el: ".slider-3items .swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: '.slider-3items .swiper-button-next',
                prevEl: '.slider-3items .swiper-button-prev',
            },
            mousewheel: false,
            keyboard: true,
            autoplay: {
                delay: 4000,
            },
            loop: false,
            breakpoints: {
                0: {
                    slidesPerView: 1,
                },
                480: {
                    slidesPerView: 1,
                },
                787: {
                    slidesPerView: 2,
                },
                991: {
                    slidesPerView: 2,
                },
                1200: {
                    slidesPerView: 3,
                }
            }
        });
    }

    jQuery(window).on('elementor/frontend/init', function () {

        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-posts-carousel.default', postsCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-related-portfolios.default', geekfolioRelatedPortfolios);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-brands-slider.default', geekfolioBrandsSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-services.default', geekfolioServices);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-testimonials-cards.default', geekfolioTestimonialsCards);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-progress.default', geekfolioProgress);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-card.default', geekfolioCardsSlider);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-showcases.default', showcases);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-images-carousel.default', geekfolioImagesCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-testimonials.default', testimonials);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-portfolio-grid.default', geekfolioMasonry);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-portfolio-carousel.default', geekfolioPortfolioCarousel);
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-team-carousel.default', geekfolioTeamCarousel);
    });


})(jQuery); 
