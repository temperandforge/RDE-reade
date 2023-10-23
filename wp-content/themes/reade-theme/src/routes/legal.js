
const { $ } = window;
// const $body = $( document.body );

export default {
	init() {
		generateInPageNavigation();
		handleMobileInPageNav();
	},
	finalize() {

	},
};

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
	const $nav = $( '.in-page-nav nav ul' );
	const sectionHeadings = document.querySelectorAll( '.main-content-wrap h2' );

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
