/**
 * Created by eazypen on 1/13/2018.
 */
(function () {
    // Menu Toggle For Mobile
    document.querySelector(".menu-toggle i").addEventListener("click", App.menuToggleFunction);
    // Scrolling Event
    window.onscroll = function() {
        App.stickyNav();
        App.showGoToTop();
    };

    // Form Validation
    document.querySelectorAll('input, textarea').forEach(function(input) {
        input.addEventListener('blur', Form.validate);
    });

    // Form Submission
    document.querySelectorAll('#form, form').forEach(function (input) {
        input.addEventListener('submit', Form.submit);
    });

    // Keypress for Number Only
    document.querySelectorAll('#phone').forEach(function (input) {
       input.addEventListener('keydown', Form.ForceNumericOnly);
    });

})();



$(document).ready(function () {
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
                return item.el.attr('title') + '<small>by Restoration Chapel International Media.</small>';
            }
        }
    });
});