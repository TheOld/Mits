<template>
	<div class="threesixty__controller">
		<div class="threesixty__knob js-threesixty-knob" :style="{'left': `${position.x}px`, 'top': `${position.y}px`}">
			<span>360</span>
		</div>
		<svg>
			<path :d="controllerPath" />
		</svg>
	</div>
</template>
<script>
	import { normalize } from '@js/utils';

	export default {
		name: 'threesixty-controller',
		props: [
			'totalImages',
			'currentIndex'
		],
		methods: {
			init() {
				this.width = this.$el.offsetWidth;
				this.height = this.$el.offsetHeight;
			},
			getQuadraticBezierXYatPercent(startPt, controlPt, endPt, percent) {
				var x = Math.pow(1 - percent, 2) * startPt.x + 2 * (1 - percent) * percent * controlPt.x + Math.pow(percent, 2) * endPt.x;
				var y = Math.pow(1 - percent, 2) * startPt.y + 2 * (1 - percent) * percent * controlPt.y + Math.pow(percent, 2) * endPt.y;
				return( {x: x, y: y} );
			},
			getCurrentPosition(percentage) {
				let point = this.getQuadraticBezierXYatPercent({x: 0, y: 0}, {x: (this.width / 2), y: (this.height * 2)}, {x: this.width, y: 0}, percentage);
				return point;
			}
		},
		mounted() {
			this.init();
			this.$bus.$on('SITE_RESIZE', this.init);
		},
		computed: {
			progress () {
				return normalize(this.currentIndex, this.totalImages, 0);
			},
			controllerPath () {
				return `M0,0 Q${ this.width / 2 },${ 2 * this.height } ${ this.width },0`
			},
			position () {
				return {
					x: this.getCurrentPosition(this.progress).x,
					y: this.getCurrentPosition(this.progress).y
				}
			}
		},
		data() {
			return {
				width: 0,
				height: 0
			};
		}
	}
</script>
<style>
</style>

