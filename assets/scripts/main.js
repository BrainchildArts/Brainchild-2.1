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

        var allReveals = $('.reveal');
        $('.reveal-button').bind('click', function(e){
          if ($(this).parent().hasClass('is-expanded')) {
            $(this).parent().find('.reveal').toggle();  // apply the toggle to the reveal
            $(this).parent().find('.reveal').toggleClass('vhs-fade');
            $(this).parent().toggleClass('is-expanded');
          } else {
            allReveals.hide();
            allReveals.parent().removeClass('is-expanded');
            allReveals.removeClass('vhs-fade');
            $(this).parent().find('.reveal').toggle();  // apply the toggle to the reveal
            $(this).parent().find('.reveal').toggleClass('vhs-fade');
            $(this).parent().toggleClass('is-expanded');
          }
          e.preventDefault();
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
        // Grid.init()



        $('#artist__grid article').magnificPopup({
          type: 'inline',
          gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
          }
        });

        var client_id = '9d5d36353b4fa04a9e70b1de4fc56669';
        SC.initialize({
          client_id: '9d5d36353b4fa04a9e70b1de4fc56669'
        });

        if ($('#sc-widget').length) {
          var $items        = $( '#artist__grid .hentry' ),
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
              console.log($items);
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
            console.log('next');
          };

          $("article.type-artists").on("click", "a.soundcloud_link", function(e) {
            e.preventDefault();
            var permalink_url = $(this).attr('href');
            $(this).addClass('sc-playing');
            $.get('http://api.soundcloud.com/resolve.json?url='+permalink_url+'/tracks&client_id='+client_id , function (result) {
                newSoundUrl = 'http://api.soundcloud.com/tracks/'+result.id;
                widget.bind(SC.Widget.Events.READY, function() {
                  // load new widget
                  widget.load(newSoundUrl, options);
                  widget.bind(SC.Widget.Events.PLAY, function() {
                    $(widget_wrap).addClass('active');
                    $(widget_wrap).addClass('show');
                  });
                  widget.bind(SC.Widget.Events.FINISH, function() {
                    playNext();
                  });
                });
              });
          });

          $("#sc-widget-wrap").on("click", "#sc-widget-wrap__close", function(e) {
            e.preventDefault();
            widget.pause();
            $(widget_wrap).removeClass('show');
            setTimeout(function(){
              $(widget_wrap).removeClass('active');
            }, 800);
          });

          $(widgetIframe).hover(function() {
            $(widget_wrap).toggleClass('up');
          });

          $("#sc-widget-wrap").on("click", "button.play", function(e) {
            e.preventDefault();
            widget.pause();
          });
        }



        // Youtube Modal - http://codepen.io/forthewinn/pen/bNXNGK
        // REQUIRED: "jQuery Query Parser" plugin.

        // YOUTUBE VIDEO CODE

        // Modal Window for dynamically opening videos
        $("article.type-artists").on("click", ".youtube_link", function(e) {
          // Store the query string variables and values
          // Uses "jQuery Query Parser" plugin, to allow for various URL formats (could have extra parameters)
          var queryString = $(this).attr('href').slice( $(this).attr('href').indexOf('?') + 1);
          var queryVars = $.parseQuery( queryString );

          // if GET variable "v" exists. This is the Youtube Video ID
          if ( queryVars.v && $(window).width() >= 600 ) {
            // Prevent opening of external page
            e.preventDefault();

            // Variables for iFrame code. Width and height from data attributes, else use default.
            var vidWidth = 560; // default
            var vidHeight = 315; // default
            var iFrameCode = '<iframe width="' + vidWidth + '" height="'+ vidHeight +'" scrolling="no" allowtransparency="true" allowfullscreen="true" src="http://www.youtube.com/embed/'+  queryVars.v +'?autoplay=true&rel=0&wmode=transparent&showinfo=0" frameborder="0"></iframe>';

            // Replace Modal HTML with iFrame Embed
            $('#modal-youtube .modal-youtube__video').html(iFrameCode);

            // Open Modal

            $("body").addClass("modal-youtube-open");
            $("#sound").addClass("disabled");
          }
        });

        // Clear modal contents on close.
        // There was mention of videos that kept playing in the background.
        $("#modal-youtube .modal-fade-screen, #modal-youtube .modal-close").on("click", function() {
            $("body").removeClass("modal-youtube-open");
            $('#modal-youtube .modal-youtube__video').html('');
            $("#sound").removeClass("disabled");
        });

        $(".modal-inner").on("click", function(e) {
          e.stopPropagation();
        });


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

        $('#lineup .filter').click(function() {
          // fetch the class of the clicked item
          var ourClass = $(this).data('filter');


          // reset the active class on all the buttons
          $('#artist__grid').children('article').hide();
          $('.filter-tabs li').removeClass('active');
          // update the active state on our clicked button
          $(this).parent().addClass('active');

          if( ourClass === 'all') {
            // show all our items
            $('#artist__grid').children('article').fadeIn().removeClass('filtered-out');
          }
          else {
            // hide all elements that don't share ourClass
            $('#artist__grid').children('article:not(.' + ourClass + ')').hide().addClass('filtered-out');
            // show all elements that do share ourClass
            $('#artist__grid').children('article.' + ourClass).fadeIn().removeClass('filtered-out');
            showLineup();
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

        // Smooth Scrolling

        $('a[href*="#"]:not([href="#"])').click(function() {
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

        $('#lineup').addClass('truncate');
        $('#lineup a.showmore').click( function(e) {
          e.preventDefault();
          showLineup();
        });


        function onPlayerReady() {
          var player = $('#video_background').data('ytPlayer').player;
          player.mute();
          player.addEventListener('onStateChange', function(event) {
              // OnStateChange Data
              if (event.data === 1) {
                  $("#sound").addClass('loaded');
              }
          });
          // Video Muting
          function unmute() {
            player.unMute();
            $("#sound").removeClass('muted');
            $(".splash-content").addClass('vhs-flicker vhs-reverse');
            $("header.banner").addClass('vhs-flicker vhs-reverse');
            setTimeout(hide, 400);
          }

          function mute() {
              player.mute();
              $("#sound").addClass('muted');
              $(".splash-content").removeClass('hidden');
              $("header.banner").removeClass('hidden');
              $(".splash-content").addClass('vhs-flicker');
              $("header.banner").addClass('vhs-flicker');
              setTimeout(clean, 400);
          }

          $("#sound").click( function (){
            if( $(this).hasClass('muted') ) {
              unmute();
            }
            else {
              mute();
            }
          });
          var inview = new Waypoint.Inview({
            element: $('#splash')[0],
            enter: function(direction) {
              player.playVideo();
            },
            exited: function(direction) {
              if( $('#sound').hasClass('muted') ) {
                player.pauseVideo();
              }
            }
          });

        }
        var videoElement = $('#video_background'),
            $window      = $(window);

        var windowWidth = $window.width();
        if (windowWidth >= 850) {
          $('#video_background').YTPlayer({
            fitToBackground: false,
            width: $('#splash').width(),
            videoId: '-x_5aJFcWaI',
            mute: true,
            playerVars: {
              mute: true
            },
            events: {
              'onReady': onPlayerReady
            }
          });
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
