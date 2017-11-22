<section class="page page--noise page--xpt page--pb">
	<div class="skewed-tile skewed-tile--content-bottom skewed-tile--overlap skewed-tile--bottom-down page--npt">
		<div class="skewed-tile__wrapper">
			<div class="skewed-tile__container">
				<div class="skewed-tile__background background-halo image--responsive" style="background-color: <% loop $Model %> $defaultSwatchColour <% end_loop %>" :style="{paddingBottom: (device == 'mobile') ? '80%' : '35%'}">
				</div>
				<div class="skewed-tile__content">
					<div class="full-width">
						<background-image :src="'<% loop $Model %>$lifeStyleImage<% end_loop %>'" :position="'center'"></background-image>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="grid__container">
		<div class="grid__lg--9 grid--center">
			<div class="vehicle-overlap">
				<div class="vehicle-overlap__container">
					<img :src="'<% loop $Model %>$defaultRightAngleClearCut<% end_loop %>'">
				</div>
			</div>
		</div>
	</div>


	<filters inline-template :default="'<% loop $Model %><% loop $specs.Limit(1) %>$groupName<% end_loop %><% end_loop %>'" :data="{device: device}">
		<div class="grid__container clearfix grid__xl--14 grid__lg--16 grid--center">
			<div class="grid--14 grid--center push--1">
				<% loop $Model %>
				<div class="type--left my--4x center-mobile">
					{$SVG($logo).fill(#000000).height(20)}
					<span class="color--dark ml--2x type--uppercase font--5x block-mobile">$name</span>
				</div>
				<% end_loop %>
			</div>

			<!-- filter for everything not mobile -->
			<div class="grid--14 grid--center push--1" v-sticky="{ zIndex: 1, stickyTop: 10 }" v-if="data.device !== 'mobile'">

				<ul class="filter filter--liquid">
					<% loop $Model %>
						<% loop $specs %>
						<li class="filter__item px--3x py--1x" :class="{'filter__item--active': query == '$groupName'}" @click="set('$groupName')">$groupName</li>
						<% end_loop %>
						<li class="filter__item px--3x py--1x" :class="{'filter__item--active': query == 'all'}" @click="set('all')">all specs</li>
					<% end_loop %>
				</ul>
			</div>
			<!-- /filter for everything not mobile -->

			<!-- mobile filter -->
			<div class="grid__sm--14 grid--center clearfix center-mobile" v-else>
				<dropdown :visible="visible" @clickOut="visible = false" :position="[ 'center', 'bottom', 'left', 'top' ]" :animation="'ani-slide-y'" class="mobile-dropdown relative">
					<div class="font--6x py--2x center-mobile" @click="visible = true" v-text="(query == 'all') ? 'All specs' : query"></div>
					<div class="font--6x color--dark" slot="dropdown">
						<% loop $Model %>
							<% loop $specs %>
							<div class="py--2x" :class="{'font--bold': query == '$groupName'}" @click="set('$groupName')">$groupName</div>
							<% end_loop %>
							<div class="py--2x" :class="{'font--bold': query == 'all'}" @click="set('all')">All specs</div>
						<% end_loop %>
					</div>
				</dropdown>
			</div>
			<!-- /mobile filter -->

			<hr class="grid--16 grid--center gradient-border mt--5x mb--10x">

			<div class="grid--8 grid__sm--16 grid__md--14 grid--center">
				<% include MitsubishiMotors/_Specifications Specifications=$Model %>
			</div>
		</div>
	</filters>
</section>


<!--
<% loop $Model %>
	<br>
	<br>
	<h1>View Full Spec - $name</h1>

	<p>$id</p>
	<p>$name</p>
	<p>$defaultSwatchName</p>
	<p>$defaultSwatchColour</p>
	<p>$defaultAngleName</p>
	<p>$defaultAngleImageTitle</p>
	<p>$defaultAngleImage</p>
	<div>
		<p>Unique specs:</p>
		<% loop $uniqueSpecs %>
			<p>$id, $name, $icon</p>
		<% end_loop %>
	</div>
	<div>
	<p>Spec labels:</p>
		<% loop $specLabels %>
			<p>$id, $name, $value,  $description, $group, $category</p>
		<% end_loop %>
	</div>
	<div>
	<p>Grouped Specs:</p>
	<% loop $specs %>

			<h5>$groupName</h5>

			<% loop $categories %>

				<br><h6>$categoryName</h6><br>

				<% loop $categories %>
					<p>$name: $value</p>
				<% end_loop %>

			<% end_loop %>
	<% end_loop %>
	</div>
	<p></p>
	<p>$rrp</p>
	<p>$co2</p>
	<p>$fuelConsumption</p>
	<p>$crashRatingProvider</p>
	<p>$crashRatingStars</p>

<% end_loop %>
-->
