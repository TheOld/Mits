<!--
We use the SS template directly here.
Available at: templates/includes/Page_Header.ss
-->
<template></template>
<script>
	import select from 'dom-select';
	import classes from 'dom-classes';
	import rafScroll from 'raf-scroll';

	// components dependencies
	import Megamenu from '@js/components/Header/desktop/Megamenu.vue';
	import { mapGetters } from 'vuex';
	import { mixin as clickaway } from 'vue-clickaway';

	export default {
		name: 'header',
		mixins: [ clickaway ],
		components: {
			Megamenu
		},
		data() {
			return {
				section: null,       // define the current megamenu section
				forceOpaque: null,   // force opaque style (when mega menu is expanded)
				isExpanded: false,   // flag for expanded state
				loading: true        // flag to control loading
			}
		},
		computed: {
			...mapGetters({
				menus: 'navigation',
				initialOpaque: 'opaqueHeader'
			}),
			isOpaque() {
				return this.forceOpaque || this.isExpanded || this.initialOpaque;
			}
		},
		methods: {
			expand(section) {
				// if menu items are not already loaded, trigger fetch
				if(this.loading) this.$store.dispatch('getMenus');
				// if menu is already open and same section has been
				// pressed simply close it
				// otherwise expand clicked section
				if(this.isExpanded && this.section == section) {
					this.close();
				} else {
					this.section = section;
					this.isExpanded = true;
				}
			},
			close(){
				this.section = null;
				this.isExpanded = false;
			},
			bindScroll() {
				// listen for scroll to toggle opaque/transparent header
				rafScroll.add(this.onScoll.bind(this));
			},
			onScoll(event) {
				if (event.scrollY > 100) {
					this.forceOpaque = true;
				} else if(!this.initialOpaque) {
					this.forceOpaque = false;
				}
			},
			setInitialState() {
				this.page = select('.container');
				this.$bus.$on('escape:pressed', this.close);
			},
			toggleBlur() {
				classes.toggle(this.page, 'blur');
			},
			toggleSearch() {
				this.$store.dispatch('toggleSearch');
			},
			onEscapePress() {
				this.close();
			}
		},
		watch: {
			section(newValue, oldValue) {
				// only toggle blur when either no section are selected
				// or a section has just been selected
				if(!oldValue || !newValue) this.toggleBlur();
			},
			menus(newValue, oldValue) {
				// once menu fetched set the loading flag to false
				// this will hide the spinner on the menu and trigger the
				// megamnu transition
				this.loading = false;
			}
		},
		mounted() {
			this.setInitialState();
			this.bindScroll();
		},
		beforeDestroy() {
			rafScroll.destroy();
		}
	}
</script>
<style>
</style>
