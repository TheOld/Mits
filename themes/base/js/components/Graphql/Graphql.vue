<template>
	<div class="graphql">
		GraphQL request to get navigation:
		<div class="loading" v-if="!menus">
			Loading menu...
		</div>
		<div type="context" v-if="menus!=null">
			<div v-for="item in menus" :key="item.Name">
				→ {{ item.Name }}
			</div>
		</div>
	</div>
</template>
<script>
	import { mapGetters } from 'vuex';

	export default {
		name: 'graphql',
		computed: mapGetters({
			menus: 'navigation'
		}),
		created () {
			this.$store.dispatch('getMenus')
		},
		data () {
			return {
				getMenus: null
			}
		}
	}
</script>
<style>
</style>

