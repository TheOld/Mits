<div class="grid__container clearfix type--center" v-sticky="{ zIndex: 2, stickyTop: -1 }" v-if="device != 'mobile'">
	<ul class="tab tab--fade tab--last" v-bind:class="theme()">
		<li class="mx--6x tab__item <% if $Step == 1 %>tab__item--active tab__item--last<% end_if %><% if $Step >= 1 %> tab__item--active<% end_if %>">
			<a href="/builder/vehicle" class="tab__link type--uppercase">1. vehicle</a>
		</li>
		<li class="mx--6x tab__item <% if $Step == 2 %>tab__item--active tab__item--last<% end_if %><% if $Step >= 2 %> tab__item--active<% end_if %>">
			<a :href="(vehicle.slug) ? `builder/configure/${vehicle.slug}` : null" :class="{'tab__link--inactive': !vehicle.slug}" class="tab__link type--uppercase">2. configure</a>
		</li>
		<li class="mx--6x tab__item <% if $Step == 3 %>tab__item--active tab__item--last<% end_if %><% if $Step >= 3 %> tab__item--active<% end_if %>">
			<a :href="(vehicle.slug && model.slug) ? `builder/colour/${vehicle.slug}/${model.slug}` : null" :class="{'tab__link--inactive': !vehicle.slug || !model.slug}" class="tab__link type--uppercase">3. colour</a>
		</li>
		<li class="mx--6x tab__item <% if $Step == 4 %>tab__item--active tab__item--last<% end_if %><% if $Step >= 4 %> tab__item--active<% end_if %>">
			<a :href="(vehicle.slug && model.slug) ? `builder/accessories/${vehicle.slug}/${model.slug}` : null" :class="{'tab__link--inactive': !vehicle.slug || !model.slug}" class="tab__link type--uppercase">4. accessories</a>
		</li>
		<li class="mx--6x tab__item <% if $Step == 5 %>tab__item--active tab__item--last<% end_if %><% if $Step >= 5 %> tab__item--active<% end_if %>">
			<a :href="(vehicle.slug && model.slug) ? `builder/summary/${vehicle.slug}/${model.slug}` : null" :class="{'tab__link--inactive': !vehicle.slug || !model.slug}" class="tab__link type--uppercase">5. summary</a>
		</li>
	</ul>
</div>

<div v-else>
	<% if $Step == 1 %>
		<a :href="(vehicle.slug) ? `builder/configure/${vehicle.slug}` : null" class="builder__button builder__button--center button">
			<span>NEXT: Configure</span>
		</a>
	<% end_if %>

	<% if $Step == 3 %>
		<% loop $Data %>
		<div class="builder__recap type--left" :class="`theme--${vehicle.theme}`" v-if="device=='mobile'">
			<div class="js-item">{$SVG($logo).height(10)}</div>
			<div class="price">
				<span class="price__amount my--2x">${{ $rrp | currency }}</span>
				<span class="price__conditions">RRP* + ORC</span>
			</div>
		</div>
		<% end_loop %>

		<a :href="(vehicle.slug && model.slug) ? `builder/accessories/${vehicle.slug}/${model.slug}` : null" class="builder__button builder__button--right button">
			<span>NEXT: Accessories</span>
		</a>
	<% end_if %>

	<% if $Step == 4 %>
		<div class="builder__bar">
			<% loop $Data %>
			<div class="builder__recap type--left theme--dark" v-if="device=='mobile'">
				<div class="js-item">{$SVG($logo).height(10)}</div>
				<div class="price">
					<i-count-up class="price__amount"
						:start="0"
						:end="total"
						:decimals="0"
						:duration="0.5"
						:options="options"
					></i-count-up>
					<span class="price__conditions">RRP* + ORC</span>
				</div>
			</div>
			<% end_loop %>

			<a :href="(vehicle.slug && model.slug) ? `builder/summary/${vehicle.slug}/${model.slug}` : null" class="builder__button builder__button--right button">
				<span>NEXT: Summary</span>
			</a>
		</div>
	<% end_if %>
</div>
