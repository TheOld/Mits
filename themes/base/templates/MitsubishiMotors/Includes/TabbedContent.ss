<% if $hasTileGroups %>
	<section class="editorial grid__container clearfix type--center my--10x">
		<% if $Subtitle %>
		<h6>$Subtitle</h6>
		<% end_if %>

		<% if $Title %>
		<h3 class="mt--5x mb--10x">$Title</h3>
		<% end_if %>

			<tabbed-tiles inline-template :selected="'<% loop $TileGroups.Limit(1) %>$Title<% end_loop %>'">
				<section class="pb--10x">
					<div class="grid__container clearfix type--center grid--12 grid__sm--18 grid__md--18 grid__lg--14 grid__xl--10 grid--center">
						<!-- tab -->
						<ul class="tab mb--10x">
							<% loop $TileGroups %>
								<li class="mx--6x tab__item" :class="{'tab__item--active': section == '$Title'}">
									<a class="tab__link type--uppercase" @click.stop.prevent="select('$Title')">$Title</a>
								</li>
							<% end_loop %>
						</ul>
						<!-- /tab -->

						<!-- tiles -->
						<slide-skew-transition>
							<% loop $TileGroups %>
								<div key="'$Title'" v-if="section === '$Title'">

									<% if $Type == 'Tiles' %>
										<% if $Tiles %>
											<% loop $Tiles %>
												<% include MitsubishiMotors/_TabbedTiles %>
											<% end_loop %>
										<% end_if %>
									<% else_if $Type == 'FAQ' %>
										<% if $FAQs %>
											<% include MitsubishiMotors/_FAQ FAQs=$FAQs %>
										<% end_if %>
									<% end_if %>

								</div>
							<% end_loop %>
						<slide-skew-transition>
						<!-- /tiles -->
					</div>
				</section>
			</tabbed-tiles>
	</section>
<% end_if %>
