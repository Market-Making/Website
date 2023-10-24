(function($) {
    "use strict";
	
	$.fn.changeElementType = function(newType) {
        var attrs = {};
        if (!(this[0] && this[0].attributes))
            return;

        $.each(this[0].attributes, function(idx, attr) {
            attrs[attr.nodeName] = attr.nodeValue;
        });
        this.replaceWith(function() {
            return $("<" + newType + "/>", attrs).append($(this).contents());
        });
    }
    // Make sure you run this code under Elementor..
    $("#elementor-preview-iframe").on("load", function() {

		
		
		elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-mason-gallery.default', function($scope) {
			 $scope.find('.mason-gallery').imagesLoaded(function() { 
			 	$scope.find('.mason-gallery').isotope();
			 });
		});
		elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-post-four.default', function($scope) {
					
			$scope.find('.post-blog-slider').each(function() {
				$(this).slick({
					autoplay: true,
					dots: false,
					nextArrow: '<i class="fa fa-arrow-right"></i>',
					prevArrow: '<i class="fa fa-arrow-left"></i>',
					speed: 800,
					fade: true,
					pauseOnHover: false,
					pauseOnFocus: false
				});
			});
			
			//replace the data-background into background image
			$scope.find(".blog-img-bg").each(function() {
				var imG = $(this).data('background');
				$(this).css('background-image', "url('" + imG + "') "
		
				);
			});	
		});

        //for menu
        elementorFrontend.hooks.addAction('frontend/element_ready/geekfolio-menu.default', function($scope) {

            //remove empty href
			$scope.find(".fat-list a[href='#']").remove();
			$scope.find('.fat-list').changeElementType('ul');
			$scope.find( ".fat-list a" ).wrap( "<li></li>" );
            $scope.find(".fat-list .sub-menu").remove();
            //remove empty ul on mobile menu
            $scope.find('.fat-list ul').not(':has(li)').remove();

            $scope.find('.box-mobile').each(function() {
                $(this).find('.hamburger').on('click', function() {
                    $scope.find('.fat-nav').fadeToggle();
                    $scope.find('.fat-nav').toggleClass('active');
                    $(this).toggleClass('active');
                });
            })
            $scope.find('.menu-box ul').superfish({
                delay: 400, //delay on mouseout
                animation: {
                    opacity: 'show',
                    height: 'show'
                }, // fade-in and slide-down animation
                animationOut: {
                    opacity: 'hide',
                    height: 'hide'
                },
                speed: 200, //  animation speed
                speedOut: 200,
                autoArrows: false // disable generation of arrow mark-up
            })

        });

    });

})(jQuery);