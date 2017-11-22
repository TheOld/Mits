<template>
</template>
<script>
	import dropdown from 'vue-my-dropdown';

	export default {
		name: 'combined-filters',
		data() {
			return {
				query: [],
				visible: false
			}
		},
		components: {
			dropdown
		},
		props: {
			filters: {
				type: Array,
				default: []
			},
			callback: {
				type: Function
			},
			data: {
				type: Object,
				default: null
			}
		},
		methods: {
			reset() {
				this.query = [];
			},
			toggle(query) {
				let exist = this.inArray(query);
				(!exist) ? this.add(query) : this.remove(query);
			},
			add(query) {
				this.query.push(query);
			},
			remove(query) {
				let index = this.query.indexOf(query);
				this.query.splice(index, 1);
			},
			inArray(query) {
				return (this.query.indexOf(query) < 0) ? false : true;
			},
			matchAtLeastOne(query) {
				if(!query || !this.query.length) return true;
				return this.query.some(elem => query.indexOf(elem) > -1);
			},
			matchEveryCriteria(query) {
				if(!query || !this.query.length) return true;
				return this.query.every(elem => query.indexOf(elem) > -1);
			}
		},
		computed: {
			isFiltered() {
				return (this.query.length > 0)
			}
		}
	}
</script>
<style>
</style>
