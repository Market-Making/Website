(function ($) {
    "use strict";
    
    if($(".geekfolio-nav.animated-text")){
        let elements = document.querySelectorAll(".geekfolio-nav.animated-text .main-menu ul .menu-item > a");

        elements.forEach((element) => {
            let innerText = element.innerText;
            element.innerHTML = "";

            let textContainer = document.createElement("span");
            let animationContainer = document.createElement("span");
            animationContainer.classList.add("rolling-text")
            textContainer.classList.add("block");

            for (let letter of innerText) {
                let span = document.createElement("span");
                span.innerText = letter.trim() === "" ? "\xa0" : letter;
                span.classList.add("letter");
                textContainer.appendChild(span);
            }

            animationContainer.appendChild(textContainer);
            animationContainer.appendChild(textContainer.cloneNode(true));

            element.appendChild(animationContainer);
        });

        elements.forEach((element) => {
            element.addEventListener("mouseover", () => {
                element.classList.remove("play");
            });
        });
    }

    $(window).on("load", function () {
        let elements = document.querySelectorAll(".geekfolio-nav.menu-list .main-menu ul .menu-item > a");

        elements.forEach((element) => {
            let innerText = element.innerText;

            $(element).attr('data-text', innerText)
        });      
        
        $('.geekfolio-nav.menu-list .menu-item-has-children').append('<i></i>')

        $('.geekfolio-nav.menu-list .menu-item-has-children').on('click', function () {
            $(this).children('.sub-menu').toggleClass('sub-open');
            $(this).toggleClass('sub-menu-open');
        });

        $('.geekfolio-nav.menu-list .navigation > .menu-item').on('mouseenter', function () {
            $(this).removeClass('hoverd').siblings().addClass('hoverd');
        });
    
        $('.geekfolio-nav.menu-list .navigation > .menu-item').on('mouseleave', function () {
            $(this).removeClass('hoverd').siblings().removeClass('hoverd');
        });
    });


})(jQuery);