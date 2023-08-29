const { $ } = window
const $body = $(document.body)

export default {
    init() {
        
    },
    finalize() {
        function getQueryParams(url) {
            const paramArr = url.slice(url.indexOf('?') + 1).split('&');
            const params = {};
            paramArr.map(param => {
                const [key, val] = param.split('=');
                params[key] = decodeURIComponent(val);
            })
            return params;
        }

        if ($('.site-search-result').length) {

            let resultsPerPage = 10;
            let visibleResults = resultsPerPage;

            if ($('.site-search-result-container').length > resultsPerPage) {
                $('#site-search-load-more').show().css('display', 'flex');
            }

            $('.site-search-result-container:lt(' + visibleResults + ')').fadeIn();

            $('#site-search-load-more').on('click', function() {
                visibleResults += resultsPerPage;

                $('.site-search-result-container:lt(' + visibleResults + ')').fadeIn();

                if (visibleResults >= $('.site-search-result-container').length) {
                    $('#site-search-load-more').hide();
                }
            });
        }

        $('#site-search-filter ul li').on('click', function() {
            const searchParams = new URLSearchParams(window.location.search);
            document.location.href = '/?s=' + searchParams.get('s') + '&type=' + $(this).data('key');
            return;
        })
    },
}
