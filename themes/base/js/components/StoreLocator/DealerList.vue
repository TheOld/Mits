<template>
	<div class="dealer-list relative pb--10x">
		<div v-if="dealers">
			<!-- list -->
			<accordion inline-template :items="grouped" :query="query">
				<slide-skew-transition>
					<ul class="grid__container clearfix grid--18 grid__xl--9 grid--center accordion" v-show="show">
						<li v-for="(value, key, i) in items" :key="key" class="accordion__item grid__md--14 grid__lg--14 grid__xl--16 grid--center js-item" :class="{'accordion__item--active': (index == i || query !== null), 'js-animated': !query}">
							<h4 class="accordion__title grid__lg--12 grid__xl--16 grid--center py--4x mx-auto" @click.stop.prevent="select(i)">{{key}}<i></i></h4>
							<div class="accordion__content grid__lg--12 grid__xl--16 grid--center mx-auto" v-if="(index == i || query !== null)">
								<div class="grid--6 grid__sm--18 grid__md--9 grid__xl--9" v-for="dealer in value" :key="dealer.id">
									<dealer-details :content="dealer"></dealer-details>
								</div>
							</div>
						</li>
					</ul>
				</slide-skew-transition>
			</accordion>
			<!-- /list -->
		</div>
		<div v-else>
			<loader background="rgba(255, 255, 255, 0.8)" v-if="processing"></loader>
		</div>
	</div>
</template>
<script>
	import anime from 'animejs';
	// vuex import
	import { mapGetters } from 'vuex';

	export default {
		name: 'dealer-list',
		computed: {
			...mapGetters({
				dealers: 'dealers',
				grouped: 'grouped',
				processing: 'processing',
				query: 'query'
			})
		}
	}
</script>
<style>
</style>
