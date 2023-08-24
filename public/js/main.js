$(document).ready(function () {
    $('.scrollbar-inner').scrollbar();
    $('.admin-scroll-area').scrollbar();
    $('.data-table').DataTable();
});

// Category Toggle Button
$('#menuToggler').on('click', function() {
    $(this).toggleClass('show-cross');
    $('#pageAside').toggleClass('slide-in');
});

// Feather Icons
feather.replace();


 //--------Mobile menu header & footer effect------//
// Navbar header on scroll
$(document).ready(function () {
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $(".page-header").outerHeight();
    $(window).scroll(function (event) {
        didScroll = true;
    });
    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);
    function hasScrolled() {
        var st = $(this).scrollTop();
        if (Math.abs(lastScrollTop - st) <= delta) return;
        if (st > lastScrollTop && st > navbarHeight) {
            $(".page-header").removeClass("nav-down").addClass("nav-up");
        } else {
            if (st + $(window).height() < $(document).height()) {
                $(".page-header").removeClass("nav-up").addClass("nav-down");
            }
            if (st == 0) {
                $(".page-header").removeClass("nav-down");
            }
        }
        lastScrollTop = st;
    }
});

// Navbar header on scroll
$(document).ready(function () {
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $(".bottom_menu").outerHeight();
    $(window).scroll(function (event) {
        didScroll = true;
    });
    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 250);
    function hasScrolled() {
        var st = $(this).scrollTop();
        if (Math.abs(lastScrollTop - st) <= delta) return;
        if (st > lastScrollTop && st > navbarHeight) {
            $(".bottom_menu").removeClass("nav-down").addClass("nav-up");
        } else {
            if (st + $(window).height() < $(document).height()) {
                $(".bottom_menu").removeClass("nav-up").addClass("nav-down");
            }
            if (st == 0) {
                $(".bottom_menu").removeClass("nav-down");
            }
        }
        lastScrollTop = st;
    }
});