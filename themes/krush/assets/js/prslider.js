  (function($, root, undefined) {
  	$(function() {
  		'use strict';
  		//single product scrolling
  		var nav = $('.navbar').outerHeight();
  		var footer = $('footer').outerHeight();
  		var productFooter = $('section.ks-grd-sec')
  		var productRightHeight = $('.single-product .split .right').outerHeight()
  		var winH = $(window).height();
  		var imageCount = $('.single-product .split .left .slideshow img').length;
  		var $singleProductSplit = $('.single-product .split');
      	var singleProductSplitHeight = $singleProductSplit.outerHeight();
  		var productRightPosition = $singleProductSplit.offset().top + $singleProductSplit.outerHeight();
  		var productRightBottom = productRightPosition * 0.51
  		$('.single-product .split .right section:last-child').addClass('last');
  		$('.single-product .slideshow img').slice(1).addClass('new-image');
  		// shows number of images
  		$(".single-product .split .left .slideshow img").each(function(index) {
  			$('.single-product .split .left .image-count').append("<div>" + (index + 1) + "</div>")
  		});
  		$('.single-product .split .left .image-count div').first().addClass('active');
  		//capture scroll percentage of right side
      
      
        function splitScreenScroll() {
        var wintop = $(window).scrollTop();
            var $singleProductSplit = $('.single-product .split');
            var singleProductSplitHeight = $singleProductSplit.outerHeight();          

  			if (($(window).width() > 870)) {
  				
          if (productFooter.isInViewport(0)) {
  					$('.single-product .split .left').css({
  						'position': 'absolute',
  						'bottom': 0,
                        'top': 'initial',
                        'opacity': 1
  					})
  					$('.single-product .split .left img.new-image').css({
  						'position': 'absolute',
  						'right': '0',
  						'bottom': '0 !important',
  						'max-width': '100%'
  					})
  					$('.single-product .split .left .image-count').css({
  						'position': 'absolute',
  						'top': '41%'
  					})
  				}else{
  					$('.single-product .split .left').css({
  						'position': 'fixed',
  						'bottom': '0'
  					})
  					$('.single-product .split .left .image-count').css({
  						'position': 'fixed',
  						'top': '50%'
  					})
  				}
            
  				if (imageCount === 4) {
  					if (wintop < (productRightPosition * 0.12)) {
  						$('.single-product .left .slideshow img').eq(0).addClass('fadeIn');
  						$('.single-product .left .slideshow img.new-image').removeClass('fadeIn');
  						$('.single-product .left .image-count div').removeClass('active');
  						$('.single-product .left .image-count div').eq(0).addClass('active');
  					}
  					if (wintop > (productRightPosition * 0.12) && wintop < (productRightPosition * 0.27)) {
  						$('.single-product .left .slideshow img.main-image').removeClass('fadeIn');
  						$('.single-product .left .slideshow img.new-image').removeClass('fadeIn');
  						$('.single-product .left .slideshow img').eq(1).addClass('fadeIn');
  						$('.single-product .left .image-count div').removeClass('active');
  						$('.single-product .left .image-count div').eq(1).addClass('active');
  					}
  					if (wintop > (productRightPosition * 0.27) && wintop < (productRightPosition * 0.45)) {
  						$('.single-product .left .slideshow img.new-image').removeClass('fadeIn');
  						$('.single-product .left .slideshow img').eq(2).addClass('fadeIn');
  						$('.single-product .left .image-count div').removeClass('active');
  						$('.single-product .left .image-count div').eq(2).addClass('active');
  					}
  					if (wintop > (productRightPosition * 0.45) && wintop <= (productRightPosition * 1)) {
  						$('.single-product .left .slideshow img.new-image').removeClass('fadeIn');
  						$('.single-product .left .slideshow img').eq(3).addClass('fadeIn');
  						$('.single-product .left .image-count div').removeClass('active');
  						$('.single-product .left .image-count div').eq(3).addClass('active');
  					}
  				}
  				if (imageCount === 3) {
  					if (wintop < (productRightPosition * 0.20)) {
  						$('.single-product .left .slideshow img').eq(0).addClass('fadeIn');
  						$('.single-product .left .slideshow img.new-image').removeClass('fadeIn');
  						$('.single-product .left .image-count div').removeClass('active');
  						$('.single-product .left .image-count div').eq(0).addClass('active');
  					}
  					if (wintop > (productRightPosition * 0.20) && wintop < (productRightPosition * 0.40)) {
  						$('.single-product .left .slideshow img.main-image').removeClass('fadeIn');
  						$('.single-product .left .slideshow img.new-image').removeClass('fadeIn');
  						$('.single-product .left .slideshow img').eq(1).addClass('fadeIn');
  						$('.single-product .left .image-count div').removeClass('active');
  						$('.single-product .left .image-count div').eq(1).addClass('active');
  					}
  					if (wintop > (productRightPosition * 0.40) && wintop <= (productRightPosition * 1)) {
  						$('.single-product .left .slideshow img.new-image').removeClass('fadeIn');
  						$('.single-product .left .slideshow img').eq(2).addClass('fadeIn');
  						$('.single-product .left .image-count div').removeClass('active');
  						$('.single-product .left .image-count div').eq(2).addClass('active');
  					}
  				}
  				if (imageCount === 2) {
  					if (wintop < (productRightPosition * 0.35)) {
  						$('.single-product .left .slideshow img').eq(0).addClass('fadeIn');
  						$('.single-product .left .slideshow img.new-image').removeClass('fadeIn');
  						$('.single-product .left .image-count div').removeClass('active');
  						$('.single-product .left .image-count div').eq(0).addClass('active');
  					}
  					if (wintop > (productRightPosition * 0.35) && wintop <= (productRightPosition * 1)) {
  						$('.single-product .left .slideshow img.main-image').removeClass('fadeIn');
  						$('.single-product .left .slideshow img.new-image').removeClass('fadeIn');
  						$('.single-product .left .slideshow img').eq(1).addClass('fadeIn');
  						$('.single-product .left .image-count div').removeClass('active');
  						$('.single-product .left .image-count div').eq(1).addClass('active');
  					}
  				}
  				if (imageCount === 1) {
  					if (wintop <= (productRightPosition * 1)) {
  						return
  					}
  				}
  				var wScroll = $(this).scrollTop();
  				$('.single-product .right').css({
  					'transform': 'translate(0px, -' + wScroll / 50 + '%)'
  				})
        }else{
  				if (($('.single-product .slideshow img:last-child').isInViewport(585)) || $(window).scrollTop() > productRightHeight) {
  					$('.single-product .split .right').css({
  						'position': 'relative',
  						'margin-top': '0'
  					})
  				} else {
            var formHeight = $('.single-product .split .right section.form-section form').outerHeight();
  					$('.single-product .split .right').css({
                    
  					})
  				}              
        }            
      }
                
      splitScreenScroll();
      
  		$(window).scroll(function() {
        splitScreenScroll();
  	  });
});
  })(jQuery, this);