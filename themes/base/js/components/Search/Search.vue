<template>
	<transition v-on:enter="enter" v-on:leave="leave" appear>
		<section class="search__layer animated flex flex--vcenter flex--hcenter" v-if="displaySearch" v-on-clickaway="onEscapePress">
			<div class="search__holder animated js-item">
				<search-input></search-input>
			</div>
		</section>
	</transition>
</template>
<script>
	import { mixin as clickaway } from 'vue-clickaway';
	import { mapGetters } from 'vuex';
	import anime from 'animejs';

	export default {
		name: 'search',
		mixins: [ clickaway ],
		computed: {
			...mapGetters({
				displaySearch: 'displaySearch'
			})
		},
		methods: {
			enter(el) {
				this.timelineEnter = anime.timeline({
					autoplay: false
				});
				this.timelineEnter
					.add({
						targets: el,
						scaleY: [0, 1],
						opacity: [0, 1],
						transformOrigin: ['0% 0%', '0% 0%'],
						easing: 'easeOutExpo',
						duration: 500
					})
					.add({
						targets: el.querySelectorAll('.js-item'),
						translateY: [40, 0],
						opacity: [0, 1],
						easing: 'easeOutExpo',
						duration: 400
					})
				this.timelineEnter.play();
			},
			leave(el, done) {
				this.timelineLeave = anime.timeline();
				this.timelineLeave
					.add({
						targets: el.querySelectorAll('.js-item'),
						opacity: [1, 0],
						easing: 'easeOutExpo',
						duration: 200
					})
					.add({
						targets: el,
						opacity: [1, 0],
						easing: 'easeOutExpo',
						transformOrigin: ['0% 0%', '0% 0%'],
						duration: 500
					});
				this.timelineLeave.complete = done;
			},
			onEscapePress() {
				// escape key has been binded with the `BindEscapeKey` mixin
				// close the search layer if open
				if(this.displaySearch) this.$store.dispatch('closeSearch');
			}
		},
		mounted() {
			// bind escape key to close
			this.$bus.$on('escape:pressed', this.onEscapePress);
		}
	}
</script>
<style>
</style>

