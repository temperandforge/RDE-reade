function placeholder() {}

function handleFAQAccordion() {
	const $faq = $('.faq-accordion')
	if (!$faq.length) {
		return
	}

	$faq.each(function () {
		$(this)
			.find('.accordion-btn')
			.on('click', function () {
				$(this).attr('aria-expanded', function (i, attr) {
					return attr == 'true' ? 'false' : 'true'
				})
				$(this).parent().toggleClass('open')
				// $(this)
				// 	.siblings('.accordion-answer')
				// 	.attr('aria-hidden', function (i, attr) {
				// 		return attr == 'true' ? 'false' : 'true'
				// 	})
			})
	})
}

function handleContactLocationInformation() {
	const $locations = $('.contact-information--locations button')
	const $contentBlocks = $('.contact-information--set')

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
						: $(this).attr('aria-expanded', 'true')
					$(this).toggleClass('btn btn-blue-dark-blue')
				})
				$contentBlocks.each(function () {
					$(this).attr('aria-hidden') == 'true'
						? $(this).attr('aria-hidden', 'false')
						: $(this).attr('aria-hidden', 'true')
					$(this).attr('aria-hidden') == 'true'
						? $(this).removeClass('active')
						: $(this).addClass('active')
				})
			}
		})
	})
}

function handleLeadershipSlider() {
	const $slider = $('.leadership-slider--slider')
	const $contact = $('.leadership-slider-mobile--contacts')

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
			})

	}
	$slider.on('beforeChange', function() {
		//$('.leadership-slider--slider').scrollIntoView();
		if (window.innerWidth < 1300) {
			document.getElementsByClassName('leadership-slider--slider')[0].scrollIntoView();
		}
	})

	$slider.slick({
		infinite: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		fade: true,
		appendDots: $('.leadership-slider--nav'),
		customPaging: function (slider, i) {
			var title = $(slider.$slides[i]).data('title')
			var position = $(slider.$slides[i]).data('position')
			var team_member = $(slider.$slides[i]).data('team-member')
			return `<button class="team-member--btn ${team_member}"><span>${title}</span> ${
				position ? position : ''
			}</button>`
		},
		arrows: false,
		asNavFor: $('.leadership-slider-mobile--contacts'),
		adaptiveHeight: true,
	})

	handleContactSlider()

	// $(window).on('resize', function () {
	// 	handleContactSlider()
	// })

	$(document).ready(function () {
		if (window.location.hash && window.location.hash != '') {
			if ($('.' + window.location.hash.replace('#', '')).length) {
				$('.' + window.location.hash.replace('#', '')).click().blur();
			}
		}
	})
}

function handleTabbedRotator() {
	const $tabs = $('.tabbed-rotator--tabs')

	if (!$tabs) {
		return
	}

	let $mobileBtn = $('.current-tab')
	let $tabArr = $('.tabbed-rotator--tab')

	function toggleNavClass() {
		$('.tabbed-rotator-content--wrap').toggleClass('opened closed')
	}

	$mobileBtn.on('click', function () {
		toggleNavClass()
	})

	$tabs.slick({
		infinite: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		fade: true,
		adaptiveHeight: true,
		appendDots: $('.tabbed-rotator--nav'),
		customPaging: function (slider, i) {
			var title = $(slider.$slides[i]).data('title')
			return `<button class="team-member--btn"><span>${title}</span></button>`
		},
		arrows: false,
	})

	$tabs.on('afterChange', function (event, slick, currentSlide) {
		$tabArr.each(function (index) {
			index == currentSlide ? $mobileBtn.text($(this).data('title')) : null
		})
	})

	$tabs.on('beforeChange', function (event, slick, currentSlide) {
		let x = window.matchMedia('(max-width: 1024px)')
		if (x.matches) {
			toggleNavClass()
		}
	})
}

function handleIndustrySlider() {
	const $slides = $('.industry-slider--section')

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
			})
	})
}

function handleTestimonialSlider() {
	const $slider = $('.testimonial-slider--section')

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
			})
	})

	let numTestimonials = $('.testimonial-slider--slide').length
	numTestimonials = numTestimonials - 1

	$('.testimonial-slider--slider').on(
		'afterChange',
		function (event, slick, currentSlide, nextSlide) {
			if (currentSlide == numTestimonials - 1) {
				$('.slick-next-arrow').prop('disabled', true)
			} else {
				$('.slick-next-arrow').prop('disabled', false)
			}
		}
	)
}

function handleTileSlider() {
	const $section = $('.tile-slider--section')

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
				})
		})

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
							})
					})
				}
			}
		})
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
				})
		})
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
				})
		})
	}
}

function handleVerticalAccordions() {
	const $sections = $('.vertical-accordion--section')
	if (!$sections.length) {
		return
	}

	//vertical-accordion--heading

	const $accordions = $('.vertical-accordion--accordion')
	const $images = $('.vertical-accordion--figure')
	const $buttons = $('.vertical-accordion--btn')
	const $content = $('.vertical-accordion--content')

	const $originalArias = []
	$buttons.map(function () {
		$originalArias.push($(this).attr('aria-expanded'))
	})

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
								.attr('aria-expanded', 'true')
							$(this).find('.vertical-accordion--content')
							// .attr('aria-hidden', 'false')
							$(this)
								.find('.vertical-accordion--content')
								.toggleClass('active inactive')
						} else {
							$(this)
								.find('.vertical-accordion--btn')
								.attr('aria-expanded', 'false')
							// $(this)
							// 	.find('.vertical-accordion--content')
							// 	.attr('aria-hidden', 'true')
							$(this).find('.vertical-accordion--content').addClass('inactive')
							$(this).find('.vertical-accordion--content').removeClass('active')
						}
					})

					$images.each(function (i) {
						if (i == idx) {
							$(this).removeClass('inactive')
							$(this).addClass('active')
						} else {
							$(this).addClass('inactive')
							$(this).removeClass('active')
						}
					})
				})
		})
	}

	handleClicks()

	let maxWindow = window.matchMedia('(max-width: 1024px)')
	let currentW = window.innerWidth

	function handleMobileAccordion() {
		if (maxWindow.matches) {
			$buttons.each(function () {
				$(this).attr('aria-expanded', 'true')
			})
			$content.each(function () {
				// $(this).attr('aria-hidden', 'false')
				$(this).addClass('active')
				$(this).removeClass('inactive')
			})
		} else {
			$buttons.each(function (index) {
				index == 0
					? $(this).attr('aria-expanded', 'true')
					: $(this).attr('aria-expanded', 'false')
			})
			$content.each(function (index) {
				if (index == 0) {
					// $(this).attr('aria-hidden', 'false')
					$(this).addClass('active')
					$(this).removeClass('inactive')
				} else {
					// $(this).attr('aria-hidden', 'true')
					$(this).removeClass('active')
					$(this).addClass('inactive')
				}
			})
		}
	}

	handleMobileAccordion()

	$(window).on('resize', function () {
		if (currentW < 1024 && window.innerWidth > 1024) {
			handleMobileAccordion()
		}

		// updates checker for resize to account for accessability: all open on mobile, first open on desktop
		currentW = window.innerWidth
	})
}

function handleCareerSlider() {
	const $slider = $('.career-block--slider')

	if (!$slider.length) {
		return
	}

	const $slides = $('.career-block--slide')

	if ($slides.length <= 1) {
		return
	}

	let media = window.matchMedia('(max-width: 768px)')
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
	}
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
	}

	function initSlick() {
		if (media.matches) {
			$slider.slick(mobileSettings)
		} else {
			$slider.slick(desktopSettings)
		}
	}

	initSlick()

	$(window).on('resize', function () {
		if ($slider.hasClass('slick-initialized')) {
			$slider.slick('unslick')
		}
		initSlick()
	})
}

function disableFirstDropdownOptionRFQ() {
	const $form = $('.rfq-form--form')

	if (!$form.length) {
		return
	}

	$form.each(function () {
		$(this)
			.find('.dropdown option:first-child')
			.each(function () {
				$(this).prop('disabled', true)
			})
	})
}

function handleAutoComplete() {


	
	function autocomplete(inp, arr) {
		/*the autocomplete function takes two arguments,
	  the text field element and an array of possible autocompleted values:*/
		var currentFocus
		/*execute a function when someone writes in the text field:*/
		inp.addEventListener('input', function (e) {
			var a,
				b,
				i,
				aWrapper,
				val = this.value
			/*close any already open lists of autocompleted values*/
			closeAllLists()
			if (!val) {
				return false
			}
			if (val.trim() == '') {
				return false
			}

			if (val.length > 1 ) {
				currentFocus = -1

				var containerDiv = document.createElement("div");
				containerDiv.id = 'autocomplete-list-wrapper';

				if (document.getElementById('autocomplete-list-wrapper')) {
					document.getElementById('autocomplete-list-wrapper').remove();
				}

				/*create a DIV element that will contain the items (values):*/
				a = document.createElement('DIV')
				a.setAttribute('id', this.id + 'autocomplete-list')
				a.setAttribute('class', 'autocomplete-items')
				containerDiv.appendChild(a);
				/*append the DIV element as a child of the autocomplete container:*/

				this.parentNode.appendChild(containerDiv);

				/*for each item in the array...*/
				//var pattern = new RegExp(val, 'gi');
				const boldQuery = (str, query) => {
					const n = str.toUpperCase()
					const q = query.toUpperCase()
					const x = n.indexOf(q)
					if (!q || x === -1) {
						return str // bail early
					}
					const l = q.length
					return (
						str.substr(0, x) +
						'<strong>' +
						str.substr(x, l) +
						'</strong>' +
						str.substr(x + l)
					)
				}
				//let limit = 15;
				for (i = 0; i < arr.length; i++) {
					//if (i < limit) {
					/*check if the item starts with the same letters as the text field value:*/
					if (arr[i][0].toUpperCase().includes(val.toUpperCase())) {
						//if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
						/*create a DIV element for each matching element:*/
						b = document.createElement('DIV')
						/*make the matching letters bold:*/
						//b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
						b.innerHTML = ''
						if (arr[i][1] == 'Product') {
							b.innerHTML = '<span class="product-pill">Product</span> '
						}

						b.innerHTML += boldQuery(arr[i][0], val)
						//b.innerHTML = arr[i].replace(pattern, '<strong>' + val + '</strong>');
						/*insert a input field that will hold the current array item's value:*/
						b.innerHTML +=
							"<input type='hidden' value='" +
							arr[i][0] +
							"'><input type='hidden' value='" +
							arr[i][2] +
							"'>"
						/*execute a function when someone clicks on the item value (DIV element):*/
						b.addEventListener('click', function (e) {
							let hv = (window.location.hash && window.location.hash !== '' && window.location.hash != '#' && window.location.hash.replace('#', '').startsWith('page-')) ? window.location.hash : '';
						if (document.body.classList.contains('sustainable-products') || document.body.classList.contains('tax-product_cat')) {
							const fullURL = window.location.href;
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
						closeAllLists()
						})
						a.appendChild(b)
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
		})

		/*execute a function presses a key on the keyboard:*/
		inp.addEventListener('keydown', function (e) {
			var x = document.getElementById(this.id + 'autocomplete-list')
			if (x) x = x.getElementsByTagName('div')
			if (e.keyCode == 40) {
				/*If the arrow DOWN key is pressed,
	        increase the currentFocus variable:*/
				currentFocus++
				/*and and make the current item more visible:*/
				addActive(x)
			} else if (e.keyCode == 38) {
				//up
				/*If the arrow UP key is pressed,
	        decrease the currentFocus variable:*/
				currentFocus--
				/*and and make the current item more visible:*/
				addActive(x)
			} else if (e.keyCode == 13) {
				/*If the ENTER key is pressed, prevent the form from being submitted,*/
				e.preventDefault()
				if (currentFocus > -1) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click()
				}
			}
		})

		function addActive(x) {
			/*a function to classify an item as "active":*/
			if (!x) return false
			/*start by removing the "active" class on all items:*/
			removeActive(x)
			if (currentFocus >= x.length) currentFocus = 0
			if (currentFocus < 0) currentFocus = x.length - 1
			/*add class "autocomplete-active":*/
			x[currentFocus].classList.add('autocomplete-active')
		}

		function removeActive(x) {
			/*a function to remove the "active" class from all autocomplete items:*/
			for (var i = 0; i < x.length; i++) {
				x[i].classList.remove('autocomplete-active')
			}
		}
	}

	function closeAllLists(elmnt = false, inp = false) {
		/*close all autocomplete lists in the document,
	    except the one passed as an argument:*/
		var x = document.getElementsByClassName('autocomplete-items')
		for (var i = 0; i < x.length; i++) {
			x[i].parentNode.removeChild(x[i])
		}
	}

	document.addEventListener('click', function (e) {
		closeAllLists(e.target, document.getElementById('pab-filters-search'))
	})

	document.addEventListener('DOMContentLoaded', function () {
		if (document.getElementById('pab-filters-search')) {
			autocomplete(document.getElementById('pab-filters-search'), products)
		}
	})
}

function handleCalc() {
	$('.calc .tf-dropdown ul li').on('click', function () {
		let thiscalc = $(this).closest('.calc-main').data('calc')
		let thisIndex = $(this).data('key')

		$('.calc .' + thiscalc + ' .tf-dropdown').each(function () {
			$(this)
				.find('dt p')
				.text(
					$(this)
						.find('li[data-key=' + thisIndex + ']')
						.text()
				)
		})
	})
}

function handleContactLoc() {
	if (window.innerWidth <= 768) {
		$('#location1id').on('click', function () {
			$('#location1')[0].scrollIntoView()
		})
		$('#location2id').on('click', function () {
			$('#location2')[0].scrollIntoView()
		})
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
	};

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
		clearTimeout(t)
		$( inPageNavAnchors ).removeClass( 'active' );
		e.target.classList.add( 'active' );
		t = setTimeout( () => {
			enableScrolling = true;
		}, 1000 );
	} );


}

function runBlocks() {
	placeholder()
	handleFAQAccordion()
	handleContactLocationInformation()
	handleLeadershipSlider()
	handleTabbedRotator()
	handleIndustrySlider()
	handleTestimonialSlider()
	handleTileSlider()
	handleVerticalAccordions()
	handleCareerSlider()
	disableFirstDropdownOptionRFQ()
	handleCalc()
	handleContactLoc()

	if (
		document.body.classList.contains('products') ||
		document.body.classList.contains('tax-product_cat') ||
		document.body.classList.contains('sustainable-products')
	) {
		handleAutoComplete()
	}

	if (document.body.classList.contains('single-careers')) {
		handleCareersNav();
		generateCareersNavigation();
	}
}

export { runBlocks }
