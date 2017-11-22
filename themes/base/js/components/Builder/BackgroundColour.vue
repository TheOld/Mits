<template>
	<div class="background-colour">
		<transition-group name="colour-panel" tag="ul">
			<li v-for="clr in colours" :key="clr" class="background-colour__panel" :style="{backgroundColor: clr}"></li>
		</transition-group>
	</div>
</template>
<script>
	import {color, lightness} from 'kewler';

	export default {
		name: 'background-colour',
		props: {
			colour: {
				type: String,
				default: '#ffffff'
			},
		},
		computed: {
			lightColour() {
				return color(this.colour, lightness(15));
			}
		},
		watch: {
			'colour'(newValue, oldValue) {
				this.colours.push(this.lightColour);

				setTimeout(() => {
					this.colours.splice(0, 1)
				}, 1000)
			}
		},
		data() {
			return {
				colours: []
			}
		},
		mounted() {
			this.colours.push(this.lightColour);
		}
	}
</script>
<style>
.background-colour{
	position: absolute;
	width: 100%;
	height: 100%;
	overflow: hidden;
	top: 0;
	pointer-events: none;
}

.background-colour__panel{
	position: absolute;
	width: 120%;
	left: -20%;
	height: 100%;
	top: 0;
	z-index: -1;
}

.colour-panel-enter-active, .colour-panel-leave-active {
	transition: all 1s cubic-bezier(0.785, 0.135, 0.15, 0.86);
	transform-origin: left;
}
.colour-panel-enter, .colour-panel-leave-to {
	transform: scaleX(0) skew(-20deg);
}
</style>
