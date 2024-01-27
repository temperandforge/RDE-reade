(function () {
	'use strict';

	/* ========================================================================
	 * DOM-based Routing
	 * Based on http://goo.gl/EUTi53 by Paul Irish
	 *
	 * Only fires on body classes that match. If a body class contains a dash,
	 * replace the dash with an underscore when adding it to the object below.
	 * ======================================================================== */

	// import camelCase from './camelCase';

	// The routing fires all common scripts, followed by the page specific scripts.
	// Add additional events for more control over timing e.g. a finalize event
	class Router {
		constructor(routes) {
			this.routes = routes;
		}

		fire(route, fn = 'init', args) {
			const fire = route !== '' &&
	      this.routes[route] &&
	      typeof this.routes[route][fn] === 'function';
			if (fire) {
				this.routes[route][fn](args);
			}
		}

		loadEvents() {
			// Fire common init JS
			this.fire('common');

			// Fire page-specific init JS, and then finalize JS
			document.body.className
				.toLowerCase()
				.replace(/-/g, '_')
				.split(/\s+/)
				.map(str =>
					`${str
					.charAt(0)
					.toLowerCase()}${str
					.replace(/[\W_]/g, '|')
					.split('|')
					.map(part => `${part.charAt(0).toUpperCase()}${part.slice(1)}`)
					.join('')
					.slice(1)}`)
				.forEach(className => {
					this.fire(className);
					this.fire(className, 'finalize');
				});

			// Fire common finalize JS
			this.fire('common', 'finalize');
		}
	}

	/*! lozad.js - v1.16.0 - 2020-09-06
	* https://github.com/ApoorvSaxena/lozad.js
	* Copyright (c) 2020 Apoorv Saxena; Licensed MIT */


	/**
	 * Detect IE browser
	 * @const {boolean}
	 * @private
	 */
	const isIE = typeof document !== 'undefined' && document.documentMode;

	const defaultConfig = {
	  rootMargin: '0px',
	  threshold: 0,
	  load(element) {
	    if (element.nodeName.toLowerCase() === 'picture') {
	      let img = element.querySelector('img');
	      let append = false;

	      if (img === null) {
	        img = document.createElement('img');
	        append = true;
	      }

	      if (isIE && element.getAttribute('data-iesrc')) {
	        img.src = element.getAttribute('data-iesrc');
	      }

	      if (element.getAttribute('data-alt')) {
	        img.alt = element.getAttribute('data-alt');
	      }

	      if (append) {
	        element.append(img);
	      }
	    }

	    if (element.nodeName.toLowerCase() === 'video' && !element.getAttribute('data-src')) {
	      if (element.children) {
	        const childs = element.children;
	        let childSrc;
	        for (let i = 0; i <= childs.length - 1; i++) {
	          childSrc = childs[i].getAttribute('data-src');
	          if (childSrc) {
	            childs[i].src = childSrc;
	          }
	        }

	        element.load();
	      }
	    }

	    if (element.getAttribute('data-poster')) {
	      element.poster = element.getAttribute('data-poster');
	    }

	    if (element.getAttribute('data-src')) {
	      element.src = element.getAttribute('data-src');
	    }

	    if (element.getAttribute('data-srcset')) {
	      element.setAttribute('srcset', element.getAttribute('data-srcset'));
	    }

	    let backgroundImageDelimiter = ',';
	    if (element.getAttribute('data-background-delimiter')) {
	      backgroundImageDelimiter = element.getAttribute('data-background-delimiter');
	    }

	    if (element.getAttribute('data-background-image')) {
	      element.style.backgroundImage = `url('${element.getAttribute('data-background-image').split(backgroundImageDelimiter).join('\'),url(\'')}')`;
	    } else if (element.getAttribute('data-background-image-set')) {
	      const imageSetLinks = element.getAttribute('data-background-image-set').split(backgroundImageDelimiter);
	      let firstUrlLink = (imageSetLinks[0].substr(0, imageSetLinks[0].indexOf(' ')) || imageSetLinks[0]); // Substring before ... 1x
	      firstUrlLink = firstUrlLink.indexOf('url(') === -1 ? `url(${firstUrlLink})` : firstUrlLink;
	      if (imageSetLinks.length === 1) {
	        element.style.backgroundImage = firstUrlLink;
	      } else {
	        element.setAttribute('style', (element.getAttribute('style') || '') + `background-image: ${firstUrlLink}; background-image: -webkit-image-set(${imageSetLinks}); background-image: image-set(${imageSetLinks})`);
	      }
	    }

	    if (element.getAttribute('data-toggle-class')) {
	      element.classList.toggle(element.getAttribute('data-toggle-class'));
	    }
	  },
	  loaded() {}
	};

	function markAsLoaded(element) {
	  element.setAttribute('data-loaded', true);
	}

	function preLoad(element) {
	  if (element.getAttribute('data-placeholder-background')) {
	    element.style.background = element.getAttribute('data-placeholder-background');
	  }
	}

	const isLoaded = element => element.getAttribute('data-loaded') === 'true';

	const onIntersection = (load, loaded) => (entries, observer) => {
	  entries.forEach(entry => {
	    if (entry.intersectionRatio > 0 || entry.isIntersecting) {
	      observer.unobserve(entry.target);

	      if (!isLoaded(entry.target)) {
	        load(entry.target);
	        markAsLoaded(entry.target);
	        loaded(entry.target);
	      }
	    }
	  });
	};

	const getElements = (selector, root = document) => {
	  if (selector instanceof Element) {
	    return [selector]
	  }

	  if (selector instanceof NodeList) {
	    return selector
	  }

	  return root.querySelectorAll(selector)
	};

	function lozad (selector = '.lozad', options = {}) {
	  const {root, rootMargin, threshold, load, loaded} = Object.assign({}, defaultConfig, options);
	  let observer;

	  if (typeof window !== 'undefined' && window.IntersectionObserver) {
	    observer = new IntersectionObserver(onIntersection(load, loaded), {
	      root,
	      rootMargin,
	      threshold
	    });
	  }

	  const elements = getElements(selector, root);
	  for (let i = 0; i < elements.length; i++) {
	    preLoad(elements[i]);
	  }

	  return {
	    observe() {
	      const elements = getElements(selector, root);

	      for (let i = 0; i < elements.length; i++) {
	        if (isLoaded(elements[i])) {
	          continue
	        }

	        if (observer) {
	          observer.observe(elements[i]);
	          continue
	        }

	        load(elements[i]);
	        markAsLoaded(elements[i]);
	        loaded(elements[i]);
	      }
	    },
	    triggerLoad(element) {
	      if (isLoaded(element)) {
	        return
	      }

	      load(element);
	      markAsLoaded(element);
	      loaded(element);
	    },
	    observer
	  }
	}

	const { $: $$b } = window;
	$$b( document.body );

	function responsiveNavbar() {
		window.onresize = () => {
			const navHeight = $$b( '.navbar-wrap' ).height();
			document
				.querySelector( ':root' )
				.style.setProperty( '--navbar-height', navHeight + 'px' );
			$$b( '#mobile-menu' ).css( 'top', navHeight + 'px' );
		};
		window.onload = window.onresize;
	}

	/**
	 * This function prevents clicking a main menu item with children from leaving a menu open 
	 * while another can be hovered
	 */
	function desktopMenu() {
		let dm = $$b('#menu-primary-navigation-1 > li');
		dm.on('click mouseover', function(e) {
			dm.find('.sub-menu').css('opacity', '0').css('pointer-events', 'none');
			dm.removeClass('sub-menu-open');

			$$b(this).find('.sub-menu').css('opacity', '1').css('pointer-events', 'auto');
			$$b(this).addClass('sub-menu-open');

			$$b(this).find('.sub-menu').on('mouseleave', function() {
				$$b(this).css('opacity', '0').css('pointer-events', 'none');
				$$b(this).parent().removeClass('sub-menu-open');
			});
		});
	}

	function mobileMenu() {
		// assumes existence
		const $menu = $$b( '.mobile-menu' );
		$menu.hide();
		$menu.find('.sub-menu').hide();
		$menu.removeClass( 'loading' );
		const $btn = $$b( '#toggle_nav' );
		$btn.on( 'click', function( e ) {
			$menu.fadeIn();
			$$b('.mobile-menu').css('padding-bottom', $$b('.mobile-menu--footer').outerHeight());
		} );
		$$b( `
		.mobile-menu .menu-item:not(.menu-item-has-children), 
		.mobile-menu .sub-menu .menu-item, 
		.mobile-menu--close-btn
	` ).on( 'click', function( e ) {
			$menu.fadeOut().find('.sub-menu').slideUp().parent().removeClass('item-open');
		} );

		$$b( '.mobile-menu .menu-item.menu-item-has-children > a').on('click', function(e) {
			$$b(this).toggleClass('item-open');
			if(e.target.tagName.toLowerCase() == 'a' && e.target.getAttribute('href') == '#') {
				e.preventDefault(); //prevent triggering link
				$$b(e.target).siblings('.sub-menu').slideToggle(250);
			} else { //parent li
				$$b(e.target).find('.sub-menu').slideToggle(250);
			}
		});

		function closeOnDesktop( x ) {
			if ( x.matches ) {
				$menu.fadeOut().find('.sub-menu').slideUp().parent().removeClass('item-open');
			}
		}

		const x = window.matchMedia( '(min-width: 1025px)' ); //match
		closeOnDesktop( x );
		x.addListener( closeOnDesktop );
	}

	//const scrollingDiv = document.getElementById('scrollingDiv');
	//const items = document.querySelectorAll('#scrollingDiv ul li');
	let scrollingDiv;
	let items;
	let selectedItemIndex = -1;




	// Highlight the initial selected item (optional)
	//highlightSelectedItem();
	function handleKeyboardInteraction(event) {
		if ($$b('.tf-dropdown-open').length) {

			scrollingDiv = $$b('.tf-dropdown-open');
			items = $$b('.tf-dropdown-open ul li');

			switch (event.key) {
		    case 'ArrowDown':
		      event.preventDefault();
		      selectNextItem();
		      break;
		    case 'ArrowUp':
		      event.preventDefault();
		      selectPreviousItem();
		      break;
		    case 'Enter':
		      event.preventDefault();
		      if (selectedItemIndex !== -1) {
		      	items[selectedItemIndex].click();
		      }
		      break;
		    case ' ':
		    	event.preventDefault();
		    	if (selectedItemIndex !== -1) {
		    		items[selectedItemIndex].click();
		    	}
		  }
		} else {
			scrollingDiv = null;
			items = null;
			selectedItemIndex = -1;
			document.removeEventListener('keydown', handleKeyboardInteraction);
		}
	}

	$$b('.tf-dropdown').on('click keypress', function() {
		scrollingDiv = null;
		items = null;
		selectedItemIndex = -1;

		if (event.type == 'keypress') {
			if (event.keyCode == 13 || event.keycode == 32) {
				document.removeEventListener('keydown', handleKeyboardInteraction);
				setTimeout(function() {
					document.addEventListener('keydown', handleKeyboardInteraction);
				}, 50);	
			}
		}
		if (event.type == 'click') {
			document.removeEventListener('keydown', handleKeyboardInteraction);
			setTimeout(function() {
					document.addEventListener('keydown', handleKeyboardInteraction);
			}, 50);
		}
	});


	function selectNextItem() {
	  if (selectedItemIndex < items.length - 1) {
	    selectedItemIndex++;
	    scrollToSelectedItem();
	    highlightSelectedItem();
	  }
	}

	function selectPreviousItem() {
	  if (selectedItemIndex > 0) {
	    selectedItemIndex--;
	    scrollToSelectedItem();
	    highlightSelectedItem();
	  }
	}

	function scrollToSelectedItem() {
	  const selectedElement = items[selectedItemIndex];
	  scrollingDiv.find('ul').scrollTop(Math.round(selectedElement.offsetTop - scrollingDiv.height() / 2));
	}

	function highlightSelectedItem() {
	  items.each((index, item) => {
	    if (index === selectedItemIndex) {
	      $$b(item).addClass('selected');
	    } else {
	      $$b(item).removeClass('selected');
	    }
	  });
	}

	function runFunctions() {
		responsiveNavbar();
		mobileMenu();
		desktopMenu();
	}

	function handleFAQAccordion() {
		const $faq = $('.faq-accordion');
		if (!$faq.length) {
			return
		}

		$faq.each(function () {
			$(this)
				.find('.accordion-btn')
				.on('click', function () {
					$(this).attr('aria-expanded', function (i, attr) {
						return attr == 'true' ? 'false' : 'true'
					});
					$(this).parent().toggleClass('open');
					// $(this)
					// 	.siblings('.accordion-answer')
					// 	.attr('aria-hidden', function (i, attr) {
					// 		return attr == 'true' ? 'false' : 'true'
					// 	})
				});
		});
	}

	function handleContactLocationInformation() {
		const $locations = $('.contact-information--locations button');
		const $contentBlocks = $('.contact-information--set');

		if (!$locations.length) {
			return
		}

		$locations.each(function (index) {
			$(this).on('click', function (e) {
				if ($(this).attr('aria-expanded') == 'true') {
					return
				} else {
					$locations.each(function () {
						$(this).attr('aria-expanded') == 'true'
							? $(this).attr('aria-expanded', 'false')
							: $(this).attr('aria-expanded', 'true');
						$(this).toggleClass('btn btn-blue-dark-blue');
					});
					$contentBlocks.each(function () {
						$(this).attr('aria-hidden') == 'true'
							? $(this).attr('aria-hidden', 'false')
							: $(this).attr('aria-hidden', 'true');
						$(this).attr('aria-hidden') == 'true'
							? $(this).removeClass('active')
							: $(this).addClass('active');
					});
				}
			});
		});
	}

	function handleLeadershipSlider() {
		const $slider = $('.leadership-slider--slider');
		const $contact = $('.leadership-slider-mobile--contacts');

		if (!$slider.length) {
			return
		}


		function handleContactSlider() {
				$contact.slick({
					dots: false,
					slidesToScroll: 1,
					slidesToShow: 1,
					infinite: true,
					asNavFor: $('.leadership-slider--slider'),
					prevArrow: $('.slick-prev-arrow'),
					nextArrow: $('.slick-next-arrow'),
					adaptiveHeight: true,
					fade: true,
				});

		}
		$slider.on('beforeChange', function() {
			//$('.leadership-slider--slider').scrollIntoView();
			if (window.innerWidth < 1300) {
				document.getElementsByClassName('leadership-slider--slider')[0].scrollIntoView();
			}
		});

		$slider.slick({
			infinite: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			fade: true,
			appendDots: $('.leadership-slider--nav'),
			customPaging: function (slider, i) {
				var title = $(slider.$slides[i]).data('title');
				var position = $(slider.$slides[i]).data('position');
				var team_member = $(slider.$slides[i]).data('team-member');
				return `<button class="team-member--btn ${team_member}"><span>${title}</span> ${
				position ? position : ''
			}</button>`
			},
			arrows: false,
			asNavFor: $('.leadership-slider-mobile--contacts'),
			adaptiveHeight: true,
		});

		handleContactSlider();

		// $(window).on('resize', function () {
		// 	handleContactSlider()
		// })

		$(document).ready(function () {
			if (window.location.hash && window.location.hash != '') {
				if ($('.' + window.location.hash.replace('#', '')).length) {
					$('.' + window.location.hash.replace('#', '')).click().blur();
				}
			}
		});
	}

	function handleTabbedRotator() {
		const $tabs = $('.tabbed-rotator--tabs');

		if (!$tabs) {
			return
		}

		let $mobileBtn = $('.current-tab');
		let $tabArr = $('.tabbed-rotator--tab');

		function toggleNavClass() {
			$('.tabbed-rotator-content--wrap').toggleClass('opened closed');
		}

		$mobileBtn.on('click', function () {
			toggleNavClass();
		});

		$tabs.slick({
			infinite: false,
			slidesToShow: 1,
			slidesToScroll: 1,
			dots: true,
			fade: true,
			adaptiveHeight: true,
			appendDots: $('.tabbed-rotator--nav'),
			customPaging: function (slider, i) {
				var title = $(slider.$slides[i]).data('title');
				return `<button class="team-member--btn"><span>${title}</span></button>`
			},
			arrows: false,
		});

		$tabs.on('afterChange', function (event, slick, currentSlide) {
			$tabArr.each(function (index) {
				index == currentSlide ? $mobileBtn.text($(this).data('title')) : null;
			});
		});

		$tabs.on('beforeChange', function (event, slick, currentSlide) {
			let x = window.matchMedia('(max-width: 1024px)');
			if (x.matches) {
				toggleNavClass();
			}
		});
	}

	function handleIndustrySlider() {
		const $slides = $('.industry-slider--section');

		if (!$slides.length) {
			return
		}

		$slides.each(function () {
			$(this)
				.find('.industry-slider--slider')
				.slick({
					slidesToScroll: 1,
					rows: 3,
					fade: true,
					slidesPerRow: 2,
					adaptiveHeight: true,
					dots: true,
					infinite: false,
					appendDots: $(this).find('.industry-slider--dots'),
					prevArrow: $(this).find('.industry-slider--arrows .slick-prev-arrow'),
					nextArrow: $(this).find('.industry-slider--arrows .slick-next-arrow'),
					responsive: [
						{
							breakpoint: 768,
							settings: {
								rows: 6,
								slidesPerRow: 1,
							},
						},
					],
				});
		});
	}

	function handleTestimonialSlider() {
		const $slider = $('.testimonial-slider--section');

		if (!$slider.length) {
			return
		}

		$slider.each(function () {
			$(this)
				.find('.testimonial-slider--slider')
				.slick({
					variableWidth: true,
					infinite: false,
					dots: true,
					adaptiveHeight: false,
					centerMode: false,
					mobileFirst: true,
					appendDots: $(this).find('.testimonial-slider--dots'),
					prevArrow: $(this).find('.slick-prev-arrow'),
					nextArrow: $(this).find('.slick-next-arrow'),
					responsive: [
						{
							breakpoint: 2190,
							settings: {
								slidesToShow: 3,
							},
						},
					],
				});
		});

		let numTestimonials = $('.testimonial-slider--slide').length;
		numTestimonials = numTestimonials - 1;

		$('.testimonial-slider--slider').on(
			'afterChange',
			function (event, slick, currentSlide, nextSlide) {
				if (currentSlide == numTestimonials - 1) {
					$('.slick-next-arrow').prop('disabled', true);
				} else {
					$('.slick-next-arrow').prop('disabled', false);
				}
			}
		);
	}

	function handleTileSlider() {
		const $section = $('.tile-slider--section');

		if (!$section.length) {
			return
		}

		if (document.body.classList.contains('global-sourcing')) {
			$section.each(function () {
				$(this)
					.find('.tile-slider--slider')
					.slick({
						slidesPerRow: 3,
						rows: 3,
						dots: true,
						nextArrow:
							"<button type='button' class='slick-next' aria-label='next'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M12.5477 5.35596L17.9922 10.8004M17.9922 10.8004L12.5477 16.2448M17.9922 10.8004L3.99219 10.8004' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
						prevArrow:
							"<button type='button' class='slick-prev' aria-label='previous'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M9.37413 16.2446L3.92969 10.8002M3.92969 10.8002L9.37413 5.35574M3.92969 10.8002L17.9297 10.8002' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
						appendDots: $(this).find('.tile-slider--dots'),
						appendArrows: $(this).find('.tile-slider--arrows'),
						responsive: [
							{
								breakpoint: 1024,
								settings: {
									rows: 3,
									adaptiveHeight: true,
									slidesPerRow: 2,
									adaptiveHeight: true,
								},
							},
							{
								breakpoint: 768,
								settings: 'unslick',
							},
						],
					});
			});

			$(window).on('resize', function () {
				if (window.innerWidth >= 768) {
					if (!$('.tile-slider--slider').hasClass('slick-initialized')) {
						$section.each(function () {
							$(this)
								.find('.tile-slider--slider')
								.slick({
									slidesPerRow: 3,
									rows: 3,
									dots: true,
									nextArrow:
										"<button type='button' class='slick-next' aria-label='next'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M12.5477 5.35596L17.9922 10.8004M17.9922 10.8004L12.5477 16.2448M17.9922 10.8004L3.99219 10.8004' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
									prevArrow:
										"<button type='button' class='slick-prev' aria-label='previous'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M9.37413 16.2446L3.92969 10.8002M3.92969 10.8002L9.37413 5.35574M3.92969 10.8002L17.9297 10.8002' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
									appendDots: $(this).find('.tile-slider--dots'),
									appendArrows: $(this).find('.tile-slider--arrows'),
									responsive: [
										{
											breakpoint: 1024,
											settings: {
												rows: 3,
												adaptiveHeight: true,
												slidesPerRow: 2,
												adaptiveHeight: true,
											},
										},
										{
											breakpoint: 768,
											settings: 'unslick',
										},
									],
								});
						});
					}
				}
			});
		} else if (document.body.classList.contains('toll-processing'))  {
			
			$section.each(function () {
				$(this)
					.find('.tile-slider--slider')
					.slick({
						slidesPerRow: 3,
						rows: 3,
						dots: true,
						nextArrow:
							"<button type='button' class='slick-next' aria-label='next'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M12.5477 5.35596L17.9922 10.8004M17.9922 10.8004L12.5477 16.2448M17.9922 10.8004L3.99219 10.8004' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
						prevArrow:
							"<button type='button' class='slick-prev' aria-label='previous'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M9.37413 16.2446L3.92969 10.8002M3.92969 10.8002L9.37413 5.35574M3.92969 10.8002L17.9297 10.8002' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
						appendDots: $(this).find('.tile-slider--dots'),
						appendArrows: $(this).find('.tile-slider--arrows'),
						responsive: [
							{
								breakpoint: 1024,
								settings: {
									rows: 3,
									slidesPerRow: 2
								},
							},
							{
								breakpoint: 768,
								settings: {
									rows: 6,
									slidesPerRow: 1
								},
							},
						],
					});
			});
		} else {
			$section.each(function () {
				$(this)
					.find('.tile-slider--slider')
					.slick({
						slidesPerRow: 3,
						rows: 3,
						dots: true,
						nextArrow:
							"<button type='button' class='slick-next' aria-label='next'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M12.5477 5.35596L17.9922 10.8004M17.9922 10.8004L12.5477 16.2448M17.9922 10.8004L3.99219 10.8004' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
						prevArrow:
							"<button type='button' class='slick-prev' aria-label='previous'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M9.37413 16.2446L3.92969 10.8002M3.92969 10.8002L9.37413 5.35574M3.92969 10.8002L17.9297 10.8002' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
						appendDots: $(this).find('.tile-slider--dots'),
						appendArrows: $(this).find('.tile-slider--arrows'),
						responsive: [
							{
								breakpoint: 1024,
								settings: {
									rows: 3,
									slidesPerRow: 2,
									adaptiveHeight: true,
								},
							},
							{
								breakpoint: 768,
								settings: {
									rows: 6,
									slidesPerRow: 1,
									adaptiveHeight: true,
								},
							},
						],
					});
			});
		}
	}

	function handleVerticalAccordions() {
		const $sections = $('.vertical-accordion--section');
		if (!$sections.length) {
			return
		}

		//vertical-accordion--heading

		const $accordions = $('.vertical-accordion--accordion');
		const $images = $('.vertical-accordion--figure');
		const $buttons = $('.vertical-accordion--btn');
		const $content = $('.vertical-accordion--content');

		const $originalArias = [];
		$buttons.map(function () {
			$originalArias.push($(this).attr('aria-expanded'));
		});

		// handles accordion open and close button
		function handleClicks() {
			$accordions.each(function (idx) {
				$(this)
					.find('.vertical-accordion--btn')
					.on('click', function () {
						if ($(this).attr('aria-expanded') == 'true') {
							return
						}

						$accordions.each(function (i) {
							if (i == idx) {
								$(this)
									.find('.vertical-accordion--btn')
									.attr('aria-expanded', 'true');
								$(this).find('.vertical-accordion--content');
								// .attr('aria-hidden', 'false')
								$(this)
									.find('.vertical-accordion--content')
									.toggleClass('active inactive');
							} else {
								$(this)
									.find('.vertical-accordion--btn')
									.attr('aria-expanded', 'false');
								// $(this)
								// 	.find('.vertical-accordion--content')
								// 	.attr('aria-hidden', 'true')
								$(this).find('.vertical-accordion--content').addClass('inactive');
								$(this).find('.vertical-accordion--content').removeClass('active');
							}
						});

						$images.each(function (i) {
							if (i == idx) {
								$(this).removeClass('inactive');
								$(this).addClass('active');
							} else {
								$(this).addClass('inactive');
								$(this).removeClass('active');
							}
						});
					});
			});
		}

		handleClicks();

		let maxWindow = window.matchMedia('(max-width: 1024px)');
		let currentW = window.innerWidth;

		function handleMobileAccordion() {
			if (maxWindow.matches) {
				$buttons.each(function () {
					$(this).attr('aria-expanded', 'true');
				});
				$content.each(function () {
					// $(this).attr('aria-hidden', 'false')
					$(this).addClass('active');
					$(this).removeClass('inactive');
				});
			} else {
				$buttons.each(function (index) {
					index == 0
						? $(this).attr('aria-expanded', 'true')
						: $(this).attr('aria-expanded', 'false');
				});
				$content.each(function (index) {
					if (index == 0) {
						// $(this).attr('aria-hidden', 'false')
						$(this).addClass('active');
						$(this).removeClass('inactive');
					} else {
						// $(this).attr('aria-hidden', 'true')
						$(this).removeClass('active');
						$(this).addClass('inactive');
					}
				});
			}
		}

		handleMobileAccordion();

		$(window).on('resize', function () {
			if (currentW < 1024 && window.innerWidth > 1024) {
				handleMobileAccordion();
			}

			// updates checker for resize to account for accessability: all open on mobile, first open on desktop
			currentW = window.innerWidth;
		});
	}

	function handleCareerSlider() {
		const $slider = $('.career-block--slider');

		if (!$slider.length) {
			return
		}

		const $slides = $('.career-block--slide');

		if ($slides.length <= 1) {
			return
		}

		let media = window.matchMedia('(max-width: 768px)');
		let mobileSettings = {
			rows: 2,
			slidesToShow: 1,
			infinite: false,
			dots: true,
			appendDots: $('.career-block--dots'),
			arrows: true,
			appendArrows: $('.career-block--arrows'),
			nextArrow:
				"<button aria-label='next' type='button' class='slick-next btn-blue-dark-blue'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M12.5477 5.35596L17.9922 10.8004M17.9922 10.8004L12.5477 16.2448M17.9922 10.8004L3.99219 10.8004' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
			prevArrow:
				"<button aria-label='previous' type='button' class='slick-prev btn-blue-dark-blue'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M9.37413 16.2446L3.92969 10.8002M3.92969 10.8002L9.37413 5.35574M3.92969 10.8002L17.9297 10.8002' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
		};
		let desktopSettings = {
			rows: 1,
			slidesToShow: 2,
			infinite: false,
			dots: true,
			appendDots: $('.career-block--dots'),
			arrows: true,
			appendArrows: $('.career-block--arrows'),
			nextArrow:
				"<button aria-label='next' type='button' class='slick-next btn-blue-dark-blue'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M12.5477 5.35596L17.9922 10.8004M17.9922 10.8004L12.5477 16.2448M17.9922 10.8004L3.99219 10.8004' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
			prevArrow:
				"<button aria-label='previous' type='button' class='slick-prev btn-blue-dark-blue'><svg width='21' height='21' viewBox='0 0 21 21' fill='none' xmlns='http://www.w3.org/2000/svg' aria-hidden='true'><path d='M9.37413 16.2446L3.92969 10.8002M3.92969 10.8002L9.37413 5.35574M3.92969 10.8002L17.9297 10.8002' stroke='white' stroke-width='1.67' stroke-linecap='round' stroke-linejoin='round'/></svg></button>",
		};

		function initSlick() {
			if (media.matches) {
				$slider.slick(mobileSettings);
			} else {
				$slider.slick(desktopSettings);
			}
		}

		initSlick();

		$(window).on('resize', function () {
			if ($slider.hasClass('slick-initialized')) {
				$slider.slick('unslick');
			}
			initSlick();
		});
	}

	function disableFirstDropdownOptionRFQ() {
		const $form = $('.rfq-form--form');

		if (!$form.length) {
			return
		}

		$form.each(function () {
			$(this)
				.find('.dropdown option:first-child')
				.each(function () {
					$(this).prop('disabled', true);
				});
		});
	}

	function handleAutoComplete() {


		
		function autocomplete(inp, arr) {
			/*the autocomplete function takes two arguments,
		  the text field element and an array of possible autocompleted values:*/
			var currentFocus;
			/*execute a function when someone writes in the text field:*/
			inp.addEventListener('input', function (e) {
				var a,
					b,
					i,
					val = this.value;
				/*close any already open lists of autocompleted values*/
				closeAllLists();
				if (!val) {
					return false
				}
				if (val.trim() == '') {
					return false
				}

				if (val.length > 1 ) {
					currentFocus = -1;

					var containerDiv = document.createElement("div");
					containerDiv.id = 'autocomplete-list-wrapper';

					if (document.getElementById('autocomplete-list-wrapper')) {
						document.getElementById('autocomplete-list-wrapper').remove();
					}

					/*create a DIV element that will contain the items (values):*/
					a = document.createElement('DIV');
					a.setAttribute('id', this.id + 'autocomplete-list');
					a.setAttribute('class', 'autocomplete-items');
					containerDiv.appendChild(a);
					/*append the DIV element as a child of the autocomplete container:*/

					this.parentNode.appendChild(containerDiv);

					/*for each item in the array...*/
					//var pattern = new RegExp(val, 'gi');
					const boldQuery = (str, query) => {
						const n = str.toUpperCase();
						const q = query.toUpperCase();
						const x = n.indexOf(q);
						if (!q || x === -1) {
							return str // bail early
						}
						const l = q.length;
						return (
							str.substr(0, x) +
							'<strong>' +
							str.substr(x, l) +
							'</strong>' +
							str.substr(x + l)
						)
					};
					//let limit = 15;
					for (i = 0; i < arr.length; i++) {
						//if (i < limit) {
						/*check if the item starts with the same letters as the text field value:*/
						if (arr[i][0].toUpperCase().includes(val.toUpperCase())) {
							//if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
							/*create a DIV element for each matching element:*/
							b = document.createElement('DIV');
							/*make the matching letters bold:*/
							//b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
							b.innerHTML = '';
							if (arr[i][1] == 'Product') {
								b.innerHTML = '<span class="product-pill">Product</span> ';
							}

							b.innerHTML += boldQuery(arr[i][0], val);
							//b.innerHTML = arr[i].replace(pattern, '<strong>' + val + '</strong>');
							/*insert a input field that will hold the current array item's value:*/
							b.innerHTML +=
								"<input type='hidden' value='" +
								arr[i][0] +
								"'><input type='hidden' value='" +
								arr[i][2] +
								"'>";
							/*execute a function when someone clicks on the item value (DIV element):*/
							b.addEventListener('click', function (e) {
								let hv = (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) ? window.location.hash : '';
							if (document.body.classList.contains('sustainable-products') || document.body.classList.contains('tax-product_cat')) {
							  	const stateObj = {
									search_term: document.getElementById('pab-filters-search').value
								};

							  	history.pushState(stateObj, '', thispath + '?q='+document.getElementById('pab-filters-search').value + hv);
							  	document.location.href = this.getElementsByTagName('input')[1].value;
							  	return;
							} else {
								if (document.body.classList.contains('products')) {
									const stateObj = { search_term: document.getElementById('pab-filters-search').value};
									history.pushState(stateObj, '', '/products/?q=' + document.getElementById('pab-filters-search').value);
								}
							}

							document.location.href = this.getElementsByTagName('input')[1].value;
							closeAllLists();
							});
							a.appendChild(b);
						}
						//}
					}

					// alphabetically sort the autocomplete results to match live search results
					const elements = Array.from(a.querySelectorAll('div'));
					
					elements.sort((a, b) => {
						const textA = a.innerText.trim().toLowerCase();
					    const textB = b.innerText.trim().toLowerCase();
					    return textA.localeCompare(textB);
					});

					const container = document.querySelector('#pab-filters-searchautocomplete-list');
					elements.forEach((element) => container.appendChild(element));
				}
			});

			/*execute a function presses a key on the keyboard:*/
			inp.addEventListener('keydown', function (e) {
				var x = document.getElementById(this.id + 'autocomplete-list');
				if (x) x = x.getElementsByTagName('div');
				if (e.keyCode == 40) {
					/*If the arrow DOWN key is pressed,
		        increase the currentFocus variable:*/
					currentFocus++;
					/*and and make the current item more visible:*/
					addActive(x);
				} else if (e.keyCode == 38) {
					//up
					/*If the arrow UP key is pressed,
		        decrease the currentFocus variable:*/
					currentFocus--;
					/*and and make the current item more visible:*/
					addActive(x);
				} else if (e.keyCode == 13) {
					/*If the ENTER key is pressed, prevent the form from being submitted,*/
					e.preventDefault();
					if (currentFocus > -1) {
						/*and simulate a click on the "active" item:*/
						if (x) x[currentFocus].click();
					}
				}
			});

			function addActive(x) {
				/*a function to classify an item as "active":*/
				if (!x) return false
				/*start by removing the "active" class on all items:*/
				removeActive(x);
				if (currentFocus >= x.length) currentFocus = 0;
				if (currentFocus < 0) currentFocus = x.length - 1;
				/*add class "autocomplete-active":*/
				x[currentFocus].classList.add('autocomplete-active');
			}

			function removeActive(x) {
				/*a function to remove the "active" class from all autocomplete items:*/
				for (var i = 0; i < x.length; i++) {
					x[i].classList.remove('autocomplete-active');
				}
			}
		}

		function closeAllLists(elmnt = false, inp = false) {
			/*close all autocomplete lists in the document,
		    except the one passed as an argument:*/
			var x = document.getElementsByClassName('autocomplete-items');
			for (var i = 0; i < x.length; i++) {
				x[i].parentNode.removeChild(x[i]);
			}
		}

		document.addEventListener('click', function (e) {
			closeAllLists(e.target, document.getElementById('pab-filters-search'));
		});

		document.addEventListener('DOMContentLoaded', function () {
			if (document.getElementById('pab-filters-search')) {
				autocomplete(document.getElementById('pab-filters-search'), products);
			}
		});
	}

	function handleCalc() {
		$('.calc .tf-dropdown ul li').on('click', function () {
			let thiscalc = $(this).closest('.calc-main').data('calc');
			let thisIndex = $(this).data('key');

			$('.calc .' + thiscalc + ' .tf-dropdown').each(function () {
				$(this)
					.find('dt p')
					.text(
						$(this)
							.find('li[data-key=' + thisIndex + ']')
							.text()
					);
			});
		});
	}

	function handleContactLoc() {
		if (window.innerWidth <= 768) {
			$('#location1id').on('click', function () {
				$('#location1')[0].scrollIntoView();
			});
			$('#location2id').on('click', function () {
				$('#location2')[0].scrollIntoView();
			});
		}
	}

	function handleCareersNav() {
		$('.position-application--wrap p strong').attr('id', 'apply-now');

		const psuedoSelect = document.querySelector( '.psuedo-select' );
		const active = document.querySelector( '.psuedo-select-active' );

		active.addEventListener( 'click', function( ) {
			psuedoSelect.classList.toggle( 'is-open' );
		} );

		Array.from( document.querySelectorAll( '.pseudo-select li' ) ).forEach( ( el ) => {
			el.addEventListener( 'click', function( ) {
				psuedoSelect.classList.toggle( 'is-open' );
				active.querySeletor( 'span' ).innerText = this.innerText;
			} );
		} );

		window.addEventListener( 'click', function( e ) {
			if ( ! e.target.closest( '.psuedo-select' ) || e.target.classList.contains( 'psuedo-select' ) || (e.target.tagName == 'A' && e.target.classList.contains('toc-nav-link')) || (e.target.tagName == 'SPAN' && e.target.classList.contains('active'))) 
			 {
				psuedoSelect.classList.remove( 'is-open' );
			}
		} );

		//width above fold remove class to close dropdown
	}

	function generateCareersNavigation() {
		const $nav = $( '.in-page-nav nav ul' );
		const sectionHeadings = document.querySelectorAll( '.main-content-wrap h2, .btn-blue-dark-blue span' );

		//dyanmically generate a link for each h2
		sectionHeadings.forEach( ( h2 ) => {
			const a = document.createElement( 'a' );
			//SETUP
			a.innerHTML = `<svg aria-hidden="true" width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M0.5 5.32686L11.5014 5.32686L7.25874 1.09763L8.28928 0.053703L14.2852 6.06296L8.28928 12.0588L7.25874 11.0417L11.5014 6.79906L0.5 6.79906L0.5 5.32686Z" fill="#6A6EFF"/> </svg>`;
			a.innerHTML += `<span>${ h2.innerText }</span>`;
			const id = h2.innerText.toLowerCase().replace( /\s+/g, '-' );
			h2.id = id;
			a.id = id + '-anchor';
			a.href = `#${ id }`;
			a.classList.add( 'toc-nav-link' );
			$nav.append( a );
		} );

		// load as disabled for listening to page scroll until proper anchor link section associated is scrolled to
		let enableScrolling = false;
		setTimeout( () => {
			enableScrolling = true;
			checkPosition();
		}, 200 ); //time-based substitution

		const navbarHeight =  document.querySelector('.navbar-wrap' ).getBoundingClientRect().height;
		function checkPosition() {
			if ( enableScrolling ) {
				// console.log('check position')
				for ( const h2 of sectionHeadings ) {
					if ( navbarHeight < h2.getBoundingClientRect().bottom ) {
						if ( ! activeId.includes( h2.id ) ) {
							inPageNavAnchors.forEach( ( item ) => {
								item.classList.remove( 'active' );
							} );
							activeId = h2.id;
							// console.log(activeId)
							activeAnchor = document.querySelector(
								`a[id="${ activeId }-anchor"]`
							);
							activeAnchor.classList.add( 'active' );
							let selectedElement = activeAnchor;
							let scrollingDiv = $('.in-page-nav');
	  						scrollingDiv.scrollTop(Math.round(selectedElement.offsetTop - scrollingDiv.height() / 2));
						}
						break;
					}
				}
			}
		}
		//on page load, get section from URL
		let activeId = location.hash.substr( 1 );
		if ( ! activeId ) {
			activeId = sectionHeadings[ 0 ].id;
		}
		const inPageNavAnchors = Array.from( document.querySelectorAll( '.toc-nav-link' ) );
		let activeAnchor = document.querySelector( `a[id="${ activeId }-anchor"]` );
		activeAnchor.classList.add( 'active' );

		document.onscroll = () => checkPosition();

		let t;
		$( inPageNavAnchors ).click( ( e ) => {
			enableScrolling = false;
			clearTimeout(t);
			$( inPageNavAnchors ).removeClass( 'active' );
			e.target.classList.add( 'active' );
			t = setTimeout( () => {
				enableScrolling = true;
			}, 1000 );
		} );


	}

	function runBlocks() {
		handleFAQAccordion();
		handleContactLocationInformation();
		handleLeadershipSlider();
		handleTabbedRotator();
		handleIndustrySlider();
		handleTestimonialSlider();
		handleTileSlider();
		handleVerticalAccordions();
		handleCareerSlider();
		disableFirstDropdownOptionRFQ();
		handleCalc();
		handleContactLoc();

		if (
			document.body.classList.contains('products') ||
			document.body.classList.contains('tax-product_cat') ||
			document.body.classList.contains('sustainable-products')
		) {
			handleAutoComplete();
		}

		if (document.body.classList.contains('single-careers')) {
			handleCareersNav();
			generateCareersNavigation();
		}
	}

	// import bigpicture from 'bigpicture'

	const { $: $$a } = window;
	const $body = $$a(document.body);

	var common = {
		init() {
			// new PerformanceObserver((entryList) => {
			// 	for (const entry of entryList.getEntriesByName('first-contentful-paint')) {
			// 	  console.log('FCP candidate:', entry.startTime, entry);
			// 	}
			//  }).observe({type: 'paint', buffered: true});

			const observer = lozad('img');
			observer.observe();
			$$a('.hero img, .primary-hero--figure img').attr('loading', 'eager');

			runFunctions();
			runBlocks();
			// runIO()
		},
		finalize() {
			// JavaScript to be fired on all pages, after page specific JS is fired
			// class to hide outlines if not using keyboard
			$body.on('mousedown', function () {
				$body.addClass('using-mouse');
			});
			$body.on('keydown', function () {
				$body.removeClass('using-mouse');
			});

			//newsletter footer submit
			if ($$a('.newsletter-footer-submit')) {
				$$a('.newsletter-footer-submit').on('click', function() {
					console.log('newsletter footer submitted');
					window.dataLayer.push({'event': 'newsletterfooter'});
				});
			}

			//newsletter single submit
			if ($$a('.newsletter-single-submit')) {
				$$a('.newsletter-single-submit').on('click', function() {
					console.log('newsletter single submitted');
					window.dataLayer.push({'event': 'newsletterposts'});
				});
			}

			if (document.body.classList.contains('custom-product-rfq-form')) {
				document.addEventListener(
					'wpcf7mailsent',
					function (event) {
						//location = '/itemized-rfq-form-success/';
					},
					false
				);
			}

			$$a('.header-links li a, .footer-links-list li a').on('click', function (e) {
				if ($$a(this).attr('href') == '#') {
					e.preventDefault();
				}
			});

			function handleSiteSearch() {
				if ($$a('#header-site-search').length) {
					$$a('#header-site-search').on('submit', function() {
						if ($$a('#desktop_search').length) {
							if ($$a('#desktop_search').val().trim() == '') {
								return false;
							}
						}
					});
				}
			}

			handleSiteSearch();

			let elementsPerPage;
			let categoryType = '.pab-category';
			let searchLoaded = false;
			let currentPage = 1;
			let totalElements = $$a(categoryType).length;
			let initialLoad = true;
			// hold ajax data until search is performed
			let ajaxData = false;
			// control variable to tell if contents have been loaded in dom
			let ajaxContentsLoaded = false;

			function showElements(startIndex, endIndex) {
				$$a(categoryType).hide();
				let pabs = $$a(categoryType).slice(startIndex, endIndex);
				pabs.each(function () {
					$$a(this).fadeIn(250).css('display', 'block');
				});
			}

			function updatePaginationButtons() {
				$$a('.prev-btn').prop('disabled', currentPage === 1);
				$$a('.next-btn').prop(
					'disabled',
					currentPage === Math.ceil(totalElements / elementsPerPage)
				);
			}

			

			function updateDots(create = false, noSearchResults) {
				let pages = Math.ceil($$a(categoryType).length / elementsPerPage);
				$$a('.pab-pagination-dots').html('');

				for (let i = 0; i < pages; i++) {
					$$a('.pab-pagination-dots').append(
						'<a class="nav-dots" data-dot-page="' + (i + 1) + '" href="javascript: void(0);"><svg ' +
							(i + 1 == currentPage
								? 'class="pab-pagination-dot-current" '
								: '') +
							'width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5.74709" cy="5.9999" r="5.24416" stroke="#009FC6"></circle></svg></a>'
					);
				}

				totalElements = $$a(categoryType).length;
				updatePaginationButtons();

				if (pages <= 1) {
					$$a('.pab-pagination').hide();
				} else {
					$$a('.pab-pagination').show();
				}

				if (!initialLoad) {

					if (document.body.classList.contains('products')) {
						document.getElementById('search_load').scrollIntoView();
					} else {
						if (document.getElementsByClassName('pab-filters')) {
							if (noSearchResults) {
								document
									.getElementsByClassName('pab-filters')[0]
									.scrollIntoView(true);
							}
						}
					}
				}

				initialLoad = false;

				function updatePageHash(page) {
					window.location.hash = 'page-' + page;
				}

				$$a('.nav-dots').on('click', function() {
					let thisdotpage = $$a(this).data('dot-page');

					//nothing to do, already on this page
					if (thisdotpage == currentPage) {
						return;
					}
							
					// show needed elements
					showElements((+thisdotpage-1) * elementsPerPage, ((+thisdotpage-1) * elementsPerPage) + elementsPerPage);
					currentPage = thisdotpage;

					if (!window.location.hash) {
						updatePageHash(currentPage);
					} else {
						if (window.location.hash && window.location.hash.replace('#', '').startsWith('page-')) {
							updatePageHash(currentPage);
						}
					}
					updateDots(false, true);
				});
			}
			

			/**
			 * News page, tf dropdown action
			 */
			function handleTFDropdown() {
				if ($$a('.news-featured').length) {
					if ($$a('.tf-dropdown').length) {
						$$a('.tf-dropdown ul li').on('click', function () {
							document.location.href = $$a(this).data('key');
						});
					}
				}
			}

			/**
			 * News/archive page, view more functionality
			 */
			// this variable needs to be global
			let cardsPerPage;

			function handleNewsCardPagination() {
				// if you change these values, also change the window.onresize() values
				if (window.innerWidth < 769) {
					cardsPerPage = 3;
				} else {
					cardsPerPage = 6;
				}

				let $cards = $$a('.news-card-regular');
				let totalCards = $cards.length;
				let cardsToShow = Math.min(cardsPerPage, totalCards);
				let shownCards = cardsToShow;

				if ($$a('.view-more').length) {
					$cards.slice(cardsToShow, totalCards).hide();

					if (totalCards <= cardsPerPage) {
						$$a('#view-more').hide();
					} else {
						$$a('#view-more').show();
					}

					$$a('#view-more').click(function () {
						cardsToShow += cardsPerPage;
						$cards.slice(shownCards, cardsToShow).fadeIn();
						shownCards = cardsToShow;

						if (shownCards >= totalCards) {
							$$a('#view-more').hide();
						}
					});
				}
			}

			/*
			 * news single share positioning
			 */
			function handleNewsSharePosition() {
				if (window.innerWidth > 1024) {
					if ($$a('#single-share').length) {
						var parentContainer = $$a('#single-container');
						var childElement = $$a('#single-news-content');
						$$a('#single-share').css(
							'top',
							childElement.offset().top - parentContainer.offset().top
						);
					}
				}
			}

			/** WOOCOMMERCE JS **/
			function handleSingleProductDropdown() {
				$$a(
					'body.single-product #select1 ul li, body.single-product #select2 ul li'
				).on('click', function () {
					// see if we are processing select 1, if so, reset "variant" attribute
					if (
						$$a(this).parent().parent().parent().parent().attr('id') == 'select1'
					) {
						$$a('.submitted_product_1_variant').val('');
						$$a('#product-rfq-select-' + $$a(this).data('key') + ' p').text(
							'Select ' +
								$$a('#product-' + $$a(this).data('key') + '-attribute-name').val()
						);
						//$('#product-rfq-select-' + $(this).data('key') + ' p').text('SELECT MEEE');
					}

					// hide all
					$$a('.product-rfq-select').addClass('tf-dropdown-hidden');

					// show relevant select box
					$$a('#product-rfq-select-' + $$a(this).data('key')).removeClass(
						'tf-dropdown-hidden'
					);

					// update submitted product hidden input
					if ($$a('#submitted_product_1').length) {
						$$a('#submitted_product_1').val($$a(this).data('key'));
						$$a('.submitted_product_1_variant').attr(
							'id',
							'product-' + $$a(this).data('key') + '-variant'
						);
					}

					// show relevant select box
					if ($$a('#product-rfq-select-' + $$a(this).data('key')).length) {
						if (
							$$a('#product-rfq-select-' + $$a(this).data('key'))
								.find('dt p')
								.html()
								.toLowerCase() != '' &&
							$$a('#product-rfq-select-' + $$a(this).data('key'))
								.find('ul li')
								.html()
								.toLowerCase() == 'no options'
						) {
							$$a('#product-rfq-select-' + $$a(this).data('key'))
								.find('ul li')
								.click();
							$$a('#product-rfq-select-' + $$a(this).data('key')).addClass(
								'tf-dropdown-hidden-with-value'
							);
							$$a(this).focus();
							$$a(this).parent().click();
						}
					}
				});
			}

			function handleSingleRFQDropdown() {
				$$a('body.single-product ul li').on('click', function () {
					let parent = $$a(this)
						.parent()
						.parent()
						.parent()
						.parent()
						.attr('id')
						.replace('product-rfq-select-', '');
					$$a('#product-' + parent + '-variant').val($$a(this).data('key'));
				});
			}

			function handleSingleQTYUnits() {
				if ($$a('#product-units').length) {
					$$a('#product-units ul li').on('click', function () {
						$$a('#product-qty-units').val($$a(this).data('key'));
					});
				}
			}

			function validateRFQForm(product_data) {
				let error_msg = '';

				/* Simple product */
				if (product_data.product_type == 'skip_crosssell') {
					if (product_data.product_1_variant == '') {
						error_msg =
							'Please select ' +
							product_data.product_1_attribute_name.toLowerCase();
					} else {
						if (isNaN(product_data.product_qty)) {
							error_msg = 'Please select quantity';
						}
					}
				}

				/* Multiple attributes, OR */
				if (product_data.product_type == 'multiple_attributes_or') {
					// count visible selection dropdowns
					let visible_count = $$a('.product-rfq-select:visible').length;

					if (visible_count === 0) {
						error_msg = 'Please select specification';
					} else {
						if (product_data.product_1_variant == '') {
							error_msg =
								'Please select ' +
								$$a('#product-' + product_data.product_1 + '-attribute-name')
									.val()
									.toLowerCase();
						} else {
							if (isNaN(product_data.product_qty)) {
								error_msg = 'Please select quantity';
							}
						}
					}
				}

				/* Multiple attributes, AND */
				if (product_data.product_type == 'multiple_attributes_and') {
					if (product_data.product_1_variant == '') {
						error_msg =
							'Please select ' +
							$$a('#product-' + product_data.product_1 + '-attribute-name')
								.val()
								.toLowerCase();
					} else {
						if (product_data.product_2_variant == '') {
							error_msg =
								'Please select ' +
								$$a('#product-' + product_data.product_2 + '-attribute-name')
									.val()
									.toLowerCase();
						} else {
							if (isNaN(product_data.product_qty)) {
								error_msg = 'Please select quantity';
							}
						}
					}
				}

				if (product_data.product_qty <= 0) {
					error_msg = 'Please enter a quantity greater than 0';
				}

				if (error_msg == '') {
					$$a('#product-rfq-error-message').css('display', 'none');
					return true
				} else {
					$$a('#product-rfq-error-message').html(error_msg);
					$$a('#product-rfq-error-message').css('display', 'block');
					return false
				}
			}

			function handleAddToQuote() {
				$$a('#product-submit-button').on('click', function () {
					$$a(this).find('.spinner').css('display', 'block');
					$$a(this).find('svg:not(.spinner').css('display', 'none');
					$$a(this).prop('disabled', true);

					// gather data
					let multiple_attributes = $$a('#multiple_attributes').length
						? $$a('#multiple_attributes').val()
						: '0';
					let product_1 = $$a('#submitted_product_1').length
						? $$a('#submitted_product_1').val()
						: false;
					let product_1_variant = $$a(
						'#product-' + $$a('#submitted_product_1').val() + '-variant'
					).length
						? $$a('#product-' + $$a('#submitted_product_1').val() + '-variant').val()
						: false;
					let product_2 = $$a('#submitted_product_2').length
						? $$a('#submitted_product_2').val()
						: false;
					let product_2_variant = $$a(
						'#product-' + $$a('#submitted_product_2').val() + '-variant'
					).length
						? $$a('#product-' + $$a('#submitted_product_2').val() + '-variant').val()
						: false;
					let product_qty =
						$$a('#product-qty').val() && !isNaN($$a('#product-qty').val())
							? $$a('#product-qty').val()
							: '1';
					let product_unit = $$a('#product-qty-units').val()
						? $$a('#product-qty-units').val()
						: 'units';
					let skip_crosssell = $$a('#skip_crosssell').length ? 1 : false;
					let product_type = $$a('#product_type').val()
						? $$a('#product_type').val()
						: false;
					let product_1_attribute_name = $$a('#product_1_attribute_name').val()
						? $$a('#product_1_attribute_name').val()
						: false;

					let product_data = {};
					product_data['multiple_attributes'] = multiple_attributes;
					product_data['product_1'] = product_1;
					product_data['product_1_variant'] = product_1_variant;
					product_data['product_2'] = product_2;
					product_data['product_2_variant'] = product_2_variant;
					product_data['product_qty'] = product_qty;
					product_data['product_unit'] = product_unit;
					product_data['skip_crosssell'] = skip_crosssell;
					product_data['product_type'] = product_type;
					product_data['product_1_attribute_name'] = product_1_attribute_name;

					if (!validateRFQForm(product_data)) {
						$$a(this).find('.spinner').css('display', 'none');
						$$a(this).find('svg:not(.spinner').css('display', 'block');
						$$a(this).prop('disabled', false);
						return
					}

					$$a.ajax({
						type: 'POST',
						url: '/wp-content/themes/reade-theme/_woo-ajax.php',
						data: 'action=doAddToQuote&data=' + JSON.stringify(product_data),
						success: function (responseText) {
							if (!$$a('#doc-count').length) {
								$$a('.doc-notifications').prepend(
									'<span id="doc-count" class="doc-count"></span>'
								);
							}
							$$a('#product-submit-button').find('.spinner').css('display', 'none');
							$$a('#product-submit-button')
								.find('svg:not(.spinner)')
								.css('display', 'block');
							$$a('#product-submit-button').prop('disabled', false);
							if (responseText == 'success') {
								$$a('#hidden-lity-opener').click();
							}
						},
						error: function () {
							$$a('#product-submit-button').find('.spinner').css('display', 'none');
							$$a('#product-submit-button')
								.find('svg:not(.spinner)')
								.css('display', 'block');
							$$a('#product-submit-button').prop('disabled', false);
						},
						complete: function () {
							$$a('#product-submit-button').find('.spinner').css('display', 'none');
							$$a('#product-submit-button')
								.find('svg:not(.spinner)')
								.css('display', 'block');
							$$a('#product-submit-button').prop('disabled', false);
						},
					});
				});
			}

			function handleRemoveFromQuote() {
				$$a('.removeFromQuote').on('click', function () {
					let cartKey = $$a(this).data('cartKey');

					$$a.ajax({
						type: 'POST',
						url: '/wp-content/themes/reade-theme/_woo-ajax.php',
						data: 'action=doRemoveFromQuote&key=' + JSON.stringify(cartKey),
						success: function (responseText) {
							if (responseText == 'success') {
								document.location.href = '/itemized-rfq';
								// $('#cart-item-' + cartKey).fadeOut(200, function() {
								// 	if (!$('.piq-cart-item:visible').length) {
								// 		//$('.piq-additional-notes, .rfq-notes, .piq-container-right').css('display', 'none');
								// 		 $('#piq-form-submit').prop('disabled', true);
								// 		 $('.rfq-notes').css('display', 'none');
								// 		 $('.piq-additional-notes').css('display', 'none');
								// 		$('.rfq-empty').css('display', 'flex');
								// 		$('#doc-count').hide();
								// 	}
								// });

								return
							}
						},
						error: function () {
							//alert('there was an error');
						},
						complete: function () {},
					});
				});
			}

			function handleChangeUnits() {
				$$a('.tf-dropdown ul li').on('click', function () {
					let cartKey = $$a(this)
						.parent()
						.parent()
						.parent()
						.parent()
						.parent()
						.parent()
						.parent()
						.data('cartKey');
					let unit = $$a(this).text();

					$$a.ajax({
						type: 'POST',
						url: '/wp-content/themes/reade-theme/_woo-ajax.php',
						data: 'action=doChangeUnits&newUnit=' + unit + '&cartKey=' + cartKey,
						success: function (responseText) {
						},
						error: function () {
							//alert('there was an error');
						},
						complete: function () {},
					});
				});
			}

			function debounce(fn, duration) {
				var timer;
				return function (e) {
					clearTimeout(timer);
					timer = setTimeout(fn, duration, e);
				}
			}

			function debounceSearch(fn, duration) {
				var timer;
				return function () {
					clearTimeout(timer);
					timer = setTimeout(fn, duration);
				}
			}

			function handleChangeQty() {
				$$a('.product-qty').on(
					'input',
					debounce((e) => {
						// how to get $(this) data here?
						// curently
						let cartKey = $$a(e.target).data('cartKey');
						let qtyVal = $$a(e.target).val();

						$$a.ajax({
							type: 'POST',
							url: '/wp-content/themes/reade-theme/_woo-ajax.php',
							data: 'action=doChangeQty&cartKey=' + cartKey + '&qty=' + qtyVal,
							success: function (responseText) {
							},
							error: function () {
								//alert('there was an error');
							},
							complete: function () {},
						});
					}, 500)
				);
			}

			if (document.body.classList.contains('custom-product-rfq-form')) {
				function handleCustomProductSubmit() {
					$$a('form').on('submit', function () {
						let form = $$a(this);

						$$a(this).find('.wpcf7-submit svg.spinner').css('display', 'block');
						$$a(this).find('.wpcf7-submit svg:not(.spinner)').css('display', 'none');

						$$a(this)
							.find('span')
							.bind('DOMSubtreeModified', function (event) {
								// If an error has been appended to this input's parent span, do something
								if ($$a(this).children('.wpcf7-not-valid-tip').length) {
									// RUN YOUR FUNCTION HERE
									form.find('.wpcf7-submit svg.spinner').css('display', 'none');
									form
										.find('.wpcf7-submit svg:not(.spinner)')
										.css('display', 'block');

									// Prevent this function from running multiple times
									$$a(this).off(event);

									return false
								}
							});
					});
				}

				handleCustomProductSubmit();
			}

			function handleProductCustomField() {
				let clickTimeout = false;

				$$a('.product-custom-fields-title').on('click', function (e) {
					if (!clickTimeout) {
						clickTimeout = true;
						setTimeout(function () {
							clickTimeout = false;
						}, 500);
					} else {
						e.preventDefault();
						return false
					}

					if ($$a(this).next().css('display') == 'none') {
						$$a(this).find('svg').css('transform', 'unset');
					} else {
						$$a(this).find('svg').css('transform', 'rotate(180deg)');
					}

					$$a(this).next().slideToggle(250);
				});
			}

			if (document.body.classList.contains('tax-product_cat') || document.body.classList.contains('sustainable-products')) {
				$$a('.pah-top-container .btn-arrow-reverse').on('click', function(e) {
					e.preventDefault();
					let ref = document.referrer;

					if (!ref || !ref.includes('/products')) {
						document.location = $$a(this).attr('href');
					} else {
						window.history.back();
					}
				});
			}

			if (document.body.classList.contains('single-product')) {
				$$a('.ph-btn').on('click', function(e) {
					e.preventDefault();
					let ref = document.referrer;

					if (!ref) {
						document.location = $$a(this).attr('href');
					} else {
						if (ref.includes('/products') || ref.includes('/product-category') || ref.includes('/sustainable-products')) {
							window.history.back();
						} else {
							document.location = $$a(this).attr('href');
						}
					}
				});
			}

			if (
				document.body.classList.contains('woocommerce-shop') ||
				document.body.classList.contains('products') ||
				document.body.classList.contains('sustainable-products') ||
				document.body.classList.contains('tax-product_cat')
			) {
				if (document.body.classList.contains('tax-product_cat') || document.body.classList.contains('sustainable-products')) {

					if (document.body.classList.contains('term-all-products')) {
						elementsPerPage = 20;
					} else {
						elementsPerPage = 9;
					}
				} else {
					if (window.innerWidth < 640) {
						elementsPerPage = 9;
					} else {
						elementsPerPage = 9;
					}
				}

				function getUrlParameter(name) {
					  const url = window.location.href;
					  name = name.replace(/[\[\]]/g, "\\$&");
					  const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
					  const results = regex.exec(url);

					  if (!results) return null;
					  if (!results[2]) return '';

					  return decodeURIComponent(results[2].replace(/\+/g, " "));
					}

				if (document.location.hash && document.location.hash != '' && document.location.hash != '#' && document.location.hash.replace('#', '').startsWith('page-')  && !getUrlParameter('q')) {
					let thispage = window.location.hash.replace('#page-', '');
					showElements((+thispage * elementsPerPage) - elementsPerPage, (+thispage * elementsPerPage));
					currentPage = +thispage;
					updateDots();
				} else {
					showElements(0, elementsPerPage);
					updateDots();
				}
				
				

				$$a('.prev-btn').on('click', function () {
					if (currentPage > 1) {
						currentPage--;
						const startIndex = (currentPage - 1) * elementsPerPage;
						const endIndex = startIndex + elementsPerPage;
						showElements(startIndex, endIndex);
						updateDots(false, true);
						if (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) {
							updatePageHash(currentPage);
						} else {
							if (!window.location.hash) {
								updatePageHash(currentPage);
							}
						}
					}
				});

				$$a('.next-btn').on('click', function () {
					if (currentPage < Math.ceil(totalElements / elementsPerPage)) {
						currentPage++;
						const startIndex = (currentPage - 1) * elementsPerPage;
						const endIndex = startIndex + elementsPerPage;
						showElements(startIndex, endIndex);
						updateDots(false, true);
						if (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) {
							updatePageHash(currentPage);
						} else {
							if (!window.location.hash) {
								updatePageHash(currentPage);
							}
						}
					}
				});

				function updatePageHash(page) {
					window.location.hash = 'page-' + page;
				}

				function handleSearch() {
					$$a('#clear-search-text').on('click', function(e) {
						e.preventDefault();

						if ($$a('.pab-search-empty').length) {
							$$a('.pab-search-empty').hide();
						}
						window.location.hash = '';
						$$a('.pab-product a, .pab-category a').off('click', addClickToResults);
						$$a('#pab-filters-search').val('');
						$$a('#clear-search').css('opacity', '0');
						$$a('.pab-product').hide();
									categoryType = '.pab-category';
									showElements(0, elementsPerPage);
									updateDots(false, false);
									
									searchLoaded = false;

									totalElements = $$a(categoryType).length;
									let pages = Math.ceil(
										$$a('.pab-category').length / elementsPerPage
									);
									currentPage = 1;
									$$a('.pab-pagination-dots').html('');
									for (let i = 0; i < pages; i++) {
										$$a('.pab-pagination-dots').append(
											'<svg ' +
												(i + 1 == currentPage
													? 'class="pab-pagination-dot-current" '
													: '') +
												'width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5.74709" cy="5.9999" r="5.24416" stroke="#009FC6"></circle></svg>'
										);
									}
									updatePaginationButtons();
					});

					$$a('#pab-filters-form').on('submit', function (e) {
						e.preventDefault();
					});

					$$a('#pab-filters-search-icon').on('click', function (e) {
						$$a('#pab-filters-form').submit();
					});

					function addClickToResults(e) {
						e.preventDefault();
						let hv = (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) ? window.location.hash : '';

						if (document.body.classList.contains('sustainable-products') || document.body.classList.contains('tax-product_cat')) {
							  const stateObj = {
									search_term: document.getElementById('pab-filters-search').value
								};
							  history.pushState(stateObj, '', thispath + '?q='+document.getElementById('pab-filters-search').value + hv);
							  document.location.href = e.target.href;
							  return;
						} else {
							if (document.body.classList.contains('products')) {
								const stateObj = {
									search_term: document.getElementById('pab-filters-search').value
								};
								history.pushState(stateObj, '', '/products/?q=' + document.getElementById('pab-filters-search').value + hv);
								document.location.href = e.target.href;
								return;
							}
						}
					}

					if ($$a('.pab-filters-search').length) {

						let initialAllLoad = false;
						$$a('.pab-filters-search').on(
		// 		change event not needed?  it triggers a search update when input loses focus
		//					'keyup change',
							'keyup',
							debounceSearch(() => {

								let search = $$a('.pab-filters-search').val().toLowerCase();

								if (search.length > 1) {
									/* if our ajax content hasn't been loaded yet, load it now */
									if (!ajaxContentsLoaded) {
										// load ajax content
										$$a('#search_load').html(ajaxData);

										// clear memory from variable
										ajaxData = '';

										// set control variable to true
										ajaxContentsLoaded = true;
									}

									

									$$a('#clear-search').css('opacity', '1');
									// set category type to search
									categoryType = '.search-result';
									searchLoaded = true;

									$$a('.pab-category, .pab-product').hide();

									$$a('.pab-category');
									$$a('.pab-product');
									let allCats = $$a('.pab-product').add('.pab-category');
									let count = 0;

									for (let i = 0; i < allCats.length; i++) {
										if ($$a(allCats[i]).data('searchTerms').indexOf(search) !== -1) {
											$$a(allCats[i]).addClass('search-result');
											count++;
										} else {
											$$a(allCats[i]).removeClass('search-result');
										}
									}
									if (!count) {
										$$a('.pab-search-empty').css('display', 'block');
										$$a('#pab-search-term').html(search);

										if ($$a('.pab-top-wrap').length) {
											$$a('.pab-top-wrap').hide();
										}
									} else {
										$$a('#pab-search-term').html('');
										$$a('.pab-search-empty').css('display', 'none');

										if ('.pab-top-wrap'.length) {
											$$a('.pab-top-wrap').show();
										}
									}
									currentPage = 1;

									if (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-') && !initialAllLoad) {
									 	let thispage = window.location.hash.replace('#page-', '');
									 	showElements((+thispage * elementsPerPage) - elementsPerPage, (+thispage * elementsPerPage));
									 	currentPage = +thispage;
									 	updateDots();
									 } else {
										showElements(0, elementsPerPage);
										updateDots(true, false);
									}

									initialAllLoad = true;

									$$a('.pab-product, .pab-category a').on('click', addClickToResults);
								} else {
									window.location.hash = '';
									$$a('.pab-product a, .pab-category a').off('click', addClickToResults);

									$$a('#clear-search').css('opacity', '0');
									$$a('.pab-search-empty').css('display', 'none');
									if ($$a('.pab-top-wrap').length) {
										$$a('.pab-top-wrap').show();
									}
									if (searchLoaded) {
										$$a('.pab-product').hide();
										categoryType = '.pab-category';
										showElements(0, elementsPerPage);
										updateDots(false, false);
										updatePaginationButtons();
										searchLoaded = false;

										totalElements = $$a(categoryType).length;
										let pages = Math.ceil(
											$$a('.pab-category').length / elementsPerPage
										);
										currentPage = 1;
										$$a('.pab-pagination-dots').html('');
										for (let i = 0; i < pages; i++) {
											$$a('.pab-pagination-dots').append(
												'<svg ' +
													(i + 1 == currentPage
														? 'class="pab-pagination-dot-current" '
														: '') +
													'width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5.74709" cy="5.9999" r="5.24416" stroke="#009FC6"></circle></svg>'
											);
										}
										updatePaginationButtons();
									}
								}
							}, 250)
						);
					}
				}



				handleSearch();

				if (document.body.classList.contains('tax-product_cat') || document.body.classList.contains('sustainable-products')) {
					// if (window.location.hash && window.location.hash != '' && window.location.hash != '#') {
					// 	if (window.location.hash.replace('#', '').startsWith('page-')) {
					// 		let thispage = window.location.hash.replace('#page-', '');
					// 		showElements((+thispage - 1) * elementsPerPage, ((+thispage - 1) * elementsPerPage) + elementsPerPage);
					// 		currentPage = thispage;
					// 		updateDots();
					// 	} else {
					// 		showElements(0, elementsPerPage);
					// 		updateDots();
					// 	}
					// } else {
					// 	showElements(0, elementsPerPage)
					// 	updateDots()
					// }
					let searchq;
					function getUrlParameter(name) {
					  const url = window.location.href;
					  name = name.replace(/[\[\]]/g, "\\$&");
					  const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
					  const results = regex.exec(url);

					  if (!results) return null;
					  if (!results[2]) return '';

					  return decodeURIComponent(results[2].replace(/\+/g, " "));
					}

					if (searchq = getUrlParameter('q')) {
						let pabfs = document.getElementById('pab-filters-search');
						document.getElementById('pab-filters-search').value = decodeURIComponent(searchq);
						for (let i = 0; i < pabfs.value.length; i++) {
							pabfs.dispatchEvent(new KeyboardEvent('input', {'key':pabfs[i]}));
						}
						pabfs.dispatchEvent(new KeyboardEvent('keyup', {'keyCode': 38}));
						currentPage = 1;

						if (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) {
									let thispage = window.location.hash.replace('#page-', '');
									showElements((+thispage * elementsPerPage) - elementsPerPage, (+thispage * elementsPerPage));
									currentPage = +thispage;
									updateDots();
								} else {
									showElements(0, elementsPerPage);
									updateDots(true, false);
								}
					}
				}


				function handleSort() {
					let allcards;
					$$a('#filter1 dd ul li').on('click', function () {
						let sort = $$a(this).data('key');
						let container = $$a('.pab-categories');
						categoryType = '.pab-category';
						let cards = $$a(categoryType);
						currentPage = 1;
						cards.hide();
						allcards = cards;

						if (sort == 'alpha') {
							allcards.sort(function (a, b) {
								var nameA = $$a(a)
									.find('.pab-category-info-left')
									.text()
									.toLowerCase()
									.trim();
								var nameB = $$a(b)
									.find('.pab-category-info-left')
									.text()
									.toLowerCase()
									.trim();

								if (nameA < nameB) {
									return -1
								}
								if (nameA > nameB) {
									return 1
								}
								return 0
							});
						} else if (sort == 'reversealpha') {
							allcards.sort(function (a, b) {
								var nameA = $$a(a)
									.find('.pab-category-info-left')
									.text()
									.toLowerCase()
									.trim();
								var nameB = $$a(b)
									.find('.pab-category-info-left')
									.text()
									.toLowerCase()
									.trim();

								if (nameA > nameB) {
									return -1
								}
								if (nameA < nameB) {
									return 1
								}
								return 0
							});
						} else ;

						// hide all cards
						//$(categoryType).remove()

						if (sort == 'alpha' || sort == 'reversealpha') {
							allcards.each(function () {
								$$a(container).append($$a(this).show().removeClass('child-cat-show'));
							});
						} else {
							categoryType = '.pab-category';
							cards = $$a(categoryType);
							allcards = cards;
							allcards.sort(function (a, b) {
								var nameA = $$a(a)
									.find('.pab-category-info-left')
									.text()
									.toLowerCase()
									.trim();
								var nameB = $$a(b)
									.find('.pab-category-info-left')
									.text()
									.toLowerCase()
									.trim();

								if (nameA < nameB) {
									return -1
								}
								if (nameA > nameB) {
									return 1
								}
								return 0
							});

							allcards.each(function() {
								$$a(this).removeClass('child-cat-show');
								if ($$a(this).data('child-cats').indexOf(sort) !== -1) {
									$$a(container).append($$a(this).show().addClass('child-cat-show'));
								} else {
									$$a(container).append($$a(this).hide());
								}
							});
							
							categoryType = '.child-cat-show';
						}

						showElements(0, elementsPerPage);
						updateDots();
					});
				}

				handleSort();
			}


			function handleCustomRFQDropdownColor() {
				$$a('.rfq-form--form .tf-dropdown li').on('click', function() {
					$$a(this).parent().parent().parent().parent().find('dt p').css('color', '#009fc6');
				});
			}

			if (document.body.classList.contains('custom-product-rfq-form')) {
				handleCustomRFQDropdownColor();
			}


			/** Show the categories and load products when /products/ is initially viewed and scrolled into view **/
			if (document.body.classList.contains('products')) {

				function handleHashChange() {
					if (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) {
						let thispage = window.location.hash.replace('#page-', '');
						showElements((+thispage * elementsPerPage) - elementsPerPage, (+thispage * elementsPerPage));
						currentPage = +thispage;
						updateDots();
					}
				}

				window.addEventListener('hashchange', handleHashChange);

				function getUrlParameter(name) {
				  const url = window.location.href;
				  name = name.replace(/[\[\]]/g, "\\$&");
				  const regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)");
				  const results = regex.exec(url);

				  if (!results) return null;
				  if (!results[2]) return '';

				  return decodeURIComponent(results[2].replace(/\+/g, " "));
				}

				function handleShowSearchItems() {

					let searchel;
					let searchq;

					function handleIntersection(entries, observer) {
					    entries.forEach(entry => {
					        if (entry.isIntersecting) {
					        	$$a.ajax({
							        url: '/wp-content/themes/reade-theme/template-parts/blocks/partial/product-archive-ajax.php',
							        type: 'GET',
							        success: function (data) {

							        	/* hold ajax data in variable to be triggered and injected upon typing in the search box */
							        	ajaxData = data;
							        	
							        	/* preload search if it's necessary */
										if (searchq = getUrlParameter('q')) {
											let pabfs = document.getElementById('pab-filters-search');
											document.getElementById('pab-filters-search').value = decodeURIComponent(searchq);
											for (let i = 0; i < pabfs.value.length; i++) {
												pabfs.dispatchEvent(new KeyboardEvent('input', {'key':pabfs[i]}));
											}

											pabfs.dispatchEvent(new KeyboardEvent('keyup', {'keyCode': 38}));
										}
										
							        },
							        error: function () {
							            console.error('Error loading search data.');
							        }
							    });
					            observer.disconnect();
					        }
					    });
					}

					const options = {
					    root: null,
					    rootMargin: '0px',
					    threshold: 0.1
					};

					const observer = new IntersectionObserver(handleIntersection, options);

					if (searchel = document.getElementById('search_load')) {
						observer.observe(searchel);
					}
				}

				handleShowSearchItems();
				handleHashChange();
			}

			// run functions
			handleTFDropdown();
			handleNewsCardPagination();
			handleNewsSharePosition();

			// woocommerce functions
			handleSingleProductDropdown();
			handleSingleRFQDropdown();
			handleSingleQTYUnits();
			handleAddToQuote();
			handleRemoveFromQuote();
			handleChangeUnits();
			handleChangeQty();
			handleProductCustomField();

			if ($$a('.pab-categories').length) {
				window.addEventListener('resize', function handleResize() {

					if (!document.body.classList.contains('term-all-products')) {
						/* Per page elements for products */
						if (window.innerWidth < 640) {
							if (9 != elementsPerPage) {
								elementsPerPage = 9;
								showElements(0, elementsPerPage);
								currentPage = 1;
								updatePaginationButtons();
								updateDots();
							}
						} else {
							if (document.body.classList.contains('products')) {
								if (9 != elementsPerPage) {
									elementsPerPage = 9;
									currentPage = 1;
									showElements(0, elementsPerPage);
									updatePaginationButtons();
									updateDots();
								}
							} else {
								if (9 != elementsPerPage) {
									elementsPerPage = 9;
									currentPage = 1;
									showElements(0, elementsPerPage);
									updatePaginationButtons();
									updateDots();
								}
							}
						}
					}
				});
			}

			// window resize
			window.addEventListener('resize', function () {
				/**
				 * Change pagination of news cards/grids
				 */
				if ($$a('.view-more').length) {
					if (window.innerWidth < 769) {
						cardsPerPage = 3;
					} else {
						cardsPerPage = 6;
					}

					$cards = $$a('.news-card-regular');
					totalCards = $cards.length;
					//if (cardsToShow == cardsPerPage) {
					cardsToShow = Math.min(cardsPerPage, totalCards);
					//} else {
					//cardsToShow = $('.news-card-regular:visible').length;
					//}
					shownCards = cardsToShow;

					$cards.slice(0, cardsToShow).show();
					$cards.slice(cardsToShow, totalCards).hide();

					if (totalCards <= cardsPerPage) {
						$$a('#view-more').hide();
					} else {
						$$a('#view-more').show();
					}
				}

				/**
				 * Share element positioning
				 */
				if (window.innerWidth > 1024) {
					if ($$a('#single-share').length) {
						var parentContainer = $$a('#single-container');
						var childElement = $$a('#single-news-content');
						$$a('#single-share').css(
							'top',
							childElement.offset().top - parentContainer.offset().top
						);
					}
				} else {
					if ($$a('#single-share').length) {
						$$a('#single-share').css('top', '0');
					}
				}
			});
		},
	};

	var commonjsGlobal = typeof globalThis !== 'undefined' ? globalThis : typeof window !== 'undefined' ? window : typeof global !== 'undefined' ? global : typeof self !== 'undefined' ? self : {};

	function createCommonjsModule(fn, module) {
		return module = { exports: {} }, fn(module, module.exports), module.exports;
	}

	var loadjs_umd = createCommonjsModule(function (module, exports) {
	(function(root, factory) {
	  {
	    module.exports = factory();
	  }
	}(commonjsGlobal, function() {
	/**
	 * Global dependencies.
	 * @global {Object} document - DOM
	 */

	var devnull = function() {},
	    bundleIdCache = {},
	    bundleResultCache = {},
	    bundleCallbackQueue = {};


	/**
	 * Subscribe to bundle load event.
	 * @param {string[]} bundleIds - Bundle ids
	 * @param {Function} callbackFn - The callback function
	 */
	function subscribe(bundleIds, callbackFn) {
	  // listify
	  bundleIds = bundleIds.push ? bundleIds : [bundleIds];

	  var depsNotFound = [],
	      i = bundleIds.length,
	      numWaiting = i,
	      fn,
	      bundleId,
	      r,
	      q;

	  // define callback function
	  fn = function (bundleId, pathsNotFound) {
	    if (pathsNotFound.length) depsNotFound.push(bundleId);

	    numWaiting--;
	    if (!numWaiting) callbackFn(depsNotFound);
	  };

	  // register callback
	  while (i--) {
	    bundleId = bundleIds[i];

	    // execute callback if in result cache
	    r = bundleResultCache[bundleId];
	    if (r) {
	      fn(bundleId, r);
	      continue;
	    }

	    // add to callback queue
	    q = bundleCallbackQueue[bundleId] = bundleCallbackQueue[bundleId] || [];
	    q.push(fn);
	  }
	}


	/**
	 * Publish bundle load event.
	 * @param {string} bundleId - Bundle id
	 * @param {string[]} pathsNotFound - List of files not found
	 */
	function publish(bundleId, pathsNotFound) {
	  // exit if id isn't defined
	  if (!bundleId) return;

	  var q = bundleCallbackQueue[bundleId];

	  // cache result
	  bundleResultCache[bundleId] = pathsNotFound;

	  // exit if queue is empty
	  if (!q) return;

	  // empty callback queue
	  while (q.length) {
	    q[0](bundleId, pathsNotFound);
	    q.splice(0, 1);
	  }
	}


	/**
	 * Execute callbacks.
	 * @param {Object or Function} args - The callback args
	 * @param {string[]} depsNotFound - List of dependencies not found
	 */
	function executeCallbacks(args, depsNotFound) {
	  // accept function as argument
	  if (args.call) args = {success: args};

	  // success and error callbacks
	  if (depsNotFound.length) (args.error || devnull)(depsNotFound);
	  else (args.success || devnull)(args);
	}


	/**
	 * Load individual file.
	 * @param {string} path - The file path
	 * @param {Function} callbackFn - The callback function
	 */
	function loadFile(path, callbackFn, args, numTries) {
	  var doc = document,
	      async = args.async,
	      maxTries = (args.numRetries || 0) + 1,
	      beforeCallbackFn = args.before || devnull,
	      pathname = path.replace(/[\?|#].*$/, ''),
	      pathStripped = path.replace(/^(css|img|module|nomodule)!/, ''),
	      isLegacyIECss,
	      hasModuleSupport,
	      e;

	  numTries = numTries || 0;

	  if (/(^css!|\.css$)/.test(pathname)) {
	    // css
	    e = doc.createElement('link');
	    e.rel = 'stylesheet';
	    e.href = pathStripped;

	    // tag IE9+
	    isLegacyIECss = 'hideFocus' in e;

	    // use preload in IE Edge (to detect load errors)
	    if (isLegacyIECss && e.relList) {
	      isLegacyIECss = 0;
	      e.rel = 'preload';
	      e.as = 'style';
	    }
	  } else if (/(^img!|\.(png|gif|jpg|svg|webp)$)/.test(pathname)) {
	    // image
	    e = doc.createElement('img');
	    e.src = pathStripped;    
	  } else {
	    // javascript
	    e = doc.createElement('script');
	    e.src = pathStripped;
	    e.async = async === undefined ? true : async;

	    // handle es modules
	    // modern browsers:
	    //   module: add to dom with type="module"
	    //   nomodule: call success() callback without adding to dom
	    // legacy browsers:
	    //   module: call success() callback without adding to dom
	    //   nomodule: add to dom with default type ("text/javascript")
	    hasModuleSupport = 'noModule' in e;
	    if (/^module!/.test(pathname)) {
	      if (!hasModuleSupport) return callbackFn(path, 'l');
	      e.type = "module";
	    } else if (/^nomodule!/.test(pathname) && hasModuleSupport) return callbackFn(path, 'l');
	  }

	  e.onload = e.onerror = e.onbeforeload = function (ev) {
	    var result = ev.type[0];

	    // treat empty stylesheets as failures to get around lack of onerror
	    // support in IE9-11
	    if (isLegacyIECss) {
	      try {
	        if (!e.sheet.cssText.length) result = 'e';
	      } catch (x) {
	        // sheets objects created from load errors don't allow access to
	        // `cssText` (unless error is Code:18 SecurityError)
	        if (x.code != 18) result = 'e';
	      }
	    }

	    // handle retries in case of load failure
	    if (result == 'e') {
	      // increment counter
	      numTries += 1;

	      // exit function and try again
	      if (numTries < maxTries) {
	        return loadFile(path, callbackFn, args, numTries);
	      }
	    } else if (e.rel == 'preload' && e.as == 'style') {
	      // activate preloaded stylesheets
	      return e.rel = 'stylesheet'; // jshint ignore:line
	    }
	    
	    // execute callback
	    callbackFn(path, result, ev.defaultPrevented);
	  };

	  // add to document (unless callback returns `false`)
	  if (beforeCallbackFn(path, e) !== false) doc.head.appendChild(e);
	}


	/**
	 * Load multiple files.
	 * @param {string[]} paths - The file paths
	 * @param {Function} callbackFn - The callback function
	 */
	function loadFiles(paths, callbackFn, args) {
	  // listify paths
	  paths = paths.push ? paths : [paths];

	  var numWaiting = paths.length,
	      x = numWaiting,
	      pathsNotFound = [],
	      fn,
	      i;

	  // define callback function
	  fn = function(path, result, defaultPrevented) {
	    // handle error
	    if (result == 'e') pathsNotFound.push(path);

	    // handle beforeload event. If defaultPrevented then that means the load
	    // will be blocked (ex. Ghostery/ABP on Safari)
	    if (result == 'b') {
	      if (defaultPrevented) pathsNotFound.push(path);
	      else return;
	    }

	    numWaiting--;
	    if (!numWaiting) callbackFn(pathsNotFound);
	  };

	  // load scripts
	  for (i=0; i < x; i++) loadFile(paths[i], fn, args);
	}


	/**
	 * Initiate script load and register bundle.
	 * @param {(string|string[])} paths - The file paths
	 * @param {(string|Function|Object)} [arg1] - The (1) bundleId or (2) success
	 *   callback or (3) object literal with success/error arguments, numRetries,
	 *   etc.
	 * @param {(Function|Object)} [arg2] - The (1) success callback or (2) object
	 *   literal with success/error arguments, numRetries, etc.
	 */
	function loadjs(paths, arg1, arg2) {
	  var bundleId,
	      args;

	  // bundleId (if string)
	  if (arg1 && arg1.trim) bundleId = arg1;

	  // args (default is {})
	  args = (bundleId ? arg2 : arg1) || {};

	  // throw error if bundle is already defined
	  if (bundleId) {
	    if (bundleId in bundleIdCache) {
	      throw "LoadJS";
	    } else {
	      bundleIdCache[bundleId] = true;
	    }
	  }

	  function loadFn(resolve, reject) {
	    loadFiles(paths, function (pathsNotFound) {
	      // execute callbacks
	      executeCallbacks(args, pathsNotFound);
	      
	      // resolve Promise
	      if (resolve) {
	        executeCallbacks({success: resolve, error: reject}, pathsNotFound);
	      }

	      // publish bundle load event
	      publish(bundleId, pathsNotFound);
	    }, args);
	  }
	  
	  if (args.returnPromise) return new Promise(loadFn);
	  else loadFn();
	}


	/**
	 * Execute callbacks when dependencies have been satisfied.
	 * @param {(string|string[])} deps - List of bundle ids
	 * @param {Object} args - success/error arguments
	 */
	loadjs.ready = function ready(deps, args) {
	  // subscribe to bundle load event
	  subscribe(deps, function (depsNotFound) {
	    // execute callbacks
	    executeCallbacks(args, depsNotFound);
	  });

	  return loadjs;
	};


	/**
	 * Manually satisfy bundle dependencies.
	 * @param {string} bundleId - The bundle id
	 */
	loadjs.done = function done(bundleId) {
	  publish(bundleId, []);
	};


	/**
	 * Reset loadjs dependencies statuses
	 */
	loadjs.reset = function reset() {
	  bundleIdCache = {};
	  bundleResultCache = {};
	  bundleCallbackQueue = {};
	};


	/**
	 * Determine if bundle has already been defined
	 * @param String} bundleId - The bundle id
	 */
	loadjs.isDefined = function isDefined(bundleId) {
	  return bundleId in bundleIdCache;
	};


	// export
	return loadjs;

	}));
	});

	const { $: $$9 } = window;
	$$9(document.body);


	var customProductRfqForm = {
	  init() {

	  },
	  finalize() {

	    function disableForm() {
	      $$9('#rfq-form-submit').prop('disabled', true);
	      $$9('#rfq-form-submit svg').show();
	    }

	    function enableForm() {
	      $$9('#rfq-form-submit').prop('disabled', false);
	      $$9('#rfq-form-submit svg').hide();
	    }

	    let fieldsnotempty = ['rfq-input-product', 'rfq-input-size', 'rfq-input-size-measure', 'rfq-input-purity', 'rfq-input-quantity', 'rfq-input-quantity-measure', 'rfq-input-general-application'];
	    let allfields2 = ['r-first_name', 'r-last_name', 'r-company', 'r-street', 'r-city', 'r-zip', 'r-phone', 'r-email'];
	    let errorfields = [];
	    let errorfields2 = [];

	    $$9('#rfq-form-next').on('click', function(e) {
	      e.preventDefault();

	      if (validateFormPart1()) {
	        $$9('.all-fields').removeClass('rfq-error');
	        $$9('.rfq-form-slide-1').css('display', 'none').addClass('rfq-form-slide-hidden');
	        $$9('.rfq-form-slide-2').fadeIn(function() {
	          $$9(this).removeClass('rfq-form-slide-hidden');
	        }).css('display', 'flex');
	      } else {
	        $$9('.all-fields').removeClass('rfq-error');
	        $$9('#00N6g00000TtToL, #00N6g00000TUVFo').removeClass('rfq-error');

	        for (let i = 0; i < errorfields.length; i++) {
	          if (document.getElementsByClassName(errorfields[i]).length) {
	            document.getElementsByClassName(errorfields[i])[0].classList.add('rfq-error');
	          } else {
	            if (document.getElementById(errorfields[i])) {
	              document.getElementById(errorfields[i]).classList.add('rfq-error');
	            }
	          }
	        }

	      }
	    });


	    $$9('#custom-rfq-form').on('submit', function(e) {
	      disableForm();
	      e.preventDefault();
	      if (validateFormPart2()) {
	        $$9('.all-fields-2').removeClass('rfq-error');
	        $$9('#r-00N6g00000TtToJ, #r-00N6g00000TtToG, #r-state, #r-country').removeClass('rfq-error');
	        

	         // update salesforce form with values from this field
	        $$9('#sf-form #first_name').val($$9('#r-first_name').val());
	        $$9('#sf-form #last_name').val($$9('#r-last_name').val());
	        $$9('#sf-form #company').val($$9('#r-company').val());
	        $$9('#sf-form #phone').val($$9('#r-phone').val());
	        $$9('#sf-form #sfemail').val($$9('#r-email').val());
	        $$9('#sf-form #street').text($$9('#r-street').val());
	        $$9('#sf-form #city').val($$9('#r-city').val());
	        $$9('#sf-form #zip').val($$9('#r-zip').val());
	        $$9('#00N3J000001mdyh').text($$9('#r-00N3J000001mdyh').val());

	        //state
	        $$9('#sf-form #state').val($$9('#r-state dt p').text());
	        $$9('#sf-form #country').val($$9('#r-country dt p').text());

	        // how they found us
	        $$9('#00N6g00000TtToG').val($$9('#r-00N6g00000TtToG dt p').text());

	        // found us details - if "other" is selected
	        $$9('#00N6g00000U3avS').val($$9('#r-00N6g00000U3avS').val());

	        // preferred method of contact
	        $$9('#00N6g00000TtToJ').val($$9('#r-00N6g00000TtToJ dt p').text());

	        // product 1 name
	        $$9('#00N6g00000VMFwG').val($$9('#00N6g00000TUVFe').val());

	        // product 1 details
	        $$9('#00N6g00000VMFwF').text(
	            'Size: ' + $$9('#00N6g00000Tj7ls').val() + "\r\n" + 
	            'Shape: ' + $$9('#00N6g00000TBLtL').val() + "\r\n" + 
	            'Size Unit: ' + $$9('#00N6g00000TtToL dt p').text() + "\r\n" + 
	            'Min. Purity: ' + $$9('#00N6g00000TUVFy').val() + "\r\n" + 
	            'Quantity: ' + $$9('#00N6g00000TUVG3').val() + "\r\n" + 
	            'Quantity Unit: ' + $$9('#00N6g00000TUVFo dt p').text() + "\r\n" + 
	            'Currently Using: ' + ($$9('#r-currently-using-yes').is(':checked') ? 'Yes' : 'No') + "\r\n" + 
	            'General Application: ' + $$9('#00N6g00000TUVG8').val()
	        );
	 
	        setTimeout(function() {
	          $$9('#custom-rfq-form').off('submit').submit();
	        }, 250);




	      } else {
	        enableForm();
	        $$9('.all-fields-2').removeClass('rfq-error');
	        $$9('#r-00N6g00000TtToJ, #r-00N6g00000TtToG, #r-state, #r-country').removeClass('rfq-error');
	        
	        for (let i = 0; i < errorfields2.length; i++) {
	          document.getElementById(errorfields2[i]).classList.add('rfq-error');
	        }
	      }
	    });

	    $$9('#rfq-form-previous').on('click', function(e) {
	      e.preventDefault();
	      $$9('.rfq-form-slide-2').addClass('rfq-form-slide-hidden').css('display', 'none');
	      $$9('.rfq-form-slide-1').fadeIn(function() {
	      //removeClass('rfq-form-slide-hidden');
	      }).css('display', 'flex');
	    });

	    function validateFormPart2() {
	      errorfields2 = [];

	      for (let i = 0; i < allfields2.length; i++) {
	        if ($$9('#'+allfields2[i]).val() == '' || $$9('#' + allfields2[i]).val() == '0') {
	          if (!errorfields2.includes(allfields2[i])) {
	            errorfields2.push(allfields2[i]);
	          }
	        }
	      }


	      let phoneNumber = $$9('#r-phone').val();
	      let cleanedPhoneNumber = phoneNumber.replace(/\D/g, '');
	      let phoneRegex = /^[0-9]{10,15}$/;

	      if (!phoneRegex.test(cleanedPhoneNumber)) {
	        if (!errorfields2.includes('r-phone')) {
	          errorfields2.push('r-phone');
	        }
	      }

	      let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	      if (!emailRegex.test($$9('#r-email').val())) {
	        if (!errorfields2.includes('r-email')) {
	          errorfields2.push('r-email');
	        }
	      }

	      if ($$9('#r-00N6g00000TtToJ dt p').text() == 'Preferred Method of Contact *') {
	        if (!errorfields2.includes('r-00N6g00000TtToJ')) {
	          errorfields2.push('r-00N6g00000TtToJ');
	        }
	      }

	      if ($$9('#r-state dt p').text() == 'State/Providence') {
	         if (!errorfields2.includes('r-state')) {
	           errorfields2.push('r-state');
	         }
	       }

	      if ($$9('#r-country dt p').text() == 'Select Country *') {
	        if (!errorfields2.includes('r-country')) {
	          errorfields2.push('r-country');
	        }
	      }

	      if ($$9('#r-00N6g00000TtToG dt p').text() == 'How did you find us? *') {
	        if (!errorfields2.includes('r-00N6g00000TtToG')) {
	          errorfields2.push('r-00N6g00000TtToG');
	        }
	      }

	      if ($$9('#r-00N6g00000TtToG dt p').text() == 'Other') {
	        if ($$9('#r-00N6g00000U3avS').val() == '') {
	           if (!errorfields2.includes('r-00N6g00000U3avS')) {
	             errorfields2.push('r-00N6g00000U3avS');
	           }
	         }
	      }

	      // if ($('#r-00N6g00000TtToG').val() == 'Other') {
	      //   if ($('#r-00N6g00000U3avS').val() == '') {
	      //     if (!errorfields2.includes('r-00N6g00000U3avS')) {
	      //       errorfields2.push('r-00N6g00000U3avS');
	      //     }
	      //   }
	      // }

	      if ($$9('#p-accept-terms input:checked').length != 1) {
	        if (!errorfields2.push('p-accept-terms')) {
	          errorfields2.push('p-accept-terms');
	        }
	      }

	      if (errorfields2.length) {
	        return false;
	      }

	      return true;
	    }

	    $$9('#r-00N6g00000TtToG ul li').on('click', function() {
	      if ($$9(this).text() == 'Other') {
	        $$9('#r-00N6g00000U3avS').css('display', 'block');
	      } else {
	        $$9('#r-00N6g00000U3avS').css('display', 'none');
	        $$9('#r-00N6g00000U3avS').val('');
	      }
	    });

	    function validateFormPart1() {
	      errorfields = [];
	      for (let i = 0; i < fieldsnotempty.length; i++) {
	        if ($$9('.'+fieldsnotempty[i]).val() == '' || $$9('.'+fieldsnotempty[i]).val() == '0') {
	          if (!errorfields.includes(fieldsnotempty[i])) {
	            errorfields.push(fieldsnotempty[i]);
	          }
	        }
	      }

	      if ($$9('#00N6g00000TtToL dt p').text() == 'Size Unit of Measure *') {
	        if (!errorfields.includes('00N6g00000TtToL')) {
	          errorfields.push('00N6g00000TtToL');
	        }
	      }

	      if ($$9('#00N6g00000TUVFo dt p').text() == 'Quantity Unit of Measure *') {
	        if (!errorfields.includes('00N6g00000TUVFo')) {
	          errorfields.push('00N6g00000TUVFo');
	        }
	      }
	      
	      // if (isNaN($('.rfq-input-quantity').val())) {
	      //   if (!errorfields.includes('rfq-input-quantity')) {
	      //     errorfields.push('rfq-input-quantity');
	      //   }
	      // }
	      if ($$9('.rfq-currently-using input:checked').length != 1) {
	        if (!errorfields.includes('rfq-currently-using')) {
	          errorfields.push('rfq-currently-using');
	        }
	      }



	      if (errorfields.length) {
	        return false;
	      }

	      return true;
	    }
	  },
	};

	const { $: $$8 } = window;
	// const $body = $( document.body );

	var pageTemplateLegal = {
		init() {
			// Usage
			if(document.body.classList.contains('page-id-91')) { // Terms of service of sales
				generateInPageNavigation();
				handleMobileInPageNav();
			} else {
				waitForElement('#iub-pp-container h2', (element) => {
					// The element is now present on the page
					generateInPageNavigation();
					handleMobileInPageNav();
				});
			}
		},
		finalize() {

		},
	};
	// Function to wait for an element to be present
	function waitForElement(selector, callback) {
	  const observer = new MutationObserver((mutationsList, observer) => {
	    const element = document.querySelector(selector);
	    if (element) {
	      observer.disconnect();
	      callback(element);
	    }
	  });

	  observer.observe(document.documentElement, { childList: true, subtree: true });
	}


	function handleMobileInPageNav() {

		const psuedoSelect = document.querySelector( '.psuedo-select' );
		const active = document.querySelector( '.psuedo-select-active' );

		active.addEventListener( 'click', function( ) {
			psuedoSelect.classList.toggle( 'is-open' );
		} );

		Array.from( document.querySelectorAll( '.pseudo-select li' ) ).forEach( ( el ) => {
			el.addEventListener( 'click', function( ) {
				psuedoSelect.classList.toggle( 'is-open' );
				active.querySeletor( 'span' ).innerText = this.innerText;
			} );
		} );

		window.addEventListener( 'click', function( e ) {
			if ( ! e.target.closest( '.psuedo-select' ) || e.target.classList.contains( 'psuedo-select' ) || (e.target.tagName == 'A' && e.target.classList.contains('toc-nav-link')) || (e.target.tagName == 'SPAN' && e.target.classList.contains('active'))) 
			 {
				psuedoSelect.classList.remove( 'is-open' );
			}
		} );

		//width above fold remove class to close dropdown
	}

	function generateInPageNavigation() {
		const $nav = $$8( '.in-page-nav nav ul' );
		// const sectionHeadings = document.querySelector('.page-id-4562') chris' - local page id
		const sectionHeadings = document.querySelector('.page-id-5101') //page id for cookies
			? document.querySelectorAll('.main-content-wrap h3')
			: document.querySelectorAll('.main-content-wrap h2');

		//dyanmically generate a link for each h2
		sectionHeadings.forEach( ( h2 ) => {
			const a = document.createElement( 'a' );
			//SETUP
			a.innerHTML = `<svg aria-hidden="true" width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M0.5 5.32686L11.5014 5.32686L7.25874 1.09763L8.28928 0.053703L14.2852 6.06296L8.28928 12.0588L7.25874 11.0417L11.5014 6.79906L0.5 6.79906L0.5 5.32686Z" fill="#6A6EFF"/> </svg>`;
			a.innerHTML += `<span>${ h2.innerText.replace(':', '') }</span>`;
			const id = h2.innerText.toLowerCase().replace( /\s+/g, '-' );
			h2.id = id;
			a.id = id + '-anchor';
			a.href = `#${ id }`;
			a.classList.add( 'toc-nav-link' );
			$nav.append( a );
		} );

		// load as disabled for listening to page scroll until proper anchor link section associated is scrolled to
		let enableScrolling = false;
		setTimeout( () => {
			enableScrolling = true;
			checkPosition();
		}, 200 ); //time-based substitution

		const navbarHeight =  document.querySelector('.navbar-wrap' ).getBoundingClientRect().height;
		function checkPosition() {
			if ( enableScrolling ) {
				// console.log('check position')
				for ( const h2 of sectionHeadings ) {
					if ( navbarHeight < h2.getBoundingClientRect().bottom ) {
						if ( ! activeId.includes( h2.id ) ) {
							inPageNavAnchors.forEach( ( item ) => {
								item.classList.remove( 'active' );
							} );
							activeId = h2.id;
							// console.log(activeId)
							activeAnchor = document.querySelector(
								`a[id="${ activeId }-anchor"]`
							);
							activeAnchor.classList.add( 'active' );
							let selectedElement = activeAnchor;
							let scrollingDiv = $$8('.in-page-nav');
	  						scrollingDiv.scrollTop(Math.round(selectedElement.offsetTop - scrollingDiv.height() / 2));
						}
						break;
					}
				}
			}
		}
		//on page load, get section from URL
		let activeId = location.hash.substr( 1 );
		if ( ! activeId ) {
			activeId = sectionHeadings[ 0 ].id;
		}
		const inPageNavAnchors = Array.from( document.querySelectorAll( '.toc-nav-link' ) );
		let activeAnchor = document.querySelector( `a[id="${ activeId }-anchor"]` );
		activeAnchor.classList.add( 'active' );

		document.onscroll = () => checkPosition();

		let t;
		$$8( inPageNavAnchors ).click( ( e ) => {
			enableScrolling = false;
			clearTimeout(t);
			$$8( inPageNavAnchors ).removeClass( 'active' );
			e.target.classList.add( 'active' );
			t = setTimeout( () => {
				enableScrolling = true;
			}, 1000 );
		} );
	}

	const { $: $$7 } = window;
	$$7(document.body);

	var single = {
	  init() {
	    
	  },
	  finalize() {

	  },
	};

	const { $: $$6 } = window;
	$$6(document.body);

	var frontPage = {
	    init() {
	        
	    },
	    finalize() {

	    },
	};

	const { $: $$5 } = window;
	$$5(document.body);

	var history$1 = {
		init() {
			//TODO replace jquery use were possible
			//TODO does not work with new use of GSAP
			//TODO animation easing - easeInOut
			$$5('.btn--back-to-start').on('click', function (e) {
				e.preventDefault();

				// calculate farthest left side of first history section to scroll x coordinate
				const beginningHistory = document.getElementById('history-1773');
				let beginRect = beginningHistory.getBoundingClientRect();

				// calculate height of navbar and hero section to scroll under both for y coordinate
				const heroSection = document.querySelector('.grid-hero--section');
				let heroRect = heroSection.getBoundingClientRect();
				let heroBottom = heroRect.height;

				const navbar = document.querySelector('.navbar-wrap');
				let navRect = navbar.getBoundingClientRect();
				let navBottom = navRect.height;

				scrollTo(beginRect.x, heroBottom + navBottom);
			});
		},
		finalize() {
			loadjs_umd(
				[
					//mobile-first
					'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
					//desktop
					'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
					'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
				],
				'gsap',
				{
					before: function (_path, _scriptEl) {
						/* execute code before fetch */
					},
					async: true, // load files synchronously or asynchronously (default: true)
					numRetries: 3, // see caveats about using numRetries with async:false (default: 0),
					returnPromise: false, // return Promise object (default: false)
				}
			);

			loadjs_umd.ready('gsap', {
				/* scripts successfully loaded */
				success: function () {
					//mobile
					const historySlider = document.querySelector('.history--slider');
					if (!historySlider) {
						return
					}
					const history = historySlider.parentNode;
					function renderHistoryLayout(x) {
						if (x.matches) {
							$$5('.history--slider').slick({
								arrows: true,
								autoplay: false,
								autoplaySpeed: 7000,
								dots: false,
								fade: false,
								infinite: false,
								slidesToShow: 1,
								adaptiveHeight: true,
								slidesToScroll: 1,
								speed: 300, // match css value - search: f78
								prevArrow: history.querySelector('.slick-prev'),
								nextArrow: history.querySelector('.slick-next'),
							});
						} else {
							if (document.querySelector('.history--slider.slick-initialized')) {
								$$5(historySlider).slick('unslick');
							}
						}
					}

					var x = window.matchMedia('(max-width: 1280px)'); //match css media query breakpoint  - search: h89
					renderHistoryLayout(x); // Call listener function at run time
					x.addListener(renderHistoryLayout); // Attach listener function on state changes
					let tween;
					function initHistoryScroller() {
						if (!x.matches) {
							gsap.registerPlugin(ScrollTrigger);

							let x = 0;
							let sections = gsap.utils.toArray('.panel');
							let widths = sections.map((el) => el.getBoundingClientRect().width);
							widths.map((val) => (x += val));
							// .reduce((accumulator, currentValue) => accumulator + currentValue, initialValue)

							// console.log(gsap.utils.toArray('.panel').map((el) => el.getBoundingClientRect().width).reduce((accumulator, currentValue) => accumulator + currentValue, 0))
							tween = gsap.to(sections, {
								x: document.body.clientWidth - gsap.utils.toArray('.panel').map((el) => el.getBoundingClientRect().width).reduce((accumulator, currentValue) => accumulator + currentValue, 0),//initialValue),
								ease: 'none',
								scrollTrigger: {
									trigger: '.history-desktop--scroll-container',
									pin: true,
									scrub: 1,
									// snap: 1 / (sections.length - 1),

									// base vertical scrolling on how wide the container is
									// so it feels more natural.
									// a.k.a adjust rate of change relative to scroll quantity
									end: '+=15000', //scroll spped control
									invalidateOnResize: true,
									invalidateOnRefresh: true
								},
							});
						}
					}

					// runs initHistoryScroller if page loads desktop size
					initHistoryScroller();

					let t = null;
					window.addEventListener('resize', function () {
						// // runs initHistoryScroller is page loads mobile and resizes to desktop
						// if (!initHistoryScrollerRan) {
							// 	initHistoryScroller()
							// }
							
						clearTimeout(t);
						t = setTimeout(function () {
							// console.log('History')
							if( !! tween.scrollTrigger ) {
								tween.scrollTrigger.kill(true);
							}
							initHistoryScroller();
						}, 350);
					});

					function handleImgTransition() {
						const images = document.querySelectorAll(
							'.historical-event.panel figure'
						);

						images.forEach((img, index) => {
							window.innerWidth - 300 >= img.getBoundingClientRect().left &&
								img.classList.add('active');
						});
					}

					function handleLineAnimation() {
						const line = document.getElementById('historySVG1');

						// console.log(line.getBoundingClientRect())
						window.innerWidth - 150 >= line.getBoundingClientRect().left &&
							line.classList.add('active');
					}

					setTimeout(() => {
						handleImgTransition();
						document.addEventListener(
							'scroll',
							function () {
								handleImgTransition();
								handleLineAnimation();
							},
							{
								passive: true,
							}
						);
					}, 200);
				},
				error: function (depsNotFound) {
					/*  cdn scripts failed to load */
					console.log('failed to load required scripts');
				},
			});
		},
	};

	const { $: $$4 } = window;
	$$4(document.body);


	var singleProduct = {
	  init() {

	  },
	  finalize() {

	    

	    if ($$4('.prp-product').length) {
	      // more than 3, enable load more functionality
	      if ($$4('.prp-product').length > 3) {
	        let itemsPerPage = 3;
	        let currentIndex = 0;
	        let $products = $$4('.prp-product');

	        showNextProducts();

	        function showNextProducts() {
	          $products.slice(currentIndex, currentIndex + itemsPerPage).fadeIn();
	          currentIndex += itemsPerPage;

	          if (currentIndex >= $products.length) {
	            $$4('#prp-load-more').hide();
	          }
	        }

	        $$4('#prp-load-more').on('click', function() {
	          showNextProducts();
	        });
	      } else {
	        // there are less than 3, just show them
	        $$4('.prp-product').show();
	      }
	    }
	  },
	};

	const { $: $$3 } = window;
	$$3(document.body);

	var itemizedRfq = {
	  init() {

	  },
	  finalize() {

	    function handleCurrentlyUsing() {

	      function debounce(fn, duration) {
	        var timer;
	        return function(e){
	          clearTimeout(timer);
	          timer = setTimeout(fn, duration, e);
	        }
	      }

	      $$3('.general-application-textarea').on('input', debounce((e) => {
	        e.target;
	        let $thisitem = $$3(e.target).parent().parent().parent();
	        let $thiscartkey = $thisitem.data('cart-key');
	        let $thisvalue = $$3(e.target).val();

	        $$3.ajax({
	          type: "POST",
	          url: "/wp-content/themes/reade-theme/_woo-ajax.php",
	          data: 'action=doUpdateGeneralApplication&cart-key=' + $thiscartkey + '&value=' + $thisvalue,
	          success: function(responseText){
	            if (responseText != 'success') {
	              console.log('something went wrong saving this response, please try again.');
	            }
	          },
	          error: function() {
	            //alert('there was an error');
	          },
	          complete: function() {
	          }
	        });

	      }, 500));

	      $$3('input[type="radio"]').on('change', function(e) {
	        let thisvalue = $$3(this).val();
	        let thisitem = $$3(this).parent().parent().parent().parent();
	        let thiscartkey = thisitem.data('cart-key');

	        $$3.ajax({
	          type: "POST",
	          url: "/wp-content/themes/reade-theme/_woo-ajax.php",
	          data: 'action=doChangeCurrentlyUsing&cart-key=' + thiscartkey + '&value=' + thisvalue,
	          success: function(responseText){
	            //alert(responseText);
	            if (responseText != 'success') {
	              console.log('something went wrong saving this response, please try again.');
	            }
	          },
	          error: function() {
	            //alert('there was an error');
	          },
	          complete: function() {
	          }
	        });
	      });
	    }

	    function handleRFQDropdown() {
	      $$3('#find_us ul li').on('click', function() {
	        let livalue = $$3(this).text();
	        $$3('#find_us p').css('color', '#045');

	        if (livalue == 'Other') {
	          $$3('#rfq-find-us-other').css('display', 'block');
	        } else {
	          $$3('#rfq-find-us-other').css('display', 'none');
	        }
	      });

	      $$3('#how-to-contact ul li').on('click', function() {
	        $$3('#how-to-contact p').css('color', '#045');
	      });

	      $$3('#rfq-state ul li').on('click', function() {
	        $$3('#rfq-state p').css('color', '#045');
	      });

	      $$3('#rfq-country ul li').on('click', function() {
	        $$3('#rfq-country p').css('color', '#045');
	      });
	    }

	    function handleRFQSubmit() {

	      let errors = [];
	      let errorFields = [];

	      function validateRFQForm() {
	        errorFields = [];
	        errors = [];
	        // input type="text" id="rfq-first-name" name="rfq-first-name" placeholder="First Name" value="">
	        //                     <input type="text" id="rfq-last-name" name="rfq-last-name" placeholder="Last Name" value="">
	        //                     <input type="text" id="rfq-company" name="rfq-company" placeholder="Company" value="">
	        //                     <input type="phone" id="rfq-phone" name="rfq-phone" placeholder="Phone Number" value="">
	        //                     <input type="email" id="rfq-email" name="rfq-email" placeholder="Email" value="">
	        //                     <input type="text" id="rfq-address-line-1" name="rfq-address-line-1" placeholder="Address" value="">
	        //                     <input type="text" id="rfq-address-line-2" name="rfq-address-line-2" placeholder="Address Line 2" value="">
	        //                     <input type="text" id="rfq-city" name="rfq-city" placeholder="City" value="">
	        //                     <input type="text" id="rfq-state" name="rfq-state" placeholder="State" value="">
	        //                     <input type="text" id="rfq-zip" name="rfq-zip" placeholder="Zip" value="">

	        if ($$3('#rfq-first-name').val() == '') {
	          errors.push('Please enter a first name');
	          if (!errorFields.includes('rfq-first-name')) {
	            errorFields.push('rfq-first-name');
	          }
	        }

	        if ($$3('#rfq-last-name').val() == '') {
	          errors.push('Please enter a last name');
	          if (!errorFields.includes('rfq-last-name')) {
	            errorFields.push('rfq-last-name');
	          }
	        }

	        if ($$3('#rfq-company').val() == '') {
	          errors.push('Please enter a company');
	          if (!errorFields.includes('rfq-company')) {
	            errorFields.push('rfq-company');
	          }
	        }
	        
	        if ($$3('#rfq-phone').val() == '') {
	          errors.push('Please enter a phone number');
	          if (!errorFields.includes('rfq-phone')) {
	            errorFields.push('rfq-phone');
	          }
	        } else {
	          let phoneNumber = $$3('#rfq-phone').val();
	          let cleanedPhoneNumber = phoneNumber.replace(/\D/g, '');
	          let phoneRegex = /^[0-9]{10,15}$/;

	          if (!phoneRegex.test(cleanedPhoneNumber)) {
	            errors.push('Please enter a valid phone number');
	            if (!errorFields.includes('rfq-phone')) {
	              errorFields.push('rfq-phone');
	            }
	          }
	        }

	        if ($$3('#rfq-email').val() == '') {
	          errors.push('Please enter an email address');
	          if (!errorFields.includes('rfq-email')) {
	            errorFields.push('rfq-email');
	          }
	        } else {
	          let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	          if (!emailRegex.test($$3('#rfq-email').val())) {
	            errors.push = 'Please enter a valid email address';
	            if (!errorFields.includes('rfq-email')) {
	              errorFields.push('rfq-email');
	            }
	          }
	        }

	        if ($$3('#rfq-address-line-1').val() == '') {
	          errors.push('Please enter an address');
	          if (!errorFields.includes('rfq-address-line-1')) {
	            errorFields.push('rfq-address-line-1');
	          }
	        }

	        if ($$3('#rfq-city').val() == '') {
	          errors.push('Please enter a city');
	          if (!errorFields.includes('rfq-city')) {
	            errorFields.push('rfq-city');
	          }
	        }

	        if ($$3('#rfq-state p').text() == 'State/Providence') {
	          errors.push('Please enter a state');
	          if (!errorFields.includes('rfq-state')) {
	            errorFields.push('rfq-state');
	          }
	        }

	        if ($$3('#rfq-zip').val() == '') {
	          errors.push('Please enter a ZIP');
	          if (!errorFields.includes('rfq-zip')) {
	            errorFields.push('rfq-zip');
	          }
	        }

	        if ($$3('#find_us p').text() == 'How did you find us?') {
	          errors.push('Please let us know how you found READE');
	          if (!errorFields.includes('find_us')) {
	            errorFields.push('find_us');
	          }
	        }

	        if ($$3('#rfq-country p').text() == 'Select Country *') {
	          errors.push('Please enter a country');
	          if (!errorFields.includes('rfq-country')) {
	            errorFields.push('rfq-country');
	          }
	        }

	        if ($$3('#find_us p').text() == 'Other') {
	          if ($$3('#rfq-find-us-other').val() == '') {
	            errors.push('Please enter how you found READE');
	            if (!errorFields.includes('rfq-find-us-other')) {
	              errorFields.push('rfq-find-us-other');
	            }
	          }
	        }
	        
	        if ($$3('#how-to-contact p').text() == 'Preferred method of contact?') {
	          errors.push('Please select your preferred method of contact');
	          if (!errorFields.includes('how-to-contact')) {
	            errorFields.push('how-to-contact');
	          }
	        }

	        if (!$$3('#rfq-accept-terms').is(':checked')) {
	          errors.push('Please accept the terms and conditions of sale');
	          if (!errorFields.includes('rfq-tos')) {
	            errorFields.push('rfq-tos');
	          }
	        }

	        let items = $$3('.piq-cart-item');

	        if (items.length) {

	          // check textarea info is there
	          items.each(function(index, element) {
	            let $thisitem = $$3(this);
	            let thiscartkey = $thisitem.data('cart-key');

	            if ($thisitem.find('#rfq-' + thiscartkey + '-general-application').val() == '') {
	              errors.push('Please enter general application details');
	              if (!errorFields.includes('rfq-' + thiscartkey + '-general-application')) {
	                errorFields.push('rfq-' + thiscartkey + '-general-application');
	              }
	              if (!errorFields.includes('general-application-' + thiscartkey)) {
	                errorFields.push('general-application-' + thiscartkey);
	              }
	            }
	          });

	          // check radio button has been selected
	          items.each(function(index, element) {
	            let $thisradio = $$3(this);
	            let thisradiocartkey = $thisradio.data('cart-key');
	            
	            if ($thisradio.find('input[type="radio"]:checked').length != 1) {
	              errors.push('Please select currently using status');
	              if (!errorFields.includes('currently-using-' + thisradiocartkey)) {
	                errorFields.push('currently-using-' + thisradiocartkey);
	              }
	              if (!errorFields.includes('rfq-' + thisradiocartkey + '-using-yes')) {
	                errorFields.push('rfq-' + thisradiocartkey + '-using-yes');
	              }
	              if (!errorFields.includes('rfq-' + thisradiocartkey + '-using-no')) {
	                errorFields.push('rfq-' + thisradiocartkey + '-using-no');
	              }
	            }
	          });
	        }

	        if (errors.length) {
	          return false;
	        }


	        // update salesforce form with values from this field
	        $$3('#sf-form #first_name').val($$3('#rfq-first-name').val());
	        $$3('#sf-form #last_name').val($$3('#rfq-last-name').val());
	        $$3('#sf-form #company').val($$3('#rfq-company').val());
	        $$3('#sf-form #phone').val($$3('#rfq-phone').val());
	        $$3('#sf-form #sfemail').val($$3('#rfq-email').val());
	        $$3('#sf-form #street').text($$3('#rfq-address-line-1').val() + ($$3('#rfq-address-line-2').val() ? "\r\n" + $$3('#rfq-address-line-2').val() : ''));
	        $$3('#sf-form #city').val($$3('#rfq-city').val());
	        $$3('#sf-form #state').val($$3('#rfq-state dt p').text());
	        $$3('#sf-form #country').val($$3('#rfq-country dt p').text());
	        $$3('#sf-form #zip').val($$3('#rfq-zip').val());
	        
	        // additional comments
	        $$3('#00N6g00000TtToE').text($$3('#rfq-notes').val());

	        // how they found us
	        $$3('#00N6g00000TtToG').val($$3('#find_us p').text());

	        // found us details - if "other" is selected
	        $$3('#00N6g00000U3avS').val($$3('#rfq-find-us-other').val());

	        // preferred method of contact
	        if ($$3('#how-to-contact p').text() != 'Preferred method of contact?') {
	          $$3('#00N6g00000TtToJ').val($$3('#how-to-contact p').text());
	        } else {
	          $$3('#00N6g00000TtToJ').val('Unspecified');
	        }

	        // product 1 name
	        if ($$3('#sf-product-1-name').length) {
	          if ($$3('#sf-product-1-name').text() != '') {
	            $$3('#00N6g00000VMFwG').val($$3('#sf-product-1-name').text());

	            // product 1 details
	            //console.log($('#product-1-using input[type="radio"]:checked').val());
	            $$3('#00N6g00000VMFwF').text($$3('#sf-product-1-qty').val() + "\r\n" + $$3('dl#product-units-1 dt p').text() + "\r\n" + $$3('#sf-product-1-attributes').text() + "\r\nCurrently Using: " + (($$3('#product-1-using input[type="radio"]:checked').val() == '1') ? 'Yes' : 'No') + "\r\nGeneral Application: " + $$3('.product-1-general-application').val());
	          } else {
	            $$3('#00N6g00000VMFwG').val('');
	            $$3('#00N6g00000VMFwF').text('');
	          }
	        } else {
	          $$3('#00N6g00000VMFwG').val('');
	          $$3('#00N6g00000VMFwF').text('');
	        }



	        // product 2 name
	        if ($$3('#sf-product-2-name').length) {
	          if ($$3('#sf-product-2-name').text() != '') {
	            $$3('#00N6g00000VMFwI').val($$3('#sf-product-2-name').text());

	            // product 2 details
	            $$3('#00N6g00000VMFwH').text($$3('#sf-product-2-qty').val() + "\r\n" + $$3('dl#product-units-2 dt p').text() + "\r\n" + $$3('#sf-product-2-attributes').text() + "\r\nCurrently Using: " + (($$3('#product-2-using input[type="radio"]:checked').val() == '1') ? 'Yes' : 'No') + "\r\nGeneral Application: " + $$3('.product-2-general-application').val());
	          } else {
	            $$3('#00N6g00000VMFwI').val('');
	            $$3('#00N6g00000VMFwH').text('');
	          }
	        } else {
	          $$3('#00N6g00000VMFwI').val('');
	          $$3('#00N6g00000VMFwH').text('');
	        }

	        // product 3 name
	        if ($$3('#sf-product-3-name').length) {
	          if ($$3('#sf-product-3-name').text() != '') {
	            $$3('#00N6g00000VMFwK').val($$3('#sf-product-3-name').text());

	            // product 3 details
	            $$3('#00N6g00000VMFwJ').text($$3('#sf-product-3-qty').val() + "\r\n" + $$3('dl#product-units-3 dt p').text() + "\r\n" + $$3('#sf-product-3-attributes').text() + "\r\nCurrently Using: " + (($$3('#product-3-using input[type="radio"]:checked').val() == '1') ? 'Yes' : 'No') + "\r\nGeneral Application: " + $$3('.product-3-general-application').val());
	          }else {
	            $$3('#00N6g00000VMFwK').val('');
	            $$3('#00N6g00000VMFwJ').text('');
	          }
	        } else {
	          $$3('#00N6g00000VMFwK').val('');
	          $$3('#00N6g00000VMFwJ').text('');
	        }

	        // product 4 name
	        if ($$3('#sf-product-4-name').length) {
	          if ($$3('#sf-product-4-name').text() != '') {
	            $$3('#00N6g00000VMFwM').val($$3('#sf-product-4-name').text());

	            // product 4 details
	            $$3('#00N6g00000VMFwL').text($$3('#sf-product-4-qty').val() + "\r\n" + $$3('dl#product-units-4 dt p').text() + "\r\n" + $$3('#sf-product-4-attributes').text() + "\r\nCurrently Using: " + (($$3('#product-4-using input[type="radio"]:checked').val() == '1') ? 'Yes' : 'No') + "\r\nGeneral Application: " + $$3('.product-4-general-application').val());
	          }else {
	            $$3('#00N6g00000VMFwM').val('');
	            $$3('#00N6g00000VMFwL').text('');
	          }
	        } else {
	          $$3('#00N6g00000VMFwM').val('');
	          $$3('#00N6g00000VMFwL').text('');
	        }

	        // product 5 name
	        if ($$3('#sf-product-5-name').length) {
	          if ($$3('#sf-product-5-name').text() != '') {
	            $$3('#00N6g00000VMFwO').val($$3('#sf-product-5-name').text());

	            // product 5 details
	            $$3('#00N6g00000VMFwN').text($$3('#sf-product-5-qty').val() + "\r\n" + $$3('dl#product-units-5 dt p').text() + "\r\n" + $$3('#sf-product-5-attributes').text() + "\r\nCurrently Using: " + (($$3('#product-5-using input[type="radio"]:checked').val() == '1') ? 'Yes' : 'No') + "\r\nGeneral Application: " + $$3('.product-5-general-application').val());
	          }else {
	            $$3('#00N6g00000VMFwO').val('');
	            $$3('#00N6g00000VMFwN').text('');
	          }
	        } else {
	          $$3('#00N6g00000VMFwO').val('');
	          $$3('#00N6g00000VMFwN').text('');
	        }

	        
	        return true;


	      }

	      

	      function disableForm() {
	        $$3('#piq-form-submit').prop('disabled', true);
	      }

	      function enableForm() {
	        $$3('#piq-form-submit').prop('disabled', false);
	      }
	      
	      $$3('#piq-itemized-rfq').on('submit', function(e) {
	          e.preventDefault();
	          disableForm();

	          if (validateRFQForm()) {
	            e.preventDefault();
	            

	            $$3('.rfq-error-message').hide();

	            // submit form
	            setTimeout(function() {
	              $$3('#piq-itemized-rfq').off('submit').submit();
	            }, 250);

	          } else {

	            let fields = $$3('.piq-form input:not([type="submit"])');
	            fields.each(function(index, element) {
	              $$3(element).removeClass('rfq-error');
	            });
	            $$3('#rfq-state').removeClass('rfq-error');
	            $$3('#rfq-country').removeClass('rfq-error');
	            $$3('#find_us').removeClass('rfq-error');
	            $$3('#rfq-tos').removeClass('rfq-error');
	            $$3('#how-to-contact').removeClass('rfq-error');
	            $$3('.general-application').removeClass('rfq-error');
	            $$3('.general-application-textarea').removeClass('rfq-error');
	            $$3('.rfq-using-yes').removeClass('rfq-error');
	            $$3('.rfq-using-no').removeClass('rfq-error');
	            $$3('.currently-using').removeClass('rfq-error');

	            errorFields.forEach(function(id) {
	              document.getElementById(id).classList.add('rfq-error');
	            });

	            enableForm();

	            if (window.innerWidth <= 768) {
	              if (document.getElementsByClassName('rfq-error').length) {
	                document.getElementsByClassName('rfq-error')[0].scrollIntoView();
	              }
	            }
	          }
	      });
	      
	    }

	    handleRFQSubmit();
	    handleRFQDropdown();
	    handleCurrentlyUsing();
	  }
	};

	function noop() { }
	function add_location(element, file, line, column, char) {
	    element.__svelte_meta = {
	        loc: { file, line, column, char }
	    };
	}
	function run(fn) {
	    return fn();
	}
	function blank_object() {
	    return Object.create(null);
	}
	function run_all(fns) {
	    fns.forEach(run);
	}
	function is_function(thing) {
	    return typeof thing === 'function';
	}
	function safe_not_equal(a, b) {
	    return a != a ? b == b : a !== b || ((a && typeof a === 'object') || typeof a === 'function');
	}
	function is_empty(obj) {
	    return Object.keys(obj).length === 0;
	}
	function append(target, node) {
	    target.appendChild(node);
	}
	function insert(target, node, anchor) {
	    target.insertBefore(node, anchor || null);
	}
	function detach(node) {
	    if (node.parentNode) {
	        node.parentNode.removeChild(node);
	    }
	}
	function destroy_each(iterations, detaching) {
	    for (let i = 0; i < iterations.length; i += 1) {
	        if (iterations[i])
	            iterations[i].d(detaching);
	    }
	}
	function element(name) {
	    return document.createElement(name);
	}
	function svg_element(name) {
	    return document.createElementNS('http://www.w3.org/2000/svg', name);
	}
	function text(data) {
	    return document.createTextNode(data);
	}
	function space() {
	    return text(' ');
	}
	function listen(node, event, handler, options) {
	    node.addEventListener(event, handler, options);
	    return () => node.removeEventListener(event, handler, options);
	}
	function attr(node, attribute, value) {
	    if (value == null)
	        node.removeAttribute(attribute);
	    else if (node.getAttribute(attribute) !== value)
	        node.setAttribute(attribute, value);
	}
	function children(element) {
	    return Array.from(element.childNodes);
	}
	function custom_event(type, detail, { bubbles = false, cancelable = false } = {}) {
	    const e = document.createEvent('CustomEvent');
	    e.initCustomEvent(type, bubbles, cancelable, detail);
	    return e;
	}

	let current_component;
	function set_current_component(component) {
	    current_component = component;
	}
	function get_current_component() {
	    if (!current_component)
	        throw new Error('Function called outside component initialization');
	    return current_component;
	}
	/**
	 * The `onMount` function schedules a callback to run as soon as the component has been mounted to the DOM.
	 * It must be called during the component's initialisation (but doesn't need to live *inside* the component;
	 * it can be called from an external module).
	 *
	 * `onMount` does not run inside a [server-side component](/docs#run-time-server-side-component-api).
	 *
	 * https://svelte.dev/docs#run-time-svelte-onmount
	 */
	function onMount(fn) {
	    get_current_component().$$.on_mount.push(fn);
	}

	const dirty_components = [];
	const binding_callbacks = [];
	const render_callbacks = [];
	const flush_callbacks = [];
	const resolved_promise = Promise.resolve();
	let update_scheduled = false;
	function schedule_update() {
	    if (!update_scheduled) {
	        update_scheduled = true;
	        resolved_promise.then(flush);
	    }
	}
	function add_render_callback(fn) {
	    render_callbacks.push(fn);
	}
	// flush() calls callbacks in this order:
	// 1. All beforeUpdate callbacks, in order: parents before children
	// 2. All bind:this callbacks, in reverse order: children before parents.
	// 3. All afterUpdate callbacks, in order: parents before children. EXCEPT
	//    for afterUpdates called during the initial onMount, which are called in
	//    reverse order: children before parents.
	// Since callbacks might update component values, which could trigger another
	// call to flush(), the following steps guard against this:
	// 1. During beforeUpdate, any updated components will be added to the
	//    dirty_components array and will cause a reentrant call to flush(). Because
	//    the flush index is kept outside the function, the reentrant call will pick
	//    up where the earlier call left off and go through all dirty components. The
	//    current_component value is saved and restored so that the reentrant call will
	//    not interfere with the "parent" flush() call.
	// 2. bind:this callbacks cannot trigger new flush() calls.
	// 3. During afterUpdate, any updated components will NOT have their afterUpdate
	//    callback called a second time; the seen_callbacks set, outside the flush()
	//    function, guarantees this behavior.
	const seen_callbacks = new Set();
	let flushidx = 0; // Do *not* move this inside the flush() function
	function flush() {
	    // Do not reenter flush while dirty components are updated, as this can
	    // result in an infinite loop. Instead, let the inner flush handle it.
	    // Reentrancy is ok afterwards for bindings etc.
	    if (flushidx !== 0) {
	        return;
	    }
	    const saved_component = current_component;
	    do {
	        // first, call beforeUpdate functions
	        // and update components
	        try {
	            while (flushidx < dirty_components.length) {
	                const component = dirty_components[flushidx];
	                flushidx++;
	                set_current_component(component);
	                update(component.$$);
	            }
	        }
	        catch (e) {
	            // reset dirty state to not end up in a deadlocked state and then rethrow
	            dirty_components.length = 0;
	            flushidx = 0;
	            throw e;
	        }
	        set_current_component(null);
	        dirty_components.length = 0;
	        flushidx = 0;
	        while (binding_callbacks.length)
	            binding_callbacks.pop()();
	        // then, once components are updated, call
	        // afterUpdate functions. This may cause
	        // subsequent updates...
	        for (let i = 0; i < render_callbacks.length; i += 1) {
	            const callback = render_callbacks[i];
	            if (!seen_callbacks.has(callback)) {
	                // ...so guard against infinite loops
	                seen_callbacks.add(callback);
	                callback();
	            }
	        }
	        render_callbacks.length = 0;
	    } while (dirty_components.length);
	    while (flush_callbacks.length) {
	        flush_callbacks.pop()();
	    }
	    update_scheduled = false;
	    seen_callbacks.clear();
	    set_current_component(saved_component);
	}
	function update($$) {
	    if ($$.fragment !== null) {
	        $$.update();
	        run_all($$.before_update);
	        const dirty = $$.dirty;
	        $$.dirty = [-1];
	        $$.fragment && $$.fragment.p($$.ctx, dirty);
	        $$.after_update.forEach(add_render_callback);
	    }
	}
	const outroing = new Set();
	function transition_in(block, local) {
	    if (block && block.i) {
	        outroing.delete(block);
	        block.i(local);
	    }
	}

	const globals = (typeof window !== 'undefined'
	    ? window
	    : typeof globalThis !== 'undefined'
	        ? globalThis
	        : global);
	function mount_component(component, target, anchor, customElement) {
	    const { fragment, after_update } = component.$$;
	    fragment && fragment.m(target, anchor);
	    if (!customElement) {
	        // onMount happens before the initial afterUpdate
	        add_render_callback(() => {
	            const new_on_destroy = component.$$.on_mount.map(run).filter(is_function);
	            // if the component was destroyed immediately
	            // it will update the `$$.on_destroy` reference to `null`.
	            // the destructured on_destroy may still reference to the old array
	            if (component.$$.on_destroy) {
	                component.$$.on_destroy.push(...new_on_destroy);
	            }
	            else {
	                // Edge case - component was destroyed immediately,
	                // most likely as a result of a binding initialising
	                run_all(new_on_destroy);
	            }
	            component.$$.on_mount = [];
	        });
	    }
	    after_update.forEach(add_render_callback);
	}
	function destroy_component(component, detaching) {
	    const $$ = component.$$;
	    if ($$.fragment !== null) {
	        run_all($$.on_destroy);
	        $$.fragment && $$.fragment.d(detaching);
	        // TODO null out other refs, including component.$$ (but need to
	        // preserve final state?)
	        $$.on_destroy = $$.fragment = null;
	        $$.ctx = [];
	    }
	}
	function make_dirty(component, i) {
	    if (component.$$.dirty[0] === -1) {
	        dirty_components.push(component);
	        schedule_update();
	        component.$$.dirty.fill(0);
	    }
	    component.$$.dirty[(i / 31) | 0] |= (1 << (i % 31));
	}
	function init(component, options, instance, create_fragment, not_equal, props, append_styles, dirty = [-1]) {
	    const parent_component = current_component;
	    set_current_component(component);
	    const $$ = component.$$ = {
	        fragment: null,
	        ctx: [],
	        // state
	        props,
	        update: noop,
	        not_equal,
	        bound: blank_object(),
	        // lifecycle
	        on_mount: [],
	        on_destroy: [],
	        on_disconnect: [],
	        before_update: [],
	        after_update: [],
	        context: new Map(options.context || (parent_component ? parent_component.$$.context : [])),
	        // everything else
	        callbacks: blank_object(),
	        dirty,
	        skip_bound: false,
	        root: options.target || parent_component.$$.root
	    };
	    append_styles && append_styles($$.root);
	    let ready = false;
	    $$.ctx = instance
	        ? instance(component, options.props || {}, (i, ret, ...rest) => {
	            const value = rest.length ? rest[0] : ret;
	            if ($$.ctx && not_equal($$.ctx[i], $$.ctx[i] = value)) {
	                if (!$$.skip_bound && $$.bound[i])
	                    $$.bound[i](value);
	                if (ready)
	                    make_dirty(component, i);
	            }
	            return ret;
	        })
	        : [];
	    $$.update();
	    ready = true;
	    run_all($$.before_update);
	    // `false` as a special case of no DOM component
	    $$.fragment = create_fragment ? create_fragment($$.ctx) : false;
	    if (options.target) {
	        if (options.hydrate) {
	            const nodes = children(options.target);
	            // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
	            $$.fragment && $$.fragment.l(nodes);
	            nodes.forEach(detach);
	        }
	        else {
	            // eslint-disable-next-line @typescript-eslint/no-non-null-assertion
	            $$.fragment && $$.fragment.c();
	        }
	        if (options.intro)
	            transition_in(component.$$.fragment);
	        mount_component(component, options.target, options.anchor, options.customElement);
	        flush();
	    }
	    set_current_component(parent_component);
	}
	/**
	 * Base class for Svelte components. Used when dev=false.
	 */
	class SvelteComponent {
	    $destroy() {
	        destroy_component(this, 1);
	        this.$destroy = noop;
	    }
	    $on(type, callback) {
	        if (!is_function(callback)) {
	            return noop;
	        }
	        const callbacks = (this.$$.callbacks[type] || (this.$$.callbacks[type] = []));
	        callbacks.push(callback);
	        return () => {
	            const index = callbacks.indexOf(callback);
	            if (index !== -1)
	                callbacks.splice(index, 1);
	        };
	    }
	    $set($$props) {
	        if (this.$$set && !is_empty($$props)) {
	            this.$$.skip_bound = true;
	            this.$$set($$props);
	            this.$$.skip_bound = false;
	        }
	    }
	}

	function dispatch_dev(type, detail) {
	    document.dispatchEvent(custom_event(type, Object.assign({ version: '3.55.1' }, detail), { bubbles: true }));
	}
	function append_dev(target, node) {
	    dispatch_dev('SvelteDOMInsert', { target, node });
	    append(target, node);
	}
	function insert_dev(target, node, anchor) {
	    dispatch_dev('SvelteDOMInsert', { target, node, anchor });
	    insert(target, node, anchor);
	}
	function detach_dev(node) {
	    dispatch_dev('SvelteDOMRemove', { node });
	    detach(node);
	}
	function listen_dev(node, event, handler, options, has_prevent_default, has_stop_propagation) {
	    const modifiers = options === true ? ['capture'] : options ? Array.from(Object.keys(options)) : [];
	    if (has_prevent_default)
	        modifiers.push('preventDefault');
	    if (has_stop_propagation)
	        modifiers.push('stopPropagation');
	    dispatch_dev('SvelteDOMAddEventListener', { node, event, handler, modifiers });
	    const dispose = listen(node, event, handler, options);
	    return () => {
	        dispatch_dev('SvelteDOMRemoveEventListener', { node, event, handler, modifiers });
	        dispose();
	    };
	}
	function attr_dev(node, attribute, value) {
	    attr(node, attribute, value);
	    if (value == null)
	        dispatch_dev('SvelteDOMRemoveAttribute', { node, attribute });
	    else
	        dispatch_dev('SvelteDOMSetAttribute', { node, attribute, value });
	}
	function set_data_dev(text, data) {
	    data = '' + data;
	    if (text.wholeText === data)
	        return;
	    dispatch_dev('SvelteDOMSetData', { node: text, data });
	    text.data = data;
	}
	function validate_each_argument(arg) {
	    if (typeof arg !== 'string' && !(arg && typeof arg === 'object' && 'length' in arg)) {
	        let msg = '{#each} only iterates over array-like objects.';
	        if (typeof Symbol === 'function' && arg && Symbol.iterator in arg) {
	            msg += ' You can use a spread to convert this iterable into an array.';
	        }
	        throw new Error(msg);
	    }
	}
	function validate_slots(name, slot, keys) {
	    for (const slot_key of Object.keys(slot)) {
	        if (!~keys.indexOf(slot_key)) {
	            console.warn(`<${name}> received an unexpected slot "${slot_key}".`);
	        }
	    }
	}
	/**
	 * Base class for Svelte components with some minor dev-enhancements. Used when dev=true.
	 */
	class SvelteComponentDev extends SvelteComponent {
	    constructor(options) {
	        if (!options || (!options.target && !options.$$inline)) {
	            throw new Error("'target' is a required option");
	        }
	        super();
	    }
	    $destroy() {
	        super.$destroy();
	        this.$destroy = () => {
	            console.warn('Component was already destroyed'); // eslint-disable-line no-console
	        };
	    }
	    $capture_state() { }
	    $inject_state() { }
	}

	/* src/components/calculator.svelte generated by Svelte v3.55.1 */

	const { console: console_1 } = globals;
	const file = "src/components/calculator.svelte";

	function get_each_context(ctx, list, i) {
		const child_ctx = ctx.slice();
		child_ctx[5] = list[i];
		child_ctx[7] = i;
		return child_ctx;
	}

	function get_each_context_1(ctx, list, i) {
		const child_ctx = ctx.slice();
		child_ctx[8] = list[i];
		child_ctx[10] = i;
		return child_ctx;
	}

	function get_each_context_2(ctx, list, i) {
		const child_ctx = ctx.slice();
		child_ctx[11] = list[i];
		child_ctx[13] = i;
		return child_ctx;
	}

	// (62:2) {#if content.btn}
	function create_if_block(ctx) {
		let a;
		let span;

		const block = {
			c: function create() {
				a = element("a");
				span = element("span");
				span.textContent = `${/*content*/ ctx[1].btn.title}`;
				add_location(span, file, 63, 4, 1785);
				attr_dev(a, "href", /*content*/ ctx[1].btn);
				attr_dev(a, "class", "btn");
				attr_dev(a, "target", /*content*/ ctx[1].btn.target);
				add_location(a, file, 62, 3, 1718);
			},
			m: function mount(target, anchor) {
				insert_dev(target, a, anchor);
				append_dev(a, span);
			},
			p: noop,
			d: function destroy(detaching) {
				if (detaching) detach_dev(a);
			}
		};

		dispatch_dev("SvelteRegisterBlock", {
			block,
			id: create_if_block.name,
			type: "if",
			source: "(62:2) {#if content.btn}",
			ctx
		});

		return block;
	}

	// (109:9) {#each dd.values as entry, idx}
	function create_each_block_2(ctx) {
		let button;
		let t0_value = /*entry*/ ctx[11].value + "";
		let t0;
		let t1;
		let mounted;
		let dispose;

		function click_handler() {
			return /*click_handler*/ ctx[3](/*idx*/ ctx[13]);
		}

		const block = {
			c: function create() {
				button = element("button");
				t0 = text(t0_value);
				t1 = space();
				attr_dev(button, "class", "whitespace-nowrap flex items-center gap-x-3.5 py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-blue-500 _dark:text-gray-400 _dark:hover:bg-gray-700 _dark:hover:text-gray-300");
				attr_dev(button, "data-idx", /*idx*/ ctx[13]);
				add_location(button, file, 109, 10, 3924);
			},
			m: function mount(target, anchor) {
				insert_dev(target, button, anchor);
				append_dev(button, t0);
				append_dev(button, t1);

				if (!mounted) {
					dispose = listen_dev(button, "click", click_handler, false, false, false);
					mounted = true;
				}
			},
			p: function update(new_ctx, dirty) {
				ctx = new_ctx;
			},
			d: function destroy(detaching) {
				if (detaching) detach_dev(button);
				mounted = false;
				dispose();
			}
		};

		dispatch_dev("SvelteRegisterBlock", {
			block,
			id: create_each_block_2.name,
			type: "each",
			source: "(109:9) {#each dd.values as entry, idx}",
			ctx
		});

		return block;
	}

	// (73:5) {#each group['dropdowns'] as dd, colidx}
	function create_each_block_1(ctx) {
		let div2;
		let h4;
		let t0_value = /*dd*/ ctx[8].label + "";
		let t0;
		let t1;
		let div1;
		let button;

		let t2_value = (/*activeIdx*/ ctx[0] > -1
		? /*dd*/ ctx[8].values.length > /*activeIdx*/ ctx[0]
			? /*dd*/ ctx[8].values[/*activeIdx*/ ctx[0]]['value']
			: 'N/A'
		: 'Actions') + "";

		let t2;
		let t3;
		let svg;
		let path;
		let t4;
		let div0;
		let t5;
		let each_value_2 = /*dd*/ ctx[8].values;
		validate_each_argument(each_value_2);
		let each_blocks = [];

		for (let i = 0; i < each_value_2.length; i += 1) {
			each_blocks[i] = create_each_block_2(get_each_context_2(ctx, each_value_2, i));
		}

		const block = {
			c: function create() {
				div2 = element("div");
				h4 = element("h4");
				t0 = text(t0_value);
				t1 = space();
				div1 = element("div");
				button = element("button");
				t2 = text(t2_value);
				t3 = space();
				svg = svg_element("svg");
				path = svg_element("path");
				t4 = space();
				div0 = element("div");

				for (let i = 0; i < each_blocks.length; i += 1) {
					each_blocks[i].c();
				}

				t5 = space();
				add_location(h4, file, 74, 7, 2063);
				attr_dev(path, "d", "M2 5L8.16086 10.6869C8.35239 10.8637 8.64761 10.8637 8.83914 10.6869L15 5");
				attr_dev(path, "stroke", "currentColor");
				attr_dev(path, "stroke-width", "2");
				attr_dev(path, "stroke-linecap", "round");
				add_location(path, file, 95, 10, 3157);
				attr_dev(svg, "aria-hidden", "true");
				attr_dev(svg, "class", "hs-dropdown-open:rotate-180 w-2.5 h-2.5 text-gray-600");
				attr_dev(svg, "width", "16");
				attr_dev(svg, "height", "16");
				attr_dev(svg, "viewBox", "0 0 16 16");
				attr_dev(svg, "fill", "none");
				attr_dev(svg, "xmlns", "http://www.w3.org/2000/svg");
				add_location(svg, file, 86, 9, 2890);
				attr_dev(button, "id", "hs-dropdown-hover-event");
				attr_dev(button, "type", "button");
				attr_dev(button, "class", "hs-dropdown-toggle py-3 px-4 inline-flex justify-center items-center gap-2 rounded-md border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm _dark:bg-slate-900 _dark:hover:bg-slate-800 _dark:border-gray-700 _dark:text-gray-400 _dark:hover:text-white _dark:focus:ring-offset-gray-800 border-[var(--primary-500-main, #009FC6)]");
				add_location(button, file, 76, 8, 2163);
				attr_dev(div0, "class", "hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 _opacity-0 block absolute top-full min-w-[15rem] bg-white shadow-md rounded-lg p-2 mt-2 _dark:bg-gray-800 _dark:border _dark:border-gray-700 _dark:divide-gray-700 after:h-4 after:absolute after:-bottom-4 after:left-0 after:w-full before:h-4 before:absolute before:-top-4 before:left-0 before:w-full z-50");
				attr_dev(div0, "aria-labelledby", "hs-dropdown-hover-event");
				add_location(div0, file, 104, 8, 3403);
				attr_dev(div1, "class", "hs-dropdown relative inline-flex [--trigger:hover]");
				add_location(div1, file, 75, 7, 2090);
				add_location(div2, file, 73, 6, 2050);
			},
			m: function mount(target, anchor) {
				insert_dev(target, div2, anchor);
				append_dev(div2, h4);
				append_dev(h4, t0);
				append_dev(div2, t1);
				append_dev(div2, div1);
				append_dev(div1, button);
				append_dev(button, t2);
				append_dev(button, t3);
				append_dev(button, svg);
				append_dev(svg, path);
				append_dev(div1, t4);
				append_dev(div1, div0);

				for (let i = 0; i < each_blocks.length; i += 1) {
					each_blocks[i].m(div0, null);
				}

				append_dev(div2, t5);
			},
			p: function update(ctx, dirty) {
				if (dirty & /*activeIdx*/ 1 && t2_value !== (t2_value = (/*activeIdx*/ ctx[0] > -1
				? /*dd*/ ctx[8].values.length > /*activeIdx*/ ctx[0]
					? /*dd*/ ctx[8].values[/*activeIdx*/ ctx[0]]['value']
					: 'N/A'
				: 'Actions') + "")) set_data_dev(t2, t2_value);

				if (dirty & /*activeIdx, groups*/ 5) {
					each_value_2 = /*dd*/ ctx[8].values;
					validate_each_argument(each_value_2);
					let i;

					for (i = 0; i < each_value_2.length; i += 1) {
						const child_ctx = get_each_context_2(ctx, each_value_2, i);

						if (each_blocks[i]) {
							each_blocks[i].p(child_ctx, dirty);
						} else {
							each_blocks[i] = create_each_block_2(child_ctx);
							each_blocks[i].c();
							each_blocks[i].m(div0, null);
						}
					}

					for (; i < each_blocks.length; i += 1) {
						each_blocks[i].d(1);
					}

					each_blocks.length = each_value_2.length;
				}
			},
			d: function destroy(detaching) {
				if (detaching) detach_dev(div2);
				destroy_each(each_blocks, detaching);
			}
		};

		dispatch_dev("SvelteRegisterBlock", {
			block,
			id: create_each_block_1.name,
			type: "each",
			source: "(73:5) {#each group['dropdowns'] as dd, colidx}",
			ctx
		});

		return block;
	}

	// (69:2) {#each groups as group, rowidx}
	function create_each_block(ctx) {
		let div1;
		let h3;
		let t0_value = /*group*/ ctx[5].label + "";
		let t0;
		let t1;
		let div0;
		let t2;
		let each_value_1 = /*group*/ ctx[5]['dropdowns'];
		validate_each_argument(each_value_1);
		let each_blocks = [];

		for (let i = 0; i < each_value_1.length; i += 1) {
			each_blocks[i] = create_each_block_1(get_each_context_1(ctx, each_value_1, i));
		}

		const block = {
			c: function create() {
				div1 = element("div");
				h3 = element("h3");
				t0 = text(t0_value);
				t1 = space();
				div0 = element("div");

				for (let i = 0; i < each_blocks.length; i += 1) {
					each_blocks[i].c();
				}

				t2 = space();
				add_location(h3, file, 70, 4, 1944);
				attr_dev(div0, "class", "flex gap-x-6");
				add_location(div0, file, 71, 4, 1971);
				add_location(div1, file, 69, 3, 1934);
			},
			m: function mount(target, anchor) {
				insert_dev(target, div1, anchor);
				append_dev(div1, h3);
				append_dev(h3, t0);
				append_dev(div1, t1);
				append_dev(div1, div0);

				for (let i = 0; i < each_blocks.length; i += 1) {
					each_blocks[i].m(div0, null);
				}

				append_dev(div1, t2);
			},
			p: function update(ctx, dirty) {
				if (dirty & /*groups, activeIdx*/ 5) {
					each_value_1 = /*group*/ ctx[5]['dropdowns'];
					validate_each_argument(each_value_1);
					let i;

					for (i = 0; i < each_value_1.length; i += 1) {
						const child_ctx = get_each_context_1(ctx, each_value_1, i);

						if (each_blocks[i]) {
							each_blocks[i].p(child_ctx, dirty);
						} else {
							each_blocks[i] = create_each_block_1(child_ctx);
							each_blocks[i].c();
							each_blocks[i].m(div0, null);
						}
					}

					for (; i < each_blocks.length; i += 1) {
						each_blocks[i].d(1);
					}

					each_blocks.length = each_value_1.length;
				}
			},
			d: function destroy(detaching) {
				if (detaching) detach_dev(div1);
				destroy_each(each_blocks, detaching);
			}
		};

		dispatch_dev("SvelteRegisterBlock", {
			block,
			id: create_each_block.name,
			type: "each",
			source: "(69:2) {#each groups as group, rowidx}",
			ctx
		});

		return block;
	}

	function create_fragment(ctx) {
		let section;
		let div0;
		let h2;
		let t1;
		let p;
		let t3;
		let t4;
		let div1;
		let if_block = /*content*/ ctx[1].btn && create_if_block(ctx);
		let each_value = /*groups*/ ctx[2];
		validate_each_argument(each_value);
		let each_blocks = [];

		for (let i = 0; i < each_value.length; i += 1) {
			each_blocks[i] = create_each_block(get_each_context(ctx, each_value, i));
		}

		const block = {
			c: function create() {
				section = element("section");
				div0 = element("div");
				h2 = element("h2");
				h2.textContent = `${/*content*/ ctx[1].heading}`;
				t1 = space();
				p = element("p");
				p.textContent = `${/*content*/ ctx[1].content}`;
				t3 = space();
				if (if_block) if_block.c();
				t4 = space();
				div1 = element("div");

				for (let i = 0; i < each_blocks.length; i += 1) {
					each_blocks[i].c();
				}

				add_location(h2, file, 59, 2, 1641);
				add_location(p, file, 60, 2, 1670);
				attr_dev(div0, "class", "calculator--content");
				add_location(div0, file, 58, 1, 1605);
				attr_dev(div1, "class", "calculator--wrap flex flex-wrap gap-x-6");
				add_location(div1, file, 67, 1, 1843);
				attr_dev(section, "class", "calculator");
				add_location(section, file, 57, 0, 1575);
			},
			l: function claim(nodes) {
				throw new Error("options.hydrate only works if the component was compiled with the `hydratable: true` option");
			},
			m: function mount(target, anchor) {
				insert_dev(target, section, anchor);
				append_dev(section, div0);
				append_dev(div0, h2);
				append_dev(div0, t1);
				append_dev(div0, p);
				append_dev(div0, t3);
				if (if_block) if_block.m(div0, null);
				append_dev(section, t4);
				append_dev(section, div1);

				for (let i = 0; i < each_blocks.length; i += 1) {
					each_blocks[i].m(div1, null);
				}
			},
			p: function update(ctx, [dirty]) {
				if (/*content*/ ctx[1].btn) if_block.p(ctx, dirty);

				if (dirty & /*groups, activeIdx*/ 5) {
					each_value = /*groups*/ ctx[2];
					validate_each_argument(each_value);
					let i;

					for (i = 0; i < each_value.length; i += 1) {
						const child_ctx = get_each_context(ctx, each_value, i);

						if (each_blocks[i]) {
							each_blocks[i].p(child_ctx, dirty);
						} else {
							each_blocks[i] = create_each_block(child_ctx);
							each_blocks[i].c();
							each_blocks[i].m(div1, null);
						}
					}

					for (; i < each_blocks.length; i += 1) {
						each_blocks[i].d(1);
					}

					each_blocks.length = each_value.length;
				}
			},
			i: noop,
			o: noop,
			d: function destroy(detaching) {
				if (detaching) detach_dev(section);
				if (if_block) if_block.d();
				destroy_each(each_blocks, detaching);
			}
		};

		dispatch_dev("SvelteRegisterBlock", {
			block,
			id: create_fragment.name,
			type: "component",
			source: "",
			ctx
		});

		return block;
	}

	function instance($$self, $$props, $$invalidate) {
		let { $$slots: slots = {}, $$scope } = $$props;
		validate_slots('Calculator', slots, []);
		let activeIdx = -1;

		const testData = [
			//rows of columns/values
			[1, 2, 3, 4, 5, 6, 7, 8, 9],
			[2, 3, 4, 5, 6, 7, 8, 9, 10],
			[3, 4, 5, 6, 7, 8, 9, 10, 11],
			[4, 5, 6, 7, 8, 9, 10, 11, 12]
		];

		if (!calculatorData.btn.target) {
			calculatorData.btn.target = '_self';
		}

		const content = calculatorData;
		const groups = calculatorData.dropdown_groups;

		onMount(() => {
			document.querySelectorAll('.hs-dropdown-toggle').forEach(el => el.addEventListener('click', e => {
				e.preventDefault();

				// console.log(e.target)
				// console.log(e.target.parentNode.querySelector('.hs-dropdown-menu'))
				// console.log(e.target.parentNode.querySelector('.hs-dropdown-menu').classList.contains('.hs-dropdown-open'))
				window.$('.hs-dropdown-menu').removeClass('hs-dropdown-open');

				// console.log(
				// 	e.target.parentNode //.querySelector('.hs-dropdown-menu').classList
				// )
				e.target.parentNode.querySelector('.hs-dropdown-menu').classList.toggle('hs-dropdown-open');
			})); // console.log(
			// 	e.target.parentNode
			// 		.querySelector('.hs-dropdown-menu')
			// 		.classList.contains('.hs-dropdown-open')
			// )

			//close on blur
			window.addEventListener('click', function (e) {
				if (!e.target.closest('.hs-dropdown')) {
					window.$('.hs-dropdown-menu').removeClass('hs-dropdown-open');
				}
			});
		});

		const writable_props = [];

		Object.keys($$props).forEach(key => {
			if (!~writable_props.indexOf(key) && key.slice(0, 2) !== '$$' && key !== 'slot') console_1.warn(`<Calculator> was created with unknown prop '${key}'`);
		});

		const click_handler = idx => $$invalidate(0, activeIdx = idx);

		$$self.$capture_state = () => ({
			onMount,
			activeIdx,
			testData,
			content,
			groups
		});

		$$self.$inject_state = $$props => {
			if ('activeIdx' in $$props) $$invalidate(0, activeIdx = $$props.activeIdx);
		};

		if ($$props && "$$inject" in $$props) {
			$$self.$inject_state($$props.$$inject);
		}

		console.log(calculatorData); //TODO multiple?
		return [activeIdx, content, groups, click_handler];
	}

	class Calculator extends SvelteComponentDev {
		constructor(options) {
			super(options);
			init(this, options, instance, create_fragment, safe_not_equal, {});

			dispatch_dev("SvelteRegisterComponent", {
				component: this,
				tagName: "Calculator",
				options,
				id: create_fragment.name
			});
		}
	}

	const { $: $$2 } = window;
	$$2(document.body);


	var pageId103 = {
	   init() {
	      const calculator = document.querySelector('#calculator-wrap');
	      if( calculator ) {
	         new Calculator({
	            target: calculator,
	            props: $$2(calculator).data()
	         });
	      }
	   },
	   finalize() {

	   },
	};

	const { $: $$1 } = window;
	$$1(document.body);

	var search = {
	    init() {
	        
	    },
	    finalize() {

	        if ($$1('.site-search-result').length) {

	            let resultsPerPage = 10;
	            let visibleResults = resultsPerPage;

	            if ($$1('.site-search-result-container').length > resultsPerPage) {
	                $$1('#site-search-load-more').show().css('display', 'flex');
	            }

	            $$1('.site-search-result-container:lt(' + visibleResults + ')').fadeIn();

	            $$1('#site-search-load-more').on('click', function() {
	                visibleResults += resultsPerPage;

	                $$1('.site-search-result-container:lt(' + visibleResults + ')').fadeIn();

	                if (visibleResults >= $$1('.site-search-result-container').length) {
	                    $$1('#site-search-load-more').hide();
	                }
	            });
	        }

	        $$1('#site-search-filter ul li').on('click', function() {
	            const searchParams = new URLSearchParams(window.location.search);
	            document.location.href = '/?s=' + searchParams.get('s') + '&type=' + $$1(this).data('key');
	            return;
	        });
	    },
	};

	// match unique body_class

	/**
	 * Populate Router instance with DOM routes
	 * @type {Router} routes - An instance of our router
	 */
	const routes = new Router({
	  common,
	  customProductRfqForm,
	  single,
	  pageTemplateLegal,
	  frontPage,
	  history: history$1,
	  singleProduct,
	  itemizedRfq,
	  pageId103,
	  search
	});

	/** Load Events */
	routes.loadEvents();

})();
//# sourceMappingURL=bundle.js.map
