<!--
Template is injected directly from SS using inline-template property
-->
<template></template>

<script>
	import touchwipe from 'vanilla-touchwipe';
	import { mapGetters } from 'vuex';

	export default {
		name: 'vehicle-list-mobile',
		computed: {
			...mapGetters({
				height: 'height',
				vehicle: 'vehicle',
				device: 'device'
			})
		},
		props: {
			select: {
				type: Function
			},
			items: {
				type: Number
			},
			vehicles: {
				type: Array,
				required: true
			}
		},
		data() {
			return {
				current: null,
				transition: 'fadeLeft'
			};
		},
		methods: {
			setCurrent(position, isPrev, isNext) {
				this.current = position;

				if(isPrev) this.transition = 'fadeLeft';
				else if(isNext) this.transition = 'fadeRight';

				setTimeout(() => {
					this.select(this.vehicles[this.current - 1]);
				}, 750);
			},
			bindTouch() {
				this.touch = touchwipe(this.$refs.gesture, {
					wipeLeft: this.navigateNext,
					wipeRight: this.navigatePrev,
					min_move_x: 20,
					min_move_y: 20,
					preventDefaultEvents: true
				});
			},
			navigatePrev() {
				// navigate prev on swipe if previous item exist
				if (this.current - 1 > 0) this.setCurrent(this.current - 1, true, false);
			},
			navigateNext() {
				// navigate next on swipe if next item exist
				if (this.current + 1 <= this.vehicles.length) this.setCurrent(this.current + 1, false, true);
			}
		},
		mounted() {
			this.bindTouch();
			if(this.vehicles.length) {
				for (var i = 0; i < this.vehicles.length; i++) {
					if(this.vehicle.slug == this.vehicles[i].slug) this.current = i + 1;
				}
			}
		},
		beforeDestroy() {
			this.touch.unbind();
		}
	}
</script>

<style lang="less">

// block
.vehicle-list-mobile{
	position: relative;
}

// elements
.vehicle-list-mobile__item{
	position: absolute;
	width: 100%;
	min-height: 100px;
	transition: all 0.5s cubic-bezier(0.785, 0.135, 0.15, 0.86);
	opacity: 0;
}

.vehicle-list-mobile__item--next, .vehicle-list-mobile__item--prev{
	position: absolute;
	top: 0;
	z-index: 1;
	opacity: 1;
}

.vehicle-list-mobile__details{
	height: 40rem;
}

.vehicle-list-mobile__price{
	position: absolute;
	width: 100%;
	bottom: 4rem;
}

.vehicle-list-mobile__nav{
	display: none;
	transition: all 0.2s ease;
}

.vehicle-list-mobile__holder{
	width: 25%;
	display: flex;
	flex-direction: column;
	flex-grow: 1;
	text-align: left;
	transform: translateX(150%);
	transition: opacity 0.2s;
}

// modifiers
.vehicle-list-mobile__item--prev{
	left: 0;
	transform: translateX(-50%) translateY(20%);

	.vehicle-list-mobile__nav--prev{
		display: block;
	}

	.vehicle-list-mobile__holder{
		text-align: right;
		opacity: 0.4;
	}
}

.vehicle-list-mobile__item--next{
	right: 0;
	transform: translateX(50%) translateY(20%);

	.vehicle-list-mobile__nav--next{
		display: block;
	}

	.vehicle-list-mobile__holder{
		text-align: left;
		opacity: 0.4;
	}
}

.vehicle-list-mobile__item--current{
	opacity: 1;
	top: 0;
}

// transitions
.fadeLeft-enter-active, .fadeLeft-leave-active, .fadeRight-enter-active, .fadeRight-leave-active {
	transition: all 0.6s cubic-bezier(0.785, 0.135, 0.15, 0.86);
}
.fadeLeft-enter, .fadeLeft-leave-to {
	opacity: 0;
	transform: translateX(-5rem);
}

.fadeRight-enter, .fadeRight-leave-to {
	opacity: 0;
	transform: translateX(5rem);
}
</style>
