<template>
	<transition-group name="title" class="background-title background-title--medium" tag="ul" :css="false" v-on:before-enter="beforeEnter" v-on:enter="enter" v-on:leave="leave">
		<li v-for="(letter, index) in letters" :key="index" :data-index="index">{{letter | isWhitespace}}</li>
	</transition-group>
</template>
<script>
	import anime from 'animejs';
	import { mapGetters } from 'vuex';

	export default {
		name: 'background-title',
		computed: mapGetters({
			vehicle: 'vehicle'
		}),
		watch: {
			'vehicle.name'(newValue, oldValue) {
				this.letters = [];

				setTimeout(() => {
					this.letters = newValue.split('');
				}, 1250);
			}
		},
		filters: {
			isWhitespace: function(value) {
				return (value == ' ') ? '\xA0' : value;
			}
		},
		methods: {
			beforeEnter: function (el) {
				el.style.opacity = 0;
			},
			enter: function (el, done) {
				anime.timeline()
				.add({
					targets: el,
					translateY: [30, 0],
					skewY: [10, 0],
					opacity: [0, 0.1],
					easing: 'easeOutExpo',
					duration: 750,
					delay: el.dataset.index * 50
				})
				.complete = done;
			},
			leave: function (el, done) {
				anime.timeline()
				.add({
					targets: el,
					translateY: [0, -50],
					skewY: [0, 10],
					opacity: [0.1, 0],
					easing: 'easeOutExpo',
					duration: 750,
					delay: el.dataset.index * 50
				})
				.complete = done;
			}
		},
		data() {
			return {
				letters: []
			}
		},
		mounted() {
			this.letters = this.vehicle.name.split('');
		}
	}
</script>
<style>
</style>
