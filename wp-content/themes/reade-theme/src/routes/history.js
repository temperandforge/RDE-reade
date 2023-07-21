import loadjs from 'loadjs'
const { $ } = window
const $body = $(document.body)

export default {
  init() {
    
    //TODO replace jquery use were possible
    //TODO does not work with new use of GSAP
    //TODO animation easing - easeInOut
    $('.btn--back-to-start').on('click', function(e) {
      e.preventDefault()
      for(let i = e.target.closest("#history-desktop").scrollLeft; i > 0; i--) {
        setTimeout(() => {
          e.target.closest("#history-desktop").scrollTo(i, 0)
        }, (e.target.closest("#history-desktop").scrollLeft - i ) / 11)
      }
    })

  },
  finalize() {
    //TODO include script integrity security checks
    loadjs([
      //mobile-first
      //TODO cash-dom instead of jQuery
      'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
      //desktop
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
    ], 'gsap', {
      before: function( _path, _scriptEl ) { /* execute code before fetch */ },
      async: true,  // load files synchronously or asynchronously (default: true)
      numRetries: 3,  // see caveats about using numRetries with async:false (default: 0),
      returnPromise: false  // return Promise object (default: false)
    });
  
    loadjs.ready('gsap', {
      /* scripts successfully loaded */ 
      success: function() { 
        //mobile
        const historySlider = document.querySelector( '.history--slider' )
        if( ! historySlider ) { return }
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
              slidesToScroll: 1,
              speed: 300, // match css value - search: f78
              prevArrow: history.querySelector('.slick-prev'),
              nextArrow: history.querySelector('.slick-next')
            })
          } else {
            if(document.querySelector('.history--slider.slick-initialized')) {
              $(historySlider).slick('unslick')
            }
          }
        }
        
        var x = window.matchMedia("(max-width: 1280px)") //match css media query breakpoint  - search: h89
        renderHistoryLayout(x) // Call listener function at run time
        x.addListener(renderHistoryLayout) // Attach listener function on state changes


        function initHistoryScroller() {
          gsap.registerPlugin(ScrollTrigger);

          let x = 0
          let sections = gsap.utils.toArray(".panel");
          let widths = sections.map(el => el.getBoundingClientRect().width)
          widths.map(val => x += val)

          gsap.to(sections, {
            x: -x + document.body.clientWidth,
            ease: "none",
            scrollTrigger: {
              trigger: ".history-desktop--scroll-container",
              pin: true,
              scrub: 1,
              // snap: 1 / (sections.length - 1),
              
              // base vertical scrolling on how wide the container is 
              // so it feels more natural.
              // a.k.a adjust rate of change relative to scroll quantity
              end: "+=3500",
            }
          });
        }
        initHistoryScroller()
      },
      error: function(depsNotFound) { 
        /*  cdn scripts failed to load */ 
        console.log('failed to load required scripts')
      },
    });
  },
}


function drawSVG() {
  //dynamically pinpoint and draw svg
}
