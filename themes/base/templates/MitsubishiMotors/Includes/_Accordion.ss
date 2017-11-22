<!-- generic accordion component -->
<accordion inline-template>
	<slide-skew-transition>
		<ul class="accordion grid--8 grid__sm--16 grid__md--18 grid--center" v-show="show">
			<% loop $Accordions %>
				<li class="accordion__item animated js-tabbed-item js-item" :class="{'accordion__item--active': index == $Pos}">
					<h5 class="accordion__title py--4x mx-auto" @click.stop.prevent="select($Pos)">$Title <i></i></h5>
					<div class="accordion__content mx-auto">
						<div class="my--4x color--mid font--7x">
							$Content
						</div>
					</div>
				</li>
			<% end_loop %>
		</ul>
	</slide-skew-transition>
</accordion>
<!-- generic accordion component -->
