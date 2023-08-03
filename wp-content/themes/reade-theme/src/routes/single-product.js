import loadjs from 'loadjs'
const { $ } = window
const $body = $(document.body)

export default {
  init() {

  },
  finalize() {

    if ($('.prp-product').length) {
      // more than 3, enable load more functionality
      if ($('.prp-product').length > 3) {
        let itemsPerPage = 3;
        let currentIndex = 0;
        let $products = $('.prp-product');

        showNextProducts();

        function showNextProducts() {
          $products.slice(currentIndex, currentIndex + itemsPerPage).fadeIn();
          currentIndex += itemsPerPage;

          if (currentIndex >= $products.length) {
            $('#prp-load-more').hide();
          }
        }

        $('#prp-load-more').on('click', function() {
          showNextProducts();
        });
      } else {
        // there are less than 3, just show them
        $('.prp-product').show();
      }
    }
  },
}