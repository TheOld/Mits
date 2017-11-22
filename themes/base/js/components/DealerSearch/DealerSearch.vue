<template>
	<div class="dealer-search">
		<h6 class="dealer-search__placeholder" :class="{'dealer-search__placeholder--active': focus}">find a dealer</h6>
		<div class="dealer-search__holder">
			<div class="dealer-search__field px--3x py--2x">
				<input ref="search" class="dealer-search__input type--center" type="text" @click="setFocus" @blur="search" @keyup.enter="search" v-model="query">
			</div>
			<i class="dealer-search__icon icon-search ml--2x"></i>
		</div>
		<h6 class="dealer-search__hint py--2x">Type in your city or region</h6>
	</div>
</template>
<script>
	import { mapGetters , mapActions} from 'vuex';

	export default {
		name: 'dealer-search',
		data() {
			return {
				focus: false,
				placeholder: 'Find a dealer',
				query: null,
				firstSearch: true
			}
		},
		created() {
			this.query = this.placeholder;
			this.$store.dispatch('getDealers');
		},
		computed: {
			...mapGetters({
				dealers: 'dealers',
			})
		},
		methods: {
			...mapActions([
				'filterDealers'
			]),
			setFocus() {
				// remove placeholder if it's the first search or if the value
				// match initial place holder
				if(this.firstSearch || this.query == this.placeholder) this.query = '';
				this.focus = true;
				this.$refs.search.focus();
				this.$refs.search.select();
				this.firstSearch = false;
			},
			search() {
				// trigger store dealer filter action
				this.filterDealers(this.query);
				// if nothing has been typed simply put the initial placeholder back
				if(!this.query) this.query = this.placeholder;
				// hide placeholder and leave input focus
				this.focus = false;
				this.$refs.search.blur();
			}
		}
	}
</script>
<style>
</style>
