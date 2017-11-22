<template>
	<canvas class="threesixty__canvas" :width="width * this.devicePixelRatio" :height="height * this.devicePixelRatio"></canvas>
</template>
<script>
	import raf from 'raf';

	export default {
		name: 'threesixty-canvas',
		props: [
			'images',
			'totalImages',
			'firstImage',
			'currentIndex',
			'width',
			'height'
		],
		watch: {
			'width'(newValue, oldValue) {
				// watch for width change and if so set a the rerender flag
				// to true to make sure the image will be re-draw even if it's
				// the same
				if(newValue !== oldValue) {
					this.setSize();
					this.forceRerender = true;
				}
			}
		},
		methods: {
			render() {
				this.draw(this.images[this.currentIndex])
				this.loop = raf(this.render);
			},
			setSize() {
				// wait for width and height to be passed
				if(!this.width || !this.height) return;

				// set possible new device pixel ratio
				this.devicePixelRatio = window.devicePixelRatio;

				// set canvas dom width and height
				this.$el.style.width = `${this.width}px`;
				this.$el.style.height = `${this.height}px`;

				// once the canvas has been updated make sure to select the new context
				// and set the new scale
				this.$nextTick(() => {
					// store canvas context
					this.context = this.$el.getContext("2d");
					// make sure canvas looks nice on hi dpi context
					this.context.scale(this.devicePixelRatio, this.devicePixelRatio);
				})
			},
			init() {
				// set canvas size
				this.setSize();
				// start raf loop (only redraw image if image has changed)
				this.render();
			},
			draw(img) {
				// skip if the requested image doesn't exist or if it's the same than
				// the existing one and if the force re-render flag is set to false
				if(!img || (this.currentImage === img && !this.forceRerender)) return;

				// store image variable for later use
				let ratio = img.width / img.height;
				let newWidth = this.width;
				let newHeight = this.width / ratio;

				// get image size based on canvas size
				if (newHeight > this.height) {
					newHeight = this.height;
					newWidth = newHeight * ratio;
				}

				// compute image offset on canvas (if needed)
				let xOffset = newWidth < this.width ? ((this.width - newWidth) / 2) : 0;
				let yOffset = newHeight < this.height ? ((this.height - newHeight) / 2) : 0;

				// make sure force rerender is set to false
				this.forceRerender = false;
				// store new image
				this.currentImage = img;
				// erase previous canvas drawing
				this.context.clearRect(0, 0, this.width, this.height);
				// draw new image
				this.context.drawImage(img, xOffset, yOffset, newWidth, newHeight);
			}
		},
		mounted() {
			this.init();
		},
		beforeDestroy() {
			raf.cancel(this.loop);
		},
		data() {
			return {
				currentImage: null,
				context: null,
				forceRerender: false,
				devicePixelRatio: window.devicePixelRatio
			};
		}
	}
</script>
<style>
</style>

