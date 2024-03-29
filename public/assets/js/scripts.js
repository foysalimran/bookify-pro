jQuery(document).ready(function ($) {
  "use strict";
  var bop_myScript = function () {
    if ($(".ta-container").length > 0) {
      $(".ta-container").each(function () {
        var bop_container = $(this),
          bop_container_id = bop_container.attr("id"),
          bop_Wrapper_ID = "#" + bop_container_id,
          pc_sid = $(bop_Wrapper_ID).data("sid"), // The Shortcode ID.
          bopCarousel = $("#" + bop_container_id + " .ta-bop-carousel"),
          bopAccordion = $("#" + bop_container_id + " .ta-collapse"),
          bopfilter = $("#" + bop_container_id + ".bop-filter-wrapper"),
          ajaxurl = spbop.ajaxurl,
          nonce = spbop.nonce,
          bopCarouselDir = bopCarousel.attr("dir"),
          bopSwiper,
          bopCarouselData = bopCarousel.data("carousel");
       
        if (bopCarousel.length > 0) {
          var mobile_land = parseInt(
              bopCarouselData.responsive.mobile_landscape
            ),
            tablet_size = parseInt(bopCarouselData.responsive.tablet),
            desktop_size = parseInt(bopCarouselData.responsive.desktop),
            lg_desktop_size = parseInt(bopCarouselData.responsive.lg_desktop);
        }

        // Carousel Init function.
        function bop_carousel_init() {
          // Carousel ticker mode.
          if (bopCarouselData.mode == "ticker") {
            var item = bopCarousel.find(".swiper-wrapper .swiper-slide").length;
            bopSwiper = bopCarousel.find(".swiper-wrapper").bxSlider({
              mode: "horizontal",
              moveSlides: 1,
              slideMargin: bopCarouselData.spaceBetween,
              infiniteLoop: bopCarouselData.loop,
              slideWidth: bopCarouselData.ticker_width,
              minSlides: bopCarouselData.slidesPerView.mobile,
              maxSlides: bopCarouselData.slidesPerView.lg_desktop,
              speed: bopCarouselData.ticker_speed * item,
              ticker: true,
              tickerHover: bopCarouselData.stop_onHover,
              autoDirection: bopCarouselDir,
            });
          }

          // Carousel Swiper for Standard & Center mode.
          if (
            bopCarouselData.mode == "standard" ||
            bopCarouselData.mode == "center"
          ) {
            if (
              bopCarouselData.effect == "fade" ||
              bopCarouselData.effect == "cube" ||
              bopCarouselData.effect == "flip"
            ) {
              if ($(window).width() > lg_desktop_size) {
                slidePerView = bopCarouselData.slidesPerView.lg_desktop;
              } else if ($(window).width() > desktop_size) {
                slidePerView = bopCarouselData.slidesPerView.desktop;
              } else if ($(window).width() > tablet_size) {
                slidePerView = bopCarouselData.slidesPerView.tablet;
              } else if ($(window).width() > 0) {
                slidePerView = bopCarouselData.slidesPerView.mobile_landscape;
              }
              $(
                bop_Wrapper_ID +
                  " .ta-bop-carousel .swiper-wrapper > .ta-bookify-pro-item"
              )
                .css("width", 100 / slidePerView + "%")
                .removeClass("swiper-slide");
              var fade_items = $(
                bop_Wrapper_ID +
                  " .ta-bop-carousel .swiper-wrapper > .ta-bookify-pro-item"
              );
              var style =
                bopCarouselDir == "rtl" ? "marginLeft" : "marginRight";
              for (var i = 0; i < fade_items.length; i += slidePerView) {
                fade_items
                  .slice(i, i + slidePerView)
                  .wrapAll('<div class="swiper-slide"></div>');
                fade_items.eq(i - 1).css(style, 0);
              }
              bopSwiper = new Swiper(
                "#" + bop_container_id + " .ta-bop-carousel",
                {
                  speed: bopCarouselData.speed,
                  slidesPerView: 1,
                  spaceBetween: bopCarouselData.spaceBetween,
                  loop:
                    bopCarouselData.slidesRow.lg_desktop > "1" ||
                    bopCarouselData.slidesRow.desktop > "1" ||
                    bopCarouselData.slidesRow.tablet > "1" ||
                    bopCarouselData.slidesRow.mobile_landscape > "1" ||
                    bopCarouselData.slidesRow.mobile > "1"
                      ? false
                      : bopCarouselData.loop,
                  effect: bopCarouselData.effect,
                  slidesPerGroup: bopCarouselData.slideToScroll.mobile,
                  preloadImages: false,
                  observer: true,
                  runCallbacksOnInit: false,
                  initialSlide: 0,
                  slidesPerColumn: bopCarouselData.slidesRow.mobile,
                  slidesPerColumnFill: "row",
                  autoHeight:
                    bopCarouselData.slidesRow.lg_desktop > "1" ||
                    bopCarouselData.slidesRow.desktop > "1" ||
                    bopCarouselData.slidesRow.tablet > "1" ||
                    bopCarouselData.slidesRow.mobile_landscape > "1" ||
                    bopCarouselData.slidesRow.mobile > "1"
                      ? false
                      : bopCarouselData.autoHeight,
                  simulateTouch: bopCarouselData.simulateTouch,
                  allowTouchMove: bopCarouselData.allowTouchMove,
                  mousewheel: bopCarouselData.slider_mouse_wheel,
                  centeredSlides: bopCarouselData.center_mode,
                  lazy: bopCarouselData.lazy,
                  pagination:
                    bopCarouselData.pagination == true
                      ? {
                          el: ".swiper-pagination",
                          clickable: true,
                          dynamicBullets: bopCarouselData.dynamicBullets,
                          renderBullet: function (index, className) {
                            if (bopCarouselData.bullet_types == "number") {
                              return (
                                '<span class="' +
                                className +
                                '">' +
                                (index + 1) +
                                "</span>"
                              );
                            } else {
                              return '<span class="' + className + '"></span>';
                            }
                          },
                        }
                      : false,
                  autoplay: {
                    delay: bopCarouselData.autoplay_speed,
                  },
                  navigation:
                    bopCarouselData.navigation == true
                      ? {
                          nextEl: ".bop-button-next",
                          prevEl: ".bop-button-prev",
                        }
                      : false,
                  fadeEffect: {
                    crossFade: true,
                  },
                  ally: {
                    enabled: bopCarouselData.enabled,
                    prevSlideMessage: bopCarouselData.prevSlideMessage,
                    nextSlideMessage: bopCarouselData.nextSlideMessage,
                    firstSlideMessage: bopCarouselData.firstSlideMessage,
                    lastSlideMessage: bopCarouselData.lastSlideMessage,
                    paginationBulletMessage:
                      bopCarouselData.paginationBulletMessage,
                  },
                  keyboard: {
                    enabled: bopCarouselData.keyboard === "true" ? true : false,
                  },
                }
              );
            } else {
              bopSwiper = new Swiper(
                "#" + bop_container_id + " .ta-bop-carousel",
                {
                  speed: bopCarouselData.speed,
                  slidesPerView: bopCarouselData.slidesPerView.mobile,
                  spaceBetween: bopCarouselData.spaceBetween,
                  loop:
                    bopCarouselData.slidesRow.lg_desktop > "1" ||
                    bopCarouselData.slidesRow.desktop > "1" ||
                    bopCarouselData.slidesRow.tablet > "1" ||
                    bopCarouselData.slidesRow.mobile_landscape > "1" ||
                    bopCarouselData.slidesRow.mobile > "1"
                      ? false
                      : bopCarouselData.loop,
                  effect: bopCarouselData.effect,
                  slidesPerGroup: bopCarouselData.slideToScroll.mobile,
                  preloadImages: false,
                  observer: true,
                  runCallbacksOnInit: false,
                  initialSlide: 0,
                  slidesPerColumn: bopCarouselData.slidesRow.mobile,
                  slidesPerColumnFill: "row",
                  autoHeight:
                    bopCarouselData.slidesRow.lg_desktop > "1" ||
                    bopCarouselData.slidesRow.desktop > "1" ||
                    bopCarouselData.slidesRow.tablet > "1" ||
                    bopCarouselData.slidesRow.mobile_landscape > "1" ||
                    bopCarouselData.slidesRow.mobile > "1"
                      ? false
                      : bopCarouselData.autoHeight,
                  simulateTouch: bopCarouselData.simulateTouch,
                  allowTouchMove: bopCarouselData.allowTouchMove,
                  mousewheel: bopCarouselData.slider_mouse_wheel,
                  centeredSlides: bopCarouselData.center_mode,
                  lazy: bopCarouselData.lazy,
                  pagination:
                    bopCarouselData.pagination == true
                      ? {
                          el: ".swiper-pagination",
                          clickable: true,
                          dynamicBullets: bopCarouselData.dynamicBullets,
                          renderBullet: function (index, className) {
                            if (bopCarouselData.bullet_types == "number") {
                              return (
                                '<span class="' +
                                className +
                                '">' +
                                (index + 1) +
                                "</span>"
                              );
                            } else {
                              return '<span class="' + className + '"></span>';
                            }
                          },
                        }
                      : false,
                  autoplay: {
                    delay: bopCarouselData.autoplay_speed,
                  },
                  navigation:
                    bopCarouselData.navigation == true
                      ? {
                          nextEl: ".bop-button-next",
                          prevEl: ".bop-button-prev",
                        }
                      : false,
                  breakpoints: {
                    [mobile_land]: {
                      slidesPerView:
                        bopCarouselData.slidesPerView.mobile_landscape,
                      slidesPerGroup:
                        bopCarouselData.slideToScroll.mobile_landscape,
                      slidesPerColumn:
                        bopCarouselData.slidesRow.mobile_landscape,
                      navigation:
                        bopCarouselData.navigation_mobile == true
                          ? {
                              nextEl: ".bop-button-next",
                              prevEl: ".bop-button-prev",
                            }
                          : false,
                      pagination:
                        bopCarouselData.pagination_mobile == true
                          ? {
                              el: ".swiper-pagination",
                              clickable: true,
                              dynamicBullets: bopCarouselData.dynamicBullets,
                              renderBullet: function (index, className) {
                                if (bopCarouselData.bullet_types == "number") {
                                  return (
                                    '<span class="' +
                                    className +
                                    '">' +
                                    (index + 1) +
                                    "</span>"
                                  );
                                } else {
                                  return (
                                    '<span class="' + className + '"></span>'
                                  );
                                }
                              },
                            }
                          : false,
                    },
                    [tablet_size]: {
                      slidesPerView: bopCarouselData.slidesPerView.tablet,
                      slidesPerGroup: bopCarouselData.slideToScroll.tablet,
                      slidesPerColumn: bopCarouselData.slidesRow.tablet,
                    },
                    [desktop_size]: {
                      slidesPerView: bopCarouselData.slidesPerView.desktop,
                      slidesPerGroup: bopCarouselData.slideToScroll.desktop,
                      slidesPerColumn: bopCarouselData.slidesRow.desktop,
                    },
                    [lg_desktop_size]: {
                      slidesPerView: bopCarouselData.slidesPerView.lg_desktop,
                      slidesPerGroup: bopCarouselData.slideToScroll.lg_desktop,
                      slidesPerColumn: bopCarouselData.slidesRow.lg_desktop,
                    },
                  },
                  fadeEffect: {
                    crossFade: true,
                  },
                  ally: {
                    enabled: bopCarouselData.enabled,
                    prevSlideMessage: bopCarouselData.prevSlideMessage,
                    nextSlideMessage: bopCarouselData.nextSlideMessage,
                    firstSlideMessage: bopCarouselData.firstSlideMessage,
                    lastSlideMessage: bopCarouselData.lastSlideMessage,
                    paginationBulletMessage:
                      bopCarouselData.paginationBulletMessage,
                  },
                  keyboard: {
                    enabled: bopCarouselData.keyboard === "true" ? true : false,
                  },
                }
              );
            }
            if (bopCarouselData.autoplay === false) {
              bopSwiper.autoplay.stop();
            }
            if (bopCarouselData.stop_onHover && bopCarouselData.autoplay) {
              $(bopCarousel).on({
                mouseenter: function () {
                  bopSwiper.autoplay.stop();
                },
                mouseleave: function () {
                  bopSwiper.autoplay.start();
                },
              });
            }
            $(window).on("resize", function () {
              bopSwiper.update();
            });
            $(window).trigger("resize");
          }
        }
        if (bopCarousel.length > 0) {
          bop_carousel_init();
        }
        $(
          ".ta-overlay.ta-bop-post,.ta-content-box.ta-bop-post",
          bop_Wrapper_ID
        ).on("mouseover", function () {
          $(this)
            .find(".bookify__item__content.animated:not(.bop_hover)")
            .addClass("bop_hover");
        });

        
        /**
         *  Isotope Filter layout.
         */
        if (bopfilter.length > 0) {
          if (bopfilter.data("grid") == "masonry") {
            var layoutMode = "masonry";
          } else {
            var layoutMode = "fitRows";
          }
          var $grid = $(".grid", bop_Wrapper_ID).isotope({
            itemSelector: ".item",
            //layoutMode: 'fitRows'
            layoutMode: layoutMode,
          });
          $grid.imagesLoaded().progress(function () {
            $grid.isotope("layout");
          });

          // This function added for bop-Lazyload.
          function bop_lazyload() {
            $is_find = $(".ta-bop-post-thumb-area img").hasClass(
              "bop-lazyload"
            );
            if ($is_find) {
              $("img.bop-lazyload")
                .bop_lazyload({ effect: "fadeIn", effectTime: 2000 })
                .removeClass("bop-lazyload")
                .addClass("bop-lazyloaded");
            }
            $grid.isotope("layout");
          }

          // Store filter for each group.
          var filters = {};
          $(".bop-shuffle-filter .taxonomy-group", bop_Wrapper_ID).on(
            "change",
            function (event) {
              var $select = $(event.target);
              // get group key
              var filterGroup = $select.attr("data-filter-group");
              // set filter for group
              filters[filterGroup] = event.target.value;
              // combine filters
              var filterValue = concatValues(filters);
              // set filter for Isotope
              $grid.isotope({ filter: filterValue });
              $grid.on("layoutComplete", function () {
                $(window).trigger("scroll");
              });
            }
          );

          $(".bop-shuffle-filter", bop_Wrapper_ID).on(
            "click",
            ".bop-button",
            function (event) {
              var $button = $(event.currentTarget);
              // get group key
              var $taxonomyGroup = $button.parents(".taxonomy-group");
              var filterGroup = $taxonomyGroup.attr("data-filter-group");
              // taxonomy = $taxonomyGroup.attr('data-filter-group');
              // set filter for group
              filters[filterGroup] = $button.attr("data-filter");
              //  term_id = $button.attr('data-termid');
              // combine filters
              var filterValue = concatValues(filters);
              // set filter for Isotope
              $grid.isotope({ filter: filterValue });
              $grid.on("layoutComplete", function () {
                $(window).trigger("scroll");
              });
            }
          );
          // Change is-active class on buttons.
          $(".taxonomy-group", bop_Wrapper_ID).each(function (
            i,
            taxonomyGroup
          ) {
            var $taxonomyGroup = $(taxonomyGroup);
            var $find_active_button = $taxonomyGroup.find(".is-active");
            if ($find_active_button.length == 0) {
              $taxonomyGroup
                .find("button:nth-child(1)")
                .addClass("is-active")
                .click();
            }
            $taxonomyGroup.on("click", "button", function (event) {
              $taxonomyGroup.find(".is-active").removeClass("is-active");
              var $button = $(event.currentTarget);
              $button.addClass("is-active");
            });
          });
          // Flatten object by concatenation values.
          function concatValues(obj) {
            var value = "";
            for (var prop in obj) {
              value += obj[prop];
            }
            return value;
          }
        }

        function bop_item_same_height() {
          var maxHeight = 0;
          $(bop_Wrapper_ID + ".bop_same_height .item").each(function () {
            if ($(this).find(".ta-bop-post").height() > maxHeight) {
              maxHeight = $(this).find(".ta-bop-post").height();
            }
          });
          $(bop_Wrapper_ID + ".bop_same_height .ta-bop-post").height(maxHeight);
        }
        if (
          $(bop_Wrapper_ID + ".bop_same_height").hasClass("bop-filter-wrapper")
        ) {
          bop_item_same_height();
        }

        // Ajax Action for Live filter.
        var keyword = "",
          orderby = "",
          taxonomy = "",
          order = "",
          term_id = "",
          page = "",
          spsp_lang = $(bop_Wrapper_ID).data("lang");
          var author_id = "",
          custom_field_key = "",
          custom_field_value = "",
          bop_hash_url = Array(),
          bop_last_filter = "",
          custom_fields_array = Array(),
          is_pagination_url_change = true;
        function bop_ajax_action(selected_term_list = null) {
          jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
              action: "bop_post_order",
              id: pc_sid,
              lang: spsp_lang,
              order: order,
              keyword: keyword,
              orderby: orderby,
              taxonomy: taxonomy,
              term_id: term_id,
              author_id: author_id,
              nonce: nonce,
              term_list: selected_term_list,
              custom_fields_array: custom_fields_array,
            },
            success: function (data) {
              var $data = $(data);
              var $newElements = $data;

              if ($(bop_Wrapper_ID).hasClass("bop-masonry")) {
                var $post_wrapper = $(".ta-row", bop_Wrapper_ID);
                $post_wrapper.masonry("destroy");
                $post_wrapper.html($newElements).imagesLoaded(function () {
                  $post_wrapper.masonry();
                });
              } else if ($(bop_Wrapper_ID).hasClass("bop-filter-wrapper")) {
                $(
                  ".ta-row, .bop-timeline-grid, .ta-collapse, .table-responsive tbody",
                  bop_Wrapper_ID
                ).html($newElements);
                $grid
                  .append($newElements)
                  .isotope("appended", $newElements)
                  .imagesLoaded(function () {
                    $grid.isotope("layout");
                  });
                bop_item_same_height();
              } else if (bopCarousel.length > 0) {
                if (bopCarouselData.mode == "ticker") {
                  bopSwiper.destroySlider();
                  $(".swiper-wrapper", bop_Wrapper_ID).html($newElements);
                  bop_carousel_init();
                  bopSwiper.reloadSlider();
                } else {
                  bopSwiper.destroy(true, true);
                  $(".swiper-wrapper", bop_Wrapper_ID).html($newElements);
                  bop_carousel_init();
                }
              } else {
                var $newElements = $data.css({
                  opacity: 0,
                });
                $(
                  ".ta-row, .bop-timeline-grid, .ta-collapse, .table-responsive tbody",
                  bop_Wrapper_ID
                ).html($newElements);
                if (bopAccordion.length > 0) {
                  bopAccordion.accordion("refresh");
                  if (accordion_mode === "multi-open") {
                    bopAccordion
                      .find(".bop-collapse-header")
                      .next()
                      .slideDown();
                    bopAccordion
                      .find(".bop-collapse-header .fa")
                      .removeClass("fa-plus")
                      .addClass("fa-minus");
                  }
                }
                var $newElements = $data.css({
                  opacity: 1,
                });
              }
              bop_lazyload();
            },
          });
        }

        // Pagination.
        function bop_pagination_action(selected_term_list = null) {
          var LoadMoreText = $(".ta-bop-pagination-data", bop_Wrapper_ID).data(
            "loadmoretext"
          );
          var EndingMessage = $(".ta-bop-pagination-data", bop_Wrapper_ID).data(
            "endingtext"
          );
          jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
              action: "post_pagination_bar_mobile",
              id: pc_sid,
              order: order,
              lang: spsp_lang,
              keyword: keyword,
              orderby: orderby,
              taxonomy: taxonomy,
              author_id: author_id,
              term_id: term_id,
              page: page,
              nonce: nonce,
              term_list: selected_term_list,
              custom_fields_array: custom_fields_array,
            },
            success: function (data) {
              var $data = $(data);
              var $newElements = $data;
              $(
                ".bop-post-pagination.bop-on-mobile:not(.no_ajax)",
                bop_Wrapper_ID
              ).html($newElements);
              if (
                Pagination_Type == "infinite_scroll" ||
                Pagination_Type == "ajax_load_more"
              ) {
                $(".bop-load-more", bop_Wrapper_ID)
                  .removeClass("finished")
                  .removeClass("bop-hide")
                  .html(
                    '<button bop-processing="0">' + LoadMoreText + "</button>"
                  );
                if (!$(".bop-post-pagination a", bop_Wrapper_ID).length) {
                  $(".bop-load-more", bop_Wrapper_ID)
                    .show()
                    .html(EndingMessage);
                }
              }
              if (Pagination_Type == "infinite_scroll") {
                $(".bop-load-more", bop_Wrapper_ID).addClass("bop-hide");
              }
            },
          });
          jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
              action: "post_pagination_bar",
              id: pc_sid,
              order: order,
              lang: spsp_lang,
              keyword: keyword,
              orderby: orderby,
              taxonomy: taxonomy,
              author_id: author_id,
              term_id: term_id,
              page: page,
              nonce: nonce,
              term_list: selected_term_list,
              custom_fields_array: custom_fields_array,
            },
            success: function (data) {
              var $data = $(data);
              var $newElements = $data;
              $(
                ".bop-post-pagination.bop-on-desktop:not(.no_ajax)",
                bop_Wrapper_ID
              ).html($newElements);
              if (
                Pagination_Type == "infinite_scroll" ||
                Pagination_Type == "ajax_load_more"
              ) {
                $(".bop-load-more", bop_Wrapper_ID)
                  .removeClass("finished")
                  .removeClass("bop-hide")
                  .html(
                    '<button bop-processing="0">' + LoadMoreText + "</button>"
                  );
              }
              if (Pagination_Type == "infinite_scroll") {
                $(".bop-load-more", bop_Wrapper_ID).addClass("bop-hide");
              }
              if (!$(".bop-post-pagination a", bop_Wrapper_ID).length) {
                $(".bop-load-more", bop_Wrapper_ID).show().html(EndingMessage);
              }
              bop_lazyload();
            },
          });
        }
        // Live filter button reset on ajax call.
        function bop_live_filter_reset(selected_term_list = null) {
          jQuery.ajax({
            url: ajaxurl,
            type: "POST",
            data: {
              action: "bop_live_filter_reset",
              id: pc_sid,
              order: order,
              lang: spsp_lang,
              keyword: keyword,
              orderby: orderby,
              taxonomy: taxonomy,
              term_id: term_id,
              author_id: author_id,
              nonce: nonce,
              term_list: selected_term_list,
              last_filter: bop_last_filter,
              custom_fields_array: custom_fields_array,
            },
            success: function (data) {
              var $data = $(data);
              var $newElements = $data.animate({
                opacity: 0.5,
              });
              $(".bop-filter-bar", bop_Wrapper_ID).html($newElements);
              custom_field_filter_slider();
              $newElements.animate({
                opacity: 1,
              });
            },
          });
        }
        // Update Hash url array.
        function bop_hash_update_arr(bop_filter_keyword, filter_arr, key) {
          if (bop_hash_url.length > 0) {
            bop_hash_url.forEach(function (row) {
              if ($.inArray(bop_filter_keyword, row.bop_filter_keyword)) {
                row[key] = bop_filter_keyword;
              } else {
                bop_hash_url.push(filter_arr);
              }
            });
          } else {
            bop_hash_url.push(filter_arr);
          }
          return bop_hash_url;
        }
        // On normal pagination go to current shortcode.
        var url_hash = window.location.search;
        if (url_hash.indexOf("paged") >= 0) {
          var s_id = /paged(\d+)/.exec(url_hash)[1];
          var spscurrent_id = document.getElementById("bop_wrapper-" + s_id);
          spscurrent_id.scrollIntoView();
        }
        // Update url.
        var selected_term_list = Array();
        function bop_update_url() {
          var p_search = window.location.search;
          if (p_search.indexOf("page_id") >= 0) {
            var bop_page = /page_id\=(\d+)/.exec(p_search)[1];
            var bop_url = "?page_id=" + bop_page + "&";
          } else {
            var bop_url = "&";
          }
          if (bop_hash_url.length > 0) {
            $.map(bop_hash_url, function (value, index) {
              $.map(value, function (value2, index2) {
                if (
                  value2 == "all" ||
                  value2 == "none" ||
                  value2 == "" ||
                  value2 == "page"
                ) {
                  bop_url += "";
                } else {
                  bop_url += "bop_" + index2 + "=" + value2 + "&";
                }
              });
            });
          }
          if (selected_term_list.length > 0) {
            var term_total_length = selected_term_list.length;
            $.map(selected_term_list, function (value, index) {
              if (value.term_id == "all" || value.term_id == "") {
                bop_url += "";
              } else {
                if (index == term_total_length - 1) {
                  bop_url += "tx_" + value.taxonomy + "=" + value.term_id + "";
                } else {
                  bop_url += "tx_" + value.taxonomy + "=" + value.term_id + "&";
                }
              }
            });
          }
          if (custom_fields_array.length > 0) {
            var meta_field_total_length = custom_fields_array.length;
            $.map(custom_fields_array, function (value, index) {
              //  if (index == meta_field_total_length - 1) {
              bop_url +=
                "cf" +
                value.custom_field_key +
                "=" +
                value.custom_field_value +
                "&";
              // }
            });
          }
          if (bop_hash_url.length < 0 || selected_term_list.length < 0) {
            bop_url = "";
          }
          if (bop_url.length > 1) {
            var slf = "";
            if (bop_last_filter.length > 0) {
              var slf = "&slf=" + bop_last_filter;
            }

            bop_url = "?sps=" + pc_sid + slf + bop_url;
            history.pushState(null, null, encodeURI(bop_url));
          } else {
            var uri = window.location.toString();
            if (uri.indexOf("?") > 0) {
              var clean_uri = uri.substring(0, uri.indexOf("?"));
              window.history.replaceState({}, document.title, clean_uri);
            }
          }
        }

        function custom_field_filter_slider() {
          $(bop_Wrapper_ID + " .bop-custom-field-filter-slider").each(
            function () {
              var _that = $(this);
              var _input = _that.find(".bop-input");
              var custom_field_key = _input.attr("name");
              var _min = _input.data("min");
              var _crmin = _input.data("crmin");
              var _crmax = _input.data("crmax");
              var _max = _input.data("max");
              _that.find(".bop-slider").slider({
                range: true,
                min: _crmin,
                max: _crmax,
                values: [_min, _max],
                slide: function (event, ui) {
                  _input.val(ui.values[0] + " - " + ui.values[1]);
                },
                stop: function (event, ui) {
                  _input.data("max", ui.values[1]);

                  custom_field_value = ui.values[0] + " " + ui.values[1];
                  custom_fields_array.push({
                    custom_field_key,
                    custom_field_value,
                  });
                  custom_fields_array.map(function (person) {
                    if (person.custom_field_key === custom_field_key) {
                      person.custom_field_value = custom_field_value;
                    }
                  });
                  custom_fields_array = $.grep(
                    custom_fields_array,
                    function (e, i) {
                      return e.custom_field_value.length;
                    }
                  );
                  custom_fields_array = custom_fields_array
                    .map(JSON.stringify)
                    .reverse() // convert to JSON string the array content, then reverse it (to check from end to beginning)
                    .filter(function (item, index, arr) {
                      return arr.indexOf(item, index + 1) === -1;
                    }) // check if there is any occurrence of the item in whole array
                    .reverse()
                    .map(JSON.parse);
                  bop_update_url();
                  bop_last_filter = custom_field_key;
                  bop_ajax_action(selected_term_list);
                  bop_live_filter_reset(selected_term_list);
                },
              });
            }
          );
        }
        custom_field_filter_slider();
        // Ajax post search.
        $("input.bop-search-field", bop_Wrapper_ID).on("keyup", function () {
          var that = $(this);
          keyword = that.val();
          bop_last_filter = "keyword";
          var bop_search_arr = { keyword, keyword };
          bop_live_filter_reset(selected_term_list);
          bop_hash_update_arr(keyword, bop_search_arr, "keyword");
          bop_update_url();
          bop_ajax_action(selected_term_list);
          bop_pagination_action();
          is_pagination_url_change = false;
          bop_hash_update_arr("page", { page: "" }, "page");
          bop_update_url();
        });

        // Post order by.
        $(".bop-order-by", bop_Wrapper_ID).on("change", function () {
          var that;
          $(this)
            .find("option:selected, input:radio:checked")
            .each(function () {
              that = $(this);
              orderby = that.val();
            });
          var orerbyarr = { orderby, orderby };
          bop_hash_update_arr(orderby, orerbyarr, "orderby");
          bop_update_url();
          bop_ajax_action();
          bop_pagination_action();
          bop_hash_update_arr("page", { page: "" }, "page");
          bop_update_url();
        });

        function bop_filter_push(myarr, item) {
          var found = false;
          var i = 0;
          while (i < myarr.length) {
            if (myarr[i] === item) {
              // Do the logic (delete or replace)
              found = true;
              break;
            }
            i++;
          }
          // Add the item
          if (!found) myarr.push(item);
          return myarr;
        }

        // Pre Filter Init.
        var tax_list = Array();
        $(".bop-filter-by", bop_Wrapper_ID)
          .find("option:selected, input:radio:checked")
          .each(function () {
            term_id = $(this).val();
            taxonomy = $(this).data("taxonomy");
            var selected_tax_length = selected_term_list.length;
            if (selected_tax_length > 0) {
              var selected_tax =
                selected_term_list[selected_tax_length - 1]["taxonomy"];
              selected_term_list.map(function (person) {
                if (person.taxonomy === taxonomy) {
                  person.term_id = term_id;
                }
              });
              // if ($.inArray(taxonomy, tax_list) == -1) {
              selected_term_list.push({
                taxonomy,
                term_id,
              });
              //  }
              if (
                selected_term_list[selected_tax_length - 1]["term_id"] ==
                  "all" &&
                selected_tax === taxonomy
              ) {
                tax_list = tax_list.filter(function (val) {
                  return val !== taxonomy;
                });
              } else {
                tax_list = bop_filter_push(tax_list, taxonomy);
              }
              selected_term_list = $.grep(selected_term_list, function (e, i) {
                return e.term_id != "all";
              });
            } else {
              selected_term_list.push({
                taxonomy,
                term_id,
              });
              selected_term_list = $.grep(selected_term_list, function (e, i) {
                return e.term_id != "all";
              });
              tax_list = Array(taxonomy);
            }
          });
        $(".bop-author-filter", bop_Wrapper_ID)
          .find("option:selected, input:radio:checked")
          .each(function () {
            that = $(this);
            author_id = that.val();
          });
        $(".bop-order", bop_Wrapper_ID)
          .find("option:selected, input:radio:checked")
          .each(function () {
            that = $(this);
            order = $(this).val();
          });
        $(".bop-order-by", bop_Wrapper_ID)
          .find("option:selected, input:radio:checked")
          .each(function () {
            that = $(this);
            orderby = that.val();
          });
        $("input.bop-search-field", bop_Wrapper_ID).each(function () {
          var that = $(this);
          keyword = that.val();
        });
        $(".bop-filter-by-checkbox", bop_Wrapper_ID).each(function () {
          var current_tax = $(this).data("taxonomy");
          var term_ids = "";
          $(this)
            .find("input[name='" + current_tax + "']:checkbox:checked")
            .each(function () {
              term_ids += $(this).val() + ",";
              taxonomy = $(this).data("taxonomy");
            });
          term_id = term_ids.replace(/,(?=\s*$)/, "");
          selected_term_list.map(function (person) {
            if (person.taxonomy === current_tax) {
              person.term_id = term_id;
            }
          });
          selected_term_list.push({
            taxonomy,
            term_id,
          });
        });
        selected_term_list = $.grep(selected_term_list, function (e, i) {
          return e.term_id.length;
        });
        // Custom field filter.
        $(".bop-custom-field-filter", bop_Wrapper_ID).each(function () {
          $(this)
            .find("option:selected, input:radio:checked")
            .each(function () {
              custom_field_key = $(this).attr("name");
              custom_field_value = $(this).val();
              custom_fields_array.map(function (person) {
                if (person.custom_field_key === custom_field_key) {
                  person.custom_field_value = custom_field_value;
                }
              });
              custom_fields_array.push({
                custom_field_key,
                custom_field_value,
              });
            });
        });
        selected_term_list = selected_term_list
          .map(JSON.stringify)
          .reverse() // convert to JSON string the array content, then reverse it (to check from end to beginning)
          .filter(function (item, index, arr) {
            return arr.indexOf(item, index + 1) === -1;
          }) // check if there is any occurence of the item in whole array
          .reverse()
          .map(JSON.parse);
        // Filter by checkbox.
        $(bop_Wrapper_ID).on("change", ".bop-filter-by-checkbox", function (e) {
          e.stopPropagation();
          e.preventDefault();
          $(".bop-filter-by-checkbox", bop_Wrapper_ID).each(function () {
            var current_tax = $(this).data("taxonomy");
            var term_ids = "";
            $(this)
              .find("input[name='" + current_tax + "']:checkbox:checked")
              .each(function () {
                term_ids += $(this).val() + ",";
                taxonomy = $(this).data("taxonomy");
              });
            term_id = term_ids.replace(/,(?=\s*$)/, "");
            selected_term_list.map(function (person) {
              if (person.taxonomy === current_tax) {
                person.term_id = term_id;
              }
            });
            selected_term_list.push({
              taxonomy,
              term_id,
            });
          });
          selected_term_list = $.grep(selected_term_list, function (e, i) {
            return e.term_id.length;
          });
          selected_term_list = selected_term_list
            .map(JSON.stringify)
            .reverse() // convert to JSON string the array content, then reverse it (to check from end to beginning)
            .filter(function (item, index, arr) {
              return arr.indexOf(item, index + 1) === -1;
            }) // check if there is any occurence of the item in whole array
            .reverse()
            .map(JSON.parse);
          var term_ids = "";
          $(this)
            .find("input:checkbox:checked")
            .each(function () {
              term_ids += $(this).val() + ",";
              taxonomy = $(this).data("taxonomy");
            });
          taxonomy = $(this).data("taxonomy");
          term_id = term_ids.replace(/,(?=\s*$)/, "");
          if (term_id.length > 0) {
            bop_last_filter = taxonomy;
          } else {
            bop_last_filter = bop_last_filter;
          }
          bop_hash_update_arr("page", { page: "" }, "page");
          bop_update_url();
          bop_live_filter_reset(selected_term_list);
          bop_ajax_action(selected_term_list);
          bop_pagination_action(selected_term_list);
        });

        // Filter by custom field.
        $(bop_Wrapper_ID).on(
          "change",
          ".bop-custom-field-filter",
          function (e) {
            e.stopPropagation();
            e.preventDefault();
            $(".bop-custom-field-filter", bop_Wrapper_ID).each(function () {
              $(this)
                .find("option:selected, input:radio:checked")
                .each(function () {
                  custom_field_key = $(this).attr("name");
                  custom_field_value = $(this).val();
                  custom_fields_array.map(function (person) {
                    if (person.custom_field_key === custom_field_key) {
                      person.custom_field_value = custom_field_value;
                    }
                  });
                  custom_fields_array.push({
                    custom_field_key,
                    custom_field_value,
                  });
                });
            });
            bop_last_filter = $(this)
              .find("option:selected, input:radio:checked")
              .attr("name");
            custom_fields_array = $.grep(custom_fields_array, function (e, i) {
              return e.custom_field_value != "all";
            });
            custom_fields_array = custom_fields_array
              .map(JSON.stringify)
              .reverse() // convert to JSON string the array content, then reverse it (to check from end to beginning)
              .filter(function (item, index, arr) {
                return arr.indexOf(item, index + 1) === -1;
              }) // check if there is any occurence of the item in whole array
              .reverse()
              .map(JSON.parse);
            bop_ajax_action(selected_term_list);
            bop_pagination_action(selected_term_list);
            bop_live_filter_reset(selected_term_list);
            bop_update_url();
          }
        );
        // Filter by checkbox custom field.
        $(bop_Wrapper_ID).on(
          "change",
          ".bop-custom-field-filter-checkbox",
          function (e) {
            e.stopPropagation();
            e.preventDefault();
            $(".bop-custom-field-filter-checkbox", bop_Wrapper_ID).each(
              function () {
                var custom_field_key = $(this)
                  .find("input:checkbox")
                  .attr("name");
                var custom_field_value = "";
                $(this)
                  .find(
                    "input[name='" + custom_field_key + "']:checkbox:checked"
                  )
                  .each(function () {
                    custom_field_key = $(this).attr("name");
                    custom_field_value += $(this).val() + ",";
                  });
                custom_field_value = custom_field_value.replace(
                  /,(?=\s*$)/,
                  ""
                );
                custom_fields_array.push({
                  custom_field_key,
                  custom_field_value,
                });
                custom_fields_array.map(function (person) {
                  if (person.custom_field_key === custom_field_key) {
                    person.custom_field_value = custom_field_value;
                  }
                });
                custom_fields_array = $.grep(
                  custom_fields_array,
                  function (e, i) {
                    return e.custom_field_value.length;
                  }
                );
              }
            );
            bop_last_filter = $(this)
              .find("input:checkbox:checked")
              .attr("name");
            custom_fields_array = custom_fields_array
              .map(JSON.stringify)
              .reverse() // convert to JSON string the array content, then reverse it (to check from end to beginning)
              .filter(function (item, index, arr) {
                return arr.indexOf(item, index + 1) === -1;
              }) // check if there is any occurrence of the item in whole array
              .reverse()
              .map(JSON.parse);
            bop_ajax_action(selected_term_list);
            bop_pagination_action(selected_term_list);
            bop_live_filter_reset(selected_term_list);
            bop_update_url();
          }
        );
        // Filter by taxonomy.
        $(bop_Wrapper_ID).on("change", ".bop-filter-by", function (e) {
          e.stopPropagation();
          e.preventDefault();
          $(this)
            .find("option:selected, input:radio:checked")
            .each(function () {
              term_id = $(this).val();
              taxonomy = $(this).data("taxonomy");
              var selected_tax_length = selected_term_list.length;
              if (selected_tax_length > 0) {
                var selected_tax =
                  selected_term_list[selected_tax_length - 1]["taxonomy"];
                selected_term_list.map(function (person) {
                  if (person.taxonomy === taxonomy) {
                    person.term_id = term_id;
                  }
                });
                // if ($.inArray(taxonomy, tax_list) == -1) {
                selected_term_list.push({
                  taxonomy,
                  term_id,
                });
                //  }
                if (
                  selected_term_list[selected_tax_length - 1]["term_id"] ==
                    "all" &&
                  selected_tax === taxonomy
                ) {
                  tax_list = tax_list.filter(function (val) {
                    return val !== taxonomy;
                  });
                } else {
                  tax_list = bop_filter_push(tax_list, taxonomy);
                }
                selected_term_list = $.grep(
                  selected_term_list,
                  function (e, i) {
                    return e.term_id != "all";
                  }
                );
              } else {
                selected_term_list.push({
                  taxonomy,
                  term_id,
                });
                tax_list = Array(taxonomy);
              }
            });
          if (term_id == "all") {
            bop_last_filter = bop_last_filter;
          } else {
            bop_last_filter = taxonomy;
          }
          selected_term_list = selected_term_list
            .map(JSON.stringify)
            .reverse()
            .filter(function (item, index, selected_term_list) {
              return selected_term_list.indexOf(item, index + 1) === -1;
            })
            .reverse()
            .map(JSON.parse);
          bop_hash_update_arr("page", { page: "" }, "page");
          bop_update_url();
          // if ($('.bop-filter-by', bop_Wrapper_ID).length > 1) {
          bop_live_filter_reset(selected_term_list);
          //}
          bop_ajax_action(selected_term_list);
          bop_pagination_action(selected_term_list);
        });
        // Author filter.
        $(bop_Wrapper_ID).on("change", ".bop-author-filter", function (e) {
          var that;
          $(this)
            .find("option:selected, input:radio:checked")
            .each(function () {
              that = $(this);
              author_id = that.val();
            });
          var author_arr = { author_id, author_id };
          if (author_id == "all") {
            bop_last_filter = bop_last_filter;
          } else {
            bop_last_filter = "author_id";
          }
          bop_hash_update_arr(author_id, author_arr, "author_id");
          bop_update_url();
          bop_live_filter_reset(selected_term_list);
          bop_ajax_action();
          bop_pagination_action();
        });

        // Post order asc/dsc.
        $(bop_Wrapper_ID).on("change", ".bop-order", function (e) {
          var that;
          $(this)
            .find("option:selected, input:radio:checked")
            .each(function () {
              that = $(this);
              order = $(this).val();
            });
          var order_arr = { order, order };
          bop_hash_update_arr(order, order_arr, "order");
          bop_update_url();
          bop_ajax_action();
          bop_pagination_action();
          bop_hash_update_arr("page", { page: "" }, "page");
          bop_update_url();
        });
        /**
         * Grid masonry.
         */
        if ($(bop_Wrapper_ID).hasClass("bop-masonry")) {
          var $post_wrapper = $(".ta-row", bop_Wrapper_ID);
          $post_wrapper.imagesLoaded(function () {
            $post_wrapper.masonry(/* {
                itemSelector: 'div[class*=ta-col-]',
                //fitWidth: true,
                percentPosition: true
              } */);
          });
        }

        /**
         * The Pagination effects.
         *
         * The effects for pagination to work for both mobile and other screens.
         */
        var Pagination_Type = $(bop_Wrapper_ID).data("pagination");
        if ($(window).width() <= 480) {
          var Pagination_Type = $(bop_Wrapper_ID).data("pagination_mobile");
        }
        // Ajax number pagination
        if (Pagination_Type == "ajax_pagination") {
          $(bop_Wrapper_ID).on("click", ".bop-post-pagination a", function (e) {
            e.preventDefault();
            var that = $(this);
            var totalPage = $(
                ".bop-post-pagination.bop-on-desktop a:not(.bop_next, .bop_prev)",
                bop_Wrapper_ID
              ).length,
              currentPage = parseInt(
                $(
                  ".bop-post-pagination.bop-on-desktop .active:not(.bop_next, .bop_prev)",
                  bop_Wrapper_ID
                ).data("page")
              );
            if ($(window).width() <= 480) {
              var totalPage = $(
                  ".bop-post-pagination.bop-on-mobile a:not(.bop_next, .bop_prev)",
                  bop_Wrapper_ID
                ).length,
                currentPage = parseInt(
                  $(
                    ".bop-post-pagination.bop-on-mobile .active:not(.bop_next, .bop_prev)",
                    bop_Wrapper_ID
                  ).data("page")
                );
            }
            page = parseInt(that.data("page"));
            if (that.hasClass("bop_next")) {
              if (totalPage > currentPage) {
                var page = currentPage + 1;
              } else {
                return;
              }
            }
            if (that.hasClass("bop_prev")) {
              if (currentPage > 1) {
                var page = currentPage - 1;
              } else {
                return;
              }
            }
            var bop_paged = { page, page };
            $.ajax({
              url: ajaxurl,
              type: "post",
              data: {
                page: page,
                id: pc_sid,
                action: "post_grid_ajax",
                order: order,
                lang: spsp_lang,
                keyword: keyword,
                orderby: orderby,
                taxonomy: taxonomy,
                term_id: term_id,
                author_id: author_id,
                term_list: selected_term_list,
                custom_fields_array: custom_fields_array,
                nonce: nonce,
              },
              error: function (response) {
              },
              success: function (response) {
                var $data = $(response);
                var $newElements = $data;
                if ($(bop_Wrapper_ID).hasClass("bop-masonry")) {
                  var $post_wrapper = $(".ta-row", bop_Wrapper_ID);
                  $post_wrapper.masonry("destroy");
                  $post_wrapper.html($newElements).imagesLoaded(function () {
                    $post_wrapper.masonry();
                  });
                } else if ($(bop_Wrapper_ID).hasClass("bop-filter-wrapper")) {
                  $grid
                    .html($newElements)
                    .isotope("appended", $newElements)
                    .imagesLoaded(function () {
                      $grid.isotope("layout");
                    });
                  bop_item_same_height();
                } else {
                  $(
                    ".ta-row, .bop-timeline-grid, .ta-collapse, .table-responsive tbody",
                    bop_Wrapper_ID
                  ).html($newElements);
                  if (bopAccordion.length > 0) {
                    bopAccordion.accordion("refresh");
                    if (accordion_mode === "multi-open") {
                      bopAccordion
                        .find(".bop-collapse-header")
                        .next()
                        .slideDown();
                      bopAccordion
                        .find(".bop-collapse-header .fa")
                        .removeClass("fa-plus")
                        .addClass("fa-minus");
                    }
                  }
                  var $newElements = $data.css({
                    opacity: 1,
                  });
                }
                $(".page-numbers", bop_Wrapper_ID).removeClass("active");
                $(".page-numbers", bop_Wrapper_ID).each(function () {
                  // if (parseInt($('.bop-post-pagination a').data('page')) === page) {
                  $(
                    ".bop-post-pagination a[data-page=" + page + "]",
                    bop_Wrapper_ID
                  ).addClass("active");
                  // }
                });
                $(".bop_next", bop_Wrapper_ID).removeClass("active");
                $(".bop_prev", bop_Wrapper_ID).removeClass("active");
                $(".bop-post-pagination a.active", bop_Wrapper_ID).each(
                  function () {
                    if (parseInt($(this).data("page")) === totalPage) {
                      $(".bop_next", bop_Wrapper_ID).addClass("active");
                    }
                    if (parseInt($(this).data("page")) === 1) {
                      $(".bop_prev", bop_Wrapper_ID).addClass("active");
                    }
                  }
                );
                if (bopAccordion.length > 0) {
                  bopAccordion.accordion("refresh");
                  if (accordion_mode === "multi-open") {
                    bopAccordion
                      .find(".bop-collapse-header")
                      .next()
                      .slideDown();
                    bopAccordion
                      .find(".bop-collapse-header .fa")
                      .removeClass("fa-plus")
                      .addClass("fa-minus");
                  }
                }
                $newElements.animate({
                  opacity: 1,
                });
                bop_lazyload();
                // Ajax Number pagination go to current shortcode top.
                var url_hash = window.location.search;
                if (url_hash.indexOf("bop_page") >= 0) {
                  var current_screen_id =
                    document.querySelector(bop_Wrapper_ID);
                  current_screen_id.scrollIntoView();
                }
              },
            });
            bop_hash_update_arr(page, bop_paged, "page");
            bop_update_url();
          });
        }

        /**
         * Ajax load on click and Infinite scroll.
         */
        if (
          Pagination_Type == "infinite_scroll" ||
          Pagination_Type == "ajax_load_more"
        ) {
          $(bop_Wrapper_ID).each(function () {
            var EndingMessage = $(this)
              .find(".ta-bop-pagination-data")
              .data("endingtext");
            var LoadMoreText = $(this)
              .find(".ta-bop-pagination-data")
              .data("loadmoretext");
            if (
              !$(this)
                .find(".bop-load-more")
                .hasClass("bop-load-more-initialize")
            ) {
              if ($(".bop-post-pagination a", bop_Wrapper_ID).length) {
                $(".bop-post-pagination", bop_Wrapper_ID)
                  .eq(0)
                  .before(
                    '<div class="bop-load-more"><button bop-processing="0">' +
                      LoadMoreText +
                      "</button></div>"
                  );
              }
              if (Pagination_Type == "infinite_scroll") {
                $(".bop-load-more", bop_Wrapper_ID).addClass("bop-hide");
              }
              $(".bop-post-pagination", bop_Wrapper_ID).addClass("bop-hide");
              $(".ta-row div[class*=ta-col-]", bop_Wrapper_ID).addClass(
                "bop-added"
              );
              $(this)
                .find(".bop-load-more")
                .addClass("bop-load-more-initialize");
              $(this).on("click", ".bop-load-more button", function (e) {
                e.preventDefault();
                if (
                  $(
                    ".bop-post-pagination a.active:not(.bop_next, .bop_prev)",
                    bop_Wrapper_ID
                  ).length
                ) {
                  $(".bop-load-more button").attr("bop-processing", 1);
                  var current_page = parseInt(
                    $(
                      ".bop-post-pagination a.active:not(.bop_next, .bop_prev)",
                      bop_Wrapper_ID
                    ).data("page")
                  );
                  current_page = current_page + 1;
                  $(".bop-load-more", bop_Wrapper_ID).hide();
                  $(".bop-post-pagination", bop_Wrapper_ID)
                    .eq(0)
                    .before(
                      '<div class="bop-infinite-scroll-loader"><svg width="44" height="44" viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg" stroke="#444"><g fill="none" fill-rule="evenodd" stroke-width="2"><circle cx="22" cy="22" r="1"><animate attributeName="r" begin="0s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1" keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite" /> <animate attributeName="stroke-opacity" begin="0s" dur="1.8s" values="1; 0" calcMode="spline" keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite" /> </circle> <circle cx="22" cy="22" r="1"> <animate attributeName="r" begin="-0.9s" dur="1.8s" values="1; 20" calcMode="spline" keyTimes="0; 1" keySplines="0.165, 0.84, 0.44, 1" repeatCount="indefinite" /> <animate attributeName="stroke-opacity" begin="-0.9s" dur="1.8s" values="1; 0" calcMode="spline" keyTimes="0; 1" keySplines="0.3, 0.61, 0.355, 1" repeatCount="indefinite"/></circle></g></svg></div>'
                    );
                  var totalPage = $(
                    ".bop-post-pagination.bop-on-desktop.infinite_scroll a:not(.bop_next, .bop_prev), .bop-post-pagination.bop-on-desktop.ajax_load_more a:not(.bop_next, .bop_prev)",
                    bop_Wrapper_ID
                  ).length;
                  if ($(window).width() <= 480) {
                    var totalPage = $(
                      ".bop-post-pagination.bop-on-mobile.infinite_scroll a:not(.bop_next, .bop_prev), .bop-post-pagination.ajax_load_more.bop-on-mobile  a:not(.bop_next, .bop_prev)",
                      bop_Wrapper_ID
                    ).length;
                  }
                  page = current_page;
                  $.ajax({
                    url: ajaxurl,
                    type: "post",
                    data: {
                      page: page,
                      id: pc_sid,
                      action: "post_grid_ajax",
                      order: order,
                      lang: spsp_lang,
                      keyword: keyword,
                      orderby: orderby,
                      taxonomy: taxonomy,
                      term_id: term_id,
                      author_id: author_id,
                      term_list: selected_term_list,
                      custom_fields_array: custom_fields_array,
                      nonce: nonce,
                    },
                    error: function (response) {
                    },
                    success: function (response) {
                      var $data = $(response);
                      var $newElements = $data;
                      if ($(bop_Wrapper_ID).hasClass("bop-masonry")) {
                        var $post_wrapper = $(".ta-row", bop_Wrapper_ID);
                        $post_wrapper.masonry("destroy");
                        $post_wrapper
                          .append($newElements)
                          .imagesLoaded(function () {
                            $post_wrapper.masonry();
                          });
                      } else if (
                        $(bop_Wrapper_ID).hasClass("bop-filter-wrapper")
                      ) {
                        $grid
                          .append($newElements)
                          .isotope("appended", $newElements)
                          .imagesLoaded(function () {
                            $grid.isotope("layout");
                          });
                        bop_item_same_height();
                      } else {
                        var $newElements = $data.css({
                          opacity: 0,
                        });
                        $(
                          ".ta-row, .bop-timeline-grid, .ta-collapse, .table-responsive tbody",
                          bop_Wrapper_ID
                        ).append($newElements);
                        if (bopAccordion.length > 0) {
                          bopAccordion.accordion("refresh");
                          if (accordion_mode === "multi-open") {
                            bopAccordion
                              .find(".bop-collapse-header")
                              .next()
                              .slideDown();
                            bopAccordion
                              .find(".bop-collapse-header .fa")
                              .removeClass("fa-plus")
                              .addClass("fa-minus");
                          }
                        }
                        var $newElements = $data.css({
                          opacity: 1,
                        });
                      }
                      $(".page-numbers", bop_Wrapper_ID).removeClass("active");
                      $(".page-numbers", bop_Wrapper_ID).each(function () {
                        $(
                          ".bop-post-pagination a[data-page=" + page + "]",
                          bop_Wrapper_ID
                        ).addClass("active");
                      });
                      $(".bop-infinite-scroll-loader", bop_Wrapper_ID).remove();
                      if (Pagination_Type == "ajax_load_more") {
                        $(".bop-load-more").show();
                      }
                      $(".bop-load-more button").attr("bop-processing", 0);
                      $(".ta-row div[class*=ta-col-]", bop_Wrapper_ID)
                        .not(".bop-added")
                        .addClass("animated bopFadeIn")
                        .one("webkitAnimationEnd animationEnd", function () {
                          $(this)
                            .removeClass("animated bopFadeIn")
                            .addClass("bop-added");
                        });
                      if (totalPage == current_page) {
                        $(".bop-load-more", bop_Wrapper_ID)
                          .addClass("finished")
                          .removeClass("bop-hide");
                        $(".bop-load-more", bop_Wrapper_ID)
                          .show()
                          .html(EndingMessage);
                      }
                      bop_lazyload();
                    },
                  });
                } else {
                  $(".bop-load-more", bop_Wrapper_ID)
                    .addClass("finished")
                    .removeClass("bop-hide");
                  $(".bop-load-more", bop_Wrapper_ID)
                    .show()
                    .html(EndingMessage);
                }
              });
            }
            if (Pagination_Type == "infinite_scroll") {
              var bufferBefore = Math.abs(20);
              $(window).scroll(function () {
                if (
                  $(
                    ".ta-row, .ta-collapse, .bop-timeline-grid, .table-responsive tbody",
                    bop_Wrapper_ID
                  ).length
                ) {
                  var TopAndContent =
                    $(
                      ".ta-row, .ta-collapse, .bop-timeline-grid, .table-responsive tbody",
                      bop_Wrapper_ID
                    ).offset().top +
                    $(
                      ".ta-row, .ta-collapse, .bop-timeline-grid, .table-responsive tbody",
                      bop_Wrapper_ID
                    ).outerHeight();
                  var areaLeft = TopAndContent - $(window).scrollTop();
                  if (areaLeft - bufferBefore < $(window).height()) {
                    if (
                      $(".bop-load-more button", bop_Wrapper_ID).attr(
                        "bop-processing"
                      ) == 0
                    ) {
                      $(".bop-load-more button", bop_Wrapper_ID).trigger(
                        "click"
                      );
                    }
                  }
                }
              });
            }
          });
        }

        /* This code added for divi-builder ticker mode compatibility. */
        if (bopCarousel.length > 0 && bopCarouselData.mode == "ticker") {
          $(".ta-bop-carousel img").removeAttr("loading");
          $(window).on("load", function () {
            $(".ta-bop-carousel").each(function () {
              var thisdfd = $(this);
              var thisCSS = thisdfd.attr("style");
              $(this).removeAttr("style");
              setTimeout(function () {
                thisdfd.attr("style", thisCSS);
              }, 0);
            });
          });
        }

        /* Preloader js */
        $(document).ready(function () {
          $(".bop-preloader", bop_Wrapper_ID).css({
            backgroundImage: "none",
            visibility: "hidden",
          });
        });
        // This function added for bop-Lazyload.
        function bop_lazyload() {
          var $is_find = $(".bookify__item--thumbnail img").hasClass(
            "bop-lazyload"
          );
          if ($is_find) {
            $("img.bop-lazyload")
              .bop_lazyload({ effect: "fadeIn", effectTime: 2000 })
              .removeClass("bop-lazyload")
              .addClass("bop-lazyloaded");
          }
          // bop_item_same_height();
        }
        bop_lazyload();
      });
    }
  };
  bop_myScript();
});
