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

        //Sticky Nav
        var stickyNavTop = $('header.banner').offset().top;

        var stickyNav = function(){
          var scrollTop = $(window).scrollTop();

          if (scrollTop > stickyNavTop) {
              $('header.banner').addClass('sticky');
          } else {
              $('header.banner').removeClass('sticky');
          }
        };

        stickyNav();

        $(window).scroll(function() {
            stickyNav();
        });
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
            if ( $(this).nextAll('.reveal').length ) {
              $(this).nextAll('.reveal').first().toggle();
              $(this).nextAll('.reveal').first().toggleClass('vhs-fade');
              $(this).toggleClass('active');
            } else {
                console.log('length not');
                $(this).parent().nextAll('.reveal').first().toggle();
                $(this).parent().nextAll('.reveal').first().toggleClass('vhs-fade');
                $(this).toggleClass('active');
            }
        });


        // Lightbox/Gallery
        var galleryOptions = {
          previousIcon: '«',
          nextIcon: '»',
          variant: 'bc-zoom bc-gallery',
          loading: '<div class="gallery__loader"><div class="rect1"></div><div class="rect2"></div><div class="rect3"></div><div class="rect4"></div><div class="rect5"></div></div>',
          openSpeed: 50,
          closeSpeed: 50,
          galleryFadeIn: 20,          /* fadeIn speed when slide is loaded */
          galleryFadeOut: 50
        };

        $('#gallery a.zoom-in').featherlightGallery(galleryOptions);

        $('#lineup a.zoom-in').featherlightGallery(galleryOptions);

        // Init Lineup Grid
        Grid.init();

        var client_id = '9d5d36353b4fa04a9e70b1de4fc56669';
        SC.initialize({
          client_id: '9d5d36353b4fa04a9e70b1de4fc56669'
        });

        if ($('#sc-widget').length) {
          var $items        = $( '#artist__grid .hentry>a').filter('[data-track]'),
              permalink_url = $($items).first().data('track'),
              widgetIframe = document.getElementById('sc-widget'),
              widget       = SC.Widget(widgetIframe),
              widget_wrap  = $('#sc-widget-wrap'),
              options       = {
                show_artwork: false,
                show_comments: false,
                liking: false,
                buying: false,
                sharing: false,
                auto_play: true
              };

          $.get('http://api.soundcloud.com/resolve.json?url='+permalink_url+'/tracks&client_id='+client_id , function (result) {
            newSoundUrl = 'http://api.soundcloud.com/tracks/'+result.id;
            widget.bind(SC.Widget.Events.READY, function() {
              // load new widget
              widget.load(newSoundUrl, {
                show_artwork: false,
                show_comments: false,
                liking: false,
                buying: false,
                sharing: false,
                auto_play: false
              });
            });
          });

          var playNext = function(){
            var scrollTop = $(window).scrollTop();

            if (scrollTop > stickyNavTop) {
                $('header.banner').addClass('sticky');
            } else {
                $('header.banner').removeClass('sticky');
            }
          };

          $("article.category-lineup").on("click", "a.soundcloud_link", function(e) {
            e.preventDefault();
            var permalink_url = $(this).attr('href');
            $.get('http://api.soundcloud.com/resolve.json?url='+permalink_url+'/tracks&client_id='+client_id , function (result) {
                  newSoundUrl = 'http://api.soundcloud.com/tracks/'+result.id;

              widget.bind(SC.Widget.Events.READY, function() {
                // load new widget
                  widget.load(newSoundUrl, options);
                  $(widget_wrap).addClass('active');
                widget.bind(SC.Widget.Events.FINISH, function() {
                  $(widget_wrap).removeClass('active');
                });
              });
            });
          });

          $("#sc-widget-wrap").on("click", "#sc-widget-wrap__close", function(e) {
            e.preventDefault();
            widget.pause();
            $(widget_wrap).removeClass('active');
          });

          $(widgetIframe).hover(function() {
            $(widget_wrap).toggleClass('up');
          });

          $("#sc-widget-wrap").on("click", "button.play", function(e) {
            e.preventDefault();
            widget.pause();
          });
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

        $(".ticket-link").on("click", function() {
          mixpanel.track("Click on Ticket Link");
          ga('send', 'event', 'Clicks', 'click', 'Ticket Link');
        });

        $.scrollDepth({labelPrefix:"Scroll: "});

        $('.filter').click(function() {
          // fetch the class of the clicked item
          var ourClass = $(this).data('filter');

          // reset the active class on all the buttons
          $('#artist__grid').children('article').hide();
          $('.filter-tabs li').removeClass('active');
          // update the active state on our clicked button
          $(this).parent().addClass('active');

          if(ourClass === 'all') {
            // show all our items
            $('#artist__grid').children('article').fadeIn();
          }
          else {
            // hide all elements that don't share ourClass
            $('#artist__grid').children('article:not(.' + ourClass + ')').hide();
            // show all elements that do share ourClass
            $('#artist__grid').children('article.' + ourClass).fadeIn();
          }
          return false;
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
