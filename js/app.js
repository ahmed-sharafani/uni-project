 // STICKY NAV BAR
$(window).scroll(function() {
    var scroll = $(window).scrollTop();

    if (scroll >= 50) {
        $(".sticky").addClass("nav-sticky");
    } else {
        $(".sticky").removeClass("nav-sticky");
    }
});




// scrollspy
$(".navbar-nav").scrollspy({
    offset:20
});
