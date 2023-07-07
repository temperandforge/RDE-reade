const { $ } = window;
const $body = $( document.body );

const prevArrow =
  '<button type="button" class="slick-prev"><svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M39 78C60.5391 78 78 60.5391 78 39C78 17.4609 60.5391 0 39 0C17.4609 0 0 17.4609 0 39C0 60.5391 17.4609 78 39 78Z" fill="#006FAA"/> <path d="M21.5901 39L36.7001 56.04H49.8301L34.7201 39L49.8301 21.96H36.7001L21.5901 39Z" fill="white"/> </svg> <span class="sr-only">Previous</span></button>';
const nextArrow =
  '<button type="button" class="slick-next"><svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M39 4.21991e-06C17.4609 2.3369e-06 5.2925e-06 17.4609 3.40949e-06 39C1.52648e-06 60.5391 17.4609 78 39 78C60.5391 78 78 60.5391 78 39C78 17.4609 60.5391 6.10291e-06 39 4.21991e-06Z" fill="#006FAA"/> <path d="M56.41 39L41.3 21.96L28.17 21.96L43.28 39L28.17 56.04L41.3 56.04L56.41 39Z" fill="white"/> </svg> <span class="sr-only">Next</span></button>';

function responsiveNavbar() {
	window.onresize = () => {
		const navHeight = $( '.navbar-wrap' ).height();
		document
			.querySelector( ':root' )
			.style.setProperty( '--navbar-height', navHeight + 'px' );
		$( '#mobile-menu' ).css( 'top', navHeight + 'px' );
	};
	window.onload = window.onresize;
}

function mobileMenu() {
	// assumes existence
	const $menu = $( '.mobile-menu' );
	$menu.hide();
	$menu.find('.sub-menu').hide();
	$menu.removeClass( 'loading' );
	const $btn = $( '#toggle_nav' );

	const animating = false;
	$btn.on( 'click', function( e ) {
		$menu.fadeIn();
		$('.mobile-menu').css('padding-bottom', $('.mobile-menu--footer').outerHeight())
	} );
	$( '.mobile-menu .menu-item:not(.menu-item-has-children), .mobile-menu .sub-menu .menu-item, .mobile-menu--close-btn' ).on( 'click', function( e ) {
		$menu.fadeOut().find('.sub-menu').slideUp().parent().removeClass('item-open');
	} );

	$( '.mobile-menu .menu-item.menu-item-has-children').on('click', function(e) {
		$(this).toggleClass('item-open')
		if(e.target.tagName.toLowerCase() == 'a') {
			e.preventDefault() //prevent triggering link
			$(e.target).siblings('.sub-menu').slideToggle(250)
		} else { //parent li
			$(e.target).find('.sub-menu').slideToggle(250)
		}
	})

	function closeOnDesktop( x ) {
		if ( x.matches ) {
			$menu.fadeOut().find('.sub-menu').slideUp().parent().removeClass('item-open');
		}
	}

	const x = window.matchMedia( '(min-width: 1025px)' ); //match
	closeOnDesktop( x );
	x.addListener( closeOnDesktop );
}

function runFunctions() {
	responsiveNavbar();
	mobileMenu()
}

export {
	prevArrow,
	nextArrow,
	runFunctions,
};
