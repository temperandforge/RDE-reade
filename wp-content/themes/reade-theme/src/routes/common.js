// import bigpicture from 'bigpicture'
import lozad from 'lozad';

import { runFunctions } from './_functions';
import { runBlocks } from './_blocks';

const { $ } = window;
const $body = $( document.body );

export default {
	init() {
		const observer = lozad( 'img' ); 
		observer.observe();
		$('.hero img').attr('loading', 'eager')

		runFunctions();
		runBlocks();
		// runIO()
	},
	finalize() {
		// JavaScript to be fired on all pages, after page specific JS is fired
		// class to hide outlines if not using keyboard
		$body.on( 'mousedown', function() {
			$body.addClass( 'using-mouse' );
		} );
		$body.on( 'keydown', function() {
			$body.removeClass( 'using-mouse' );
		} );

		/**
		 * News page, tf dropdown action
		 */
		function handleTFDropdown() {
			if ($('.news-featured').length) {
				if ($('.tf-dropdown').length) {
					$('.tf-dropdown ul li').on('click', function() {
						document.location.href = $(this).data('key');
					})
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

			let $cards = $('.news-card-regular');
			let totalCards = $cards.length;
			let cardsToShow = Math.min(cardsPerPage, totalCards);
			let shownCards = cardsToShow;

			if ($('.view-more').length) {

				$cards.slice(cardsToShow, totalCards).hide();

				if (totalCards <= cardsPerPage) {
					$('#view-more').hide();
				} else {
					$('#view-more').show();
				}

				$('#view-more').click(function() {
					cardsToShow += cardsPerPage;
					$cards.slice(shownCards, cardsToShow).fadeIn();
					shownCards = cardsToShow;

					if (shownCards >= totalCards) {
						$('#view-more').hide();
					}
				});
			};
		}


		/*
		* news single share positioning
		*/
		function handleNewsSharePosition() {
			if (window.innerWidth > 1024) {
				if ($('#single-share').length) {
					var parentContainer = $('#single-container');
					var childElement = $('#single-news-content');
					$('#single-share').css('top', childElement.offset().top - parentContainer.offset().top);
				}
			}
		}







		/** WOOCOMMERCE JS **/
		function handleSingleProductDropdown() {
			$('body.single-product #select1 ul li, body.single-product #select2 ul li').on('click', function() {
				// hide all
				$('.product-rfq-select').addClass('tf-dropdown-hidden');

				// show relevant select box
				if ($('#product-rfq-select-' + $(this).data('key')).length) {
					$('#product-rfq-select-' + $(this).data('key')).removeClass('tf-dropdown-hidden');
				}
			});
		}

		// function handleAddToQuote() {
		// 	$('#add-to-quote-button').on('click', function() {
				
		// 	})
		// }

		// run functions
		handleTFDropdown();
		handleNewsCardPagination();
		handleNewsSharePosition();

		// woocommerce functions
		handleSingleProductDropdown();






		// window resize
		window.onresize = function() {
			
			/**
			 * Change pagination of news cards/grids
			 */
			if ($('.view-more').length) {
				if (window.innerWidth < 769) {
					cardsPerPage = 3;
				} else {
					cardsPerPage = 6;
				}
		
				$cards = $('.news-card-regular');
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
					$('#view-more').hide();
				} else {
					$('#view-more').show();
				}
			}


			/**
			 * Share element positioning
			 */
			if (window.innerWidth > 1024) {
				if ($('#single-share').length) {
					var parentContainer = $('#single-container');
					var childElement = $('#single-news-content');
					$('#single-share').css('top', childElement.offset().top - parentContainer.offset().top);
				}
			} else {
				if ($('#single-share').length) {
					$('#single-share').css('top', '0');
				}
			}
		}
	},
};
