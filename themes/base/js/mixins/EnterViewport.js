import scrollMonitor from 'scrollmonitor';

/*
 *  ==== EnterViewport ====
 */

export default {
	props: {
		offset: {
			type: [Number, String],
			default: 0
		}
	},
	methods: {
		enterViewport() {
			console.info('element enter viewport', (this.offset) ? `with offset: ${this.offset}` : '');
			this.scrollWatcher.destroy();
			this.onEnterViewport();
		},
		onEnterViewport() {
			// just a function prototype, can/should be overridden
			// in the component methods definition to handle extra
			// work after viewport enter
		}
	},
	mounted() {
		this.scrollWatcher = scrollMonitor.create(this.$el, parseInt(this.offset, 10));
		this.scrollWatcher.enterViewport(this.enterViewport);
	}
};
