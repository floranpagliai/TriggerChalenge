var initialSliderElemCount;

jQuery(document).ready(function ($) {
    initSlider();
    initNavigation();
});

function initSlider() {
    var container = $('#js-slider-container');

    initialSliderElemCount = $(container).find('.col-lg-4.active').length;
    updateSliderSize(container);
    updateSliderNavigation(container);
    $(window).resize(function () {
        updateSliderSize(container);
    });
    $('#js-slider-prev').click(function (e) {
        e.preventDefault();
        if (!$(container).find('.col-lg-4').first().hasClass('active')) {
            $(container).find('.col-lg-4.active').first().prev().removeClass('hide').addClass('active');
            $(container).find('.col-lg-4.active').last().addClass('hide').removeClass('active');
        }
        updateSliderNavigation(container);
    });

    $('#js-slider-next').click(function (e) {
        e.preventDefault();
        if (!$(container).find('.col-lg-4').last().hasClass('active')) {
            $(container).find('.col-lg-4.active').last().next().addClass('active').removeClass('hide');
            $(container).find('.col-lg-4.active').first().removeClass('active').addClass('hide');
        }
        updateSliderNavigation(container);
    });
}

function updateSliderNavigation(container) {
    if ($(container).find('.col-lg-4').last().hasClass('active')) {
        $('#js-slider-next').addClass('disabled');
    } else {
        $('#js-slider-next').removeClass('disabled');
    }
    if ($(container).find('.col-lg-4').first().hasClass('active')) {
        $('#js-slider-prev').addClass('disabled');
    } else {
        $('#js-slider-prev').removeClass('disabled');
    }
}

function updateSliderSize(container) {
    if ($(window).width() <= 991 &&  $(container).find('.col-lg-4.active').length == initialSliderElemCount) {
        $(container).find('.col-lg-4.active').first().addClass('hide').removeClass('active');
        $(container).find('.col-lg-4.active').last().addClass('hide').removeClass('active');
    } else if ($(window).width() > 991 && $(container).find('.col-lg-4.active').length == 1) {
        $(container).find('.col-lg-4.active').first().prev().removeClass('hide').addClass('active');
        $(container).find('.col-lg-4.active').last().next().removeClass('hide').addClass('active');
    }
}

function toggle_panel_visibility($lateral_panel, $background_layer, $body) {
    if ($lateral_panel.hasClass('speed-in')) {
        // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
        $lateral_panel.removeClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
            $body.removeClass('overflow-hidden');
        });
        $background_layer.removeClass('is-visible');

    } else {
        $lateral_panel.addClass('speed-in').one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
            $body.addClass('overflow-hidden');
        });
        $background_layer.addClass('is-visible');
    }
}

function move_navigation($navigation, $MQ) {
    if ($(window).width() >= $MQ) {
        $navigation.detach();
        $navigation.appendTo('header');
    } else {
        $navigation.detach();
        $navigation.insertAfter('header');
    }
}

function initNavigation() {
    //if you change this breakpoint in the style.css file (or _layout.scss if you use SASS), don't forget to update this value as well
    var $L = 1200,
        $menu_navigation = $('#main-nav'),
        $hamburger_icon = $('#cd-hamburger-menu'),
        $lateral_cart = $('#cd-cart'),
        $shadow_layer = $('#cd-shadow-layer');

    $(window).on('click', function (event) {
        if ($menu_navigation.hasClass('speed-in')) {
            toggle_panel_visibility($menu_navigation, $shadow_layer, $('body'));
        }

    });
    $menu_navigation.on('click', function (event) {
        event.stopPropagation();
    });

    //open lateral menu on mobile
    $hamburger_icon.on('click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        toggle_panel_visibility($menu_navigation, $shadow_layer, $('body'));
    });

    //close lateral cart or lateral menu
    $shadow_layer.on('click', function () {
        $shadow_layer.removeClass('is-visible');
        // firefox transitions break when parent overflow is changed, so we need to wait for the end of the trasition to give the body an overflow hidden
        if ($lateral_cart.hasClass('speed-in')) {
            $lateral_cart.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                $('body').removeClass('overflow-hidden');
            });
            $menu_navigation.removeClass('speed-in');
        } else {
            $menu_navigation.removeClass('speed-in').on('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function () {
                $('body').removeClass('overflow-hidden');
            });
            $lateral_cart.removeClass('speed-in');
        }
    });

    //move #main-navigation inside header on laptop
    //insert #main-navigation after header on mobile
    move_navigation($menu_navigation, $L);
    $(window).on('resize', function () {
        move_navigation($menu_navigation, $L);

        if ($(window).width() >= $L && $menu_navigation.hasClass('speed-in')) {
            $menu_navigation.removeClass('speed-in');
            $shadow_layer.removeClass('is-visible');
            $('body').removeClass('overflow-hidden');
        }
    });
}