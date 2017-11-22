<!-- generic accordion component -->
<accordion inline-template>
	<slide-skew-transition>
		<ul class="accordion grid--8 grid__sm--18 grid__md--8 push__md--5" v-show="show">
			<% loop $FAQs %>
				<li class="accordion__item animated js-item" :class="{'accordion__item--active': index == $Pos}">
					<h5 class="accordion__title py--4x mx-auto" @click.stop.prevent="select($Pos)">$Question <i></i></h5>
					<div class="accordion__content mx-auto">
						<div class="my--4x color--mid">
							$Answer
						</div>
					</div>
				</li>
			<% end_loop %>
		</ul>
	<slide-skew-transition>
</accordion>
<!-- generic accordion component -->
