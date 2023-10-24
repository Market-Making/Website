(function ($) {
    "use strict";

    /* =============================================================================
    ------------------------------  Parallax Items   -----------------------------
    ============================================================================= */

    jQuery(document).ready(function($){
        // Get the target elements
        const parallaxTargets = document.querySelectorAll('.geekfolio-image.parallax');

        // Get the mouse position
        let mouseX = 0;
        let mouseY = 0;
        document.addEventListener('mousemove', function (event) {
            mouseX = event.clientX;
            mouseY = event.clientY;
        });

        // Update the target elements' position on each animation frame
        let rafId = null;
        function updateParallax() {
            // Loop through each target element
            parallaxTargets.forEach(target => {
                // Get the target's speed
                let speed = target.dataset.speed;

                // Calculate the new position based on the mouse position and speed
                let x = (window.innerWidth / 2 - mouseX) * speed;
                let y = (window.innerHeight / 2 - mouseY) * speed;
                target.style.transform = `translate3d(${x / 10}rem, ${y / 10}rem, 0)`;
            });

            // Schedule the next animation frame
            rafId = requestAnimationFrame(updateParallax);
        }

        // Start the parallax animation
        updateParallax();
    });
})(jQuery);