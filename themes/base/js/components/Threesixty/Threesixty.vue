<template>
	<div class="threesixty" @mousedown="start" @mousemove="move" @mouseup="up" @touchstart="start" @touchmove="move" @touchend="up">
		<threesixty-platform :visible="loaded" :color="platformColour"></threesixty-platform>
		<loader type="mitsubishi" :hide="loaded" :label="loadingLabel" :position="'bottom'"></loader>
		<threesixty-canvas v-bind="$props" :width="width" :height="height" :images="images" :current-index="currentIndex" ref="canvas"></threesixty-canvas>
	</div>
</template>
<script>
	// library
	import classes from 'dom-classes';
	import anime from 'animejs';

	// components
	import Canvas from './Canvas.vue';
	import Platform from './Platform.vue';

	// mixins
	import LoaderMixin from '@js/mixins/LoaderMixin';
	import EnterViewportMixin from '@js/mixins/EnterViewport';

	export default {
		name: 'threesixty',
		mixins: [LoaderMixin, EnterViewportMixin],
		props: {
			baseUrl: {
				type: String,
				required: true
			},
			extension: {
				type: String,
				default: 'jpg'
			},
			totalImages: {
				type: [Number, String],
				default: 1
			},
			firstImage: {
				type: [Number, String],
				default: 1
			},
			loadingLabel: {
				type: String
			},
			platformTheme: {
				type: String,
				default: '#fffffff'
			}
		},
		components: {
			'threesixty-canvas': Canvas,
			'threesixty-platform': Platform
		},
		watch: {
			'baseUrl'(newValue, oldValue) {
				this.isUpdate = true;
				this.loaded = false;
				this.updateLeave();
			}
		},
		methods: {
			init() {
				this.width = this.$el.offsetWidth;
				this.height = this.$el.offsetHeight;
				// set initial index. check that first asked frame
				// is smaller than total images (image exist)
				this.currentIndex = (~~this.firstImage > this.totalImages) ? 1 : ~~this.firstImage;
				// make sure to update width and height when screen size changes
				this.$bus.$on('SITE_RESIZE', this.resize);
			},
			onEnterViewport() {
				this.$nextTick(() => {
					this.loadImages();
				})
			},
			loadImages() {
				// parse the number of images required for sequence
				let length = parseInt(this.totalImages, 10) + 1;
				// if webp is passed as props make sure the browser can handle it
				// if not fallback to png
				let extension = (this.extension === 'webp') ? ((Modernizr.webp) ? 'webp' : 'png') : this.extension;
				let images = [];

				// make sure that the image selected as first image is at index 0 in array of loading assets
				// this will make sure the image will be among the first to be loaded
				images.push(this.imageObject(this.currentIndex, extension));

				// generate array of assets to load excluding the first image
				for (var i = 1; i < length; i++) {
					if(i != this.currentIndex) {
						images.push(this.imageObject(i, extension));
					}
				}

				// load images using assetloader mixin
				this.load(images);
			},
			imageObject(index, extension) {
				return {
					id: index,
					url: `${this.baseUrl}/${index}.${extension}`
				}
			},
			onLoadProgress(progress) {
				this.progress = progress;
			},
			onFileLoad(asset) {
				let loadedAsset = asset.id;
				this.images[loadedAsset] = asset.file;

				// if the first image is ready display it, even tho
				// the full 360 assets are not ready yet
				// only happen on threesixty first load and draw the image to the first angle
				if(this.firstImage == loadedAsset && !this.isUpdate) this.currentIndex = loadedAsset;

				// this happen on threesixty url update (baseUrl change) and will trigger an
				// enter animation on the canvas element
				if(this.currentIndex == loadedAsset && this.isUpdate) this.updateEnter();
			},
			onLoadComplete() {
				this.loaded = true;
			},
			start(event) {
				// if threesixty is not fully loaded cancel any interaction
				if(!this.loaded) return;
				this.originalDistance = (event.pageX || event.clientX || event.touches[0].clientX);
				this.lastIndex = this.currentIndex;
				this.mouseDown = true;
			},
			up(event) {
				this.mouseDown = false;
			},
			move(event) {
				if(!this.mouseDown) return;

				let distance = (event.pageX || event.clientX || event.touches[0].clientX) - this.originalDistance;
				let index = ~~((distance * this.totalImages) / this.width);
				let newIndex = this.lastIndex + index;

				if(newIndex > this.totalImages) newIndex = (newIndex-this.totalImages)%this.totalImages;
				else if(newIndex < 0) newIndex = this.totalImages - Math.abs((newIndex-this.totalImages)%this.totalImages);

				this.currentIndex = newIndex;
			},
			updateEnter() {
				anime.timeline()
				.add({
					targets: this.$refs.canvas.$el,
					opacity: [0, 1],
					translateX: [-40, 0],
					duration: 2000
				})
			},
			updateLeave() {
				anime.timeline()
				.add({
					targets: this.$refs.canvas.$el,
					opacity: [1, 0],
					translateX: [0, 40],
					duration: 500,
					delay: 450,
					complete: () => {
						this.loadImages();
					}
				})
			},
			resize() {
				this.width = this.$el.offsetWidth;
				this.height = this.$el.offsetHeight;
			}
		},
		mounted() {
			this.init();
		},
		data() {
			return {
				width: 0,
				height: 0,
				images: [],
				currentIndex: 0,
				lastIndex: 0,
				mouseDown: false,
				progress: 0,
				loaded: false,
				isUpdate: false
			};
		},
		computed: {
			platformColour() {
				// since we are passing a theme (either 'black' or 'light')
				// we need to convert that to a proper colour to be applied
				// on the svg (should be moved to the store at some point)
				return (this.platformTheme == 'light') ? '#ffffff': '#000000';
			}
		},
	}
</script>
<style>
</style>

