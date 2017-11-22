<builder inline-template
	:step="'colour'"
	:default-swatch="<% loop $StepData %><% loop $defaultSwatch %>{
		threesixty: {
			baseUrl: '$path360s',
			extension: '$extension360s',
			totalImages: '$total360s',
			firstImage: '$start360s',
		},
		colour: '$colour',
		theme: '$Top.getBestContrastLabel($colour)',
		clearcut: '$rightAngleClearCut'
	}<% end_loop %><% end_loop %>">
	<section class="page page--noise page--xpt builder" :style="{minHeight: height + 'px'}" :class="`theme--${model.theme}`">
		<!-- navigation -->
		<% include MitsubishiMotors/_BuilderNavigation Step=3, Data=$StepData %>
		<!-- /navigation -->

		<!-- dynamic background colour -->
		<background-colour :colour="model.colour"></background-colour>
		<!-- /dynamic background colour -->

		<!-- threesixty -->
		<div class="relative">
			<!-- dynamic background image -->
			<background-image :src="vehicle.lifestyleImage"></background-image>
			<!-- /dynamic background image -->

			<div class="grid__container type--center grid__xl--14 grid__lg--16 grid--center">
				<h2 class="color--light my--15x">Select a colour</h2>

				<div class="relative grid__sm--18 grid__xl--10 grid--center" style="height: 0; margin: 0 auto;" :style="{paddingBottom: (device == 'mobile') ? '52.8%' : '25.9%'}">
					<background-title class="background-title--top"></background-title>
					<threesixty v-if="model.threesixty.baseUrl"
						:base-url="model.threesixty.baseUrl"
						:extension="model.threesixty.extension"
						:total-images="model.threesixty.totalImages"
						:first-image="model.threesixty.firstImage"
						:loading-label="`Your ${vehicle.name} is loading...`"
						:platform-theme="model.theme"
					></threesixty>
				</div>

				<% loop $StepData %>
				<div class="builder__next type--left" v-if="device != 'mobile'">
					<div class="js-item">{$SVG($logo).height(20)}</div>
					<div class="price price--inline js-item">
						<span class="price__amount">${{ $rrp | currency }}</span>
						<span class="price__conditions">RRP* + ORC</span>
					</div>
					<a :href="(model.colour) ? `builder/accessories/${vehicle.slug}/${model.slug}` : null" class="button button--uppercase mt--4x js-item">
						<span>next</span>
					</a>
				</div>
				<% end_loop %>
			</div>
		</div>

		<!-- colour swapper -->
		<ul class="colour-swapper py--15x">
			<% loop $StepData %>
				<% loop $swatches %>
					<li class="colour-swapper__item" :class="{'colour-swapper__item--active': '$colour' == model.colour}" @click="selectModelDetails('$colour', '$Top.getBestContrastLabel($colour)', '$rightAngleClearCut', {
						baseUrl: '$path360s',
						extension: '$extension360s',
						totalImages: '$total360s',
						firstImage: '$start360s'
					})">
						<span class="colour-swapper__colour" style="background: $colour;"></span>
						<strong class="colour-swapper__name" :style="{'color': model.theme}">$name</strong>
					</li>
				<% end_loop %>
			<% end_loop %>
		</ul>
		<!-- /colour swapper -->
		<!-- /threesixty -->
	</section>
</builder>

<!--
<% loop $StepData %>
	<div style="border: 1px solid red; margin-bottom: 2em;">
		<p>
			<strong style="color: black;">Id:</strong> $id<br>
			<strong style="color: black;">Name:</strong> $name<br>
			<strong style="color: black;">Logo URL:</strong> $logo<br>
			<strong style="color: black;">Life style image:</strong> $lifeStyleImage<br>
			<strong style="color: black;">defaultSwatchName:</strong> $defaultSwatchName<br>
			<strong style="color: black;">defaultSwatchColour:</strong> $defaultSwatchColour<br>
			<strong style="color: black;">rrp:</strong> $rrp<br>
			<strong style="color: black;">onPromotion:</strong> $onPromotion<br>
		</p>
		<% if $swatches %>
			<ul>
				<% loop $swatches %>
					<li><strong style="color: black;">{$name}:</strong> <span style="color: black;">$colour</span></li>
					<p>$id</p>
					<p>$name</p>
					<p>$slug</p>
					<p>$path360s</p>
					<p>$extension360s</p>
					<p>$total360s</p>
					<p>$start360s</p>
				<% end_loop %>
			</ul>
		<% end_if %>
	</div>
<% end_loop %>

-->
