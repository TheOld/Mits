<template>
</template>
<script>
	// dropdown mobile
	import dropdown from 'vue-my-dropdown';

	export default {
		name: 'filters',
		data() {
			return {
				query: null,
				visible: false
			}
		},
		components: {
			dropdown
		},
		props: {
			default: {
				type: String,
				default: null
			},
			data: {
				type: Object,
				default: null
			}
		},
		methods: {
			set(query) {
				this.query = query;
				this.visible = false;
			}
		},
		mounted() {
			this.query = this.default;
		}
	}
</script>
<style>
</style>
