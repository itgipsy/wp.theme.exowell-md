(function () {
'use strict';

const toTheTopThreshold = 600;

const $ = document.querySelector.bind(document);
const toTheTopBtn = $('#to-the-top');

let lastY = 0;
let toTopIsOn = false;

function showToTop() {
	toTheTopBtn.style.display = 'block';
	toTopIsOn = true;
}

function hideToTop() {
	toTheTopBtn.style.display = 'none';
	toTopIsOn = false;
}

function toTheTop(event) {
	event.preventDefault();
	jQuery('html, body').animate({scrollTop: 0}, 300);
	return false;
}

toTheTopBtn.addEventListener('click', toTheTop);

window.addEventListener('scroll', () => {
	if (!toTopIsOn && window.scrollY >= toTheTopThreshold) {
		requestAnimationFrame(showToTop);
	}
	if (toTopIsOn && window.scrollY < toTheTopThreshold) {
		requestAnimationFrame(hideToTop);
	}
}, false);

	
})();
