<!--
Template is injected directly from SS using inline-template property
Simply use it like so:
<accordion inline-template>
	<span>Template</span>
</accordion>
-->
<template></template>

<script>
	// use common mixin
	import EnterViewportMixin from '@js/mixins/EnterViewport';
	// components
	import DealerDetails from '@js/components/StoreLocator/DealerDetails.vue';

	export default {
		name: 'accordion',
		mixins: [EnterViewportMixin],
		components: {
			'dealer-details': DealerDetails
		},
		props: {
			items: {
				type: Object,
				required: false
			},
			query: {
				type: String,
				required: false
			}
		},
		data() {
			return {
				show: false,
				index: null
			}
		},
		watch: {
			query(newValue, oldValue) {
				// if query is null simply re-run
				// enter animation
				if(!newValue) {
					this.show = false;
					this.$nextTick(() => {
						this.show = true;
					});
				}
			}
		},
		methods: {
			select(index) {
				if (index == this.index) {
					this.index = null;
				} else {
					this.index = index;
				}
			},
			onEnterViewport() {
				this.show = true;
			}
		}
	}
</script>
<style>
</style>
