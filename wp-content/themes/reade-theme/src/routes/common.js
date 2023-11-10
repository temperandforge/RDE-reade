// import bigpicture from 'bigpicture'
import lozad from 'lozad'

import { runFunctions } from './_functions'
import { runBlocks } from './_blocks'

const { $ } = window
const $body = $(document.body)

export default {
	init() {
		// new PerformanceObserver((entryList) => {
		// 	for (const entry of entryList.getEntriesByName('first-contentful-paint')) {
		// 	  console.log('FCP candidate:', entry.startTime, entry);
		// 	}
		//  }).observe({type: 'paint', buffered: true});

		const observer = lozad('img')
		observer.observe()
		$('.hero img, .primary-hero--figure img').attr('loading', 'eager')

		runFunctions()
		runBlocks()
		// runIO()
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
		// class to hide outlines if not using keyboard
		$body.on('mousedown', function () {
			$body.addClass('using-mouse')
		})
		$body.on('keydown', function () {
			$body.removeClass('using-mouse')
		})

		if (document.body.classList.contains('custom-product-rfq-form')) {
			document.addEventListener(
				'wpcf7mailsent',
				function (event) {
					//location = '/itemized-rfq-form-success/';
				},
				false
			)
		}

		$('.header-links li a, .footer-links-list li a').on('click', function (e) {
			if ($(this).attr('href') == '#') {
				e.preventDefault()
			}
		})

		function handleSiteSearch() {
			if ($('#header-site-search').length) {
				$('#header-site-search').on('submit', function() {
					if ($('#desktop_search').length) {
						if ($('#desktop_search').val().trim() == '') {
							return false;
						}
					}
				})
			}
		}

		handleSiteSearch()

		let elementsPerPage
		let categoryType = '.pab-category'
		let searchLoaded = false
		let currentPage = 1
		let totalElements = $(categoryType).length
		let initialLoad = true
		// hold ajax data until search is performed
		let ajaxData = false;
		// control variable to tell if contents have been loaded in dom
		let ajaxContentsLoaded = false;

		function showElements(startIndex, endIndex) {
			$(categoryType).hide()
			let pabs = $(categoryType).slice(startIndex, endIndex)
			pabs.each(function () {
				$(this).fadeIn(250).css('display', 'block')
			})
		}

		function updatePaginationButtons() {
			$('.prev-btn').prop('disabled', currentPage === 1)
			$('.next-btn').prop(
				'disabled',
				currentPage === Math.ceil(totalElements / elementsPerPage)
			)
		}

		

		function updateDots(create = false, noSearchResults) {
			let pages = Math.ceil($(categoryType).length / elementsPerPage)
			$('.pab-pagination-dots').html('')

			for (let i = 0; i < pages; i++) {
				$('.pab-pagination-dots').append(
					'<a class="nav-dots" data-dot-page="' + (i + 1) + '" href="javascript: void(0);"><svg ' +
						(i + 1 == currentPage
							? 'class="pab-pagination-dot-current" '
							: '') +
						'width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5.74709" cy="5.9999" r="5.24416" stroke="#009FC6"></circle></svg></a>'
				)
			}

			totalElements = $(categoryType).length
			updatePaginationButtons()

			if (pages <= 1) {
				$('.pab-pagination').hide()
			} else {
				$('.pab-pagination').show()
			}

			if (!initialLoad) {

				if (document.body.classList.contains('products')) {
					document.getElementById('search_load').scrollIntoView();
				} else {
					if (document.getElementsByClassName('pab-filters')) {
						if (noSearchResults) {
							document
								.getElementsByClassName('pab-filters')[0]
								.scrollIntoView(true)
						}
					}
				}
			}

			initialLoad = false

			function updatePageHash(page) {
				window.location.hash = 'page-' + page;
			}

			$('.nav-dots').on('click', function() {
				let thisdotpage = $(this).data('dot-page');

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
			if ($('.news-featured').length) {
				if ($('.tf-dropdown').length) {
					$('.tf-dropdown ul li').on('click', function () {
						document.location.href = $(this).data('key')
					})
				}
			}
		}

		/**
		 * News/archive page, view more functionality
		 */
		// this variable needs to be global
		let cardsPerPage

		function handleNewsCardPagination() {
			// if you change these values, also change the window.onresize() values
			if (window.innerWidth < 769) {
				cardsPerPage = 3
			} else {
				cardsPerPage = 6
			}

			let $cards = $('.news-card-regular')
			let totalCards = $cards.length
			let cardsToShow = Math.min(cardsPerPage, totalCards)
			let shownCards = cardsToShow

			if ($('.view-more').length) {
				$cards.slice(cardsToShow, totalCards).hide()

				if (totalCards <= cardsPerPage) {
					$('#view-more').hide()
				} else {
					$('#view-more').show()
				}

				$('#view-more').click(function () {
					cardsToShow += cardsPerPage
					$cards.slice(shownCards, cardsToShow).fadeIn()
					shownCards = cardsToShow

					if (shownCards >= totalCards) {
						$('#view-more').hide()
					}
				})
			}
		}

		/*
		 * news single share positioning
		 */
		function handleNewsSharePosition() {
			if (window.innerWidth > 1024) {
				if ($('#single-share').length) {
					var parentContainer = $('#single-container')
					var childElement = $('#single-news-content')
					$('#single-share').css(
						'top',
						childElement.offset().top - parentContainer.offset().top
					)
				}
			}
		}

		/** WOOCOMMERCE JS **/
		function handleSingleProductDropdown() {
			$(
				'body.single-product #select1 ul li, body.single-product #select2 ul li'
			).on('click', function () {
				// see if we are processing select 1, if so, reset "variant" attribute
				if (
					$(this).parent().parent().parent().parent().attr('id') == 'select1'
				) {
					$('.submitted_product_1_variant').val('')
					$('#product-rfq-select-' + $(this).data('key') + ' p').text(
						'Select ' +
							$('#product-' + $(this).data('key') + '-attribute-name').val()
					)
					//$('#product-rfq-select-' + $(this).data('key') + ' p').text('SELECT MEEE');
				}

				// hide all
				$('.product-rfq-select').addClass('tf-dropdown-hidden')

				// show relevant select box
				$('#product-rfq-select-' + $(this).data('key')).removeClass(
					'tf-dropdown-hidden'
				)

				// update submitted product hidden input
				if ($('#submitted_product_1').length) {
					$('#submitted_product_1').val($(this).data('key'))
					$('.submitted_product_1_variant').attr(
						'id',
						'product-' + $(this).data('key') + '-variant'
					)
				}

				// show relevant select box
				if ($('#product-rfq-select-' + $(this).data('key')).length) {
					if (
						$('#product-rfq-select-' + $(this).data('key'))
							.find('dt p')
							.html()
							.toLowerCase() != '' &&
						$('#product-rfq-select-' + $(this).data('key'))
							.find('ul li')
							.html()
							.toLowerCase() == 'no options'
					) {
						$('#product-rfq-select-' + $(this).data('key'))
							.find('ul li')
							.click()
						$('#product-rfq-select-' + $(this).data('key')).addClass(
							'tf-dropdown-hidden-with-value'
						)
						$(this).focus()
						$(this).parent().click()
					}
				}
			})
		}

		function handleSingleRFQDropdown() {
			$('body.single-product ul li').on('click', function () {
				let parent = $(this)
					.parent()
					.parent()
					.parent()
					.parent()
					.attr('id')
					.replace('product-rfq-select-', '')
				$('#product-' + parent + '-variant').val($(this).data('key'))
			})
		}

		function handleSingleQTYUnits() {
			if ($('#product-units').length) {
				$('#product-units ul li').on('click', function () {
					$('#product-qty-units').val($(this).data('key'))
				})
			}
		}

		function validateRFQForm(product_data) {
			let error_msg = ''

			/* Simple product */
			if (product_data.product_type == 'skip_crosssell') {
				if (product_data.product_1_variant == '') {
					error_msg =
						'Please select ' +
						product_data.product_1_attribute_name.toLowerCase()
				} else {
					if (isNaN(product_data.product_qty)) {
						error_msg = 'Please select quantity'
					}
				}
			}

			/* Multiple attributes, OR */
			if (product_data.product_type == 'multiple_attributes_or') {
				// count visible selection dropdowns
				let visible_count = $('.product-rfq-select:visible').length

				if (visible_count === 0) {
					error_msg = 'Please select specification'
				} else {
					if (product_data.product_1_variant == '') {
						error_msg =
							'Please select ' +
							$('#product-' + product_data.product_1 + '-attribute-name')
								.val()
								.toLowerCase()
					} else {
						if (isNaN(product_data.product_qty)) {
							error_msg = 'Please select quantity'
						}
					}
				}
			}

			/* Multiple attributes, AND */
			if (product_data.product_type == 'multiple_attributes_and') {
				if (product_data.product_1_variant == '') {
					error_msg =
						'Please select ' +
						$('#product-' + product_data.product_1 + '-attribute-name')
							.val()
							.toLowerCase()
				} else {
					if (product_data.product_2_variant == '') {
						error_msg =
							'Please select ' +
							$('#product-' + product_data.product_2 + '-attribute-name')
								.val()
								.toLowerCase()
					} else {
						if (isNaN(product_data.product_qty)) {
							error_msg = 'Please select quantity'
						}
					}
				}
			}

			if (product_data.product_qty <= 0) {
				error_msg = 'Please enter a quantity greater than 0'
			}

			if (error_msg == '') {
				$('#product-rfq-error-message').css('display', 'none')
				return true
			} else {
				$('#product-rfq-error-message').html(error_msg)
				$('#product-rfq-error-message').css('display', 'block')
				return false
			}
		}

		function handleAddToQuote() {
			$('#product-submit-button').on('click', function () {
				$(this).find('.spinner').css('display', 'block')
				$(this).find('svg:not(.spinner').css('display', 'none')
				$(this).prop('disabled', true)

				// gather data
				let multiple_attributes = $('#multiple_attributes').length
					? $('#multiple_attributes').val()
					: '0'
				let product_1 = $('#submitted_product_1').length
					? $('#submitted_product_1').val()
					: false
				let product_1_variant = $(
					'#product-' + $('#submitted_product_1').val() + '-variant'
				).length
					? $('#product-' + $('#submitted_product_1').val() + '-variant').val()
					: false
				let product_2 = $('#submitted_product_2').length
					? $('#submitted_product_2').val()
					: false
				let product_2_variant = $(
					'#product-' + $('#submitted_product_2').val() + '-variant'
				).length
					? $('#product-' + $('#submitted_product_2').val() + '-variant').val()
					: false
				let product_qty =
					$('#product-qty').val() && !isNaN($('#product-qty').val())
						? $('#product-qty').val()
						: '1'
				let product_unit = $('#product-qty-units').val()
					? $('#product-qty-units').val()
					: 'units'
				let skip_crosssell = $('#skip_crosssell').length ? 1 : false
				let product_type = $('#product_type').val()
					? $('#product_type').val()
					: false
				let product_1_attribute_name = $('#product_1_attribute_name').val()
					? $('#product_1_attribute_name').val()
					: false

				let product_data = {}
				product_data['multiple_attributes'] = multiple_attributes
				product_data['product_1'] = product_1
				product_data['product_1_variant'] = product_1_variant
				product_data['product_2'] = product_2
				product_data['product_2_variant'] = product_2_variant
				product_data['product_qty'] = product_qty
				product_data['product_unit'] = product_unit
				product_data['skip_crosssell'] = skip_crosssell
				product_data['product_type'] = product_type
				product_data['product_1_attribute_name'] = product_1_attribute_name

				if (!validateRFQForm(product_data)) {
					$(this).find('.spinner').css('display', 'none')
					$(this).find('svg:not(.spinner').css('display', 'block')
					$(this).prop('disabled', false)
					return
				}

				$.ajax({
					type: 'POST',
					url: '/wp-content/themes/reade-theme/_woo-ajax.php',
					data: 'action=doAddToQuote&data=' + JSON.stringify(product_data),
					success: function (responseText) {
						if (!$('#doc-count').length) {
							$('.doc-notifications').prepend(
								'<span id="doc-count" class="doc-count"></span>'
							)
						}
						$('#product-submit-button').find('.spinner').css('display', 'none')
						$('#product-submit-button')
							.find('svg:not(.spinner)')
							.css('display', 'block')
						$('#product-submit-button').prop('disabled', false)
						if (responseText == 'success') {
							$('#hidden-lity-opener').click()
						}
					},
					error: function () {
						$('#product-submit-button').find('.spinner').css('display', 'none')
						$('#product-submit-button')
							.find('svg:not(.spinner)')
							.css('display', 'block')
						$('#product-submit-button').prop('disabled', false)
					},
					complete: function () {
						$('#product-submit-button').find('.spinner').css('display', 'none')
						$('#product-submit-button')
							.find('svg:not(.spinner)')
							.css('display', 'block')
						$('#product-submit-button').prop('disabled', false)
					},
				})
			})
		}

		function handleRemoveFromQuote() {
			$('.removeFromQuote').on('click', function () {
				let cartKey = $(this).data('cartKey')

				$.ajax({
					type: 'POST',
					url: '/wp-content/themes/reade-theme/_woo-ajax.php',
					data: 'action=doRemoveFromQuote&key=' + JSON.stringify(cartKey),
					success: function (responseText) {
						if (responseText == 'success') {
							document.location.href = '/itemized-rfq'
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
				})
			})
		}

		function handleChangeUnits() {
			$('.tf-dropdown ul li').on('click', function () {
				let cartKey = $(this)
					.parent()
					.parent()
					.parent()
					.parent()
					.parent()
					.parent()
					.parent()
					.data('cartKey')
				let unit = $(this).text()

				$.ajax({
					type: 'POST',
					url: '/wp-content/themes/reade-theme/_woo-ajax.php',
					data: 'action=doChangeUnits&newUnit=' + unit + '&cartKey=' + cartKey,
					success: function (responseText) {
						if (responseText == 'success') {
							//$('#cart-item-' + cartKey).fadeOut();
						}
					},
					error: function () {
						//alert('there was an error');
					},
					complete: function () {},
				})
			})
		}

		function debounce(fn, duration) {
			var timer
			return function (e) {
				clearTimeout(timer)
				timer = setTimeout(fn, duration, e)
			}
		}

		function debounceSearch(fn, duration) {
			var timer
			return function () {
				clearTimeout(timer)
				timer = setTimeout(fn, duration)
			}
		}

		function handleChangeQty() {
			$('.product-qty').on(
				'input',
				debounce((e) => {
					// how to get $(this) data here?
					// curently
					let cartKey = $(e.target).data('cartKey')
					let qtyVal = $(e.target).val()

					$.ajax({
						type: 'POST',
						url: '/wp-content/themes/reade-theme/_woo-ajax.php',
						data: 'action=doChangeQty&cartKey=' + cartKey + '&qty=' + qtyVal,
						success: function (responseText) {
							//alert(responseText);
							if (responseText == 'success') {
								//$('#cart-item-' + cartKey).fadeOut();
							}
						},
						error: function () {
							//alert('there was an error');
						},
						complete: function () {},
					})
				}, 500)
			)
		}

		if (document.body.classList.contains('custom-product-rfq-form')) {
			function handleCustomProductSubmit() {
				$('form').on('submit', function () {
					let form = $(this)

					$(this).find('.wpcf7-submit svg.spinner').css('display', 'block')
					$(this).find('.wpcf7-submit svg:not(.spinner)').css('display', 'none')

					$(this)
						.find('span')
						.bind('DOMSubtreeModified', function (event) {
							// If an error has been appended to this input's parent span, do something
							if ($(this).children('.wpcf7-not-valid-tip').length) {
								// RUN YOUR FUNCTION HERE
								form.find('.wpcf7-submit svg.spinner').css('display', 'none')
								form
									.find('.wpcf7-submit svg:not(.spinner)')
									.css('display', 'block')

								// Prevent this function from running multiple times
								$(this).off(event)

								return false
							}
						})
				})
			}

			handleCustomProductSubmit()
		}

		function handleProductCustomField() {
			let clickTimeout = false

			$('.product-custom-fields-title').on('click', function (e) {
				if (!clickTimeout) {
					clickTimeout = true
					setTimeout(function () {
						clickTimeout = false
					}, 500)
				} else {
					e.preventDefault()
					return false
				}

				if ($(this).next().css('display') == 'none') {
					$(this).find('svg').css('transform', 'unset')
				} else {
					$(this).find('svg').css('transform', 'rotate(180deg)')
				}

				$(this).next().slideToggle(250)
			})
		}

		if (document.body.classList.contains('tax-product_cat') || document.body.classList.contains('sustainable-products')) {
			$('.pah-top-container .btn-arrow-reverse').on('click', function(e) {
				e.preventDefault();
				let ref = document.referrer;

				if (!ref || !ref.includes('/products')) {
					document.location = $(this).attr('href');
				} else {
					window.history.back();
				}
			})
		}

		if (document.body.classList.contains('single-product')) {
			$('.ph-btn').on('click', function(e) {
				e.preventDefault();
				let ref = document.referrer;

				if (!ref) {
					document.location = $(this).attr('href');
				} else {
					if (ref.includes('/products') || ref.includes('/product-category') || ref.includes('/sustainable-products')) {
						window.history.back();
					} else {
						document.location = $(this).attr('href');
					}
				}
			})
		}

		if (
			document.body.classList.contains('woocommerce-shop') ||
			document.body.classList.contains('products') ||
			document.body.classList.contains('sustainable-products') ||
			document.body.classList.contains('tax-product_cat')
		) {
			if (document.body.classList.contains('tax-product_cat') || document.body.classList.contains('sustainable-products')) {
				if (window.innerWidth < 640) {
					elementsPerPage = 9
				} else {
					elementsPerPage = 9
				}
			} else {
				if (window.innerWidth < 640) {
					elementsPerPage = 9;
				} else {
					elementsPerPage = 9;
				}
			}

			showElements(0, elementsPerPage);
			updateDots();
			
			

			$('.prev-btn').on('click', function () {
				if (currentPage > 1) {
					currentPage--
					const startIndex = (currentPage - 1) * elementsPerPage
					const endIndex = startIndex + elementsPerPage
					showElements(startIndex, endIndex)
					updateDots(false, true)
					if (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) {
						updatePageHash(currentPage);
					} else {
						if (!window.location.hash) {
							updatePageHash(currentPage);
						}
					}
				}
			})

			$('.next-btn').on('click', function () {
				if (currentPage < Math.ceil(totalElements / elementsPerPage)) {
					currentPage++
					const startIndex = (currentPage - 1) * elementsPerPage
					const endIndex = startIndex + elementsPerPage
					showElements(startIndex, endIndex)
					updateDots(false, true)
					if (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) {
						updatePageHash(currentPage);
					} else {
						if (!window.location.hash) {
							updatePageHash(currentPage);
						}
					}
				}
			})

			function updatePageHash(page) {
				window.location.hash = 'page-' + page;
			}

			function handleSearch() {
				$('#clear-search-text').on('click', function(e) {
					e.preventDefault();
					window.location.hash = '';
					$('.pab-product a, .pab-category a').off('click', addClickToResults);
					$('#pab-filters-search').val('');
					$('#clear-search').css('opacity', '0');
					$('.pab-product').hide();
								categoryType = '.pab-category'
								showElements(0, elementsPerPage)
								updateDots(false, false)
								
								searchLoaded = false

								totalElements = $(categoryType).length
								let pages = Math.ceil(
									$('.pab-category').length / elementsPerPage
								)
								currentPage = 1
								$('.pab-pagination-dots').html('')
								for (let i = 0; i < pages; i++) {
									$('.pab-pagination-dots').append(
										'<svg ' +
											(i + 1 == currentPage
												? 'class="pab-pagination-dot-current" '
												: '') +
											'width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5.74709" cy="5.9999" r="5.24416" stroke="#009FC6"></circle></svg>'
									)
								}
								updatePaginationButtons()
				})

				$('#pab-filters-form').on('submit', function (e) {
					e.preventDefault()
				})

				$('#pab-filters-search-icon').on('click', function (e) {
					$('#pab-filters-form').submit()
				})

				function addClickToResults(e) {
					e.preventDefault();
					let hv = (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) ? window.location.hash : '';

					if (document.body.classList.contains('sustainable-products') || document.body.classList.contains('tax-product_cat')) {
						const fullURL = window.location.href;
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
				
				let actr;

				$('.pab-filters-search').on(
// 		change event not needed?  it triggers a search update when input loses focus
//					'keyup change',
					'keyup',
					debounceSearch(() => {

						let search = $('.pab-filters-search').val().toLowerCase()
						let searchresultsfound = false;

						if (search.length > 1) {
							/* if our ajax content hasn't been loaded yet, load it now */
							if (!ajaxContentsLoaded) {
								// load ajax content
								$('#search_load').html(ajaxData);

								// clear memory from variable
								ajaxData = '';

								// set control variable to true
								ajaxContentsLoaded = true;
							}

							

							$('#clear-search').css('opacity', '1');
							// set category type to search
							categoryType = '.search-result'
							searchLoaded = true

							$('.pab-category, .pab-product').hide()

							let allCats1 = $('.pab-category');
							let allCats2 = $('.pab-product');
							let allCats = $('.pab-product').add('.pab-category');
							let count = 0;

							for (let i = 0; i < allCats.length; i++) {
								if ($(allCats[i]).data('searchTerms').indexOf(search) !== -1) {
									$(allCats[i]).addClass('search-result')
									count++
								} else {
									$(allCats[i]).removeClass('search-result')
								}
							}
							if (!count) {
								$('.pab-search-empty').css('display', 'block')
								$('#pab-search-term').html(search)

								if ($('.pab-top-wrap').length) {
									$('.pab-top-wrap').hide()
								}
								searchresultsfound = false
							} else {
								$('#pab-search-term').html('')
								$('.pab-search-empty').css('display', 'none')

								if ('.pab-top-wrap'.length) {
									$('.pab-top-wrap').show()
								}
								searchresultsfound = true
							}
							currentPage = 1;

							if (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) {
								let thispage = window.location.hash.replace('#page-', '');
								showElements((+thispage * elementsPerPage) - elementsPerPage, (+thispage * elementsPerPage));
								currentPage = +thispage;
								updateDots();
							} else {
								showElements(0, elementsPerPage)
								updateDots(true, false)
							}

							actr = $('.pab-product, .pab-category a').on('click', addClickToResults);
						} else {
							window.location.hash = '';
							$('.pab-product a, .pab-category a').off('click', addClickToResults);

							$('#clear-search').css('opacity', '0');
							searchresultsfound = true
							$('.pab-search-empty').css('display', 'none')
							if ($('.pab-top-wrap').length) {
								$('.pab-top-wrap').show()
							}
							if (searchLoaded) {
								$('.pab-product').hide();
								categoryType = '.pab-category'
								showElements(0, elementsPerPage)
								updateDots(false, false)
								updatePaginationButtons()
								searchLoaded = false

								totalElements = $(categoryType).length
								let pages = Math.ceil(
									$('.pab-category').length / elementsPerPage
								)
								currentPage = 1
								$('.pab-pagination-dots').html('')
								for (let i = 0; i < pages; i++) {
									$('.pab-pagination-dots').append(
										'<svg ' +
											(i + 1 == currentPage
												? 'class="pab-pagination-dot-current" '
												: '') +
											'width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="5.74709" cy="5.9999" r="5.24416" stroke="#009FC6"></circle></svg>'
									)
								}
								updatePaginationButtons()
							}
						}
					}, 250)
				)
			}



			handleSearch()

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
						pabfs.dispatchEvent(new KeyboardEvent('input', {'key':pabfs[i]}))
					}
					pabfs.dispatchEvent(new KeyboardEvent('keyup', {'keyCode': 38}));
					currentPage = 1;

					if (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) {
								let thispage = window.location.hash.replace('#page-', '');
								showElements((+thispage * elementsPerPage) - elementsPerPage, (+thispage * elementsPerPage));
								currentPage = +thispage;
								updateDots();
							} else {
								showElements(0, elementsPerPage)
								updateDots(true, false)
							}
				}
			}


			function handleSort() {
				let allcards;
				$('#filter1 dd ul li').on('click', function () {
					let sort = $(this).data('key')
					let container = $('.pab-categories')
					categoryType = '.pab-category';
					let cards = $(categoryType)
					currentPage = 1
					cards.hide()
					allcards = cards;

					if (sort == 'alpha') {
						allcards.sort(function (a, b) {
							var nameA = $(a)
								.find('.pab-category-info-left')
								.text()
								.toLowerCase()
								.trim()
							var nameB = $(b)
								.find('.pab-category-info-left')
								.text()
								.toLowerCase()
								.trim()

							if (nameA < nameB) {
								return -1
							}
							if (nameA > nameB) {
								return 1
							}
							return 0
						})
					} else if (sort == 'reversealpha') {
						allcards.sort(function (a, b) {
							var nameA = $(a)
								.find('.pab-category-info-left')
								.text()
								.toLowerCase()
								.trim()
							var nameB = $(b)
								.find('.pab-category-info-left')
								.text()
								.toLowerCase()
								.trim()

							if (nameA > nameB) {
								return -1
							}
							if (nameA < nameB) {
								return 1
							}
							return 0
						})
					} else {
						
						// allcards.each(function() {
						// 	if ($(this).data('child-cats').indexOf(sort) !== -1) {
						// 		$(this).addClass("child-cat-show");
						// 	}
						// })
						
					}

					// hide all cards
					//$(categoryType).remove()

					if (sort == 'alpha' || sort == 'reversealpha') {
						allcards.each(function () {
							$(container).append($(this).show().removeClass('child-cat-show'));
						})
					} else {
						categoryType = '.pab-category';
						cards = $(categoryType)
						allcards = cards;
						allcards.sort(function (a, b) {
							var nameA = $(a)
								.find('.pab-category-info-left')
								.text()
								.toLowerCase()
								.trim()
							var nameB = $(b)
								.find('.pab-category-info-left')
								.text()
								.toLowerCase()
								.trim()

							if (nameA < nameB) {
								return -1
							}
							if (nameA > nameB) {
								return 1
							}
							return 0
						})

						allcards.each(function() {
							$(this).removeClass('child-cat-show');
							if ($(this).data('child-cats').indexOf(sort) !== -1) {
								$(container).append($(this).show().addClass('child-cat-show'));
							} else {
								$(container).append($(this).hide());
							}
						})
						
						categoryType = '.child-cat-show';
					}

					showElements(0, elementsPerPage)
					updateDots()
				})
			}

			handleSort()
		}


		function handleCustomRFQDropdownColor() {
			$('.rfq-form--form .tf-dropdown li').on('click', function() {
				$(this).parent().parent().parent().parent().find('dt p').css('color', '#009fc6');
			})
		}

		if (document.body.classList.contains('custom-product-rfq-form')) {
			handleCustomRFQDropdownColor();
		}


		/** Show the categories and load products when /products/ is initially viewed and scrolled into view **/
		if (document.body.classList.contains('products')) {

			function handleHashChange() {
				const newHash = window.location.hash;
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
				        	$.ajax({
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
											pabfs.dispatchEvent(new KeyboardEvent('input', {'key':pabfs[i]}))
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
		handleTFDropdown()
		handleNewsCardPagination()
		handleNewsSharePosition()

		// woocommerce functions
		handleSingleProductDropdown()
		handleSingleRFQDropdown()
		handleSingleQTYUnits()
		handleAddToQuote()
		handleRemoveFromQuote()
		handleChangeUnits()
		handleChangeQty()
		handleProductCustomField()

		if ($('.pab-categories').length) {
			window.addEventListener('resize', function handleResize() {
				/* Per page elements for products */
				if (window.innerWidth < 640) {
					if (9 != elementsPerPage) {
						elementsPerPage = 9
						showElements(0, elementsPerPage);
						currentPage = 1;
						updatePaginationButtons()
						updateDots()
					}
				} else {
					if (document.body.classList.contains('products')) {
						if (9 != elementsPerPage) {
							elementsPerPage = 9
							currentPage = 1;
							showElements(0, elementsPerPage)
							updatePaginationButtons()
							updateDots()
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
			})
		}

		// window resize
		window.addEventListener('resize', function () {
			/**
			 * Change pagination of news cards/grids
			 */
			if ($('.view-more').length) {
				if (window.innerWidth < 769) {
					cardsPerPage = 3
				} else {
					cardsPerPage = 6
				}

				$cards = $('.news-card-regular')
				totalCards = $cards.length
				//if (cardsToShow == cardsPerPage) {
				cardsToShow = Math.min(cardsPerPage, totalCards)
				//} else {
				//cardsToShow = $('.news-card-regular:visible').length;
				//}
				shownCards = cardsToShow

				$cards.slice(0, cardsToShow).show()
				$cards.slice(cardsToShow, totalCards).hide()

				if (totalCards <= cardsPerPage) {
					$('#view-more').hide()
				} else {
					$('#view-more').show()
				}
			}

			/**
			 * Share element positioning
			 */
			if (window.innerWidth > 1024) {
				if ($('#single-share').length) {
					var parentContainer = $('#single-container')
					var childElement = $('#single-news-content')
					$('#single-share').css(
						'top',
						childElement.offset().top - parentContainer.offset().top
					)
				}
			} else {
				if ($('#single-share').length) {
					$('#single-share').css('top', '0')
				}
			}
		})
	},
}
