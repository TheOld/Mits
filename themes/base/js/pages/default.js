import anime from 'animejs';
import Barba from 'barba.js';

var DefaultTransition = Barba.BaseTransition.extend({
	start: function() {
		/**
		 * This function is automatically called as soon the Transition starts
		 * this.newContainerLoading is a Promise for the loading of the new container
		 * (Barba.js also comes with an handy Promise polyfill!)
		 */

		// As soon the loading is finished and the old page is faded out, let's fade the new page
		Promise
			.all([this.newContainerLoading, this.fadeOut()])
			.then(this.fadeIn.bind(this));
	},

	fadeOut: function() {
		/**
		 * this.oldContainer is the HTMLElement of the old Container
		 */
		return anime({
			targets: ['#barba-wrapper'],
			opacity: 0,
			duration: 250,
			easing: 'easeInQuad'
		}).finished;
	},

	fadeIn: function() {
		/**
		 * this.newContainer is the HTMLElement of the new Container
		 * At this stage newContainer is on the DOM (inside our #barba-container and with visibility: hidden)
		 * Please note, newContainer is available just after newContainerLoading is resolved!
		 */
		var $el = this.newContainer;

		// hide old container
		this.oldContainer.style.display = 'none';

		// set css for the new container
		$el.style.opacity = 0;
		$el.style.visibility = 'visible';

		// animate
		anime({
			targets: ['#barba-wrapper', $el],
			opacity: 1,
			duration: 250,
			easing: 'easeInQuad',
			complete: () => {
				this.done();
			}
		});
	}
});

module.exports = DefaultTransition;
