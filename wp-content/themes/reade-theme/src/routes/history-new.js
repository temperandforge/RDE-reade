const { $ } = window
const $body = $(document.body)
let isDragging = false;
export default {
  init() {
  },
  finalize() {
    let sections = gsap.utils.toArray(".history-new--slide");
    let numberSections = sections.length;
	  let dial = document.querySelector(".history-new--dial-center");
  	let dash_position = 0;
    let turnto = 0;
    let prevturnto;
    let dragged = false;
    let clicked = false;
    let isDesktop = true;
    let isMobile = false;
    let view = 'desktop';

    // mobile only
    let prev_is_clickable = true;
    let next_is_clickable = true;

    if (window.innerWidth < 768) {
      view = 'mobile';
      isMobile = true;
      isDesktop = false;
    }

    window.addEventListener('resize', function() {
      gsap.set(".slide-image-1", {
        clearProps: "all"
      });
      gsap.set(".slide-image-2", {
        clearProps: "all"
      });
      if (window.innerWidth < 768) {
        if (view == 'desktop') {
          view = 'mobile';
          positionChildElementsEquallyMobile();
          
          var element = document.getElementById('history-dial');
          var transformMatrix = window.getComputedStyle(element).getPropertyValue('transform');
          var matrixValues = transformMatrix.match(/matrix\(([^\)]+)\)/)[1].split(',').map(parseFloat);
        
          var rotateValue = matrixToRotate({
            a: matrixValues[0],
            b: matrixValues[1],
            c: matrixValues[2],
            d: matrixValues[3],
            e: matrixValues[4],
            f: matrixValues[5]
          });
          turnto = parseInt(rotateValue);
          dragged = false;
          turnto = turnto + 90;
          dial.style.transform = `rotate(${turnto}deg)`
        }
        isMobile = true;
        isDesktop = false;
      } else {
        if (view == 'mobile') {
          view = 'desktop'; 
          positionChildElementsEquallyDesktop();
          var element = document.getElementById('history-dial');
          var transformMatrix = window.getComputedStyle(element).getPropertyValue('transform');
          var matrixValues = transformMatrix.match(/matrix\(([^\)]+)\)/)[1].split(',').map(parseFloat);
        
          var rotateValue = matrixToRotate({
            a: matrixValues[0],
            b: matrixValues[1],
            c: matrixValues[2],
            d: matrixValues[3],
            e: matrixValues[4],
            f: matrixValues[5]
          });
          turnto = parseInt(rotateValue);
          dragged = false;
          turnto = turnto - 90;
          dial.style.transform = `rotate(${turnto}deg)`
        }
        isDesktop = true;
        isMobile = false;
      }
    })

    function matrixToRotate(matrix) {
      // Extract rotation angle from the matrix
      var angle = Math.round(Math.atan2(matrix.b, matrix.a) * (180 / Math.PI));
    
      // Convert negative angles to positive values
      angle = (angle + 360) % 360;
    
      // Return the rotation value
      return angle + 'deg';
    }

    // create elements for years around the dial
    //for (let i = 0; i < (numberSections -1); i++) {
    const tmpRange = Array.apply(null, Array(numberSections)).map(function(_, index) {
      return index;
    });

    for (let i in tmpRange) {
		  let d = document.createElement("a");
		  d.classList.add("history-new--dial-year");

		  if (i == 0) {
			  d.classList.add('history-new--dial-year-active');
		  }
		  d.href = `#event-${i + 1}`;
		  d.dataset.position = parseInt(i) + 1;
      // console.log(i);
		  d.innerHTML = '<span class="history-new--dial-dash-year--inner">' + sections[i].dataset.year + '</span><span class="history-new--dial-dash-year"></span>';
		  dial.appendChild(d);

      // create elements for dashes around the dial inbetween years
		  for (let j = 0; j < 4; j++) {
			  let dash = document.createElement('span');
			  dash.classList.add('history-new--dial-dash');
			  dash.dataset.position = j + 1;
			  dash.innerHTML = '<span></span>';
			  dial.appendChild(dash);
			  dash_position++;
		  }
	  }

    

   // $('.history-new--slide-1').show(0);
    gsap.registerPlugin(ScrollTrigger, Draggable);

    
    // clicking on a year rotates the dial and adds active class to clicked year
    gsap.utils.toArray(".history-new--dial-year").map(el => {
		  el.addEventListener('click', function(e) {

        if (isMobile) {
          return;
        }
        
        if (dragged) {
          var element = document.getElementById('history-dial');
          var transformMatrix = window.getComputedStyle(element).getPropertyValue('transform');
          var matrixValues = transformMatrix.match(/matrix\(([^\)]+)\)/)[1].split(',').map(parseFloat);
        
          var rotateValue = matrixToRotate({
            a: matrixValues[0],
            b: matrixValues[1],
            c: matrixValues[2],
            d: matrixValues[3],
            e: matrixValues[4],
            f: matrixValues[5]
          });
          turnto = parseInt(rotateValue);
          dragged = false;
        }

        clicked = true;
        dragged = false;

        $('.history-new--dial-year').removeClass('history-new--dial-year-active');
        let active_position = findFurthestLeftElement(document.querySelectorAll('.history-new--dial-year:not(.history-grab-container)'));
        active_position = $(active_position).data('position') ;
        let this_position = $(this).data('position');
        let num_spots = this_position - active_position;
        num_spots = (num_spots + numberSections * 1.5) % numberSections - numberSections / 2;

        $('.history-new--slide-current').removeClass('history-new--slide-current').fadeTo(150, '0.0', function() {
          $(this).hide(0);
          $('.history-new--slide-' + this_position).css('opacity', '0').show(0).addClass('history-new--slide-current').fadeTo(150, '1.0');
          doImageAnimations('.history-new--slide-' + this_position);
        });

        let threshold = numberSections/2;
        if (Math.abs(num_spots) > threshold) {
          let per_spot = 360/numberSections;
        }
        
			  turnto = turnto + ((-360 / numberSections) * num_spots);    
        $(this).addClass('history-new--dial-year-active');
      
			  dial.style.transform = `rotate(${turnto}deg)`
		  })
	  });



    // position dashes and years equally around the dial
  	function positionChildElementsEquallyDesktop() {
		  let children = $('.history-new--dial-center').children(':not(svg):not(.history-grab-container)');
		  let numChildren = children.length;

      for (let i = 0; i < numChildren; i++) {
        let idx = i + numChildren / 2;
        let angle = (idx / numChildren) * 2 * Math.PI;
        let x = Math.cos(angle) * 50;
        let y = Math.sin(angle) * 50;
          
        children[i].style.left = `${x + 50}%`;
        children[i].style.top = `${y + 50}%`;

        let rotationAngle = Math.atan2(y, x) + Math.PI; //right-side
        children[i].style.transform = `translate(-50%, -50%) rotate(${rotationAngle}rad)`;
      }
	  }

    function positionChildElementsEquallyMobile() {
		  let children = $('.history-new--dial-center').children(':not(svg):not(.history-grab-container)');
		  let numChildren = children.length;

      for (let i = 0; i < numChildren; i++) {
        let idx = i + numChildren / 2;
        let angle = (idx / numChildren) * 2 * Math.PI;
        let x = Math.cos(angle) * 50;
        let y = Math.sin(angle) * 50;
          
        children[i].style.left = `${x + 50}%`;
        children[i].style.top = `${y + 50}%`;
        let rotationAngle
        if (children[i].classList.contains('history-new--dial-year')) {
          rotationAngle = Math.atan2(y, x) + Math.PI / 2;
        } else {
          rotationAngle = Math.atan2(y, x) + Math.PI;
        }

        children[i].style.transform = `translate(-50%, -50%) rotate(${rotationAngle}rad)`;
      }
	  }
    
    if (isMobile) {
      positionChildElementsEquallyMobile();
    } else {
      positionChildElementsEquallyDesktop();
    }

    if (isMobile) {
      let active = findFurthestTopElement(document.querySelectorAll('.history-new--dial-year:not(.history-grab-container'));
      $('.history-new--dial-year').removeClass('history-new--dial-year-active');
      $(active).addClass('history-new--dial-year-active');
    }


    // Initialize Draggable
    setTimeout(function() {
      Draggable.create("#history-dial", {
        type: "rotation",
        allEventDefault: true,
        liveSnap: {
          rotation: function (value) {


            setTimeout(function() {
                if (isDesktop) {
                  $('.history-new--dial-year').removeClass('history-new--dial-year-active');
                  var furthestLeftElement = findFurthestLeftElement(document.querySelectorAll('.history-new--dial-year:not(.history-grab-container)'));
                  //console.log(furthestLeftElement);
                  $(furthestLeftElement).addClass('history-new--dial-year-active');
                } else {
                  $('.history-new--dial-year').removeClass('history-new--dial-year-active');
                  var furthestTopElement = findFurthestTopElement(document.querySelectorAll('.history-new--dial-year:not(.history-new--dial-year-active):not(.history-grab-container)'));
                  //console.log(furthestLeftElement);
                  $(furthestTopElement).addClass('history-new--dial-year-active');
                }
              }, 250);
            //snap to the closest increment of number of sections
            return Math.round(value / (-360/numberSections)) * (-360/numberSections);
          },
        },
       
        onDragStart: function() {
          if (clicked) {
            clicked = false;
            dragged = true;
          }
        },

         onDragEnd: function() {
          setTimeout(function() {
            dragged = true;
            clicked = false;
            let activeElement;

            let parents = Array.from(parentContainer.getElementsByClassName('history-new--slide'));
            currentIndex = parents.findIndex(element => element.classList.contains('history-new--slide-current'));

            if (isMobile) {
              activeElement = findFurthestTopElement(document.querySelectorAll('.history-new--dial-year:not(.history-grab-container)'));
            } else {
             activeElement = findFurthestLeftElement(document.querySelectorAll('.history-new--dial-year:not(.history-grab-container)'));
            }

             let this_position = $(activeElement).data('position');
            
             $('.history-new--slide-current').removeClass('history-new--slide-current').fadeTo(150, '0.0', function() {
               $(this).hide(0);
               $('.history-new--slide-' + this_position).css('opacity', '0').show(0).addClass('history-new--slide-current').fadeTo(150, '1.0');
               doImageAnimations('.history-new--slide-' + this_position);
            });

             $('.history-new--dial-year').removeClass('history-new--dial-year-active');
             $(activeElement).addClass('history-new--dial-year-active');

             if (isMobile) {
             // $('html, body').scrollTop(0);
             }
          }, 250);
           }
      })

      // Handle manual vertical scrolling during dragging on touch devices
    let startY;
    document.getElementById('history-dial').addEventListener("touchstart", function (event) {
      startY = event.touches[0].clientY;
    });

    document.getElementById('history-dial').addEventListener("touchmove", function (event) {
     
        
        // Calculate the vertical distance moved during touchmove
        let deltaY = event.touches[0].clientY - startY;

        // Scroll the page manually
        window.scrollBy(0, -deltaY);

        // Prevent the default touchmove behavior to avoid double scrolling
        event.preventDefault();

    });
    }, 100);

    

    function findFurthestLeftElement(elements) {
      var furthestLeftElement = null;
      var minLeftPosition = Number.MAX_SAFE_INTEGER;
      Array.from(elements).forEach(function (element) {
        var rect = element.getBoundingClientRect();
        if (rect.left < minLeftPosition) {
          minLeftPosition = rect.left;
          furthestLeftElement = element;
        }
      });
  
      return furthestLeftElement;
    }

    function findFurthestTopElement(elements) {
      var furthestTopElement = null;
      var minTopPosition = Number.MAX_SAFE_INTEGER;
      Array.from(elements).forEach(function (element) {
        var rect = element.getBoundingClientRect();
        if (rect.top < minTopPosition) {
          minTopPosition = rect.top;
          furthestTopElement = element;
        }
      });
  
      return furthestTopElement;
    }

    $('.history-new--slide').hide();
    $('.history-new--slide:eq(0)').show();
    doImageAnimations('.history-new--slide:eq(0)');

    // Get the parent container and child elements
    const parentContainer = document.getElementsByClassName('history-new--slides')[0];
    const childElements = Array.from(parentContainer.getElementsByClassName('history-new--slide'));

    // Get the previous and next buttons
    const prevButton = document.getElementById('history-new--prev');
    const nextButton = document.getElementById('history-new--next');

    // Set initial index
    let currentIndex = childElements.findIndex(element => element.classList.contains('history-new--slide-current'));

    // Function to update the active child element
    const updateActiveElement = () => {
      $('.history-new--slide-current').removeClass('history-new--slide-current').fadeTo(150, '0.0', function() {
        $(this).hide(0);
        $(childElements[currentIndex]).css('opacity', '0').show(0).addClass('history-new--slide-current').fadeTo(150, '1.0');
        doImageAnimations('.history-new--slide-current');
     });

     childElements.forEach(element => element.classList.remove('active'));
      childElements[currentIndex].classList.add('active');
    };

    // Event listener for the previous button
    prevButton.addEventListener('click', function (e) {
      e.preventDefault();
      if (prev_is_clickable) {
        prev_is_clickable = false;
        let parents = Array.from(parentContainer.getElementsByClassName('history-new--slide'));
        currentIndex = parents.findIndex(element => element.classList.contains('history-new--slide-current'));
        currentIndex = (currentIndex - 1 + childElements.length) % childElements.length;
        updateActiveElement();
        updateRotation('prev');
        setTimeout(function() {
          prev_is_clickable = true;
        }, 700);
      }
    });

    // Event listener for the next button
    nextButton.addEventListener('click', function (e) {
      e.preventDefault();
      if (next_is_clickable) {
        next_is_clickable = false;
        let parents = Array.from(parentContainer.getElementsByClassName('history-new--slide'));
        currentIndex = parents.findIndex(element => element.classList.contains('history-new--slide-current'));
        currentIndex = (currentIndex + 1) % childElements.length;
        updateActiveElement();
        updateRotation('next');

        setTimeout(function() {
          next_is_clickable = true;
        }, 700);
      }
    });

    function updateRotation(val) {
    
        var element = document.getElementById('history-dial');
        var transformMatrix = window.getComputedStyle(element).getPropertyValue('transform');
        var matrixValues = transformMatrix.match(/matrix\(([^\)]+)\)/)[1].split(',').map(parseFloat);
      
        var rotateValue = matrixToRotate({
          a: matrixValues[0],
          b: matrixValues[1],
          c: matrixValues[2],
          d: matrixValues[3],
          e: matrixValues[4],
          f: matrixValues[5]
        });
        turnto = parseInt(rotateValue);
        dragged = false;
      

      clicked = true;
      dragged = false;

      if (val == 'prev') {
        turnto += (360 / numberSections) * 1;
      }

      if (val == 'next') {
        turnto += (-360 / numberSections) * 1;
      }
      dial.style.transform = `rotate(${turnto}deg)`

      setTimeout(function() {
        $('.history-new--dial-year').removeClass('history-new--dial-year-active');
        let top_active = findFurthestTopElement(document.querySelectorAll('.history-new--dial-year:not(.history-new--dial-year-active):not(.history-grab-container'));
        $(top_active).addClass('history-new--dial-year-active');
        //$('html, body').scrollTop(0);
      }, 250);
    }

    function doImageAnimations(el) {
      if (window.innerWidth >= 768) {
        if ($(el).hasClass('history-new--slide-layout-One')) {
          gsap.from($(el + ' .slide-image-1'), { x: "-500%", duration: 0.4 });
          gsap.from($(el + ' .slide-image-2'), { x: "-300%", duration: 0.5, delay: 0.4 });
        } else if ($(el).hasClass('history-new--slide-layout-Two')) {
          gsap.from($(el + ' .slide-image-1'), { y: "-500%", duration: 0.4 });
          gsap.from($(el + ' .slide-image-2'), { y: "-300%", duration: 0.5, delay: 0.4 });
        } else if ($(el).hasClass('history-new--slide-layout-Three')) {
          gsap.from($(el + ' .slide-image-1'), { x: "-500%", duration: 0.4 });
          gsap.from($(el + ' .slide-image-2'), { x: "-300%", duration: 0.5, delay: 0.4 });
        } else if ($(el).hasClass('history-new--slide-layout-Four')) {
          gsap.from($(el + ' .slide-image-1'), { y: "500%", duration: 0.4 });
          gsap.from($(el + ' .slide-image-2'), { y: "600%", duration: 0.5, delay: 0.4 });
        }
      } else {
        gsap.from($(el + ' .slide-image-1'), { x: "-300%", duration: 0.4 });
        gsap.from($(el + ' .slide-image-2'), { x: "600%", duration: 0.5, delay: 0.4 });
      }
    }
  },
}
