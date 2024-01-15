;(function( $, window ) {
  'use strict';

/*  Keep the accordion field's first item opened */
$(window).load(function () {
  $('.bop-opened-accordion').each(function () {
    if (!$(this).hasClass('hidden')) {
      $(this).addClass('bop_saved_filter')
    }
  })
})
$('.bop-field-checkbox.bop_advanced_filter').change(function (event) {
  $('.bop-opened-accordion').each(function () {
    if ($(this).hasClass('hidden')) {
      $(this).removeClass('bop_saved_filter')
    } else {
      $(this).addClass('bop_saved_filter')
    }
    if (!$(this).hasClass('bop_saved_filter')) {
      if (
        $(this)
          .find('.bop-accordion-title')
          .siblings('.bop-accordion-content')
          .hasClass('bop-accordion-open')
      ) {
        $(this).find('.bop-accordion-title')
      } else {
        $(this)
          .find('.bop-accordion-title')
          .trigger('click')
        $(this)
          .find('.bop-accordion-content')
          .find('.bop-cloneable-add')
          .trigger('click')
      }
    }
  })
})

})( jQuery, window, document );