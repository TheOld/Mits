<section data-section="vehicles">
	<!-- hero banner -->
	<section class="skewed-tile skewed-tile--bottom-down" id="top">
		<div class="skewed-tile__wrapper">
			<div class="skewed-tile__container">
				<% include MitsubishiMotors/_HeroBanner Video=$BannerVideo, Image=$BannerImage %>

				<a class="skewed-tile__content js-title">
				<% if $BannerLogo.Link %>
				$SVG($BannerLogo.Link).height(30).fill($getBestContrast($DefaultColour))
				<% end_if %>
					<h2 class="color--light">
						$BannerTitle
					</h2>
				</a>

			</div>
		</div>
	</section>
	<!-- /hero banner -->


	<!-- vehicle overview -->
	<section style="background-color: #$DefaultColour;" class="type--center background-halo skewed-tile-whitespace--pt">
		<div class="grid--18 grid__sm--18 grid__xl--14 grid__lg--16 grid--center">
			<h6 class="mt--10x">$OverviewTitle</h6>
			<h2 class="my--4x" style="color: $getBestContrast($DefaultColour)">$OverviewSubtitle</h2>
			<div class="wysiwyg my--5x" style="color: $getBestContrast($DefaultColour)">
				$OverviewIntro
			</div>
			<ul class="list list--inline list--center wysiwyg flex--wrap" style="color: $getBestContrast($DefaultColour)">
				<% loop $FeaturedSpecs %>
					<li class="list__item list__item--stacked mx--4x my--4x">
						<span>{$SVG($Icon.Link).fill($Up.getBestContrast($DefaultColour)).width(100).height(50)}</span>
						<span class="font--bold font--4x type--center mt--4x">$Title</span>
					</li>
				<% end_loop %>
			</ul>
		</div>
		<div class="grid__lg--16 grid__xl--9 grid--center">
			<div class="vehicle-overlap">
				<div class="vehicle-overlap__container">
					<% loop $Vehicle %>
						<% loop $defaultModel %>
							<img src="$defaultAngleImage">
						<% end_loop %>
					<% end_loop %>
				</div>
			</div>
		</div>
	</section>
	<!-- /vehicle overview -->

	<!-- sticky navigation -->
	<nav class="sticky-navigation sticky-navigation--dark" v-sticky="{ zIndex: 1, stickyTop: -1 }" v-if="device !== 'mobile'">
		<div class="sticky-navigation__container grid__container clearfix pt--2x grid__xl--14 grid__lg--16 grid--center">
			<scrollactive
				active-class="current"
				bezier-easing-value=".785,.135,.15,.86"
			>
				<div class="sticky-navigation__logo mt--2x">
					<% loop $Vehicle %>
					<a class="scrollactive-item" href="#top">{$SVG($logo).fill($DefaultColour)}</a>
					<% end_loop %>
				</div>

				<div class="sticky-navigation__action">
					<ul class="navigation navigation--primary">
						<li class="navigation__item font--bold px--2x pt--2x pb--4x">
							<a class="scrollactive-item" href="#design">Design</a>
						</li>
						<li class="navigation__item font--bold px--2x pt--2x pb--4x">
							<a class="scrollactive-item" href="#technology">Technology</a>
						</li>

						<% if $SafetyAnimations %>
						<li class="navigation__item font--bold px--2x pt--2x pb--4x">
							<a class="scrollactive-item" href="#safety">Safety</a>
						</li>
						<% end_if %>

						<% if $GroupedAccessories %>
						<li class="navigation__item font--bold px--2x pt--2x pb--4x">
							<a class="scrollactive-item" href="#accessories">Accessories</a>
						</li>
						<% end_if %>

						<li class="navigation__item navigation__item--active font--bold px--2x pt--2x pb--4x">
							<a class="scrollactive-item" href="#range">Range</a>
						</li>

						<li class="navigation__item">
							<a href="" class="button button--uppercase">
								<span>compare</span>
							</a>
						</li>
					</ul>
				</div>
			</scrollactive>
		</div>
	</nav>
	<!-- /sticky navigation -->

	<!-- threesixty -->
	<section id="design" class="grid__container grid--18">
		<builder inline-template
			:step="'external'"
			:default-vehicle="<% loop $Vehicle.Limit(1) %>{
			id: '$id',
			name: '$name',
			lifestyleImage: '$lifeStyleImage',
			colour: <% loop $defaultSwatch %>'$colour'<% end_loop %>,
			theme: '$Top.getBestLuminosityContrastLabel($colour)',
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
			}<% end_loop %>"
			:default-swatch="<% loop $Vehicle.Limit(1) %><% loop $defaultSwatch %>{
				threesixty: {
					baseUrl: '$path360s',
					extension: '$extension360s',
					totalImages: '$total360s',
					firstImage: '$start360s',
				},
				colour: '$colour',
				theme: '$Top.getBestLuminosityContrastLabel($colour)',
				clearcut: '$defaultRightAngleClearCut'
			}<% end_loop %><% end_loop %>">
			<section class="colours type--center mt--10x">
				<h6>$ColourTitle</h6>
				<h2 class="my--4x">$ColourSubtitle</h2>
				<div class="mb--10x">
					$ColourIntro
				</div>

				<div class="relative colours type--center mt--10x" id="design">
					<div class="grid__container type--center grid__xl--14 grid__lg--16 grid--center">
						<div class="relative grid__sm--18 grid__xl--10 grid--center image--responsive" style="margin: 0 auto;" :style="{paddingBottom: (device == 'mobile') ? '52.8%' : '25.9%'}">
							<background-title class="builder__title"></background-title>
							<threesixty v-if="model.threesixty.baseUrl"
								:base-url="model.threesixty.baseUrl"
								:extension="model.threesixty.extension"
								:total-images="model.threesixty.totalImages"
								:first-image="model.threesixty.firstImage"
								:platform-color="'black'"
							></threesixty>
						</div>
					</div>
				</div>

				<!-- colour swapper -->
				<ul class="colour-swapper">
					<% loop $Swatches %>
						<li class="colour-swapper__item" :class="{'colour-swapper__item--active': '$colour' == model.colour}" @click="selectModelDetails('$colour', '$Top.getBestLuminosityContrastLabel($colour)', '$Up.defaultRightAngleClearCut', {
							baseUrl: '$path360s',
							extension: '$extension360s',
							totalImages: '$total360s',
							firstImage: '$start360s'
						})">
							<span class="colour-swapper__colour" style="background: $colour;"></span>
							<strong class="colour-swapper__name" style="color: $colour;">$name</strong>
						</li>
					<% end_loop %>
				</ul>
				<!-- /colour swapper -->

				<% loop $Vehicle.Limit(1) %>
				<a href="/builder/configure/$slug" class="button button--uppercase mt--8x mb--15x">
					<span>customize</span>
				</a>
				<% end_loop %>
			</section>
		</builder>
	</section>
	<!-- /threesixty -->


	<!-- vehicle feature -->
	<div class="grid__xl--14 grid__lg--16 grid--center">
		<% if $hasSlices %>

			<% loop $Slices %>

				<% if $Type == 'Image' %>
					<% include MitsubishiMotors/Image Pos=$Pos %>
				<% else_if $Type == 'Carousel' %>
					<div id="technology">
						<% include MitsubishiMotors/Carousel Pos=$Pos %>
					</div>
				<% end_if %>

			<% end_loop %>

		<% end_if %>
	</div>
	<!-- /vehicle feature -->


	<!-- safety -->
	<% if SafetyAnimations %>
	<section class="safety type--center" style="background-color: #132632;" id="safety">
		<h6 class="pt--10x">safety</h6>
		<h2 class="my--4x color--light">Safety for everyone</h2>

		<tabbed-tiles inline-template :selected="<% loop $SafetyAnimations.Limit(1) %>$Pos<% end_loop %>">
			<section class="pb--15x relative">
				<div class="grid__container clearfix type--center grid__xl--10 grid__lg--16 grid--center">
					<!-- tab -->
					<ul class="tab tab--fade tab--light tab--even my--10x" :class="{'tab--center': $SafetyAnimations.Count < 5}" v-if="device !== 'mobile'">
						<% loop $SafetyAnimations %>
							<li class="mx--6x tab__item" :class="{'tab__item--active': section == '$Pos'}" <% if First %>:style="{'marginLeft': ((page -1) * -100) + '%'}"<% end_if %>>
								<a @click.stop.prevent="select($Pos)">
								<% if $Icon.Link %>
								<span class="font--bold type--center">
									{$SVG($Icon.Link).fill($Up.getBestContrast($DefaultColour)).width(100)}
								</span>
								<% end_if %>
								<span class="tab__link color--light">$Title</span>
								</a>
							</li>
						<% end_loop %>
					</ul>

					<ul class="tab tab--fade tab--light tab--even tab--responsive my--10x" :class="{'tab--center': $SafetyAnimations.Count < 5}" v-else>
						<% loop $SafetyAnimations %>
							<li class="tab__item" :class="{'tab__item--active': section == '$Pos'}" <% if First %>:style="{'marginLeft': margin() + '%'}"<% end_if %>>
								<a @click.stop.prevent="select($Pos)">
								<% if $Icon.Link %>
								<span class="font--bold type--center">
									{$SVG($Icon.Link).fill($Up.getBestContrast($DefaultColour)).width(60).height(60)}
								</span>
								<% end_if %>
								<span class="tab__link color--light">$Title</span>
								</a>
							</li>
						<% end_loop %>
					</ul>
					<!-- /tab -->

					<!-- bullets -->
					<% if $SafetyAnimations.Count > 4 %>
						<ul class="bullets bullets--light mb--2x bottom-mobile" v-if="device !== 'mobile'">
							<% loop $SafetyAnimations.Limit($paginate($SafetyAnimations.Count, 4)) %>
							<li class="bullets__item" :class="{'bullets__item--active': page == '$Pos'}" @click="page = $Pos"></li>
							<% end_loop %>
						</ul>
					<% end_if %>
					<!-- /bullets -->

					<div class="relative">
						<!-- controls -->
						<a class="controls__nav controls__nav--prev" v-if="section > 1" @click="section -= 1; page = Math.ceil(section/4)">
							{$SVG('/themes/base/images/svg/nav-prev').fill('#FFFFFF')}
						</a>
						<a class="controls__nav controls__nav--next" v-if="section < $SafetyAnimations.Count" @click="section += 1; page = Math.ceil(section/4)">
							{$SVG('/themes/base/images/svg/nav-next').fill('#FFFFFF')}
						</a>
						<!-- /controls -->

						<!-- tiles -->
						<slide-scale-transition>
							<% loop $SafetyAnimations %>
								<div key="$Pos" v-if="section == $Pos">
									<div class="js-animated js-item image--responsive" style="width: 100%; padding-bottom: 41.8%;">
										<video-player
											video="$Animation.URL"
											poster="$CoverImage.URL"
											autoplay="true"
											loop="true"
											muted="true">
										</video-player>
									</div>
									<div class="grid--12 grid__sm--16 grid__md--12 grid--center js-animated js-item-secondary">
										<p class="color--light mt--10x">
											$Description
										</p>
									</div>
								</div>
							<% end_loop %>
						</slide-scale-transition>
						<!-- /tiles -->
					</div>
				</div>
			</section>
		</tabbed-tiles>
	</section>
	<% end_if %>
	<!-- /safety -->


	<!-- customize -->
	<section class="customise type--center" style="background-color: #F6F6F6;" id="accessories">
		<h6 class="pt--15x">Accessories</h6>
		<h2 class="my--4x">Customize your <br>Mitsubishi</h2>

		<!-- accessories -->
		<tabbed-tiles inline-template :selected="'<% if $AccessoryPacks %>Accessory Pack<% else %><% loop $GroupedAccessories.Limit(1) %>$category<% end_loop %><% end_if %>'">
			<section class="acessories">
				<div class="grid__container clearfix type--center grid__md--14 grid__lg--12 grid--center">
					<!-- tab -->
					<ul class="tab mb--10x">
						<% if $AccessoryPacks %>
						<li class="mx--8x tab__item" :class="{'tab__item--active': section == 'Accessory Pack'}">
							<a class="tab__link type--uppercase" @click.stop.prevent="select('Accessory Pack')">Accessory Pack</a>
						</li>
						<% end_if %>

						<% loop $GroupedAccessories %>
						<li class="mx--8x tab__item" :class="{'tab__item--active': section == '$category'}">
							<a class="tab__link type--uppercase" @click.stop.prevent="select('$category')">$category</a>
						</li>
						<% end_loop %>
					</ul>
					<!-- /tab -->

					<!-- tiles -->
					<slide-skew-transition>
						<% if $AccessoryPacks %>
							<div class="grid__container clearfix" key="'Accessory Pack'" v-if="section === 'Accessory Pack'">
								<% loop $AccessoryPacks %>
								<div class="grid--6 grid__sm--18 grid__md--18 grid__xl--9 animated js-item">
									<div class="tile tile--no-action tile--list mb--4x">
										<div class="tile__image">
											<lazyimage image="$image" mask="#ffffff" spinner="spinner" cover="true"></lazyimage>
										</div>
										<a href="" class="tile__action">
											<i class="icon-plus"></i>
										</a>
										<div class="tile__infos">
											<div class="tile__center">
												<span class="tile__title">$name</span>
												<span class="tile__subtitle">
													${$rrp}
													<span class="tile__emphasize">save $450</span>
												</span>
												<ul class="tile__list">
													<% loop $accessories %>
													<li class="tile__list__item">$name</li>
													<% end_loop %>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<% end_loop %>
							</div>
						<% end_if %>

						<% loop $GroupedAccessories %>
						<div class="grid__container clearfix" key="'$category'" v-if="section === '$category'">
							<% loop $accessories %>
							<div class="grid--3 grid__sm--18 grid__md--9 grid__lg--9 grid__xl--6 animated js-item">
								<div class="tile tile--no-action mb--4x" @click="showModal('accessory', {image: '$image', category: '$Up.category', name: '$name', rrp: '$rrp', description: '$Top.removeBreakline($description)'})">
									<div class="tile__image">
										<lazyimage  image="$image" mask="#ffffff" spinner="spinner" cover="true"></lazyimage>
									</div>
									<a href="" class="tile__action">
										<i class="icon-plus"></i>
									</a>
									<div class="tile__infos">
										<span class="tile__title">$name</span>
										<span class="tile__subtitle">${$rrp}</span>
									</div>
								</div>
							</div>
							<% end_loop %>
						</div>
						<% end_loop %>
					</slide-skew-transition>

					<modal :ref="'accessory'"></modal>
				</div>
			</section>
		</tabbed-tiles>
		<!-- accessories -->

		<!-- action -->
		<a href="" class="button button--uppercase my--15x">
			<span>customize your mitsubishi</span>
		</a>
		<a href="{$AccessoriesPageLink}vehicle/{$Vehicle.First.slug}" class="button button--uppercase button--chromeless my--15x">
			<span><i class="icon-th mr--2x" aria-hidden="true"></i>browse all ASX accessories</span>
		</a>
		<!-- /action -->
	</section>
	<!-- /customize -->

	<!-- range -->
	<combined-filters inline-template :filters="[<% loop $Filters %>'$name',<% end_loop %>]" :data="{device: device}">
		<section class="range clearfix" id="range">
			<h6 class="type--center pt--15x">range</h6>
			<h2 class="type--center my--4x">explore the <% loop $Vehicle %>$name<% end_loop %> range</h2>
			<div class="grid__container clearfix grid--14 grid__sm--18 grid__xl--14 grid__lg--16 grid--center">

				<% include MitsubishiMotors/_CombinedFilters Filters=$Filters %>

				<div class="separator mt--4x mb--10x"></div>

				<% loop $Models %>
				<!-- model -->
				<slide-fade-transition appear>
					<article v-show="matchAtLeastOne(<% if $searchFilters %>[<% loop $searchFilters %>'$name',<% end_loop %>]<% end_if %>)">
						<% include MitsubishiMotors/_Model Model=$Me %>
					</article>
				</slide-fade-transition>
				<!-- /model -->
				<% end_loop %>

			</div>
		</section>
	</combined-filters>
	<!-- /range -->

	<!-- faq -->
	<% if $FAQs %>
	<section class="faq background-color background-color--grey py--10x">
		<div class="editorial grid__container clearfix type--center">
			<h6>FAQS</h6>

			<% if $FAQsTitle %>
			<h3 class="mt--5x mb--10x">$FAQsTitle</h3>
			<% end_if %>

			<% include MitsubishiMotors/_FAQ FAQs=$FAQs %>
		</div>
	</section>
	<% end_if %>
	<!-- /faq -->

	<!-- brochure -->
	<% if $Brochure %>
	<section class="brochure" style="background: #$DefaultColour;">
		<div class="grid__container clearfix grid__sm--18 grid__xl--14 grid__lg--16 grid--center py--10x">
			<div class="clearfix align--vertical">
				<div class="grid--8 grid__sm--18">
					<img src="$BrochureImage.ScaleMaxWidth(320).URL" class="js-rotate float--right center-mobile">
				</div>
				<div class="grid--9 push__md--1 grid__sm--18 my--2x">
					<div class="flex flex--column flex--left">
						<span>
							<% loop $Vehicle %>
							{$SVG($logo).fill($Top.getBestLuminosityContrast($Top.DefaultColour)).height(35)}
							<% end_loop %>
						</span>
						<a href="$Brochure.Link" class="links links--arrow-right my--4x" style="color: $getBestLuminosityContrast($DefaultColour)">
							download brochure
						</a>
						<p style="color: $getBestLuminosityContrast($DefaultColour)">
							$BrochureBlurb
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<% end_if %>
	<!-- /brochure -->

	<!-- upsell -->
	<% if $UpsellVehicleLink %>
	<section class="upsell relative" style="background: #$UpsellVehicleLink.DefaultColour;">
		<div class="grid__container clearfix upsell__content align--vertical relative">
			<div class="grid--14 grid__sm--18 grid__md--14 grid--center">
				<span class="mt--1x">
					{$SVG($UpsellVehicleLink.BannerLogo.Link).fill($getBestLuminosityContrast($UpsellVehicleLink.DefaultColour)).height(15)}
				</span>
				<span class="block type--left">
					<a href="$UpsellVehicleLink.Link" class="links links--arrow-right mt--1x" style="color: $getBestLuminosityContrast($UpsellVehicleLink.DefaultColour)">
						find out more
					</a>
				</span>
			</div>
		</div>
		<div class="upsell__media">
			<lazyimage image="$UpsellVehicleImage.URL" mask="transparent" cover="true"></lazyimage>
		</div>
	</section>
	<% end_if %>
	<!-- /upsell -->
</section>
