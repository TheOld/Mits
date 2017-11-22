<section data-header="opaque" class="page page--py page--noise">

	<div class="grid__container grid__xl--14 grid__lg--16 grid--center clearfix">
		<a class="h6 color--dark" href="{$Top.Link}">
			<i class="icon-arrow-left2 color--dark"></i>
			Back to vehicles
		</a>
	</div>

	<div class="type--center mb--15x">
		<span class="h5">Accessories</span>
		<h2 class="color--mid-light">for {$VehicleName}</h2>
	</div>

	<!-- accessories -->
	<tabbed-tiles inline-template :selected="'<% if $accessoryPacks %>Accessory Pack<% else %><% loop $GroupedAccessories.Limit(1) %>$category<% end_loop %><% end_if %>'">
		<section class="acessories">
			<div class="grid__container clearfix type--center grid__md--14 grid__lg--12 grid--center">
				<!-- tab -->
				<ul class="tab mb--10x">
					<% if $accessoryPacks %>
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
					<% loop $GroupedAccessories %>
						<div class="grid__container clearfix" key="'$category'" v-if="section === '$category'">
							<% loop $accessories %>
								<div class="animated js-item <% if $Up.category == 'packs' %>grid--18 grid__lg--9<% else %>grid--18 grid__md--9 grid__xl--6<% end_if %>">
									<div class="tile mb--4x <% if $Up.category == 'packs' %>tile--list<% end_if %>" @click="showModal('accessory', {id: '$id', image: '$image', category: '$Up.category', name: '$name', rrp: '$rrp', description: '$Top.removeBreakline($description)'})" :class="{'tile--selected': isSelectedAccessory('$id')}">
										<div class="tile__image">
											<lazyimage image="$image" mask="#ffffff" spinner="spinner" cover="true"></lazyimage>
										</div>
										<a class="tile__action" @click.stop="toggleAccessory('$id', '$name', '$rrp')" data-label-selected="added" data-label-remove="remove"></a>
										<div class="tile__infos">
											<span class="tile__title">$name</span>
											<span class="tile__subtitle">${{ $rrp | currency }}</span>
											<% if $Up.category == 'packs' %>
												<ul class="tile__list">
													<% loop $accessories %>
														<li class="tile__list__item">$name</li>
													<% end_loop %>
												</ul>
											<% end_if %>
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

	<div class="bar">
		<div class="bar__inner">
			<span>
				<p class="type--uppercase">total price</p>

				<counter inline-template>
					<div class="price price--inline js-item">
						<i-count-up class="price__amount"
							:start="0"
							:end="total"
							:decimals="0"
							:duration="0.5"
							:options="options"
						></i-count-up>
						<span class="price__conditions">RRP*</span>
					</div>
				</counter>
			</span>

			<a class="button button--uppercase mt--4x" href="{$Top.Link}summary">
				<span>Order from dealer</span>
			</a>
		</div>
	</div>
</section>



<%-- <div>
	<% loop $GroupedAccessories %>
		<h4>$category  - $accessories.Count</h4>

		<h2>ACCESSORIES</h2>

			<% loop $accessories %>
				<p>$name</p>
				<p>${$rrp}</p>
				<p>$image</p>


				<% if $Up.category == 'packs' %>
					<h2>Pack accessories:</h2>
					<% loop $accessories %>
					<p>
						<strong style="color: black;">Name:</strong> $name<br>
						<strong style="color: black;">Part Number:</strong> $partNumber<br>
						<strong style="color: black;">Description:</strong> $description<br>
						<strong style="color: black;">RRP:</strong> $rrp<br>
						<strong style="color: black;">Image:</strong> $image<br>
					</p>
					<% end_loop %>
				<% end_if %>
			<% end_loop %>
	<% end_loop %>
</div> --%>

