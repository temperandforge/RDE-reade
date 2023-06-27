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
  },
  finalize() {
   console.log('hsdkfh')
    loadjs([
      // 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js', 
      //mobile-first
      'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js',
      //desktop
      'https://cdn.jsdelivr.net/npm/gsap@3.12.1/dist/gsap.min.js', 
    ], 'gsap', {
      before: function(path, scriptEl) { /* execute code before fetch */ },
      async: true,  // load files synchronously or asynchronously (default: true)
      numRetries: 3,  // see caveats about using numRetries with async:false (default: 0),
      returnPromise: false  // return Promise object (default: false)
    });
  
    loadjs.ready('gsap', {
      success: function() { 
        /* foo.js & bar.js loaded */ 
        const historySlider = document.querySelector( '.history--slider' )
        if( ! historySlider ) return 
        const history = historySlider.parentNode
        function renderHistoryLayout(x) {
          if (x.matches) {
            console.log('history - mobile')
            console.log($)
            console.log($(historySlider))
            $('.history--slider').slick({
              arrows: true,
              autoplay: false,
              autoplaySpeed: 7000,
              dots: false,
              fade: false,
              infinite: false,
              slidesToShow: 1,
              slidesToScroll: 1,
              speed: 300, //f78 match css
              prevArrow: history.querySelector('.slick-prev'),
              nextArrow: history.querySelector('.slick-next')
            })
          } else {
            console.log('history - desktop')
            if(document.querySelector('.history--slider.slick-initialized')) {
              $(historySlider).slick('unslick')
            }
          }
        }
        
        var x = window.matchMedia("(max-width: 1280px)") //h89 match css on change
        renderHistoryLayout(x) // Call listener function at run time
        x.addListener(renderHistoryLayout) // Attach listener function on state changes
        console.log('success')
      },
      error: function(depsNotFound) { 
         /* foobar bundle load failed */ 
         console.log('fail')
      },
    });
  },
}
