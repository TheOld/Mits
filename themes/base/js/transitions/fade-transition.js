// external libraries
import anime from 'animejs';

export default {
	functional: true,
	render: (createElement, context) => {
		// internal props
		const duration = context.props.duration || 500;
		const data = {
			props: {
				mode: 'out-in',
				css: false,
				duration: {
					type: [String, Number],
					default: 500
				}
			},
			on: {
				beforeEnter(el) {
					console.log(`%c This component use the following transition:%c /transitions/fade-transition `, 'background: #3C3B3F; color: #8ABEB7; padding: 5px 0;', 'font-weight: bold; background: #3C3B3F; color: #8ABEB7; padding: 5px 0;');
				},
				enter(el) {
					anime.timeline()
					.add({
						targets: el,
						opacity: [0, 1],
						easing: 'easeOutExpo',
						duration: duration
					});
				},
				leave(el, done) {
					anime.timeline()
					.add({
						targets: el,
						opacity: [1, 0],
						easing: 'easeOutExpo',
						duration: duration
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
