/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        // Smooth Scrolling

        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') || location.hostname === this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                  $('html,body').animate({
                    scrollTop: target.offset().top
                  }, 200, 'easeInOutExpo');
                return false;
                }
            }
        });

        // Responsive Menu
        var menuToggle = $('#js-mobile-menu').unbind();
        $('#js-navigation-menu').removeClass("show");

        menuToggle.on('click', function(e) {
          e.preventDefault();
          $('#js-navigation-menu').slideToggle(function(){
            if($('#js-navigation-menu').is(':hidden')) {
              $('#js-navigation-menu').removeAttr('style');
            }
          });
        });

        // Reveals
        $(".reveal-button").click(function(e) {
            e.preventDefault();
            $(this).nextAll('.reveal').toggle();
            $(this).nextAll('.reveal').toggleClass('vhs-fade');
            $(this).toggleClass('active');
        });

        // Lightbox/Gallery
        var galleryOptions = {
          previousIcon: '«',
          nextIcon: '»',
          variant: 'bc-zoom bc-gallery',
          openSpeed: 50,
          closeSpeed: 50,
          galleryFadeIn: 20,          /* fadeIn speed when slide is loaded */
          galleryFadeOut: 50
        };

        $('#gallery a.zoom-in').featherlightGallery(galleryOptions);

        $('#lineup a.zoom-in').featherlightGallery(galleryOptions);


        // Video Muting
        $("#sound").click( function (){
          if( $(this).hasClass('muted') ) {
            $("video.headervideo").prop('muted', false); //mute
            $(this).removeClass('muted');
            $(".splash-content").addClass('vhs-flicker vhs-reverse');
            $("header.banner").addClass('vhs-flicker vhs-reverse');
            setTimeout(hide, 400);
          }
          else {
            $("video.headervideo").prop('muted', true);
            $(this).addClass('muted');
            $(".splash-content").removeClass('hidden');
            $("header.banner").removeClass('hidden');
            $(".splash-content").addClass('vhs-flicker');
            $("header.banner").addClass('vhs-flicker');
            setTimeout(clean, 400);
          }
        });

        function hide() {
          $(".splash-content").addClass('hidden');
          $("header.banner").addClass('hidden');
          $(".splash-content").removeClass('vhs-flicker vhs-reverse');
          $("header.banner").removeClass('vhs-flicker vhs-reverse');
        }

        function clean() {
          $(".splash-content").removeClass('vhs-flicker');
          $("header.banner").removeClass('vhs-flicker');
        }


        // Modal
        $("#modal-1").on("change", function() {
          if ($(this).is(":checked")) {
            $("body").addClass("modal-open");
            $("#sound").addClass("disabled");
          } else {
            $("body").removeClass("modal-open");
            $("#sound").removeClass("disabled");
          }
        });

        $(".modal-fade-screen, .modal-close").on("click", function() {
          $(".modal-state:checked").prop("checked", false).change();
        });

        $(".modal-inner").on("click", function(e) {
          e.stopPropagation();
        });


      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);
})(jQuery); // Fully reference jQuery after this point.
