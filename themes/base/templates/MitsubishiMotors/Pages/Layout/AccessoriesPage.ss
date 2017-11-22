<section data-header="opaque" class="page page--py page--light page--noise">
	<!-- header -->
	<header class="header">
		<div class="grid__container">
		</div>
	</header>
	<!-- /header -->

	<h2>$Title</h2>
	$Content

	<ul class="list list--inline list--center">
		<% loop $Vehicles %>
			<li class="list__item list__item--stacked px--8x js-megamenu-item">
				<a class="type--center" href="{$Top.Link}vehicle/{$slug}">
					<div class="image image--responsive" style="padding-bottom: 41.3%;">
							<%-- <lazyimage :image="$defaultClearCut.Title" mask="#ffffff" spinner="spinner"></lazyimage> --%>
						<img src="$defaultClearCut" alt="$defaultClearCut.Title">
					</div>
					<span class="font--bold type--center color--dark">$name</span>
				</a>
			</li>
		<% end_loop %>
	</ul>

</section>

