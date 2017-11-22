<template>
	<div class="video" :class="{'image-placeholder': error}" @mousemove="hover" @mouseout="out">
		<video class="video__media" ref="video"
			:src="video"
			:poster="poster">
		</video>
		<video-button-loader
			:progress="Math.floor(progress*100)"
			:loaded="loaded"
			:is-playing.sync="isPlaying"
			:is-visible="controlVisible"
			:autoplay="autoplay">
		</video-button-loader>
	</div>
</template>
<script>
	import VideoButtonLoader from '@js/components/VideoPlayer/VideoButtonLoader.vue';
	import LoaderMixin from '@js/mixins/LoaderMixin';

	export default {
		name: 'video-player',
		mixins: [LoaderMixin],
		props: {
			video: {
				type: String,
				required: true
			},
			poster: {
				type: String,
				required: false
			},
			loop: {
				type: [String, Boolean],
				required: false,
				default: false
			},
			autoplay: {
				type: [String, Boolean],
				required: false,
				default: false
			},
			muted: {
				type: [String, Boolean],
				required: false,
				default: false
			},
			controls: {
				type: [String, Boolean],
				required: false,
				default: true
			}
		},
		components: {
			VideoButtonLoader
		},
		methods: {
			onLoadComplete() {
				console.log('load complete');
				setTimeout(() => {
					this.loaded = true;
				}, 500);
			},
			onLoadError() {
				// if we can't load the video display a placeholer instead
				this.loaded = true;
				this.error = true;
			},
			start() {
				this.load([{
					url: this.video,
					blob: true
				}]);
			},
			showControl() {
				this.controlVisible = true;
			},
			hideControl() {
				if(this.isPlaying) this.controlVisible = false;
			},
			hover() {
				if(!this.error) this.showControl();

				if(this.timer) {
					window.clearTimeout(this.timer);
				}
				this.timer = window.setTimeout(() => {
					this.hideControl();
				}, 1000);
			},
			out() {
				this.hideControl();
			}
		},
		data() {
			return {
				error: false,
				loaded: false,
				isPlaying: false,
				controlVisible: true,
				timer: null
			};
		},
		mounted() {
			this.$bus.$on('video:load', this.start);

			// bind video properties
			this.$refs.video.loop = this.loop;
			this.$refs.video.muted = this.muted;

			if(!JSON.parse(this.controls)) this.controlVisible = false;
			if(!JSON.parse(this.autoplay)) return;

			// if autoplay simply start loading
			this.start();
		},
		watch: {
			isPlaying(newValue, oldValue) {
				if(newValue) {
					this.$refs.video.play();
					this.hideControl();
				} else {
					this.$refs.video.pause();
					this.showControl();
				}
			}
		}
	}
</script>
<style>
</style>
