<!--
Template is injected directly from SS using inline-template property
-->
<template></template>

<script>
	// async component
	const VehicleListMobile = () => import('@js/components/Builder/mobile/VehicleList.vue'/* webpackChunkName: "builder/builder.mobile" */);

	// regular dependencies
	import BackgroundColour from '@js/components/Builder/BackgroundColour.vue';
	import ICountUp from 'vue-countup-v2';
	import { mapGetters } from 'vuex';

	export default {
		name: 'builder-vehicle',
		computed: {
			...mapGetters({
				height: 'height',
				vehicle: 'vehicle',
				model: 'model',
				total: 'total',
				device: 'device'
			})
		},
		data() {
			return {
				options: {
					useEasing: true,
					useGrouping: true,
					separator: ',',
					decimal: '.',
					prefix: '$',
					suffix: ''
				}
			};
		},
		components: {
			BackgroundColour,
			ICountUp,
			VehicleListMobile
		},
		props: {
			step: {
				type: String,
				default: 'vehicle'
			},
			defaultSwatch: {
				type: Object
			},
			defaultVehicle: {
				type: Object
			}
		},
		watch: {
			'defaultSwatch'(newValue, oldValue) {
				// if the default value is null do nothing
				if(!newValue) return;
				// if a default threesixty hasn't been saved locally set
				// it to the default one
				if(!this.model.threesixty.baseUrl) this.selectModelDetails(newValue.colour, newValue.theme, newValue.clearcut, newValue.threesixty);
			}
		},
		methods: {
			selectVehicle(vehicle) {
				this.$store.dispatch('resetAccessory');
				this.$store.dispatch('saveBuilderVehicle', {
					vehicle: vehicle
				});
			},
			selectModelDetails(colour, theme, clearcut, threesixty) {
				this.$store.dispatch('saveBuilderModelDetails', {
					...this.model,
					colour: colour,
					theme: theme,
					clearcut: clearcut,
					threesixty: threesixty
				});
			},
			selectModelSlug(model) {
				this.$store.dispatch('saveBuilderModelSlug', model);
			},
			theme() {
				// the dynamic header style colour only apply on the vehicle and colour section of the builder
				// (where the threesixty sit)
				return (this.step == 'configure' || this.step == 'accessories') ? 'tab--dark' : `tab--${this.vehicle.theme}`;
			}
		},
		mounted() {
			// no vehicle are stored in locatorage,
			// save a default one (first in the list)
			if(!this.vehicle.slug || this.step == 'external') this.selectVehicle(this.defaultVehicle, this.defaultVehicle.threesixty);
		}
	}
</script>
