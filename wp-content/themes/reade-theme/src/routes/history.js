import loadjs from 'loadjs'
const { $ } = window
const $body = $(document.body)

export default {
  init() {
      // const $historySlider = $( '.history--slider' )
      // if( ! $historySlider.length ) return 
      // const $history = $historySlider.parent()
      // $historySlider.slick({
      //   arrows: true,
      //   autoplay: false,
      //   autoplaySpeed: 7000,
      //   dots: false,
      //   fade: false,
      //   infinite: false,
      //   slidesToShow: 1,
      //   slidesToScroll: 1,
      //   speed: 300, //f78 match css
      //   prevArrow: $history.find('.slick-prev'),
      //   nextArrow: $history.find('.slick-next')
      // })

      //

      //TODO dragscroll preventing
      // $(document.querySelector('.btn--back-to-start').addEventListener('click', function(e) {
      $('.btn--back-to-start').on('click', function(e) {
        e.preventDefault()
        for(let i = e.target.closest("#history-desktop").scrollLeft; i > 0; i--) {
          setTimeout(() => {
            e.target.closest("#history-desktop").scrollTo(i, 0)//, {behavior: 'smooth'})
          }, (e.target.closest("#history-desktop").scrollLeft - i )/ 11) //TODO easeInOut
        }
      })

      const $historyDesktop = $('.horizontal-scroll-wrapper')
      let horizontalScrollOffset = 0, flag = false
      $historyDesktop.on('scroll', (e) => {
        //scrolling right only
        if(
          $historyDesktop.offset().top > 0
        ) {
          // e.preventDefault()
          console.log('m')
          window.scrollTo(0, $historyDesktop.offset().top, { behavior: 'instant' })
        }
        horizontalScrollOffset = $historyDesktop.scrollTop()
        // console.log(flag, horizontalScrollOffset, $historyDesktop.scrollTop())
      })
  },
  finalize() {
    loadjs([
      // 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', 
      //mobile-first
      'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
      //desktop
      //'https://cdn.jsdelivr.net/npm/gsap@3.12.1/dist/gsap.min.js', 
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
      'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',//TODO integrity="sha512-Ic9xkERjyZ1xgJ5svx3y0u3xrvfT/uPkV99LBwe68xjy/mGtO+4eURHZBW2xW4SZbFrF1Tf090XqB+EVgXnVjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    ], 'gsap', {
      before: function(path, scriptEl) { /* execute code before fetch */ },
      async: true,  // load files synchronously or asynchronously (default: true)
      numRetries: 3,  // see caveats about using numRetries with async:false (default: 0),
      returnPromise: false  // return Promise object (default: false)
    });
  
    loadjs.ready('gsap', {
      success: function() { 
        /* foo.js & bar.js loaded */ 
        // const historySlider = document.querySelector( '.history--slider' )
        // if( ! historySlider ) return 
        // const history = historySlider.parentNode
        // function renderHistoryLayout(x) { //TODO
        //   if (x.matches) {
        //     // console.log('history - mobile')
        //     // console.log($)
        //     // console.log($(historySlider))
        //     $('.history--slider').slick({
        //       arrows: true,
        //       autoplay: false,
        //       autoplaySpeed: 7000,
        //       dots: false,
        //       fade: false,
        //       infinite: false,
        //       slidesToShow: 1,
        //       slidesToScroll: 1,
        //       speed: 300, //f78 match css
        //       prevArrow: history.querySelector('.slick-prev'),
        //       nextArrow: history.querySelector('.slick-next')
        //     })
        //   } else {
        //     // console.log('history - desktop')
        //     if(document.querySelector('.history--slider.slick-initialized')) {
        //       $(historySlider).slick('unslick')
        //     }
        //   }
        // }
        
        // var x = window.matchMedia("(max-width: 1280px)") //h89 match css on change
        // renderHistoryLayout(x) // Call listener function at run time
        // x.addListener(renderHistoryLayout) // Attach listener function on state changes
        // // console.log('success')


        function initHistoryScroller() {
          gsap.registerPlugin(ScrollTrigger);

          let x = 0
          let sections = gsap.utils.toArray(".panel");
          let widths = sections.slice(0, sections.length - 1).map(el => el.getBoundingClientRect().width)
          widths.map(val => x += val)
          // console.log(-x, widths)

          gsap.to(sections, {
            // xPercent: -100 * (sections.length - 1),
            x: -x,
            ease: "none",
            scrollTrigger: {
              trigger: ".history-desktop--scroll-container",
              pin: true,
              scrub: 1,
              // snap: 1 / (sections.length - 1),
              // base vertical scrolling on how wide the container is so it feels more natural.
              end: "+=3500",
            }
          });
        }
        initHistoryScroller()
      },
      error: function(depsNotFound) { 
         /* foobar bundle load failed */ 
         console.log('fail')
      },
    });
  },
}


function drawSVG() {
  //dynamically pinpoint and draw svg
}
