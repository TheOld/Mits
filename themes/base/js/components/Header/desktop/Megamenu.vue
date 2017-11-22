<template>
	<div class="megamenu-container">

		<transition v-on:enter="enter" v-on:leave="leave" v-for="item in navigation" :key="item.Name" appear>
			<div class="block-drop-shadow megamenu js-megamenu" v-if="menus && section == item.Name">
				<div class="grid__container grid__xl--14 grid__lg--16 grid--center">
					<div class="megamenu__wrapper">
						<ul class="list list--inline grid--center">
							<li class="list__item list__item--stacked px--1x js-megamenu-item" v-for="category in item.Items" :key="category.ID">
								<h4 class="font--bold type--center color--mid-light px--8x mb--10x">{{category.MenuTitle}}</h4>
								<a class="font--bold type--center color--dark mb--8x" :href="link.Link" v-for="link in category.Children" :key="link.ID">{{link.MenuTitle}}</a>
							</li>
						</ul>

						<div class="background-title background-title--medium">
							<span class="color--dark">{{item.Name}}</span>
						</div>
					</div>
				</div>
			</div>
		</transition>


		<transition v-on:enter="enter" v-on:leave="leave">
			<div class="megamenu megamenu--stretch js-megamenu" v-if="section == 'Vehicles'" mode="out-in">
				<div class="grid__container clearfix grid__xl--14 grid__lg--16 grid--center">
					<div class="megamenu__wrapper">
						<ul class="list list--inline list--center">
							<li class="list__item list__item--stacked px--8x js-megamenu-item" v-for="vehicle in vehicles" :key="vehicle.title">
								<a :href="vehicle.link" class="type--center">
									<div class="image image--responsive" style="padding-bottom: 41.3%;">
										<lazyimage  :image="vehicle.image" mask="#ffffff" spinner="spinner"></lazyimage>
									</div>
									<span class="font--bold type--center color--dark">{{vehicle.title}}</span>
									<span class="special-offer mt--1x" :class="{'invisible': !vehicle.hasPromotion}">Special offer</span>
								</a>
							</li>
						</ul>
					</div>

					<div class="background-title background-title--medium">
						<span class="color--dark">Vehicles</span>
					</div>
				</div>
			</div>
		</transition>

	</div>
</template>
<script>
	import select from 'dom-select';
	import anime from 'animejs';

	export default {
		name: 'megamenu',
		props: {
			section: {
				type: String
			},
			vehicles: {
				type: Array,
				default: []
			},
			menus: {
				type: Array,
				default: []
			}
		},
		methods: {
			enter(el) {
				this.timelineEnter = anime.timeline({
					autoplay: false
				});
				this.timelineEnter
					.add({
						targets: el,
						scaleY: [0, 1],
						opacity: [0, 1],
						transformOrigin: ['0% 0%', '0% 0%'],
						easing: 'easeOutExpo',
						duration: 500
					})
					.add({
						targets: el.querySelectorAll('.js-megamenu-item'),
						translateY: [40, 0],
						opacity: [0, 1],
						easing: 'easeOutExpo',
						duration: 400,
						offset: '-=200',
						delay: (el, i, l) => { return i * 100; }
					});
				this.timelineEnter.play();
			},
			leave(el, done) {
				this.timelineLeave = anime.timeline();
				this.timelineLeave
					.add({
						targets: el.querySelectorAll('.js-megamenu-item'),
						opacity: [1, 0],
						easing: 'easeOutExpo',
						duration: 200
					})
					.add({
						targets: el,
						opacity: [1, 0],
						easing: 'easeOutExpo',
						transformOrigin: ['0% 0%', '0% 0%'],
						duration: 500
					});
				this.timelineLeave.complete = done;
			}
		},
		computed: {
			navigation() {
				if(!this.menus) return;
				return this.menus.filter(p => this.megamenuItems.indexOf(p.Name) !== -1);
			},
		},
		data() {
			return {
				megamenuItems: ['Owners', 'Buyers', 'Offers']
			}
		}
	}
</script>
<style>
</style>
