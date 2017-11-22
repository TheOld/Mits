<!--
We use the SS template directly here.
Available at: templates/includes/Page_Header.ss
-->
<template></template>
<script>
	// external libraries
	import { mapGetters } from 'vuex';
	import anime from 'animejs';

	export default {
		name: 'header-mobile',
		data() {
			return {
				open: false,
				section: null,
				loading: true        // flag to control loading
			}
		},
		computed: {
			...mapGetters({
				menus: 'navigation',
				isOpaque: 'opaqueHeader'
			}),
			items() {
				if(!this.section) return;
				return this.menus.filter(p => p.Name == this.section)[0];
			}
		},
		methods: {
			enter(el) {
				this.timelineenter = anime.timeline()
				this.timelineenter.add({
					targets: el,
					scaleY: [
						{ value: 0, duration: 0, elasticity: 0 },
						{ value: 1, duration: 1000, delay: 0, elasticity: 0, easing: 'easeOutExpo' }
					],
					skewY: [
						{ value: 10, duration: 300, easing: 'easeOutExpo', elasticity: 0 },
						{ value: 0, duration: 500, easing: 'easeOutExpo', elasticity: 0 }
					]
				})
				.add({
					targets: el.querySelectorAll('.js-menu-item'),
					translateY: [40, 0],
					skewY: [10, 0],
					opacity: [0, 1],
					easing: 'easeOutExpo',
					duration: 500,
					offset: '-=450',
					delay: (el, i, l) => { return i * 50; }
				});
			},
			done(){
				this.section = null;
			},
			leave(el, done) {
				this.timelineenter.completed = false;
				this.timelineenter.complete = () => {
					done();
				};
				this.timelineenter.reverse();
				this.timelineenter.play();
			},
			navigate(section) {
				// if menu items are not already loaded, trigger fetch
				if(this.loading) this.$store.dispatch('getMenus')
				this.section = section;
			},
			toggleSearch() {
				this.$store.dispatch('toggleSearch');
			}
		},
		watch: {
			menus(newValue, oldValue) {
				this.loading = false;
			}
		},
	}
</script>
<style>
</style>
