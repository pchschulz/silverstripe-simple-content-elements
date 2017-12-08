$(document).ready(function() {
	$('.accordion > .accordion__item > .item__title').click(function(e) {
		var accordion = $(this).closest('.accordion'),
				onlyOneOpen = true;

		if(onlyOneOpen) {
			var open = accordion.find('.accordion__item--is-open');
			if(open.length && !open.is($(this).parent('.accordion__item'))) {
				open.find('> .item__content').slideToggle('fast');
				open.toggleClass('accordion__item--is-open');
			}
		}

		$(this).next('.item__content').slideToggle('fast');
		$(this).parent('.accordion__item').toggleClass('accordion__item--is-open');
	});
});