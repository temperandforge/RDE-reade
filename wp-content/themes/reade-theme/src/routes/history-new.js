const { $ } = window
const $body = $(document.body)
// import gsap from "gsap";
// console.log(gsap);
// import { ScrollTrigger } from "gsap/ScrollTrigger";
// gsap.registerPlugin(ScrollTrigger);


export default {
  init() {

   
  },
  finalize() {

    


    let sections = gsap.utils.toArray(".history-new--slide");
    let numberSections = sections.length;
	  let dial = document.querySelector(".history-new--dial-center");
  	let dash_position = 0;
    let turnto = 0;
    let dragged = false;
    let clicked = false;

    function matrixToRotate(matrix) {
      // Extract rotation angle from the matrix
      var angle = Math.round(Math.atan2(matrix.b, matrix.a) * (180 / Math.PI));
    
      // Convert negative angles to positive values
      angle = (angle + 360) % 360;
    
      // Return the rotation value
      return angle + 'deg';
    }

    // create elements for years around the dial
  	for (let i of [...Array(numberSections).keys()]) {
		  let d = document.createElement("a");
		  d.classList.add("history-new--dial-year");

		  if (i == 0) {
			  d.classList.add('history-new--dial-year-active');
		  }
		  d.href = `#event-${i + 1}`;
		  d.dataset.position = i + 1;
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

    $('.history-new--slide-1').show(0);
    gsap.registerPlugin(ScrollTrigger, Draggable);

    
    // clicking on a year rotates the dial and adds active class to clicked year
    gsap.utils.toArray(".history-new--dial-year").map(el => {
		  el.addEventListener('click', function(e) {
        
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

        let active_position = $('.history-new--dial-year-active').data('position');
        let this_position = $(this).data('position');
        let num_spots = this_position - active_position;

        $('.history-new--slide-current').removeClass('history-new--slide-current').fadeTo(150, '0.0', function() {
          $(this).hide(0);
          $('.history-new--slide-' + this_position).css('opacity', '0').show(0).addClass('history-new--slide-current').fadeTo(150, '1.0');
        });

			  turnto += (-360 / numberSections) * num_spots;
        $('.history-new--dial-year').removeClass('history-new--dial-year-active');
        $(this).addClass('history-new--dial-year-active');
      
			  dial.style.transform = `rotate(${turnto}deg)`
		  })
	  });

    // position dashes and years equally around the dial
  	function positionChildElementsEqually() {
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
    
	  positionChildElementsEqually();

    // Initialize Draggable
    setTimeout(function() {
      Draggable.create("#history-dial", {
        type: "rotation",
        liveSnap: {
          rotation: function (value) {
            //snap to the closest increment of number of sections
            return Math.round(value / (-360/numberSections)) * (-360/numberSections);
          },
        },
       
        onDragStart: function() {
          if (clicked) {
          //   var element = document.getElementById('history-dial');
          //   var transformMatrix = window.getComputedStyle(element).getPropertyValue('transform');
          //   var matrixValues = transformMatrix.match(/matrix\(([^\)]+)\)/)[1].split(',').map(parseFloat);
        
          //   var rotateValue = matrixToRotate({
          //     a: matrixValues[0],
          //     b: matrixValues[1],
          //     c: matrixValues[2],
          //     d: matrixValues[3],
          //     e: matrixValues[4],
          //     f: matrixValues[5]
          //   });
          //   turnto = parseInt(rotateValue);
          //   $('#history-dial').css('transition', '');
          //  this.rotation = turnto;
          //   //$('#history-dial').css('transition', 'transform ease 0.3s');

          //   //TODO - if previously clicked, set the rotation value to the current rotation, so dragging starts at that rotation value instead of starting at 0
          //   // this.rotation = turnto;
          //   // $('#history-dial').css('transition', '').css('transform', 'rotate(' + turnto + 'deg)').css('transition', 'transform ease 0.3s');
            clicked = false;
            dragged = true;
          }
        },

         onDragEnd: function() {
          setTimeout(function() {
            dragged = true;
            clicked = false;
             var furthestLeftElement = findFurthestLeftElement(document.querySelectorAll('.history-new--dial-year:not(.history-new--dial-year-active):not(.history-grab-container)'));
             let this_position = $(furthestLeftElement).data('position');

             $('.history-new--slide-current').removeClass('history-new--slide-current').fadeTo(150, '0.0', function() {
               $(this).hide(0);
               $('.history-new--slide-' + this_position).css('opacity', '0').show(0).addClass('history-new--slide-current').fadeTo(150, '1.0');
            });

             $('.history-new--dial-year').removeClass('history-new--dial-year-active');
             $(furthestLeftElement).addClass('history-new--dial-year-active');
          }, 250);
           }
      })
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
  },
}