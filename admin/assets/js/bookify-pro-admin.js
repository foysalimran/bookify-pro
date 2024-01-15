; (function ($) {
	'use strict'
  
	/**
	 * JavaScript code for admin dashboard.
	 *
	 */
  
	$(function () {
	  /* Preloader */
	  $("#ta_bop_view_options .bop-metabox").css("visibility", "hidden");
  
	  var PCP_layout_type = $(
		'#bop-section-ta_bop_layouts_1 .bop-field-layout_preset .bop-siblings .bop--sibling'
	  )
	  var PCP_get_layout_value = $(
		'#bop-section-ta_bop_layouts_1 .bop-field-layout_preset .bop-siblings .bop--sibling.bop--active'
	  )
		.find('input')
		.val()
  
	  // Carousel Layout.
	  if (PCP_get_layout_value !== 'carousel_layout') {
		$(
		  '#ta_bop_view_options .bop-nav ul li.menu-item_ta_bop_view_options_3'
		).hide()
		$(
		  '#ta_bop_view_options .bop-nav ul li.menu-item_ta_bop_view_options_1 a'
		).trigger('click');
	  } else {
		$(
		  '#ta_bop_view_options .bop-nav ul li.menu-item_ta_bop_view_options_3'
		).show()
	  }
  
	  /**
	   * Show/Hide tabs on changing of layout.
	   */
	  $(PCP_layout_type).on('change', 'input', function (event) {
		var PCP_get_layout_value = $(this).val();
  
		// Carousel Layout.
		if (PCP_get_layout_value !== 'carousel_layout') {
		  $(
			'#ta_bop_view_options .bop-nav ul li.menu-item_ta_bop_view_options_3'
		  ).hide()
		  $(
			'#ta_bop_view_options .bop-nav ul li.menu-item_ta_bop_view_options_1 a'
		  ).trigger('click');
		} else {
		  $(
			'#ta_bop_view_options .bop-nav ul li.menu-item_ta_bop_view_options_3'
		  ).show()
		}
	  })
  
	  /* Preloader js */
	  $("#ta_bop_view_options .bop-metabox").css({ "backgroundImage": "none", "visibility": "visible", "minHeight": "auto" });
	  $("#ta_bop_view_options .bop-nav-metabox li").css("opacity", 1);
  
	  /* Copy to clipboard */
	  $('.bop-shortcode-selectable').on('click',function (e) {
		e.preventDefault();
		bop_copyToClipboard($(this));
		bop_SelectText($(this));
		$(this).trigger("focus").select();
		$('.bop-after-copy-text').animate({
		  opacity: 1,
		  bottom: 25
		}, 300);
		setTimeout(function () {
		  jQuery(".bop-after-copy-text").animate({
			opacity: 0,
		  }, 200);
		  jQuery(".bop-after-copy-text").animate({
			bottom: 0
		  }, 0);
		}, 2000);
	  });
	  $('.ta_bop_input').on('click',function (e) {
		e.preventDefault();
		/* Get the text field */
		var copyText = $(this);
		/* Select the text field */
		copyText.select();
		document.execCommand("copy");
		$('.bop-after-copy-text').animate({
		  opacity: 1,
		  bottom: 25
		}, 300);
		setTimeout(function () {
		  jQuery(".bop-after-copy-text").animate({
			opacity: 0,
		  }, 200);
		  jQuery(".bop-after-copy-text").animate({
			bottom: 0
		  }, 0);
		}, 2000);
	  });
	  function bop_copyToClipboard(element) {
		var $temp = $("<input>");
		$("body").append($temp);
		$temp.val($(element).text()).select();
		document.execCommand("copy");
		$temp.remove();
	  }
	  function bop_SelectText(element) {
		var r = document.createRange();
		var w = element.get(0);
		r.selectNodeContents(w);
		var sel = window.getSelection();
		sel.removeAllRanges();
		sel.addRange(r);
	  }
  
	})
  })(jQuery)
  