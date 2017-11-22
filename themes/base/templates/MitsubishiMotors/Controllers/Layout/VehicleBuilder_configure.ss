<builder inline-template :step="'configure'">
	<section class="page page--noise page--xpt" data-header="opaque">
		<!-- navigation -->
		<% include MitsubishiMotors/_BuilderNavigation Step=2 %>
		<!-- /navigation -->

		<% loop $StepData %>
		<combined-filters inline-template :callback="selectModelSlug" :filters="[<% loop $searchFilters %>'$name',<% end_loop %>]" :data="{device: device}">
			<section class="range clearfix">
				<h2 class="type--center mt--15x color--mid-light">Configure</h2>
				<div class="grid__container clearfix grid--14 grid__sm--18 grid__xl--14 grid__lg--16 grid--center">

					<% include MitsubishiMotors/_CombinedFilters Filters=$searchFilters %>

					<div class="separator mt--4x mb--10x"></div>
				</div>
				<div class="grid__container clearfix grid__xl--14 grid__lg--16 grid--center">
					<!-- model -->
					<% loop $models %>
					<slide-fade-transition appear>
						<article v-show="matchAtLeastOne(<% if $searchFilters %>[<% loop $searchFilters %>'$name',<% end_loop %>]<% end_if %>)">
							<% include MitsubishiMotors/_Model Model=$Me, Vehicle=$Up.slug, Type="Builder" %>
						</article>
					</slide-fade-transition>
					<% end_loop %>
					<!-- /model -->
				</div>
			</section>
		</combined-filters>
		<% end_loop %>
	</section>
</builder>

<!--
<% loop $StepData %>
	<p>$id</p>
	<p>$name</p>
	<p>$slug</p>
	<p>vehicle search filters</p>
	<% loop $searchFilters %>
		<p>$id</p>
		<p>$name</p>
	<% end_loop %>

	<% loop $models %>
		<% loop $searchFilters %>
			<span>$name</span>
		<% end_loop %>

		<h4>$name</h4>
		<h5>Specs link: /spec/full/$slug</h5>
		<p>Default angle image: $defaultAngleImage</p>
		<p>RRP: ${$rrp}</p>
		<p>On promotion: $onPromotion</p>
		<p>Slug: $slug</p>
		<% loop $uniqueSpecs %>
			<h6>$name - $icon</h6>
		<% end_loop %>
	<% end_loop %>
<% end_loop %>
-->
