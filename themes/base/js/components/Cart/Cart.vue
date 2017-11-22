<template>
	<div class="cart block-drop-shadow block-drop-shadow--top align--vertical py--6x" v-if="total">
		<div class="price mx--5x">
			<span class="price__label type--uppercase">total price</span>
			<span class="price__amount">${{total}}</span>
		</div>

		<div class="action mx--5x">
			<a href="" class="button button--uppercase">
				<span>Order from dealer</span>
			</a>
		</div>
	</div>
</template>
<script>
	import { mapGetters } from 'vuex';

	export default {
		name: 'cart',
		computed: {
			...mapGetters({
				total: 'total'
			})
		},
		methods: {
		}
	}
</script>
<style scoped>
.cart{
	position: fixed;
	bottom: 0;
	width: 100%;
	background: white;
	z-index: 11;
	justify-content: center;
}
</style>
