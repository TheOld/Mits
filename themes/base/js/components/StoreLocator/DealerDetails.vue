<template>
	<transition v-on:enter="enter" v-on:leave="leave" appear>
		<div class="dealer-detail-tile p--8x mb--4x" v-if="content">
				<h4 class="js-animated">{{content.name}}</h4>

				<div class="dealer-detail-tile__content">
					<span class="dealer-detail-tile__label pt--4x"></span>
					<span class="dealer-detail-tile__text js-animated">
						{{content.addressLine1}}<i class="color--dark" v-if="content.addressLine2">, </i>
						{{content.addressLine2}}<i class="color--dark" v-if="content.addressLine3">, </i>
						{{content.addressLine3}}
					</span>

					<span class="dealer-detail-tile__label pt--4x js-animated">Phone number</span>
					<a :href="`tel:${content.phone}`" class="dealer-detail-tile__text js-animated">{{content.phone}}</a>
				</div>

				<ul class="dealer-detail-tile__links pt--4x js-animated">
					<li v-if="content.website">
						<a rel="noopener noreferrer" target="_blank" :href="content.website" class="links links--arrow-right mr--4x">
							Visit website
						</a>
					</li>
					<li>
						<a rel="noopener noreferrer" target="_blank" :href="`https://www.google.com/maps/dir/Current+Location/${content.position.lat},${content.position.lng}`" class="links links--arrow-right">
							get directions
						</a>
					</li>
				</ul>
			</div>
	</transition>
</template>
<script>
	// external libraries
	import anime from 'animejs';

	export default {
		name: 'dealer-details',
		props: {
			content: {
				type: Object,
				required: false
			}
		},
		methods: {
			enter(el) {
				anime.timeline()
				.add({
					targets: el,
					transformOrigin: ['0% 0%', '0% 0%'],
					translateY: [40, 0],
					opacity: [0, 1],
					easing: 'easeOutExpo',
					duration: 1000
				})
				.add({
					targets: el.querySelectorAll('.js-animated'),
					transformOrigin: ['0% 0%', '0% 0%'],
					translateY: [40, 0],
					skewY: [10, 0],
					opacity: [0, 1],
					easing: 'easeOutExpo',
					duration: 1000,
					offset: '-=600',
					delay: (el, i, l) => { return i * 100; }
				});
			},
			leave(el, done) {
				anime.timeline()
				.add({
					targets: el,
					opacity: [1, 0],
					easing: 'easeOutExpo',
					duration: 250
				})
				.complete = done;
			}
		}
	}
</script>
<style>
</style>
