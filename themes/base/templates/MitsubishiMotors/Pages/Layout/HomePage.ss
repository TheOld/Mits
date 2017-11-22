<section data-section="home">
	<!-- hero banner -->
	<section class="skewed-tile skewed-tile--bottom-down">
		<div class="skewed-tile__wrapper">
			<div class="skewed-tile__container">
				<% include MitsubishiMotors/_HeroBanner Video=$BannerVideo, Image=$BannerImage %>

				<a class="skewed-tile__content js-title">
					<h6 class="mb--5x">$BannerTitle</h6>
					<h2 class="color--light type--center">
						$BannerSubtitle
					</h2>
				</a>
			</div>
		</div>
	</section>
	<!-- /hero banner -->

	<!-- vehicle features -->
	<% loop $VehicleFeatures %>
		<section class="background-image-content background-image-content--top">
			<div class="background-image-content__content type--center">
				<h6 class="mb--5x">$Title</h6>
				<h1 class="mb--10x" style="color: $getBestContrast($BackgroundColour);">$Subtitle</h1>
				<a href="$Link.Link" class="button button--uppercase">
					<span>$ButtonText</span>
				</a>
			</div>
			<div class="background-image-content__background" style="background-color: $BackgroundColour; background-image: url($BackgroundImage.Link); padding-bottom: $BackgroundImage.GetRatio()%;"></div>
		</section>

		<section style="background-color: $BackgroundColour;">
			<div class="grid__container clearfix">
				<div class="grid--5 grid__sm--18 grid__md--5 <% if Even %>float--right pull__md--2<% else %> push__md--2<% end_if %>">
					<div class="vehicle-feature-description vehicle-feature-description--vertical pt--10x mt--10x js-tile-fast">
						<div class="vehicle-feature-description__image">
							<lazyimage offset="-100" image="$Image1.Fill(400, 400).URL" mask="$BackgroundColour" reveal="top"></lazyimage>
						</div>
						<div class="vehicle-feature-description__description">
							<h6 class="vehicle-feature-description__label vehicle-feature-description__label--vertical font--bold pt--4x">$Image1Title</h6>
							<p class="vehicle-feature-description__content font--bold py--4x">$Image1Copy</p>
						</div>
					</div>
				</div>

				<div class="grid--1 spacer <% if Even %>float--right<% end_if %>">
				</div>

				<div class="grid--8 grid__sm--18 grid__md--8 <% if Even %>float--right<% end_if %>">
					<div class="vehicle-feature-keypoint js-tile-slow">
						<div class="vehicle-feature-keypoint__image">
							<lazyimage offset="-100" image="$Image2.URL" mask="$BackgroundColour"></lazyimage>
						</div>
						<div class="vehicle-feature-keypoint__description" style="background-color: $BackgroundColour;">
							<h6 class="vehicle-feature-keypoint__label">$Image2Subtitle</h6>
							<h4 class="vehicle-feature-keypoint__title my--4x">$Image2Title</h4>
							<p class="vehicle-feature-keypoint__content font--bold">$Image2Copy</p>
						</div>
					</div>
				</div>
			</div>
		</section>
	<% end_loop %>
	<!-- /vehicle features -->


	<!-- vehicle special offer -->
	<% if $SpecialOfferVisibility %>
	<section class="vehicle-special-offer">
		<div class="flex flex--column">
			<div class="skewed-tile skewed-tile--content-top skewed-tile--top-up">
				<div class="skewed-tile__wrapper">
					<div class="skewed-tile__container">
						<div class="skewed-tile__background background-halo image--responsive" style="background-color: #$SpecialOffer.DefaultColour;" :style="{paddingBottom: (device == 'mobile') ? '80%' : '35%'}">
							<background-image
								:src="'$SpecialOffer.LifeStyleImage.Link'"
								:position="'bottom'"
							></background-image>
						</div>
						<div class="skewed-tile__content">
							<h6>$SpecialOfferTitle</h6>
							<span class="my--3x">
							{$SVG($SpecialOffer.BannerLogo.Link).fill($getBestContrast($SpecialOffer.DefaultColour)).height(40)}
							</span>
							<h5 class="mb--4x" style="color: $getBestContrast($SpecialOffer.DefaultColour)">$SpecialOfferSubtitle</h5>
							<a href="$SpecialOffer.Link" class="button button--model">
								<span style="color: #$SpecialOffer.DefaultColour;">$SpecialOfferButtonText</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="grid__lg--9 grid--center">
			<div class="vehicle-overlap vehicle-overlap--top">
				<div class="vehicle-overlap__container">
					<img src="$SpecialOffer.DefaultVehicleModelAngleImage">
				</div>
			</div>
		</div>
	</section>
	<% end_if %>
	<!-- /vehicle special offer -->

	<!-- tabbed tiles -->
	<% if $TileGroups %>
	<tabbed-tiles inline-template :selected="'<% loop $TileGroups.Limit(1) %>$Title<% end_loop %>'">
		<section class="background-color--grey pb--10x">
			<div class="grid__container clearfix type--center">
				<!-- tab -->
				<ul class="tab mb--10x">
					<% loop $TileGroups %>
						<li class="mx--6x tab__item" :class="{'tab__item--active': section == '$Title'}">
							<a class="tab__link type--uppercase" @click.stop.prevent="select('$Title')">$Title</a>
						</li>
					<% end_loop %>
				</ul>
				<!-- /tab -->

				<!-- /tiles -->
				<slide-skew-transition>
					<% loop $TileGroups %>
						<div class="grid--12 grid__sm--18 grid__md--18 grid__lg--14 grid__xl--10 grid--center" key="'$Title'" v-if="section === '$Title'">
							<% if $Type == 'Tiles' %>
								<% loop $Tiles %>
									<% include MitsubishiMotors/_TabbedTiles %>
								<% end_loop %>
							<% end_if %>
							<% if $Type == 'FAQ' %>
								<% include MitsubishiMotors/_FAQ %>
							<% end_if %>
						</div>
					<% end_loop %>
				</slide-skew-transition>
				<!-- /tiles -->
			</div>
		</section>
	</tabbed-tiles>
	<% end_if %>

</section>
