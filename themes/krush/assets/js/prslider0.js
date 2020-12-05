(function($, root, undefined) {
	$(function() {
		'use strict';
		// console.log('enabled');
		//if div is visible in the viewport function
		$.fn.isInViewport = function(distance) {
			var elementTop = $(this).offset().top + distance;
			var elementBottom = elementTop + $(this).outerHeight();
			var viewportTop = $(window).scrollTop();
			var viewportBottom = viewportTop + $(window).height();
			return elementBottom > viewportTop && elementTop < viewportBottom;
		};
		//if div is center in of the viewport function
		$.fn.center = function(parent) {
			if (parent) {
				parent = this.parent();
			} else {
				parent = window;
			}
			this.css({
				"position": "absolute",
				"top": ((($(parent).height() - this.outerHeight()) / 2) + $(parent).scrollTop() + "px"),
				"left": ((($(parent).width() - this.outerWidth()) / 2) + $(parent).scrollLeft() + "px")
			});
			return this;
		}
		//menu
		var isActive = false;
		$('.js-menu').on('click', function() {
			if (isActive) {
				$(this).removeClass('active');
				$('body').removeClass('menu-open');
			} else {
				$(this).addClass('active');
				$('body').addClass('menu-open');
			}
			isActive = !isActive;
		});
		//cart 
		$('.navbar .cart').on('click', function() {
			$('.cart-items').addClass('open');
			$('.cart-overlay').addClass('show');
			$('body').css({
				'overflow': 'hidden'
			})
            return false;
		})
		$('.cart-items .close-btn').on('click', function() {
			$('.cart-items').removeClass('open');
			$('.cart-overlay').removeClass('show');
			$('body').css({
				'overflow-x': 'hidden',
				'overflow-y': 'scroll'
			})
		})
		//close cart by clicking outside
		var $cart = $('.cart');
		var $cartItems = $('.cart-items');
		var $cartOverlay = $('.cart-overlay');
		$($cartOverlay).on('click touchstart', function(e) {
			if (!$cart.is(e.target) && $cart.has(e.target).length === 0) {
				$cartItems.removeClass('open');
				$cartOverlay.removeClass('show');
				$('body').css({
					'overflow': 'initial'
				})
			}
		});
		// Select all links with hashes
		$('a[href*="#"]')
			// Remove links that don't actually link to anything
			.not('[href="#"]').not('[href="#0"]').click(function(event) {
				// On-page links
				if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
					// Figure out element to scroll to
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
					// Does a scroll target exist?
					if (target.length) {
						// Only prevent default if animation is actually gonna happen
						event.preventDefault();
						$('html, body').animate({
							scrollTop: target.offset().top
						}, 1000, function() {
							// Callback after animation
							// Must change focus!
							var $target = $(target);
							$target.focus();
							if ($target.is(":focus")) { // Checking if the target was focused
								return false;
							} else {
								$target.attr('tabindex', '-1'); // Adding tabindex for elements not focusable
								$target.focus(); // Set focus again
							};
						});
					}
				}
			});
		// sticky nav + popup
		if( $('.navbar').length ){
		var stickyNavTop = $('.navbar').offset().top;
		var isshow = localStorage.getItem('isshow');
		var stickyNav = function() {
			var scrollTop = $(window).scrollTop();
			if (scrollTop > stickyNavTop) {
				$('.navbar').addClass('sticky');
				$('main .page').css('margin-top', '96px');
				if ($('.newsletter-popup').length) {
					if (isshow == null) {
						localStorage.setItem('isshow', 1);
						$('.newsletter-popup').fadeIn();
					}
				}
				// popup close element click
				$('.newsletter-popup #close').click(function(e) {
					console.log('clicked')
					$('.newsletter-popup').fadeOut(function() {
						$(this).css('z-index', '-9999');
					});
				});
			} else {
				$('.navbar').removeClass('sticky');
				$('main .page').css('margin-top', 'initial');
			}
		};
		}
		// hero logo
		var fadeHeroLogo = function() {
			$(".hero .logo, .hero-copy").css("opacity", 2 - $(window).scrollTop() / 100);
		}
		//featured slider
		$('.featured-slider .right').slick({
			dots: false, // disabled on 12/21/2018
			autoplay: true,
			infinite: true,
			autoplaySpeed: 3000,
			customPaging: function(slider, i) {
				var thumb = $(slider.$slides[i]).data();
				return '<a>' + (i + 1) + ' of 4' + '</a>';
			},
			fade: true,
			responsive: [{
				breakpoint: 870,
				settings: {
					arrows: true,
					centerMode: true,
					centerPadding: '10px',
					slidesToShow: 1,
					autoplay: false
				}
			}]
		});
		//instagram slider
		/*$('.instagram .slider').slick({
			autoplay: true,
			autoplaySpeed: 3000,
			infinite: true,
			centerMode: true,
			variableWidth: true,
			slidesToShow: 5,
			slidesToScroll: 1,
			responsive: [{
				breakpoint: 860,
				settings: {
					centerMode: true,
					centerPadding: '40px',
					slidesToShow: 3
				}
			}, {
				breakpoint: 480,
				settings: {
					arrows: false,
					centerMode: true,
					centerPadding: '10px',
					slidesToShow: 1
				}
			}]
		});*/
		$('.news-posts .post .content').each(function() {
			if ($(this).find('img').length) {
				$(this).css('padding', '0');
				$(this).addClass('image-container')
			} else {
				$(this).parent().addClass('post-text');
			}
			if ($(this).find('a').length) {
				$(this).find('a').addClass('btn');
			}
		});
		$('.news-posts .column').each(function() {
			$('.news-posts .column:nth-of-type(even)').addClass('even')
		})
		//news post filtering function
		function filterList(value) {
			var list = $(".news .news-posts .post");
			$(list).hide();
			if (value == "everything") {
				$(".news .news-posts").find(".post").each(function(i) {
					$(this).fadeIn(650);
				});
			} else {
				$(".news .news-posts").find(".post[data-category*=" + value + "]").each(function(i) {
					$(this).fadeIn(650);
				});
			}
		}
		//news post filtering
		$('.news .categories a.category').click(function() {
			$('.news .news-posts .post').hide();
			$('.news .categories a.category').removeClass('active');
			$(this).addClass('active');
			var filter = $(this).attr('data-category');
			console.log($(this).attr('data-category'));
			filterList(filter);
		});
		//newsletter placeholder slide up 
		$('.newsletter .sign-up').on('click', function() {
			$(this).find('label').addClass('slideUp');
		})
		$('.newsletter .sign-up input#email').on('input', function() {
			if ($(this).val() == '') {
				$(this).prev().removeClass('slideUp');
			} else {
				$(this).prev().addClass('slideUp');
			}
		});
		$('.newsletter .sign-up input#popup-email').on('input', function() {
			if ($(this).val() == '') {
				$(this).prev().removeClass('slideUp');
			} else {
				$(this).prev().addClass('slideUp');
			}
		});
		//slide down newsletter placeholder by clicking outside
		var $emailForm = $('.newsletter .sign-up');
		var $emailInputField = $(".newsletter .sign-up input[type='text']");
		var $newsletterLabel = $('.newsletter .sign-up label');
		$('main, footer').click(function(e) {
			if (!$emailForm.is(e.target) && $emailForm.has(e.target).length === 0) {
				$newsletterLabel.removeClass('slideUp');
				$emailInputField.val('');
			}
			if (!$emailForm.is(e.target) && $emailForm.has(e.target).length === 0) {
				$newsletterLabel.removeClass('slideUp');
				$emailInputField.val('');
			}
		});
		/*shop label nav highlighting adding a class to each link
		$('.shop-sub-menu a').each(function() {
			var menuItemName = $(this).attr('href').replace('#', '');
			$(this).addClass('menu-item-' + menuItemName)
		})*/
		// scroll functions
		$(window).on('resize scroll', function() {
			var scrolling = $(window).scrollTop();
			var winHeight = $(window).height();
			var winWidth = $(window).width();			
			
			//stickyNav();
			fadeHeroLogo();
			
			//sticking the newletter before the footer
			if ($('footer').length && $('footer').isInViewport(0)) {
				$('.newsletter-popup').css({
					'position': 'absolute',
					'bottom': '330px'
				})
			} else {
				$('.newsletter-popup').css({
					'position': 'fixed',
					'bottom': '30px'
				})
			}
			/*adding active class to sub menu items
			$('.product-grid section').each(function() {
				var activeSection = $(this).attr('name');
				if ($(this).isInViewport(150)) {
					$('.menu-item-' + activeSection).prev().removeClass('active');
					$('.menu-item-' + activeSection).addClass('active');
				} else {
					$('.menu-item-' + activeSection).removeClass('active');
				}
			});*/
			//hero display on scroll
			if (scrolling > 400) {
				$('.hero .logo').css({
					'display': 'none'
				})
			} else {
				$('.hero .logo').css({
					'display': 'block'
				})
			}
			if (scrolling > (winHeight + 400)) {
				$('.home .hero').css({
					'visibility': 'hidden'
				})
			} else {
				$('.home .hero').css({
					'visibility': 'visible'
				})
			}			
			//about page scrolling sections 
			if ($('.about section').length && winWidth > 1160) {
				var aboutImageTop = $('.about .meet-thelma-2 img').offset().top;
				var aboutImageHeight = ($('.about .meet-thelma-2 img').outerHeight());
				var aboutImageTopOffset = aboutImageTop - scrolling;
				var aboutImageBottomOffset = winHeight - ((aboutImageTop + aboutImageHeight) - scrolling);
				var thelmaSection2Height = $('.about .meet-thelma-2').outerHeight();
				if (aboutImageBottomOffset >= aboutImageTopOffset) {
					$('.about .meet-thelma img').css({
						'position': 'absolute',
						'top': thelmaSection2Height + 70,
						'max-width': '100%',
						'margin-bottom': '-140px'
					})
					$('.about .founder').css({
						'margin-top': '-108px'
					})
				} else {
					$('.about .meet-thelma img').css({
						'position': 'fixed',
						'top': 0,
						'right': 0,
						'max-width': '50%',
						'margin-bottom': '0'
					})
					$('.about .founder').css({
						'margin-top': '0'
					})                    
				}
			}
		});
		//about page tabbed sections 
		if ($('.about .press').length) {
			$('.about .press .brands .tab').on('click', function() {
				var $content = $(this).parents().siblings('.tab-section-display').children('.content');
				var $stuff = $(this).next().text();
				$('.about .press .brands .tab').removeClass('active');
				$(this).addClass('active');
				//empties the display section
				$content.empty();
				$content.html('<p>' + $stuff + '</p>');
			})
		}
	});
})(jQuery, this);