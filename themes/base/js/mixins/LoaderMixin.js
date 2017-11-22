import assetsLoader from 'assets-loader';

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
		load(manifest) {
			// if a loader is already in place kill it first
			// (this is for super excited user who might click too fast)
			if (this.loader) this.loader.destroy();

			this.loader = assetsLoader({
				'assets': manifest
			})
			.on('error', (error) => { this._onLoadError(error); })
			.on('progress', (progress) => { this._onLoadProgress(progress); })
			.on('childcomplete', (asset) => { this._onFileLoad(asset); })
			.on('complete', (complete) => { this._onLoadComplete(complete); });

			try {
				this.loader.start();
			} catch (error) {
				this._onLoadError(error);
			}
		},
		_onLoadProgress(progress) {
			this.progress = progress;
			this.onLoadProgress(this.progress);
		},
		_onFileLoad(asset) {
			this.onFileLoad(asset);
		},
		_onLoadError(error) {
			this.onLoadError(error);
		},
		_onLoadComplete(event) {
			setTimeout(() => {
				this.loader.destroy();
				this.onLoadComplete();
			}, 200);
		},
		onLoadProgress() {},
		onFileLoad() {},
		onLoadError() {},
		onLoadComplete() {}
	},
	beforeDestroy() {
		if (this.loader) {
			this.loader.destroy();
		}
	},

	data() {
		return {
			progress: 0
		};
	}
};
