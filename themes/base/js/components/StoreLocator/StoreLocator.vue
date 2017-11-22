<template>
	<div class="dealer-locator">
		<!-- filter -->
		<ul class="filter filter--center my--10x">
			<li class="filter__item px--3x py--1x" :class="{'filter__item--active': display == 'gmap'}"  @click="display = 'gmap'">map</li>
			<li class="filter__item px--3x py--1x" :class="{'filter__item--active': display == 'list'}" @click="display = 'list'">list</li>
		</ul>
		<!-- /filter -->

		<fade-transition>
			<component v-bind:is="display"></component>
		</fade-transition>
	</div>
</template>
<script>
	// local components
	import DealerList from '@js/components/StoreLocator/DealerList.vue';
	import DealerMap from '@js/components/StoreLocator/DealerMap.vue';

	export default {
		name: 'store-locator',
		components: {
			'list': DealerList,
			'gmap': DealerMap
		},
		data() {
			return {
				display: 'gmap'
			}
		}
	}
</script>
<style>
</style>
