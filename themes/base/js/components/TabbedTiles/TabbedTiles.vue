<!--
Template is injected directly from SS using inline-template property
Simply use it like so:
<tabbed-tiles inline-template>
	<span>Template</span>
</tabbed-tiles>
-->
<template></template>

<script>
	// store
	import { mapGetters } from 'vuex';

	// use common mixin
	import EnterViewportMixin from '@js/mixins/EnterViewport';

	export default {
		name: 'tabbed-tiles',
		mixins: [EnterViewportMixin],
		data() {
			return {
				section: null,
				page: 1
			}
		},
		computed: {
			...mapGetters({
				device: 'device'
			})
		},
		props: {
			selected: {
				required: false
			}
		},
		methods: {
			onEnterViewport() {
				this.section = this.selected;
			},
			select(section) {
				this.section = section;
			},
			margin() {
				if(this.section == 1) return 20;
				else return (15 + ((this.section - 2) * 35)) * -1;
			}
		}
	}
</script>
