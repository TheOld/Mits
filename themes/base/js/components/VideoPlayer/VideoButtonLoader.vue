<template>
	<div class="video__control relative" :style="{ 'width': size + 'px', 'height': size + 'px' }" :class="{'video__control--hidden': !isVisible}">
		<svg class="video__progress" role="progressbar"
			:aria-valuemax="100"
			:aria-valuemin="0"
			:height="size"
			:width="size"
			:stroke="backgroundColor"
		>
			<circle fill="transparent" stroke-dashoffset="0"
				:cx="size / 2"
				:cy="size / 2"
				:r="radius"
				:stroke="backgroundColor"
				:style="{ 'stroke-width': calculatedStroke }"
			></circle>

			<circle v-if="!loaded" ref="progress" fill="transparent" stroke-dashoffset="0"
				:cx="size / 2"
				:cy="size / 2"
				:r="radius"
				:stroke="foregroundColor"
				:stroke-dasharray="strokeDashArray"
				:style="{ 'stroke-dashoffset': strokeDashOffset, 'stroke-width': calculatedStroke }"
			></circle>
		</svg>

		<div class="video__icons" @click="click">
			<transition mode="out-in" name="zoom-fade" v-if="autoplay && !loaded">
				<loader type="mitsubishi"></loader>
			</transition>
			<transition mode="out-in" name="zoom-fade" v-else>
				<i class="icon-play ml--1x" key="play" v-if="!isPlaying"></i>
				<i class="icon-pause" key="pause" v-if="isPlaying"></i>
			</transition>
		</div>
	</div>
</template>
<script>
	export default {
		name: 'video-button-loader',
		props: {
			progress: {
				type: Number,
				default: 0
			},
			loaded: {
				type: [String, Boolean],
				default: false
			},
			isPlaying: {
				type: [String, Boolean],
				required: true,
				default: false
			},
			isVisible: {
				type: [String, Boolean],
				default: true
			},
			size: {
				type: Number,
				default: 100
			},
			stroke: {
				type: Number,
				default: 3
			},
			autoStroke: {
				type: Boolean,
				default: true
			},
			backgroundColor: {
				type: String,
				default: '#ffffff'
			},
			foregroundColor: {
				type: String,
				default: '#ed0000'
			},
			autoplay: {
				type: [String, Boolean],
				default: false
			}
		},
		computed: {
			strokeDashArray() {
				const circumference = 2 * Math.PI * this.radius;
				// Use first 3 decimal places, rounded as appropriate
				return Math.round(circumference * 1000) / 1000;
			},
			strokeDashOffset() {
				const progress = this.progress;
				const circumference = 2 * Math.PI * this.radius;
				return ((100 - progress) / 100) * circumference;
			},
			radius() {
				const stroke = this.stroke ? this.stroke : 4;
				return (this.size - stroke) / 2;
			},
			calculatedStroke() {
				if (this.stroke) {
					return this.stroke;
				}
				if (this.autoStroke) {
					return parseInt(this.size / 8, 10);
				}
				return 4;
			}
		},
		methods: {
			click() {
				if(!this.loaded) {
					this.$bus.$emit('video:load', this);
				} else {
					this.$emit('update:isPlaying', !this.isPlaying);
				}
			}
		},
		watch: {
			loaded(newValue, oldValue) {
				if(newValue) this.$emit('update:isPlaying', true);
			}
		}
	}
</script>
<style>
</style>
