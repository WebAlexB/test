( function( $ ) {
	"use strict";
	
function _load_slick_carousel($element){
	$element.slick({
		arrows: $element.data("nav") ? true : false ,
		dots: $element.data("dots") ? true : false ,
		prevArrow: '<i class="slick-arrow fa fa-long-arrow-left"></i>',
		nextArrow: '<i class="slick-arrow fa fa-long-arrow-right"></i>',	
		slidesToShow: $element.data("columns"),
		asNavFor: $element.data("asnavfor") ? $element.data("asnavfor") : false ,
		vertical: $element.data("vertical") ? true : false ,
		verticalSwiping: $element.data("verticalswiping") ? $element.data("verticalswiping") : false ,
		rtl: ($("body").hasClass("rtl") && !$element.data("vertical")) ? true : false ,
		centerMode: $element.data("centermode") ? $element.data("centermode") : false ,
		focusOnSelect: $element.data("focusonselect") ? $element.data("focusonselect") : false ,
		responsive: [	
			{
			  breakpoint: 1200,
			  settings: {
				slidesToShow: $element.data("columns1"),
			  }
			},				
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: $element.data("columns2"),
			  }
			},
			{
			  breakpoint: 768,
			  settings: {
				slidesToShow: $element.data("columns3"),
				vertical: false,
				verticalSwiping : false,
			  }
			},
			{
			  breakpoint: 480,
			  vertical: false,
			  verticalSwiping : false,				  
			  settings: {
				slidesToShow: $element.data("columns4"),
				vertical: false,
				verticalSwiping : false,					
			  }
			}
		]								
	});	
}

_click_quickview_button();

function _click_quickview_button(){
	$('.quickview-button').on( "click", function(e) {
		e.preventDefault();
		var product_id  = $(this).data('product_id');
		$(".quickview-"+product_id).addClass("loading");
		$.ajax({
			url: '<?php echo esc_url(admin_url('admin-ajax.php', 'relative')); ?>',
			data: {
				"action" : "hanata_quickviewproduct",
				'product_id' : product_id
			},
			success: function(results) {
				$('.bwp-quick-view').empty().html(results).addClass("active");
				$(".quickview-"+product_id).removeClass("loading");				
				_load_slick_carousel($('.quickview-slick'));
				if( typeof jQuery.fn.tawcvs_variation_swatches_form != 'undefined' ) {
					$( '.variations_form' ).wc_variation_form();
					$( '.variations_form' ).tawcvs_variation_swatches_form();
				}else{
					var form_variation = $(".bwp-quick-view").find('.variations_form');
					var form_variation_select = $(".bwp-quick-view").find('.variations_form .variations select');
					form_variation.wc_variation_form();
					form_variation_select.change();
				}					
				_close_quickview();
			},
			error: function(errorThrown) { console.log(errorThrown); },
		});
	});
}
	
function _close_quickview(){
	$('.quickview-close').on( "click", function(e) {
		e.preventDefault();
		$('.bwp-quick-view').empty().removeClass("active");
	});		
}

} )( jQuery );
	
