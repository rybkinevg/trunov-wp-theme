jQuery(document).ready(function ($) {

    $('.index-news').slick({
        autoplay: true,
        autoplaySpeed: 6000,
    });

    $('.partners').slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 6000,
        responsive: [
            {
                breakpoint: 1300,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 900,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });

    $(".fancybox").fancybox({
        openEffect: 'none',
        closeEffect: 'none'
    });
});