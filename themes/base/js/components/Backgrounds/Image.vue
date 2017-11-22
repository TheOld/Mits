<template>
	<transition name="draw" mode="out-in" appear>
		<div v-if="loaded" class="background-image" :class="{'background-image--bottom': (position == 'bottom'), 'background-image--center': (position == 'center')}" :style="{ 'background-image': 'url(' + src + ')' }"></div>
	</transition>
</template>
<script>
	import LoaderMixin from '@js/mixins/LoaderMixin';

	export default {
		name: 'background-image',
		mixins: [LoaderMixin],
		props: {
			src: {
				type: String,
				default: null
			},
			position: {
				type: String,
				default: 'top'
			}
		},
		data() {
			return {
				loaded: false
			};
		},
		methods: {
			onLoadComplete() {
				setTimeout(() => {
					this.loaded = true;
				}, 500);
			}
		},
		created() {
			this.$bus.$on('load:complete', this.onLoadComplete);
			this.load([this.src]);
		},
		watch: {
			'src'(newValue, oldValue) {
				if(newValue !== oldValue) {
					this.loaded = false;
					this.load([this.src]);
				}
			}
		}
	}
</script>
<style>
.background-image{
	position: absolute;
	width: 100%;
	height: 100%;
	pointer-events: none;
	background-size: contain;
	-webkit-mask: url(~/themes/base/images/temp/sprite.png);
	-webkit-mask-size: 8400% 100%;
	background-repeat: no-repeat;
	background-position: center;
	opacity: 0.25;
	max-height: 600px;
}

.background-image--bottom{
	bottom: 0;
}

.background-image--center{
	top: 50%;
	transform: translateY(-50%);
}

.draw-enter-active {
	animation: mask-play 1s steps(83) reverse;
}
.draw-leave-active {
	opacity: 0;
}

@keyframes mask-play {
	from {
		-webkit-mask-position: 0% 0;
		mask-position: 0% 0;
	}
	to {
		-webkit-mask-position: 100% 0;
		mask-position: 100% 0;
	}
}
</style>
