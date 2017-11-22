<builder inline-template
	:step="'vehicle'"
	:default-vehicle="<% loop $StepData.Limit(1) %>{
	id: '$id',
	name: '$name',
	lifestyleImage: '$lifeStyleImage',
	colour: <% loop $defaultSwatch %>'$colour'<% end_loop %>,
	theme: '$Top.getBestContrastLabel($colour)',
	rrp: '$lowestRRP',
	slug: '$slug',
	<% loop $defaultSwatch %>
		threesixty: {
			baseUrl: '$path360s',
			extension: '$extension360s',
			totalImages: '$total360s',
			firstImage: '$start360s'
		}
	<% end_loop %>
	}<% end_loop %>">
	<section class="page page--noise page--xpt builder" :style="{minHeight: height + 'px'}" :class="`theme--${vehicle.theme}`">
		<!-- navigation -->
		<% include MitsubishiMotors/_BuilderNavigation Step=1 %>
		<!-- /navigation -->

		<!-- dynamic background colour -->
		<background-colour :colour="vehicle.colour"></background-colour>
		<!-- /dynamic background colour -->

		<!-- threesixty -->
		<div class="relative">
			<!-- dynamic background image -->
			<background-image :src="vehicle.lifestyleImage"></background-image>
			<!-- /dynamic background image -->


			<div class="grid__container type--center grid__sm--18 grid__xl--14 grid__lg--16 grid--center">
				<h2 class="mt--15x mb--5x">Select a vehicle</h2>

				<div class="relative grid__sm--18 grid__xl--10 grid--center image--responsive" style=" margin: 0 auto;" :style="{paddingBottom: (device == 'mobile') ? '52.8%' : '25.9%'}">
					<background-title class="background-title--top"></background-title>
					<threesixty v-if="vehicle.threesixty.baseUrl"
						:base-url="vehicle.threesixty.baseUrl"
						:extension="vehicle.threesixty.extension"
						:total-images="vehicle.threesixty.totalImages"
						:first-image="vehicle.threesixty.firstImage"
						:loading-label="`Your ${vehicle.name} is loading...`"
						:platform-theme="vehicle.theme"
					></threesixty>
				</div>

				<!-- next -->
				<% loop $StepData %>
				<fade-transition v-if="device != 'mobile'">
					<div class="builder__next type--left" v-if="vehicle.slug == '$slug'">
						<div class="js-item mb--2x">{$SVG($logo).height(20)}</div>
						<div class="price price--inline js-item">
							<span class="price__amount">${{ $lowestRRP | currency }}</span>
							<span class="price__conditions">RRP* + ORC</span>
						</div>
						<a :href="(vehicle.slug) ? `builder/configure/${vehicle.slug}` : null" class="button button--uppercase mt--4x js-item">
							<span>next</span>
						</a>
					</div>
				</fade-transition>
				<% end_loop %>
				<!-- /next -->
			</div>

		</div>
		<!-- /threesixty -->

		<!-- vehicle-list -->
		<div class="grid__container type--center grid__xl--14 grid__lg--16 grid--center" v-if="device != 'mobile'">
			<ul class="vehicle-list py--10x">
				<% loop $StepData %>

				<li class="vehicle-list__item" :class="{'vehicle-list__item--active': $id == vehicle.id}" @click="selectVehicle({
				id: '$id',
				name: '$name',
				lifestyleImage: '$lifeStyleImage',
				colour: <% loop $defaultSwatch %>'$colour'<% end_loop %>,
				theme: '$Up.getBestContrastLabel($defaultColour)',
				rrp: '$lowestRRP',
				slug: '$slug',
					<% loop $defaultSwatch %>
					threesixty: {
						baseUrl: '$path360s',
						extension: '$extension360s',
						totalImages: '$total360s',
						firstImage: '$start360s'
					}<% end_loop %>
				})">
					<div class="vehicle-list__images">
						<div class="vehicle-list__wires">
							{$SVG($outline).fill(#ffffff).width(200)}
						</div>
						<div class="vehicle-list__photo">
							<% loop $defaultModel %>
							<img src="$defaultRightAngleClearCut" alt="$name">
							<% end_loop %>
						</div>
					</div>
					<span class="vehicle-list__name pt--2x">$name</span>
				</li>
				<% end_loop %>
			</ul>
		</div>
		<div v-else>
			<vehicle-list-mobile inline-template
				:select="selectVehicle"
				:items="$StepData.Count"
				:vehicles="[
					<% loop $StepData %>{
						'slug': '$slug',
						'index': '$Pos',
						id: '$id',
						name: '$name',
						lifestyleImage: '$lifeStyleImage',
						colour: '#$defaultColour',
						theme: '$Up.getBestContrastLabel($defaultColour)',
						rrp: '$lowestRRP',
						slug: '$slug',
						<% loop $defaultSwatch %>
						threesixty: {
							baseUrl: '$path360s',
							extension: '$extension360s',
							totalImages: '$total360s',
							firstImage: '$start360s'
						}<% end_loop %>
					},<% end_loop %>
				]">
				<div class="vehicle-list-mobile mt--5x" :class="`theme--${vehicle.theme}`" ref="gesture">

					<div class="vehicle-list-mobile__details flex flex--vbottom flex--column">
						<!-- price -->
						<% loop $StepData %>
							<transition mode="out-in" :name="transition">
								<div class="vehicle-list-mobile__price price type--center"  v-if="current == $Pos">
									<span class="price__amount">${{ $lowestRRP | currency }}</span>
									<span class="price__conditions my--2x">RRP* + ORC</span>
								</div>
							</transition>
						<% end_loop %>
						<!-- /price -->

						<!-- bullets -->
						<ul class="bullets type--center mt--4x" :class="`bullets--${vehicle.theme}`">
						<% loop $StepData %>
							<% if TotalItems > 1 %>
								<li class="bullets__item" :class="{'bullets__item--active': current == $Pos}"></li>
							<% end_if %>
						<% end_loop %>
						</ul>
						<!-- /bullets -->
					</div>

					<% loop $StepData %>
						<span class="type--center vehicle-list-mobile__item flex flex--column" :class="{'vehicle-list-mobile__item--current': $Pos == current, 'vehicle-list-mobile__item--next': $Pos == (current + 1), 'vehicle-list-mobile__item--prev': $Pos == (current - 1)}">
							<div @click="setCurrent($Pos, ($Pos == (current - 1)), $Pos == (current + 1))" class="vehicle-list-mobile__holder">
							<a class="vehicle-list-mobile__nav vehicle-list-mobile__nav--prev mb--2x">PREV</a>
							<a class="vehicle-list-mobile__nav vehicle-list-mobile__nav--next mb--2x">NEXT</a>
							{$SVG($logo).height(15)}
							</div>
						</span>
					<% end_loop %>
				</div>
			</vehicle-list-mobile>
		</div>
		<!-- vehicle-list -->
	</section>
</builder>

<!--
<% loop $StepData %>
	<br>
	<br>
	<h1>Vehicle Builder - Step 1 > vehicle action</h1>
	<div style="border: 1px solid red; margin-bottom: 2em;">
		<p>
			<strong style="color: black;">Id:</strong> $id<br>
			<strong style="color: black;">Name:</strong> $name<br>
			<strong style="color: black;">Slug:</strong> $slug<br>
			<strong style="color: black;">Logo URL:</strong> $logo<br>
			<strong style="color: black;">Lowest RRP:</strong> $lowestRRP<br>
			<strong style="color: black;">Default Swatch Colour:</strong> <% with $defaultSwatch %>$colour<% end_with %><br>
			<strong style="color: black;">Outline URL:</strong> $outline<br>
			<strong style="color: black;">Default Clear Cut:</strong> $defaultClearCut<br>
			<strong style="color: black;">Lifestyle Image:</strong> $lifeStyleImage<br>
			<strong style="color: black;">Default Colour:</strong> $defaultColour<br>

			<% if $defaultSwatch %>
				<strong style="color: black;">Default Swatch:</strong>
				<% loop $defaultSwatch %>
					$name <br>
					$path360s <br>
					$extension360s <br>
					$total360s <br>
					$start360s
				<% end_loop %>
			<% end_if %>
		</p>
</div>
<% end_loop %>
-->

