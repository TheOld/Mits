<builder inline-template :step="'summary'">
	<section class="page page--noise page--xpt page--pb">
		<!-- navigation -->
		<% include MitsubishiMotors/_BuilderNavigation Step=5 %>
		<!-- /navigation -->

		<div class="skewed-tile skewed-tile--content-bottom skewed-tile--overlap skewed-tile--bottom-down page--npt">
			<div class="skewed-tile__wrapper">
				<div class="skewed-tile__container">
					<div class="skewed-tile__background background-halo image--responsive" :style="{backgroundColor: model.colour, paddingBottom: (device == 'mobile') ? '80%' : '35%'}">
					</div>
					<div class="skewed-tile__content">
						<div class="full-width">
							<background-title></background-title>
							<background-image :src="'<% loop $StepData %>$lifeStyleImage<% end_loop %>'" :position="'center'"></background-image>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="grid__container">
			<div class="grid__lg--9 grid--center">
				<div class="vehicle-overlap">
					<div class="vehicle-overlap__container">
						<img :src="model.clearcut">
					</div>
				</div>
			</div>
		</div>

		<div class="grid__container clearfix grid__xl--14 grid__lg--16 grid--center mb--10x">
			<div class="grid--5 push--1 grid__sm--16 grid__md--5">
				<% loop $StepData %>
				<div class="type--left mt--2x center-mobile">
					{$SVG($logo).fill(#000000).height(20)}
					<span class="color--dark ml--2x type--uppercase font--5x block-mobile">{{ model.name }}</span>
					</br>
					<a class="button button--uppercase mt--3x center-mobile">
						<span>talk to a dealer</span>
					</a>
				</div>
				<% end_loop %>
			</div>

			<br class="grid__sm--18 my--4x only-mobile" />

			<div class="grid--6 grid__sm--18 grid__md--5 float--right center-mobile">
				<div class="price price--inline">
					<i-count-up class="price__amount"
						:start="0"
						:end="total"
						:decimals="0"
						:duration="0.5"
						:options="options"
					></i-count-up>
					<span class="price__conditions">RRP* + ORC</span>
				</div>
				<a class="links links--arrow-right mt--3x">Save my vehicle</a>
			</div>
		</div>

		<filters inline-template :default="'<% loop $StepData %><% loop $specs.Limit(1) %>$groupName<% end_loop %><% end_loop %>'" :data="{model: model, accessories: accessories, device: device}">
			<div class="grid__container clearfix grid__xl--14 grid__lg--16 grid--center">
				<div class="grid--14 push--1" v-sticky="{ zIndex: 1, stickyTop: 10 }" v-if="data.device !== 'mobile'">
					<!-- filter -->
					<ul class="filter filter--liquid">
						<% loop $StepData %>
							<% loop $specs %>
							<li class="filter__item px--3x py--1x" :class="{'filter__item--active': query == '$groupName'}" @click="set('$groupName')">$groupName</li>
							<% end_loop %>
							<li class="filter__item px--3x py--1x" :class="{'filter__item--active': query == 'all'}" @click="set('all')">all specs</li>
						<% end_loop %>
					</ul>
					<!-- /filter -->
				</div>

				<div class="grid__sm--14 grid--center clearfix center-mobile" v-else>
					<dropdown :visible="visible" @clickOut="visible = false" :position="[ 'center', 'bottom', 'left', 'top' ]" :animation="'ani-slide-y'" class="mobile-dropdown relative">
						<div class="font--6x py--2x center-mobile" @click="visible = true" v-text="(query == 'all') ? 'All specs' : query"></div>
						<div class="font--6x color--dark" slot="dropdown">
							<% loop $StepData %>
								<% loop $specs %>
								<div class="py--2x" :class="{'font--bold': query == '$groupName'}" @click="set('$groupName')">$groupName</div>
								<% end_loop %>
								<div class="py--2x" :class="{'font--bold': query == 'all'}" @click="set('all')">All specs</div>
							<% end_loop %>
						</div>
					</dropdown>
				</div>

				<hr class="grid--16 gradient-border mt--5x mb--10x">

				<div class="grid--18 clearfix reverse-mobile">
					<div class="grid--1 spacer not-mobile"></div>

					<div class="grid--5 grid__sm--18 grid__md--5">
						<h4 class="mb--7x">Unique features</h4>

						<!-- unique selling point -->
						<ul class="unique-selling-point">
							<% loop $StepData %>
								<% loop $uniqueSpecs %>
									<li class="unique-selling-point__item mb--2x">
										<span class="unique-selling-point__icon">
											{$SVG($icon).fill(#767676).height(20)}
										</span>
										<span class="unique-selling-point__label">$name</span>
									</li>
								<% end_loop %>
							<% end_loop %>
						</ul>
						<!-- /unique selling point -->

						<h4 class="mt--10x mb--5x">Colour</h4>

						<div class="comparison-table comparison-table--inactive">
							<table class="comparison-table__wrapper">
								<tbody>
									<tr class="comparison-table__line">
										<td class="comparison-table__cell font--5x">Finishing</td>
										<td class="comparison-table__cell">
											<!-- colour swapper -->
											<ul class="colour-swapper colour-swapper--small colour-swapper--left">
												<li class="colour-swapper__item">
													<span class="colour-swapper__colour" style="background: #3469b3;" :style="{'background': data.model.colour}"></span>
												</li>
											</ul>
											<!-- /colour swapper -->
										</td>
									</tr>
								</tbody>
							</table>
						</div>

						<h4 class="mt--10x mb--5x">Accessories</h4>
						<!-- comparison-table -->
						<div class="comparison-table comparison-table--inactive comparison-table--two-columns">
							<table class="comparison-table__wrapper">
								<tbody>
									<tr class="comparison-table__line mb--2x" v-for="accessory in data.accessories">
										<td class="comparison-table__cell font--5x">{{ accessory.name }}</td>
										<td class="comparison-table__cell font--5x">${{ accessory.rrp | currency }}</td>
									</tr>
									<tr class="comparison-table__line mb--2x" v-if="data.accessories.length == 0">
										<td class="comparison-table__cell font--5x">No accessories selected.</td>
										<td class="comparison-table__cell font--5x"></td>
									</tr>
								</tbody>
							</table>
						</div>
						<!-- comparison-table -->
					</div>

					<div class="grid--2 spacer not-mobile"></div>

					<div class="grid--8 grid__sm--18 grid__md--8">
						<% include MitsubishiMotors/_Specifications Specifications=$StepData %>
					</div>
				</div>
			</div>
		</filters>
	</section>
</builder>

<!--

<% loop $StepData %>
	<h2>Model ID $id - ($name)</h2>
	<h3>Unique Specs</h3>
	<% loop $uniqueSpecs %>
		<p>$name ($icon)</p>
	<% end_loop %>
  <h3>Grouped Specs</h3>
	<% loop $specs %>

		<h5>$groupName</h5>

		<% loop $categories %>

			<br><h6>$categoryName</h6><br>

			<% loop $categories %>
					<p>$name: $value</p>
			<% end_loop %>

		<% end_loop %>
	<% end_loop %>
<% end_loop %>
-->
