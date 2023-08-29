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
	const $slide = $('.leadership-slider--slider')
	const $contact = $('.leadership-slider-mobile--contacts')

	if (!$slide.length) {
		return
	}

	$slide.slick({
		infinite: false,
		slidesToShow: 1,
		slidesToScroll: 1,
		dots: true,
		fade: true,
		appendDots: $('.leadership-slider--nav'),
		customPaging: function (slider, i) {
			var title = $(slider.$slides[i]).data('title')
			var position = $(slider.$slides[i]).data('position')
			var team_member = $(slider.$slides[i]).data('team-member');
			return `<button class="team-member--btn ${team_member}"><span>${title}</span> ${
				position ? position : ''
			}</button>`
		},
		arrows: false,
		asNavFor: $contact,
		adaptiveHeight: true,
	})

	$contact.slick({
		dots: false,
		slidesToScroll: 1,
		slidesToShow: 1,
		infinite: false,
		asNavFor: $slide,
		prevArrow: $('.slick-prev-arrow'),
		nextArrow: $('.slick-next-arrow'),
	})

	$(document).ready(function() {
		if (window.location.hash && window.location.hash != '') {
			if ($('.' + window.location.hash.replace('#', '')).length) {
				$('.' + window.location.hash.replace('#', '')).click();
			}
		}
	});
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
				slidesPerRow: 2,
				adaptiveHeight: true,
				dots: true,
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
				appendDots: $(this).find('.testimonial-slider--dots'),
				prevArrow: $(this).find('.slick-prev-arrow'),
				nextArrow: $(this).find('.slick-next-arrow'),
			})
	})

	let numTestimonials = $('.testimonial-slider--slide').length;
	numTestimonials = numTestimonials - 1;

	$('.testimonial-slider--slider').on('afterChange', function(event, slick, currentSlide, nextSlide){
	    
	    if (currentSlide == (numTestimonials - 1)) {
	    	$('.slick-next-arrow').prop('disabled', true);
	    } else {
	    	$('.slick-next-arrow').prop('disabled', false);
	    }
	});
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
							settings: "unslick"
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
										settings: "unslick"
									},
								],
							})
						});
					}
				}
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
								adaptiveHeight: true,
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
				.find('.vertical-accordion--heading')
				.on('click', function () {
					if ($(this).attr('aria-expanded') == 'true') {
						return
					}

					$accordions.each(function (i) {
						if (i == idx) {
							$(this)
								.find('.vertical-accordion--btn')
								.attr('aria-expanded', 'true')
							$(this)
								.find('.vertical-accordion--content')
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
	  var currentFocus;
	  /*execute a function when someone writes in the text field:*/
	  inp.addEventListener("input", function(e) {
	      var a, b, i, val = this.value;
	      /*close any already open lists of autocompleted values*/
	      closeAllLists();
	      if (!val) { return false;}
	      if (val.trim() == '') { return false; }
	      currentFocus = -1;
	      /*create a DIV element that will contain the items (values):*/
	      a = document.createElement("DIV");
	      a.setAttribute("id", this.id + "autocomplete-list");
	      a.setAttribute("class", "autocomplete-items");
	      /*append the DIV element as a child of the autocomplete container:*/
	      this.parentNode.appendChild(a);
	      /*for each item in the array...*/
	      //var pattern = new RegExp(val, 'gi');
	      const boldQuery = (str, query) => {
			    const n = str.toUpperCase();
			    const q = query.toUpperCase();
			    const x = n.indexOf(q);
			    if (!q || x === -1) {
			        return str; // bail early
			    }
			    const l = q.length;
			    return str.substr(0, x) + '<strong>' + str.substr(x, l) + '</strong>' + str.substr(x + l);
			}
			//let limit = 15;
	      for (i = 0; i < arr.length; i++) {
	      	//if (i < limit) {
	        /*check if the item starts with the same letters as the text field value:*/
	        if (arr[i].toUpperCase().includes(val.toUpperCase())) {
	        //if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
	          /*create a DIV element for each matching element:*/
	          b = document.createElement("DIV");
	          /*make the matching letters bold:*/
	          //b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
	          b.innerHTML = boldQuery(arr[i], val);
	          //b.innerHTML = arr[i].replace(pattern, '<strong>' + val + '</strong>');
	          /*insert a input field that will hold the current array item's value:*/
	          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
	          /*execute a function when someone clicks on the item value (DIV element):*/
	              b.addEventListener("click", function(e) {
	              /*insert the value for the autocomplete text field:*/
	              inp.value = this.getElementsByTagName("input")[0].value;
	              /*close the list of autocompleted values,
	              (or any other open lists of autocompleted values:*/
	              closeAllLists();
	          });
	          a.appendChild(b);
	        }
	      //}
	  	}
	  });
	  /*execute a function presses a key on the keyboard:*/
	  inp.addEventListener("keydown", function(e) {
	      var x = document.getElementById(this.id + "autocomplete-list");
	      if (x) x = x.getElementsByTagName("div");
	      if (e.keyCode == 40) {
	        /*If the arrow DOWN key is pressed,
	        increase the currentFocus variable:*/
	        currentFocus++;
	        /*and and make the current item more visible:*/
	        addActive(x);
	      } else if (e.keyCode == 38) { //up
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
	    if (!x) return false;
	    /*start by removing the "active" class on all items:*/
	    removeActive(x);
	    if (currentFocus >= x.length) currentFocus = 0;
	    if (currentFocus < 0) currentFocus = (x.length - 1);
	    /*add class "autocomplete-active":*/
	    x[currentFocus].classList.add("autocomplete-active");
	  }

	  function removeActive(x) {
	    /*a function to remove the "active" class from all autocomplete items:*/
	    for (var i = 0; i < x.length; i++) {
	      x[i].classList.remove("autocomplete-active");
	    }
	  }
  
	}

	function closeAllLists(elmnt=false, inp=false) {
	    /*close all autocomplete lists in the document,
	    except the one passed as an argument:*/
	    var x = document.getElementsByClassName("autocomplete-items");
	    for (var i = 0; i < x.length; i++) {
	         x[i].parentNode.removeChild(x[i]);
	    }
	  }

	document.addEventListener("click", function (e) {
	    closeAllLists(e.target, document.getElementById('pab-filters-search'));
	});

	document.addEventListener('DOMContentLoaded', function() {
		autocomplete(document.getElementById("pab-filters-search"), products);
	});

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

	if (document.body.classList.contains('products') || document.body.classList.contains('tax-product_cat')) {
		handleAutoComplete();
	}
}

export { runBlocks }
