<template>
	<div class="hello">
		<h1>Hello</h1> <br>
		<a class="button" @click="increment">Increment counter</a>
	</div>
</template>
<script>
	export default {
		methods: {
			increment() {
				this.$store.dispatch('incrementCounter');
			}
		},
		destroyed () {
			console.log('destroy hello')
		}
	}
</script>
<style lang="less">
	@import '~@styles/variables.less';

	.hello{
		color: @color-primary;
	}
</style>

