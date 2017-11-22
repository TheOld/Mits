<template>
	<div class="spinner spinner__logo">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80.7 69.9">
			<path :style="{fill: color}" d="M40.4 46.6l13.4 23.3h26.9L67.3 46.6z" id="right" ref="right"/>
			<path :style="{fill: color}" d="M40.4 46.6H13.5L0 69.9h26.9l13.5-23.3z" id="left" ref="left"/>
			<path :style="{fill: color}" d="M40.4 0L26.9 23.3l13.5 23.3 13.4-23.3z" id="top" ref="top"/>
		</svg>
	</div>
</template>
<script>
	import anime from 'animejs';
	export default {
		props: {
			color: {
				type: String,
				default: '#ed0000'
			}
		},
		mounted() {
			const timeline = anime.timeline({loop: true});

			timeline
				.add({
					targets: this.$el,
					opacity: 1
				})
				.add({
					targets: this.$refs.top,
					opacity: [0, 1],
					duration: 1000,
					easing: 'easeOutExpo',
				})
				.add({
					targets: this.$refs.left,
					opacity: [0, 1],
					offset: '-=750',
					duration: 1000,
					easing: 'easeOutExpo',
				})
				.add({
					targets: this.$refs.right,
					opacity: [0, 1],
					offset: '-=750',
					duration: 1000,
					easing: 'easeOutExpo',
				})
				.add({
					targets: this.$el,
					rotate: -360,
					easing: 'easeOutExpo'
				})
				.add({
					targets: this.$el,
					opacity: 0,
					duration: 750,
					easing: 'easeOutExpo'
				});
		}
	}
</script>
<style>
</style>

