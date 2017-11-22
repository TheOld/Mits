/*
 *  ==== BindEscapeKey ====
 */

export default {
	methods: {
		binEscapeEvent() {
			// bind escape key to close method
			document.onkeydown = this.onKeydown;
		},
		onKeydown(e) {
			e = e || window.event;
			if (e.key === 'Escape' || e.key === 'Esc') this.$bus.$emit('escape:pressed');
		}
	},
	mounted() {
		this.binEscapeEvent();
	}
};
