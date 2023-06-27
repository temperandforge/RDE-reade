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

		if ($('.news-featured').length) {
			if ($('.tf-dropdown').length) {
				$('.tf-dropdown ul li').on('click', function() {
					document.location.href = $(this).data('key');
				})
			}
		}

		//TODO bigpicture on img
	},
};

function runIO() {
	// const options = {
	//   root: null,
	//   rootMargin: '0px',
	//   threshold: [],
	// };

	//closure
	let count = 0;
	setInterval( () => {
		count = Math.max( 0, count - 1 );
	}, 350 );
	function handleIntersection( entries ) {
		entries.map( ( entry ) => {
			if ( entry.isIntersecting ) {
				count++;
				setTimeout( () => {
					entry.target.classList.add( 'show' );
				}, ( count % 5 ) * 50 );
			}
			// else {
			//   entry.target.classList.remove('visible')
			// }
		} );
	}

	const io = new IntersectionObserver( handleIntersection );//, options);
	//match io.scss
	$( `
    .landing-hero-content > *, 
    .page-default-content *[class*=-content] > *,
    *[class*=-img]:not(.clients-img) > *
  ` ).each( ( _, el ) => io.observe( el ) );
}
