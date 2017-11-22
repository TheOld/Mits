<template>
	<div class="lazyimage" :class="{'image-placeholder': error}" ref="container">
		<loader :type="spinner" :progress="progress" :hide="loaded" v-if="spinner"></loader>
		<div class="lazyimage__image" :class="{'image--fullwidth': !cover}" v-if="loaded" ref="image">
			<img :class="{'image--fullwidth': !cover}" :src="imagePath">
		</div>
		<div class="lazyimage__layer" ref="layer" :style="{backgroundColor: mask}"></div>
	</div>
</template>
<script>
	import EnterViewportMixin from '@js/mixins/EnterViewport';
	import LoaderMixin from '@js/mixins/LoaderMixin';
	import anime from 'animejs';
	import fit from 'fit.js';

	export default {
		mixins: [EnterViewportMixin, LoaderMixin],
		props: {
			image: {
				type: String
			},
			reveal: {
				type: String,
				default: 'fade'
			},
			mask: {
				type: String,
				default: '#11171b'
			},
			spinner: {
				type: String,
				default: null
			},
			cover: {
				type: [String, Boolean],
				default: false
			},
			waitForScroll: {
				type: [String, Boolean],
				default: true
			}
		},
		methods: {
			onEnterViewport() {
				// if the 'wait-for-scroll' props is passed
				// the loading will start as soon as the component
				// is mounted
				if(!this.waitForScroll) return;
				// if not wait for scroll event to decide when to
				// load the image
				this.startLoading();
			},
			onLoadComplete() {
				console.log('load complete');
				this.loaded = true;
				this.$nextTick(() => {
					if(this.cover) this.fitInContainer()
					this.animationLoaded();
				})
			},
			onLoadProgress(event) {
				console.log('load progress', event);
			},
			onLoadError(error) {
				console.log('loading error replace, image will be replaced with placeholder', error);
				this.error = true;
				this.onLoadComplete();
			},
			startLoading() {
				this.load([this.image]);
			},
			fitInContainer() {
				fit(this.$refs.image, this.$refs.container, { cover: true });
			},
			animationLoaded() {
				// define the different animation
				let animation = {
					'fade': {
						opacity: 0
					},
					'left': {
						scaleX: 0,
						transformOrigin: ['0% 0%', '0% 0%']
					},
					'right': {
						scaleX: 0,
						transformOrigin: ['100% 100%', '100% 100%']
					},
					'top': {
						scaleY: 0,
						transformOrigin: ['0% 0%', '0% 0%']
					},
					'bottom': {
						scaleY: 0,
						transformOrigin: ['100% 100%', '100% 100%']
					}
				}

				// create timeline
				anime.timeline()
					.add({
						...animation[this.reveal],
						targets: this.$refs.layer,
						easing: 'easeOutExpo',
						duration: 1000,
						delay: 250
					})
					.add({
						targets: this.$refs.image,
						opacity: [0, 1],
						easing: 'easeOutExpo',
						offset: '-=800',
						duration: 2000
					});

			}
		},
		created() {
			this.$bus.$on('load:complete', this.onLoadComplete);
			this.$bus.$on('load:progress', this.onLoadProgress);
			// if the 'wait-for-scroll' props is passed load the image
			// directly without waiting for scroll event
			if(!this.waitForScroll) this.startLoading();
		},
		computed: {
			imagePath(oldValue, newValue) {
				return (this.error) ? this.placeholder : this.image;
			}
		},
		data() {
			return {
				error: false,
				loaded: false
			};
		}
	}
</script>
<style lang="less">
	.lazyimage{
		position: absolute;
		left: 0;
		width: 100%;
		height: 100%;
		overflow: hidden;

		&__image{
			position: absolute;
			left: 0;
			opacity: 0;
		}

		&__layer{
			position: absolute;
			height: 100%;
			width: 100%;
		}
	}
</style>

