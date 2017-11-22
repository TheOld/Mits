<template>
	<form class="my--10x" method="POST" :action="`/search?for=${search}`" ref="form" v-on:submit.prevent="saveQuery">
		<input placeholder="Search" type="text" class="search__input" v-model="search">
		<a class="search__button links links--arrow-right" @click="saveQuery">search</a>
	</form>
</template>
<script>
	import { mapGetters } from 'vuex';

	export default {
		name: 'search-input',
		data() {
			return {
				search: null
			}
		},
		props: {
			query: {
				type: String
			}
		},
		computed: {
			...mapGetters({
				querySearch: 'querySearch'
			})
		},
		methods: {
			saveQuery() {
				this.$store.dispatch('saveSearchQuery', this.search);
				this.$refs.form.submit();

			}
		},
		mounted() {
			this.search = this.query;
		}
	}
</script>
<style>
</style>

