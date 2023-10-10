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

/**
 * This function prevents clicking a main menu item with children from leaving a menu open 
 * while another can be hovered
 */
function desktopMenu() {
	let dm = $('#menu-primary-navigation-1 > li');
	dm.on('click mouseover', function(e) {
		dm.find('.sub-menu').css('opacity', '0').css('pointer-events', 'none');
		dm.removeClass('sub-menu-open');

		$(this).find('.sub-menu').css('opacity', '1').css('pointer-events', 'auto');
		$(this).addClass('sub-menu-open');

		$(this).find('.sub-menu').on('mouseleave', function() {
			$(this).css('opacity', '0').css('pointer-events', 'none');
			$(this).parent().removeClass('sub-menu-open');
		})
	});
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
	$( `
		.mobile-menu .menu-item:not(.menu-item-has-children), 
		.mobile-menu .sub-menu .menu-item, 
		.mobile-menu--close-btn
	` ).on( 'click', function( e ) {
		$menu.fadeOut().find('.sub-menu').slideUp().parent().removeClass('item-open');
	} );

	$( '.mobile-menu .menu-item.menu-item-has-children > a').on('click', function(e) {
		$(this).toggleClass('item-open')
		if(e.target.tagName.toLowerCase() == 'a' && e.target.getAttribute('href') == '#') {
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

//const scrollingDiv = document.getElementById('scrollingDiv');
//const items = document.querySelectorAll('#scrollingDiv ul li');
let scrollingDiv;
let items;
let selectedItemIndex = -1;




// Highlight the initial selected item (optional)
//highlightSelectedItem();
function handleKeyboardInteraction(event) {
	if ($('.tf-dropdown-open').length) {

		scrollingDiv = $('.tf-dropdown-open');
		items = $('.tf-dropdown-open ul li');

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

$('.tf-dropdown').on('click keypress', function() {
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
  console.log(selectedElement.offsetTop - scrollingDiv.height() / 2);
  scrollingDiv.scrollTop(Math.round(selectedElement.offsetTop - scrollingDiv.height() / 2));
}

function highlightSelectedItem() {
  items.each((index, item) => {
    if (index === selectedItemIndex) {
      $(item).addClass('selected');
    } else {
      $(item).removeClass('selected');
    }
  });
}

function runFunctions() {
	responsiveNavbar();
	mobileMenu()
	desktopMenu()
}

export {
	prevArrow,
	nextArrow,
	runFunctions,
};
