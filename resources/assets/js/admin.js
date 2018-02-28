/**
 * Created by eazypen on 1/14/2018.
 */
(function () {

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

    // $('#form').ajax({
    //     url: '/reset',
    //     method: "POST",
    //     data: $('#form').serialize()
    // }).success(function (response) {
    //     if(response.status == "success") {
    //         alert(response.message);
    //         if(response.redirect !== null) {
    //             window.location = response.redirect;
    //         }
    //     }
    //     else if(response.status == "error") {
    //         alert(response.message);
    //     }
    // }).error(function (err) {
    //     console.log(err)
    // });
})();




$(document).ready(function () {
    $('#datatable').DataTable();

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