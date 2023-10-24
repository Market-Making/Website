(function ($) {
    "use strict";

    const link = document.querySelectorAll('.hover-this');
    const animateit = function (e) {
        const hoverAnim = this.querySelector('.hover-anim');
        const { offsetX: x, offsetY: y } = e,
            { offsetWidth: width, offsetHeight: height } = this,
            move = 25,
            xMove = x / width * (move * 2) - move,
            yMove = y / height * (move * 2) - move;
        hoverAnim.style.transform = `translate(${xMove}px, ${yMove}px)`;
        if (e.type === 'mouseleave') hoverAnim.style.transform = '';
    };
    link.forEach(b => b.addEventListener('mousemove', animateit));
    link.forEach(b => b.addEventListener('mouseleave', animateit));

})(jQuery);