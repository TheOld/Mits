<template>
	<div class="loader">
		<fade-transition>
			<div class="loader__wrapper" :class="`loader__wrapper--${position}`" :style="{backgroundColor: background}" v-show="!hide" ref="container">
				<div v-if="type == 'progressbar'" ref="bar" class="loader__progressbar">
					<div class="loader__percentage" :style="{transform: 'scaleX(' + progress + ')'}"></div>
				</div>
				<spinner v-if="type == 'spinner'" ref="spinner"></spinner>
				<mitsubishi v-if="type == 'mitsubishi'" ref="mitsubishi"></mitsubishi>
				<span class="loader__label ml--2x" v-if="label">{{label}}</span>
			</div>
		</fade-transition>
	</div>
</template>
<script>
	import anime from 'animejs';
	import Spinner from '@js/components/Spinners/Spinner.vue';
	import Mitsubishi from '@js/components/Spinners/Mitsubishi.vue';

	export default {
		name: 'loader',
		components: {
			Spinner,
			Mitsubishi
		},
		props: {
			type: {
				type: String,
				default: 'spinner'
			},
			progress: {
				type: Number
			},
			background: {
				type: String,
				default: 'transparent'
			},
			hide: {
				type: Boolean,
				default: false
			},
			position: {
				type: String,
				default: 'center'
			},
			label: {
				type: String,
				default: null
			}
		},
		methods: {
		}
	}
</script>
<style>
</style>

