function placeholder() {}

function handleFAQAccordion() {
	const $faq = $('.faq-accordion')
	if (!$faq.length) {
		return
	}

	$faq.each(function () {
		$(this)
			.find('.accordion-btn')
			.on('click', function () {
				$(this).attr('aria-expanded', function (i, attr) {
					return attr == 'true' ? 'false' : 'true'
				})
				$(this).parent().toggleClass('open')
				$(this)
					.siblings('.accordion-answer')
					.attr('aria-hidden', function (i, attr) {
						return attr == 'true' ? 'false' : 'true'
					})
			})
	})
}

function runBlocks() {
	placeholder()
	handleFAQAccordion()
}

export { runBlocks }
