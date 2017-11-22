<!--
Template is injected directly from SS using inline-template property
-->
<template></template>

<script>
	// regular dependencies
	import ICountUp from 'vue-countup-v2';
	import { mapGetters } from 'vuex';

	export default {
		name: 'counter',
		computed: {
			...mapGetters({
				total: 'total'
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
			ICountUp
		}
	};
</script>
