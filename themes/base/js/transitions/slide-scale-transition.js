// external libraries
import anime from 'animejs';

export default {
	functional: true,
	render: (createElement, context) => {
		const data = {
			props: {
				css: false,
				mode: 'out-in'
			},
			on: {
				beforeEnter(el) {
					console.log(`%c This component use the following transition:%c /transitions/slide-skew-transition `, 'background: #3C3B3F; color: #8ABEB7; padding: 5px 0;', 'font-weight: bold; background: #3C3B3F; color: #8ABEB7; padding: 5px 0;');
				},
				enter(el) {
					anime.timeline()
					.add({
						targets: el.querySelectorAll('.js-item'),
						transformOrigin: ['50% 50%', '50% 50%'],
						scale: [0.95, 1],
						opacity: [0, 1],
						easing: 'easeOutExpo',
						duration: 1000,
						delay: (el, i, l) => { return i * 100; }
					})
					.add({
						targets: el.querySelectorAll('.js-item-secondary'),
						transformOrigin: ['0% 0%', '0% 0%'],
						translateY: [40, 0],
						opacity: [0, 1],
						easing: 'easeOutExpo',
						duration: 1000,
						offset: '-=800',
						delay: (el, i, l) => { return i * 100; }
					});
				},
				leave(el, done) {
					anime.timeline()
					.add({
						targets: el.querySelectorAll('.js-item'),
						transformOrigin: ['50% 50%', '50% 50%'],
						scale: [1, 0.95],
						opacity: [1, 0],
						easing: 'easeOutExpo',
						duration: 500,
						delay: (el, i, l) => { return (l - i) * 100; }
					})
					.add({
						targets: el.querySelectorAll('.js-item-secondary'),
						transformOrigin: ['0% 0%', '0% 0%'],
						translateY: [0, 40],
						opacity: [1, 0],
						easing: 'easeOutExpo',
						duration: 1000,
						offset: '-=500',
						delay: (el, i, l) => { return i * 100; }
					})
					.complete = done;
				}
			}
		};
		return createElement('transition', data, context.children);
	},
	methods: {
		enter(el) {},
		leave(el, done) {}
	}
};
