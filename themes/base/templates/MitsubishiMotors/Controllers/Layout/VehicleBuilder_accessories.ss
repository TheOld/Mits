<builder inline-template :step="'accessories'">
	<section class="page page--xpt page--pb" data-header="opaque">
		<!-- navigation -->
		<% include MitsubishiMotors/_BuilderNavigation Step=4, Data=$StepData %>
		<!-- /navigation -->


		<div class="grid__container clearfix grid__md--14 grid__lg--12 grid__xl--14 grid--center" :style="{minHeight: height + 'px'}">
			<h2 class="color--mid-light type--center my--15x relative">
				Accessories

				<% loop $StepData %>
					<div class="builder__next type--left theme--dark" v-if="device != 'mobile'">
						<div class="js-item">{$SVG($logo).fill(#000000).height(20)}</div>
						<div class="price price--inline js-item">
							<i-count-up class="price__amount"
								:start="0"
								:end="total"
								:decimals="0"
								:duration="0.5"
								:options="options"
							></i-count-up>
							<span class="price__conditions">RRP* + ORC</span>
						</div>
						<a :href="(model.colour) ? `builder/summary/${vehicle.slug}/${model.slug}` : null" class="button button--uppercase mt--4x js-item">
							<span>next</span>
						</a>
					</div>
				<% end_loop %>
			</h2>

			<section class="accessories">
				<% loop $StepData %>
					<% if $accessoryPacks %>
						<div class="grid--18">
							<h6 class="my--4x">Packs</h6>
						</div>
						<% loop $accessoryPacks %>
						<div class="grid--6 grid__sm--18 grid__md--18 grid__xl--9">
							<div class="tile tile--list mb--4x">
								<div class="tile__image">
									<lazyimage image="$image" mask="#ffffff" spinner="spinner" cover="true"></lazyimage>
								</div>
								<a class="tile__action" @click.stop="toggleAccessory('$id', '$name', '$rrp')" data-label-selected="added" data-label-remove="remove"></a>
								<div class="tile__infos">
									<div class="tile__center">
										<span class="tile__title">$name</span>
										<span class="tile__subtitle">
											${{ $rrp | currency }}
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

					<hr class="grid--18 gradient-border my--10x">
					<% end_if %>

					<% if $accessories %>
						<div class="grid--18">
							<h6 class="my--4x">Accessories</h6>
						</div>
						<% loop $accessories %>
						<div class="grid--3 grid__sm--18 grid__md--9 grid__lg--9 grid__xl--6">
							<div class="tile mb--4x" @click="showModal('accessory', {id: '$id', image: '$image', category: '$Up.category', name: '$name', rrp: '$rrp', description: '$Top.removeBreakline($description)'})" :class="{'tile--selected': isSelectedAccessory('$id')}">
								<div class="tile__image">
									<lazyimage image="$image" mask="#ffffff" spinner="spinner" cover="true"></lazyimage>
								</div>
								<a class="tile__action" @click.stop="toggleAccessory('$id', '$name', '$rrp')" data-label-selected="added" data-label-remove="remove"></a>
								<div class="tile__infos">
									<span class="tile__title">$name</span>
									<span class="tile__subtitle">${{ $rrp | currency }}</span>
								</div>
							</div>

							<modal :ref="'accessory'"></modal>
						</div>
						<% end_loop %>
					<% end_if %>
				<% end_loop %>
			</section>
		</div>

	</section>
</builder>

<!--
<% loop $StepData %>
	<div style="border: 1px solid red; margin-bottom: 2em;">
		<h2>ACCESSORIES</h2>
		<% loop $accessories %>
			<p>
				<strong style="color: black;">Name:</strong> $name<br>
				<strong style="color: black;">Description:</strong> $description<br>
				<strong style="color: black;">Image:</strong> $image<br>
				<strong style="color: black;">Category:</strong> <% with $category %>name: $name, description: $description<% end_with %><br>
			</p>
		<% end_loop %>
			<hr>
		<h2>PACKS</h2>
		<% loop $accessoryPacks %>
			<p>
				<strong style="color: black;">Name:</strong> $name<br>
				<strong style="color: black;">Part Number:</strong> $partNumber<br>
				<strong style="color: black;">Description:</strong> $description<br>
				<strong style="color: black;">RRP:</strong> $rrp<br>
				<strong style="color: black;">Image:</strong> $image<br>
			</p>
		<% end_loop %>
	</div>
<% end_loop %>
-->
