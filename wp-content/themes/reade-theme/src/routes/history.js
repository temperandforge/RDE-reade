import loadjs from 'loadjs'
const { $ } = window
const $body = $(document.body)

export default {
	init() {
		//TODO replace jquery use were possible
		//TODO does not work with new use of GSAP
		//TODO animation easing - easeInOut
		$('.btn--back-to-start').on('click', function (e) {
			e.preventDefault()

			// calculate farthest left side of first history section to scroll x coordinate
			const beginningHistory = document.getElementById('history-1773')
			let beginRect = beginningHistory.getBoundingClientRect()

			// calculate height of navbar and hero section to scroll under both for y coordinate
			const heroSection = document.querySelector('.grid-hero--section')
			let heroRect = heroSection.getBoundingClientRect()
			let heroBottom = heroRect.height

			const navbar = document.querySelector('.navbar-wrap')
			let navRect = navbar.getBoundingClientRect()
			let navBottom = navRect.height

			scrollTo(beginRect.x, heroBottom + navBottom)
		})
	},
	finalize() {
		loadjs(
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
		)

		loadjs.ready('gsap', {
			/* scripts successfully loaded */
			success: function () {
				//mobile
				const historySlider = document.querySelector('.history--slider')
				if (!historySlider) {
					return
				}
				const history = historySlider.parentNode
				function renderHistoryLayout(x) {
					if (x.matches) {
						$('.history--slider').slick({
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
						})
					} else {
						if (document.querySelector('.history--slider.slick-initialized')) {
							$(historySlider).slick('unslick')
						}
					}
				}

				var x = window.matchMedia('(max-width: 1280px)') //match css media query breakpoint  - search: h89
				renderHistoryLayout(x) // Call listener function at run time
				x.addListener(renderHistoryLayout) // Attach listener function on state changes

				let initHistoryScrollerRan = false
				let tween
				function initHistoryScroller() {
					if (!x.matches) {
						gsap.registerPlugin(ScrollTrigger)

						let x = 0
						let sections = gsap.utils.toArray('.panel')
						let widths = sections.map((el) => el.getBoundingClientRect().width)
						widths.map((val) => (x += val))
						// .reduce((accumulator, currentValue) => accumulator + currentValue, initialValue)

						console.log(gsap.utils.toArray('.panel').map((el) => el.getBoundingClientRect().width).reduce((accumulator, currentValue) => accumulator + currentValue, 0))
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
						})

						initHistoryScrollerRan = true
					}
				}

				// runs initHistoryScroller if page loads desktop size
				initHistoryScroller()

				let t = null
				window.addEventListener('resize', function () {
					// // runs initHistoryScroller is page loads mobile and resizes to desktop
					// if (!initHistoryScrollerRan) {
						// 	initHistoryScroller()
						// }
						
					clearTimeout(t)
					t = setTimeout(function () {
						console.log('History')
						if( !! tween.scrollTrigger ) {
							tween.scrollTrigger.kill(true)
						}
						initHistoryScroller()
					}, 350)
				})

				function handleImgTransition() {
					const images = document.querySelectorAll(
						'.historical-event.panel figure'
					)

					images.forEach((img, index) => {
						window.innerWidth - 300 >= img.getBoundingClientRect().left &&
							img.classList.add('active')
					})
				}

				function handleLineAnimation() {
					const line = document.getElementById('historySVG1')

					// console.log(line.getBoundingClientRect())
					window.innerWidth - 150 >= line.getBoundingClientRect().left &&
						line.classList.add('active')
				}

				setTimeout(() => {
					handleImgTransition()
					document.addEventListener(
						'scroll',
						function () {
							handleImgTransition()
							handleLineAnimation()
						},
						{
							passive: true,
						}
					)
				}, 200)
			},
			error: function (depsNotFound) {
				/*  cdn scripts failed to load */
				console.log('failed to load required scripts')
			},
		})
	},
}

function drawSVG() {
	//dynamically pinpoint and draw svg
}
