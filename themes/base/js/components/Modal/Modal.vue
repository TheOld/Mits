<template>
	<transition name="modal">
		<div class="modal__mask" v-if="show">
			<div class="modal__wrapper">
				<div class="modal__container relative" v-on-clickaway="away">
					<a class="modal__close icon-close" @click="away()"></a>

					<div class="modal__media" v-if="content.image">
						<div slot="media" class="modal__image" :style="{ backgroundImage: 'url(' + content.image + ')' }"></div>
					</div>

					<div class="modal__body type--left px--5x py--10x">
						<div>
							<h6>{{content.category}}</h6>
							<h4 class="py--4x">{{content.name}}</h4>
							<span class="color--dark">${{content.rrp | currency}}</span>
							<p class="py--4x" v-html="content.description">{{ content.description }}</p>
							<a href="" class="button button--active button--uppercase" v-if="isSelectedAccessory(content.id)">
								<span>
									<i class="icon-tick mr--1x"></i> Added
								</span>
							</a>
							<a class="button button--uppercase" @click.stop="toggleAccessory(content.id, content.name, content.rrp)" v-else>
								<span>Add</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</transition>
</template>
<script>
	import { mixin as clickaway } from 'vue-clickaway';

	export default {
		name: 'modal',
		mixins: [ clickaway ],
		data() {
			return {
				show: false,
				content: null
			}
		},
		methods: {
			away() {
				this.show = false;
			},
			onKeydown(e) {
				e = e || window.event;
				if (e.key == "Escape" || e.key == "Esc") {
					this.away();
				}
			},
			bindCloseEvents() {
				// bind escape key to close method
				window.addEventListener('keydown', this.onKeydown);
			},
			unbindCloseEvents() {
				// unbind escape key to close method
				window.removeEventListener('keydown', this.onKeydown);
			}
		},
		watch: {
			show(newVal, oldVal) {
				(newVal) ? this.bindCloseEvents() : this.unbindCloseEvents();
			}
		},
		destroyed() {
			this.unbindCloseEvents();
		}
	}
</script>
<style>
</style>
