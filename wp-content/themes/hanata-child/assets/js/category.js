document.addEventListener("DOMContentLoaded", function() {
	document.querySelectorAll(".faq-question").forEach(question => {
		question.addEventListener("click", function() {
			let answer = this.nextElementSibling;
			let toggle = this.querySelector(".faq-toggle");

			answer.style.display = answer.style.display === "block" ? "none" : "block";
			toggle.textContent = toggle.textContent === "+" ? "−" : "+";
		});
	});
});
jQuery(document).ready(function ($) {
	$('.js-toggle-button').on('click', function () {
		var $textBlock = $(this).prev('.seo-text');
		var toggleText = $(this).closest('.catalog__text').find('.seo-text').data('toggle-text');

		if ($textBlock.hasClass('__clip')) {
			$textBlock.removeClass('__clip').css('max-height', 'none');
			$(this).text(toggleText.hide);
		} else {
			$textBlock.addClass('__clip').css('max-height', '190px');
			$(this).text(toggleText.show);
		}
	});
});




