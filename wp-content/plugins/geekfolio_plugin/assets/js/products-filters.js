(function ($) {
	"use strict";
    let minValue = $( ".geekfolio-products-filters #amount1" ).data('min-value');
    let maxValue = $( ".geekfolio-products-filters #amount2" ).data('max-value');
    let maxStoreValue = $( ".geekfolio-products-filters .amount-input" ).data('max-store-value');
    $( ".geekfolio-products-filters #slider-range" ).slider({
            range: true,
            min: 0,
            max: maxStoreValue,
            values: [ minValue, maxValue ],
            slide: function( event, ui ) {
            $( "#amount1" ).val( ui.values[ 0 ] );
            $( "#amount2" ).val( ui.values[ 1 ] );
        }
    });
    $( ".geekfolio-products-filters #amount1" ).val( $( "#slider-range" ).slider( "values", 0 ) );
    $( ".geekfolio-products-filters #amount2" ).val( $( "#slider-range" ).slider( "values", 1 ) );

	$(document).ready(function(){
		$('.geekfolio-products-filters .form-check .form-check-input').change(function(){
			$('.geekfolio-products-filters .filters-form').submit();
		});
	});

    // --------- grid list view ---------
    $(".geekfolio-product .grid-list-btns").on( "click", ".bttn" , function(){
        $(this).addClass("active").siblings().removeClass("active");
    })

    $(".geekfolio-product .grid-list-btns").on( "click", ".list-btn" , function(){
        $(".geekfolio-product .products").addClass("list-view");
    })

    $(".geekfolio-product .grid-list-btns").on( "click", ".grid-btn" , function(){
        $(".geekfolio-product .products").removeClass("list-view");
    })

})(jQuery);