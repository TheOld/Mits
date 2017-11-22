<!-- navigation -->
<header-mobile inline-template v-if="device == 'mobile'">
	<header class="mobile-header" :class="{'mobile-header--open': open, 'mobile-header--opaque': isOpaque}">
		<a href="/" class="mobile-header__logo">
			{$SVG('/themes/base/images/svg/logo').width(55)}
		</a>

		<div class="mobile-header__hud">
			<span class="mobile-header__search flex flex--vcenter mr--5x" @click="toggleSearch">
				<i class="icon-search"></i>
			</span>
			<ul class="mobile-header__burger" @click.stop.prevent="open = !open">
				<li class="mobile-header__burger__item my--1x"></li>
				<li class="mobile-header__burger__item my--1x"></li>
			</ul>
		</div>


		<transition-group v-on:enter="enter" v-on:leave="leave">
			<!-- main menu -->
			<div class="mobile-header__wrapper" v-if="open" :key="'main'">
				<ul class="list list--stacked flex--vcenter flex--hcenter mt--10x js-navigation">
					<% loop $MenuSet('Primary').MenuItems %>
						<li class="mobile-header__link p--4x js-menu-item animated">
							<div class="spinner mobile-header__spinner" v-if="section == '$MenuTitle' && loading && section !== 'Vehicles'">
								<div class="spinner-icon"></div>
							</div>
							<a class="$LinkingMode" @click.stop.prevent="navigate('$MenuTitle')">$MenuTitle</a>
						</li>
					<% end_loop %>
					<li class="mobile-header__link p--4x mb--8x js-menu-item animated">
						<i class="icon-marker mr--2x" aria-hidden="true"></i>
						<% if $LocatorPageLink %>
						<a href="$LocatorPageLink" class="link">Find a dealer</a>
						<% end_if %>
					</li>
					<% loop $MenuSet('Utility').MenuItems %>
						<li class="mobile-header__link mobile-header__link--secondary p--4x js-menu-item animated">
							<a href="$Link" class="$LinkingMode">$MenuTitle</a>
						</li>
					<% end_loop %>
				</ul>
			</div>
			<!-- /main menu -->

			<!-- list submenu -->
			<nav class="mobile-header__submenu px--4x" v-if="section && section !== 'Vehicles' && !loading" :key="'list'">
				<div class="mobile-header__action relative type--center flex flex--vcenter flex--hcenter js-menu-item animated">
					<a class="mobile-header__back font--bold" @click="section = null">‹ Menu</a>
					<h4>{{section}}</h4>
				</div>
				<div class="mobile-header__list" v-if="items">
					<div class="background-title background-title--large background-title--dark js-menu-item animated"><span>{{section}}</span></div>
					<ul class="list list--stacked grid--center pt--5x">
						<li class="list__item list__item--stacked px--1x js-menu-item animated" v-for="category in items.Items" :key="category.ID">
							<h4 class="font--bold type--center color--mid-light px--8x mb--5x">{{category.MenuTitle}}</h4>
							<a class="font--bold type--center color--dark mb--4x" :href="link.Link" v-for="link in category.Children" :key="link.ID">{{link.MenuTitle}}</a>
						</li>
					</ul>
				</div>
				<div v-else>
					<ul class="list list--stacked grid--center pt--5x">
						<li class="list__item list__item--stacked px--1x js-menu-item animated">
							<a class="font--bold type--center color--mid-light px--8x mb--5x">There is nothing to display in this category.</a>
						</li>
					</ul>
				</div>
			</nav>
			<!-- /list submenu -->

			<!-- vehicle submenu -->
			<nav class="mobile-header__submenu" v-if="section == 'Vehicles'" :key="'vehicles'">
				<div class="mobile-header__action relative type--center flex flex--vcenter flex--hcenter mx--4x js-menu-item animated">
					<a class="mobile-header__back font--bold" @click="section = null">‹ Menu</a>
					<h4>{{section}}</h4>
				</div>
				<div class="mobile-header__list">
					<div class="flex flex--wrap pt--5x">
						<% loop $vehicleMenu %>
							<a :href="'$Link'" class="mobile-header__vehicle type--center pb--2x js-menu-item animated">
								<div class="image relative image--responsive my--4x" style="padding-bottom: 41.3%;">
									<div class="background-title background-title--dark"><span>$Title</span></div>
									<lazyimage :image="'$Image'" mask="#ffffff" spinner="spinner" :wait-for-scroll="false"></lazyimage>
								</div>
								<h5 class="font--bold type--center color--dark mt--2x">$Title</h5>
								<span class="special-offer mt--1x" v-if="'$HasPromotion'">Special offer</span>
							</a>
						<% end_loop %>
					</div>
				</div>
			</nav>
			<!-- /vehicle submenu -->
		</transition-group>
	</header>
</header-mobile>

<header-desktop inline-template v-else>
	<headroom>
		<nav v-on-clickaway="close">
			<!-- header -->
			<header class="header" :class="{'header--opaque': isOpaque, 'header--border': isExpanded}">
				<div class="grid__container">
					<div class="header__inner grid__xl--14 grid__lg--16 grid--center">
						<div class="header__utility">
							<ul class="navigation navigation--secondary">
								<% loop $MenuSet('Utility').MenuItems %>
									<li class="navigation__item">
										<a href="$Link" class="$LinkingMode">$MenuTitle</a>
									</li>
								<% end_loop %>
								<li class="navigation__item" @click="toggleSearch">
									<a class="link">Search</a>
									<i class="icon-search ml--2x"></i>
								</li>
							</ul>
						</div>
						<a href="/" class="header__logo">
							{$SVG('/themes/base/images/svg/logo').width(75)}
						</a>
						<div class="header__navigation">
							<ul class="navigation navigation--primary js-navigation">
								<% loop $MenuSet('Primary').MenuItems %>
									<li class="navigation__item p--4x">
										<div class="spinner navigation__spinner" v-if="section == '$MenuTitle' && loading && section !== 'Vehicles'">
											<div class="spinner-icon"></div>
										</div>
										<a class="$LinkingMode" :class="{'current': section == '$MenuTitle'}" @click.stop.prevent="expand('$MenuTitle')">$MenuTitle</a>
									</li>
								<% end_loop %>
								<li class="navigation__item p--4x">
									<i class="icon-marker mr--2x" aria-hidden="true"></i>
									<% if $LocatorPageLink %>
									<a href="$LocatorPageLink" class="link">Find a dealer</a>
									<% end_if %>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</header>
			<!-- header -->

			<!-- megamenu -->
			<megamenu
				:section="section"
				:vehicles="[
					<% loop $vehicleMenu %>
					{
						title: '$Title',
						link: '$Link',
						image: '$Image',
						hasPromotion: '$HasPromotion'
					},
					<% end_loop %>
				]"
				:menus="menus"
			></megamennu>
			<!-- /megamenu -->
		</nav>
	</headroom>
</header-desktop>

<search></search>
<!-- /navigation -->
