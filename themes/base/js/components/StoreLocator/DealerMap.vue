<template>
	<div class="dealer-map">
		<!-- map -->
		<div class="store-locator-container">
			<loader background="rgba(255, 255, 255, 0.8)" v-if="!tileLoaded"></loader>

			<dealer-details :content="infoContent"></dealer-details>

			<gmap-map ref="map" :options="settings.defaultMapOptions" :center="center" style="width: 100%; height: 100%">
				<gmap-cluster :styles="settings.defaultClusterSettings">
					<gmap-marker :key="i" v-for="(dealer,i) in dealers" :position="dealer.position" :clickable="true" :icon="iconType(dealer.services)" @click="toggleInfoWindow(dealer,i)"></gmap-marker>
				</gmap-cluster>
			</gmap-map>
		</div>
		<!-- /map -->
	</div>
</template>
<script>
	// vuex import
	import { mapGetters } from 'vuex';

	// components
	import DealerDetails from '@js/components/StoreLocator/DealerDetails.vue';

	// google maps imports
	import { load, Map, Marker, Cluster } from 'vue2-google-maps';
	import mapSettings from './mapSettings';

	export default {
		name: 'dealer-map',
		components: {
			'gmap-map': Map,
			'gmap-marker': Marker,
			'gmap-cluster': Cluster,
			'dealer-details': DealerDetails
		},
		methods: {
			toggleInfoWindow(dealer, idx) {
				this.infoContent = dealer;
				//check if its the same dealer that was selected if yes toggle
				if (this.currentMidx == idx) {
					this.infoContent = null;
					this.currentMidx = null;
				}
				//if different dealer set infowindow to open and reset current dealer index
				else {
					this.currentMidx = idx;
					this.$refs.map.panTo(dealer.position);
				}
			},
			centerOnVisibleMarkers() {
				if(!this.dealers) return;
				const bounds = new google.maps.LatLngBounds();
				for (let dealer of this.dealers) {
					bounds.extend(dealer.position);
				}
				this.$refs.map.$mapObject.fitBounds(bounds);
				this.$refs.map.$on('dragstart', () => this.infoContent = null);
				this.$refs.map.$on('tilesloaded', () => this.tileLoaded = true);
			},
			resize() {
				this.centerOnVisibleMarkers();
			},
			init() {
				this.$nextTick(() => {
					this.resize();
				});
			},
			iconType(services) {
				// render icon diffrently based on the service field:
				// seller icon: service contain 'new' or 'used'
				// service icon: everything else ('parts', 'service'...)
				return (~services.indexOf('new') || ~services.indexOf('used')) ? mapSettings.dealerIconSeller : mapSettings.dealerIconService;
			}
		},
		mounted() {
			// if google script hasn't been injected already
			// load the scripts first
			if(!window.google) {
				mapSettings.init = this.init;
				load({
					key: 'AIzaSyBzlLYISGjL_ovJwAehh6ydhB56fCCpPQw',
					libraries: 'geometry',
					v: '3.30'
				});
			} else {
				// mitigate co-operative multi-tasking
				setTimeout(() => {
					this.init();
				}, 0);
			}
		},
		created() {
			this.$bus.$on('SITE_RESIZE', this.resize);
		},
		destroyed() {
			this.$bus.$off('SITE_RESIZE', this.resize);
		},
		watch: {
			dealers(newValue, oldValue) {
				this.centerOnVisibleMarkers();
				this.infoContent = null;
			},
			processing(newValue, oldValue) {
				this.tileLoaded = false;
			}
		},
		computed: {
			...mapGetters({
				dealers: 'dealers',
				processing: 'processing'
			})
		},
		data() {
			return {
				settings: mapSettings,
				center: {
					lat: 0,
					lng: 0
				},
				infoWinOpen: false,
				infoContent: null,
				currentMidx: null,
				tileLoaded: false
			}
		}
	}
</script>
<style scoped>
	.store-locator-container {
		width: 100%;
		height: 700px;
		margin: 0 auto;
		position: relative;
		width: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}
	.dealer-detail-tile{
		width: 500px;
		position: absolute;
		z-index: 1;
		right: 10rem;
	}
</style>
