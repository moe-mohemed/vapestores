/* global jQuery:true */
// (function() {
//     'use strict';
//     var isTouch = 'ontouchstart' in window || 'msmaxtouchpoints' in window.navigator;

//     function Touche(nodes) {
//         // Doing this allows the developer to omit the `new` keyword from their calls to Touche
//         if (!(this instanceof Touche)) {
//             return new Touche(nodes);
//         }

//         if (!nodes) {
//             throw new Error('No DOM elements passed into Touche');
//         }

//         this.nodes = nodes;

//         return this;
//     }

//     // Our own event handler
//     Touche.prototype.on = function(event, fn) {
//         var touchend, nodes = this.nodes,
//             len = nodes.length,
//             ev;

//         if (isTouch && event === 'click') {
//             touchend = true;
//         }

//         ev = function(el, event, fn) {
//             var called, once = function() {
//                 if (!called && (called = true)) {
//                     fn.apply(this, arguments);
//                 }
//             };

//             el.addEventListener(event, once, false);

//             if (touchend) {
//                 el.addEventListener('touchend', once, false);
//             }
//         };

//         // NodeList or just a Node?
//         if (len) {
//             while (len--) {
//                 ev(nodes[len], event, fn);
//             }
//         } else {
//             ev(nodes, event, fn);
//         }

//         return this;
//     };

//     // Expose Touche
//     window.Touche = Touche;

//     // Has the developer used jQuery?
//     if (window.jQuery && isTouch) {
//         var originalOnMethod  = jQuery.fn.on,
//             originalOffMethod = jQuery.fn.off;

//         var replaceEventName = function (event) {
//             if (event.slice(0, 5) == 'click') {
//                 return event.replace('click', 'touchend');
//             }
//             return event;
//         }

//         // Change event type and re-apply .on() method
//         jQuery.fn.on = function() {
//             // arguments[0] is the event name if provided
//             if(typeof arguments[0] === "string"){
//                 arguments[0] = replaceEventName(arguments[0]);
//             }

//             originalOnMethod.apply(this, arguments);
//             return this;
//         };

//         // Change event type and re-apply .off() method
//         jQuery.fn.off = function() {
//             // arguments[0] is the event name if provided
//             if(typeof arguments[0] === "string"){
//                 arguments[0] = replaceEventName(arguments[0]);
//             }

//             originalOffMethod.apply(this, arguments);
//             return this;
//         };
//     }
// })();


// $('#province').change(function(){
//     //var selectedProvince = $('#province').val();
//     var select = $('#city');
//     var prov = (function () {
//         var json = null;
//         $.ajax({
//             'async': false,
//             'global': false,
//             'url': '/js/states.json',
//             'dataType': "json",
//             'success': function (data) {
//                 json = data;
//             }
//         });
//         return json;
//     })();
//     var locations = prov[$(this).val()];
//     var cityString = '';
//     $.each(locations, function (i, item) {
//         cityString += '<option value="' + item + '">' + item+ '</option>';
//     });
//     $('#city').html(cityString);
// });
var sideHeight = $('.cities').outerHeight();
function resizeAndReload() {
    $('.cities').height(sideHeight);
    slyelement.obj.reload();
}

if (window.innerWidth >= 1030) {
    var slyelement = {
        obj: {},
        el: '.cities',
        options: {
            speed: 300,
            easing: 'swing',
            activatePageOn: 'click',
            mouseDragging: 1,
            touchDragging: 1,
            scrollBy: 30,
            dragHandle: 1,
            dynamicHandle: 1,
            clickBar: 1,
            scrollBar: $('.scrollbar'),
            forward: $('.scroll-down i'),
            backward: $('.scroll-up i')
        }
    };


    $(function () {
        slyelement.obj = new Sly($(slyelement.el), slyelement.options);

        slyelement.obj.init();
    });
}
// function preventDefault(e) {
//     e = e || window.event;
//     if (e.preventDefault)
//         e.preventDefault();
//     e.returnValue = false;
// }
// function preventDefaultForScrollKeys(e) {
//     if (keys[e.keyCode]) {
//         preventDefault(e);
//         return false;
//     }
// }

var contains = $('.contains');
// function disableScroll() {
//     if (window.addEventListener) // older FF
//         window.addEventListener('DOMMouseScroll', preventDefault, false);
//     window.onwheel = preventDefault; // modern standard
//     window.onmousewheel = document.onmousewheel = preventDefault; // older browsers, IE
//     window.ontouchmove  = preventDefault; // mobile
//     window.onkeydown  = preventDefaultForScrollKeys;


//     window.touchcancel = preventDefault; // modern standard
//     window.touchend = preventDefault; // modern standard
//     window.touchmove = preventDefault; // modern standard
//     window.touchstart = preventDefault; // modern standard
// }

// function enableScroll() {
//     if (window.removeEventListener)
//         window.removeEventListener('DOMMouseScroll', preventDefault, false);
//     window.onmousewheel = document.onmousewheel = null;
//     window.onwheel = null;
//     window.ontouchmove = null;
//     window.onkeydown = null;

//     window.touchcancel = null;
//     window.touchend = null;
//     window.touchmove = null;
//     window.touchstart = null;
// }

// $('.sidebar').mouseover(function() {
//     window.disableScroll();
// }).mouseout(function() {
//     window.enableScroll();
// });


// $('.review-expand').click(function(event){
//     $('.ratings').toggleClass('ratings-show');
// });
$('.menu-pop .hamburger').click(function(event){
    $('.sidebar').toggleClass('sidebar-show');
    $(this).toggleClass('menu-close');
    event.stopPropagation();
});
$('.pricing-pop').click(function() {
    event.stopPropagation();
});
$('.sidebar').click(function() {
    event.stopPropagation();
});
$('.price-click').click(function(event){
    event.stopPropagation();
    $('.pricing-pop').removeClass('pricing-show');
    $(this).parent().find('.pricing-pop').toggleClass('pricing-show');
});
$('html').click(function() {
    //Hide the menus if visible
    $('.pricing-show').removeClass('pricing-show');
    $('.sidebar').removeClass('sidebar-show');
    $('.hamburger').removeClass('menu-close');
});
$('.select-img').click(function(){
    $('.select-img img').removeClass('selected-img');
    $(this).find('img').toggleClass('selected-img');
    var avValue = $(this).attr('data-value');
    console.log(avValue);
    $('.avatar-value').val(avValue);
});
$('.select-main-img').click(function(){
    $('.select-main-img img').removeClass('selected-main-img');
    $(this).find('img').toggleClass('selected-main-img');
    var mainImgValue = $(this).attr('data-value');
    $('.main-img-value').val(mainImgValue);
});
var accordionHeader = $('.province-link .region'),
    accordionContent = $('.sidebar .cities ul li ul'),
    accordionIcon = $('.province-link');

$(accordionHeader).click(function (e) {
    e.preventDefault();
    if ($(this).parent().hasClass('is-active')){
        $(this).parent().next(accordionContent).slideUp('slow', function () {
            if (window.innerWidth >= 1030) {
                resizeAndReload();
            }
        });
        $(this).parent().removeClass('is-active');
    }
    else {
        // close other content
        $(accordionHeader).not(this).parent().next(accordionContent).slideUp('slow', function () {
            if (window.innerWidth >= 1030) {
                resizeAndReload();
            }
        });
        $(accordionHeader).not(this).parent().removeClass('is-active');
        $(this).parent().next(accordionContent).slideDown('slow', function () {
            if (window.innerWidth >= 1030) {
                resizeAndReload();
            }
        });
        $(this).parent().addClass('is-active');
    }

});


$('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        gutter: 0, // Spacing from edge
        belowOrigin: false, // Displays dropdown below the button
        alignment: 'left', // Displays dropdown with edge aligned to the left of button
        stopPropagation: true // Stops event propagation
    }
);

$('.prevent-def').on('click touchstart touchend touchmove tap dbltap dragstart dragmove dragend', function (event) {
    event.stopPropagation();
});

/*$(document).ready(function () {
    if (sessionStorage.getItem('rateMessage') !== 'true') {
        setTimeout(function() {
            $('.rate-message').show('slow')
        }, 3000);
        sessionStorage.setItem('rateMessage','true');
    }   
    
});*/

$(document).ready(function(){
    $('ul.tabs').tabs();
});


// $('.login-popup form').click(function (event) {
//     event.stopPropagation();
// });


