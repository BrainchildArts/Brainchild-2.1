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
        $('.menu-single-page-navigation-container').removeClass("show");

        menuToggle.on('click', function(e) {
          e.preventDefault();
          $(this).toggleClass('is-active');
          $('.menu-single-page-navigation-container').toggleClass('show');
          $('.menu-single-page-navigation-container ul').toggleClass('show');
        });

        $('.menu-item a').click(function() {
          $('#js-mobile-menu').removeClass('show');
          $('.menu-single-page-navigation-container.show').removeClass('show');
          $('.menu-single-page-navigation-container ul.show').removeClass('show');
        });



        function noBackgroundScroll(){
          $('body').addClass('modal-open');
        }
        function restoreBackgroundScroll(){
          $('body').removeClass('modal-open');
        }

        $( '.artist__grid .entry-image' ).each(function(index, el) {

          var min_x = 0;
          var max_x = $(window).width() - $(this).width();
          var min_y = 0 - $(this).height();
          var max_y = $('.artist__grid').outerHeight() - $(this).height();


          var check_overlap = function (area,check_area) {

            var bottom1 = area.y + area.height;
            var bottom2 = check_area.y + check_area.height;
            var top1 = area.y;
            var top2 = check_area.y;
            var left1 = area.x;
            var left2 = check_area.x;
            var right1 = area.x + area.width;
            var right2 = check_area.x + check_area.width;
            if (bottom1 < top2 || top1 > bottom2 || right1 < left2 || left1 > right2) {
              return false;
            }
            return true;
          };

          $(this).each(function() {
              var rand_x=0;
              var rand_y=0;
              var area;
              var artist = $(this).data('artist');
              var thingel = $('.entry-title[data-artist="'+artist+'"]');
              var check_area = {x: thingel.position().left, y: thingel.position().top, width: thingel.width(), height: thingel.height()};
              do {
                  rand_x = Math.random() * (max_x - 0) + 0;
                  rand_y = Math.random() * (max_y - 0) + 0;
                  area = {x: rand_x, y: rand_y, width: $(this).width(), height: $(this).height()};
              } while(check_overlap(area,check_area));

              $(this).css({left:rand_x, top: rand_y});
          });


        });


        $( '.artist__grid .entry-title a' )
        .mouseenter( function() {
          var artist = $(this).data('artist');
          $('.entry-image[data-artist="'+artist+'"]').addClass('show');
        } )
        .mouseleave(function() {
          var artist = $(this).data('artist');
          $('.entry-image[data-artist="'+artist+'"]').removeClass('show');
        } );

        //Artist gallery
        $('.artist__grid a.artist-overlay').featherlightGallery({
            targetAttr: 'data-mfp-src',
            variant: 'artist-lightbox',
            loading: '<div class="loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div>',
            previousIcon: '«',
            nextIcon: '»',
            otherClose: '.lightbox__close span',
            openSpeed: 0,
            closeSpeed: 0,
            galleryFadeOut: 0,
            galleryFadeIn: 0,
            afterOpen: function() {
              noBackgroundScroll();
            },
            beforeClose: function() {
              restoreBackgroundScroll();
            }
        });


                //Artist gallery
        $('#highlights a').featherlightGallery({
            targetAttr: 'data-mfp-src',
            variant: 'highlights-lightbox',
            previousIcon: '«',
            nextIcon: '»',
            loading: '<div class="loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div>',
            otherClose: '.lightbox__close span',
            openSpeed: 0,
            closeSpeed: 800,
            galleryFadeOut: 1300,
            galleryFadeIn: 1400,
            afterOpen: function() {
              noBackgroundScroll();
            },
            beforeClose: function() {
              restoreBackgroundScroll();
            }
        });

          var $carousel = $('div.gallery-theme--slider').flickity({
            // options
            cellAlign: 'center',
            imagesLoaded: true,
            wrapAround: true
          });



          var $gallery = $('div.gallery-theme--default').masonry({
            // options
            itemSelector: '.gallery-item',
            gridSizer: '.gallery-item',
            columnWidth: '.gallery-item',
            gutter: 10,
            percentPosition: true
          });

        // Photoswipe

          var $pswp = $('.pswp')[0];
          var image = [];

          $('.gallery-theme--default').each( function() {
              var $pics     = $(this),
                  getItems = function() {
                      var items = [];
                      $pics.find('a').each(function() {
                          var $href   = $(this).attr('href'),
                              $size   = $(this).data('size').split('x'),
                              $width  = $size[0],
                              $height = $size[1];
                              $caption= $(this).find('figure').html();

                          var item = {
                              src : $href,
                              w   : $width,
                              h   : $height,
                              cap : $caption
                          };

                          items.push(item);
                      });
                      return items;
                  };

              var items = getItems();

              $.each(items, function(index, value) {
                  image[index]     = new Image();
                  image[index].src = value.src;
              });


              $pics.on('click', 'figure', function(event) {
                  event.preventDefault();
                  if (!$(this).parents('.gallery-theme--slider').length) {

                    var $index = $(this).index();
                    var options = {
                        index: $index,
                        bgOpacity: 1,
                        showHideOpacity: true,
                        fullscreenEl: false,
                        history: false,
                        zoomEl: false,
                        shareEl: false,
                        captionEl:true,
                        // Function builds caption markup
                        addCaptionHTMLFn: function(item, captionEl, isFake) {
                            // item      - slide object
                            // captionEl - caption DOM element
                            // isFake    - true when content is added to fake caption container
                            //             (used to get size of next or previous caption)

                            if(!item.cap) {
                                captionEl.children[0].innerHTML = '';
                                return false;
                            }
                            captionEl.children[0].innerHTML = item.cap;
                            return true;
                        },
                    };

                    var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                    lightBox.init();
                  }
              });
          });

          $('.gallery-theme--slider').each( function() {
              var $pics     = $(this),
                  getItems = function() {
                      var items = [];
                      $pics.find('a').each(function() {
                          var $href   = $(this).attr('href'),
                              $size   = $(this).data('size').split('x'),
                              $width  = $size[0],
                              $height = $size[1];
                              $caption= $(this).find('figure').html();

                          var item = {
                              src : $href,
                              w   : $width,
                              h   : $height,
                              cap : $caption
                          };

                          items.push(item);
                      });
                      return items;
                  };

              var items = getItems();

              $.each(items, function(index, value) {
                  image[index]     = new Image();
                  image[index].src = value.src;
              });

              $pics.on('click', 'figure', function(event) {
                  event.preventDefault();
              });

              $carousel.on( 'staticClick.flickity', function( event, pointer, cellElement, cellIndex ) {
                // dismiss if cell was not clicked
                if ( !cellElement ) {
                  return;
                }

                var options = {
                    index: cellIndex,
                    bgOpacity: 1,
                    showHideOpacity: true,
                    fullscreenEl: false,
                    zoomEl: false,
                    history: false,
                    shareEl: false,
                    captionEl:true
                };


                var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                lightBox.init();
              });
          });


          // layout Masonry after each image loads
          $gallery.imagesLoaded().progress( function() {
            $gallery.masonry('layout');
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

        // ScatterText

        $(".scatterText").lettering('words').children('span').lettering();

        // Lightbox/Gallery
        var galleryOptions = {
          previousIcon: '«',
          nextIcon: '»',
          variant: 'bc-zoom bc-gallery',
          loading: '<div class="loader"><div class="dot"></div><div class="dot"></div><div class="dot"></div></div></div>',
          openSpeed: 50,
          closeSpeed: 50,
          galleryFadeIn: 20,          /* fadeIn speed when slide is loaded */
          galleryFadeOut: 50,
          afterOpen: function() {
            noBackgroundScroll();
          },
          afterClose: function() {
            restoreBackgroundScroll();
          }
        };

        $('#gallery a.zoom-in').featherlightGallery(galleryOptions);



        var client_id = '9d5d36353b4fa04a9e70b1de4fc56669';
        SC.initialize({
          client_id: '9d5d36353b4fa04a9e70b1de4fc56669'
        });

        if ($('#sc-widget').length) {
          var $items        = $( '.lineup-overlays .hentry[data-is_track=true]' ),
              permalink_url = $($items).first().find('.soundcloud_link').attr("href"),
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

          var getNextTrack = function(node) {
            var $player = $(node).closest('.sc-player'),
                $nextItem = $('.sc-trackslist li.active', $player).next('li');
            // try to find the next track in other player
            if(!$nextItem.length){
              $nextItem = $player.nextAll('div.sc-player:first').find('.sc-trackslist li:first');
            }
            return $nextItem;
          };

          var getPrevTrack = function(node) {
            var $player = $(node).closest('.sc-player'),
                $prevItem = $('.sc-trackslist li.active', $player).prev('li');
            // try to find the next track in other player
            if(!$prevItem.length){
              $prevItem = $player.prevAll('div.sc-player:first').find('.sc-trackslist li:last');
            }
            return $prevItem;
          };

          var playNext = function(){
            console.log('next');
              var $nextItem = getNextTrack(event.target);
              // init the next track but don't play :)
              $nextItem.click();
          };

          if ($(window).width() >= 600) {
            $(document).on("click", "a.soundcloud_link", function(e) {
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
          }

          $("#sc-widget-wrap").on("click", "#sc-widget-wrap__pause", function(e) {
            e.preventDefault();
            widget.pause();
          });

          $("#sc-widget-wrap").on("click", "#sc-widget-wrap__play", function(e) {
            e.preventDefault();
            widget.play();
          });
        }



        // Youtube Modal - http://codepen.io/forthewinn/pen/bNXNGK
        // REQUIRED: "jQuery Query Parser" plugin.

        // YOUTUBE VIDEO CODE

        $(document).on("click", ".youtube_link", function(e) {
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


            $.featherlight(iFrameCode);
            $("#sound").addClass("disabled");
          }
        });


        $(".ticket-link").on("click", function() {
          mixpanel.track("Click on Ticket Link");
          ga('send', 'event', 'Clicks', 'click', 'Ticket Link');
        });

        $(".volunteerticket-link").on("click", function() {
          mixpanel.track("Click on Volunteer Ticket Link");
          ga('send', 'event', 'Clicks', 'click', 'Volunteer Ticket Link');
        });

        $(".volunteermodal-link").on("click", function() {
          mixpanel.track("Click on Volunteer modal Link");
          ga('send', 'event', 'Clicks', 'click', 'Volunteer modal Link');
        });

        $.scrollDepth({labelPrefix:"Scroll: "});

        $('#lineup .filter').click(function() {
          // fetch the class of the clicked item
          var ourClass = $(this).data('filter');

          // reset the active class on all the buttons
          $('.artist__grid').children('.entry-title').hide();
          $('.filter-tabs li').removeClass('active');
          // update the active state on our clicked button
          $(this).parent().addClass('active');

          if( ourClass === 'all') {
            // show all our items
            $('.artist__grid').children('.entry-title').fadeIn().removeClass('filtered-out');
          }
          else {
            // hide all elements that don't share ourClass
            $('.artist__grid').children('.entry-title:not(.' + ourClass + ')').hide().addClass('filtered-out');
            // show all elements that do share ourClass
            $('.artist__grid').children('.entry-title.' + ourClass).fadeIn().removeClass('filtered-out');
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
          $(".splash-content").removeClass('vhs-flicker vhs-reverse');
        }

        function clean() {
          $(".splash-content").removeClass('vhs-flicker');
        }

        // Smooth Scrolling

        $('a[href*="#"]:not([href="#"])').click(function() {
            if (location.pathname.replace(/^\//,'') === this.pathname.replace(/^\//,'') || location.hostname === this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                  $('html,body').animate({
                    scrollTop: target.offset().top-100
                  }, 200, 'easeInOutExpo');
                return false;
                }
            }
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
            setTimeout(hide, 400);
          }

          function mute() {
              player.mute();
              $("#sound").addClass('muted');
              $(".splash-content").removeClass('hidden');
              $(".splash-content").addClass('vhs-flicker');
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
            videoId: '5XXNLVT8_zc',
            playerVars: {
              mute: true,
              rel: 0,
              showinfo: 0,
              setPlaybackQuality: 'hd720',
              suggestedQuality: 'hd720',
              start: '11'
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
