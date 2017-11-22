<section data-header="opaque" class="page page--pt page--light page--noise">
	<div class="grid__container grid__xl--10 grid__lg--16 grid--center clearfix pb--10x">
		<div class="grid--18 grid--center">
			<!-- header -->
			<h2 class="type--center">Search results</h2>
			<% if $Query %>
			<p class="mt--2x type--center">Results for '$Query'</p>
			<% end_if %>
			<!-- /header -->

			<div class="search grid--18 grid--center">
				<div class="grid--12 grid--center">
					<!-- search input -->
					<div class="search__holder">
						<search-input :query="'$Query'"></search-input>
					</div>
					<!-- /search input -->
				</div>
			</div>


			<% if $Query %>
				<% if $Results.Count %>
					<div class="search grid--18 grid--center">

							<!-- search offset -->
							<div class="search__label color--dark font--bold my--5x">
								Showing $Results.FirstItem - $Results.LastItem of $Results.Count result<% if $Results.Count > 1 %>s<% end_if %>
							</div>
							<!-- /search offset -->
						</div>

						<% loop $Results %>
							<!-- search separator -->
							<hr class="grid--18 gradient-border my--5x">
							<!-- /search separator -->

							<div class="grid--12 grid--center">
								<!-- search result -->
								<div class="my--5x">
									<h4>$Title</h4>
									<p class="my--4x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
									<span class="search__label color--mid">
										Found in:
										<span class="search__label color--dark">About</span>
									</span>
								</div>
								<!-- /search result -->
							</div>

							<!-- search separator -->
							<hr class="grid--18 gradient-border my--5x">
							<!-- /search separator -->
						<% end_loop %>

						<% with $Results %>
						<!-- search pagination -->
						<div class="search__pagination grid--12 grid--center">
							<a class="links links--inactive links--arrow-left">prev</a>
							<ul class="filter filter--center">
								<li class="filter__item filter__item--active px--3x py--1x">1</li>
								<li class="filter__item px--3x py--1x">2</li>
								<li class="filter__item px--3x py--1x">3</li>
								<li class="filter__item px--3x py--1x">4</li>
								<li class="filter__item px--3x py--1x">5</li>
								<li class="filter__item px--3x py--1x">6</li>
								<li class="filter__item px--3x py--1x">7</li>
							</ul>
							<a href="" class="links links--arrow-right">next</a>
						</div>
						<!-- /search pagination -->
						<% end_with %>

					</div>
				<% else %>
					<p class="mt--2x type--center">Your search returned no results. Please try again.</p>
				<% end_if %>
			<% else %>
				<p class="mt--2x type--center">Please enter a search term.</p>
			<% end_if %>
		</div>
	</div>
</section>

<!--
<% if $Query %>

	<% if $Results.Count %>

		<p>Page $Results.CurrentPage of $Results.TotalPages</p>
		<p>Showing $Results.FirstItem - $Results.LastItem of $Results.Count result<% if $Results.Count > 1 %>s<% end_if %></p>

		<% loop $Results %>
			<hr>
			<div>
				<h6>$Title</h6>
				<% if $MetaDescription %>
					<p>$MetaDescription</p>
				<% else_if $Content %>
					<p>$Content.Summary</p>
				<% end_if %>
				<p><a href="$Link"><strong>Read more</strong></a></p>
			</div>
			<% if $Last %><hr><% end_if %>
		<% end_loop %>

		<% with $Results %>
			<% include Pagination %>
		<% end_with %>

	<% else %>

		<p>Your search returned no results. Please try again.</p>

	<% end_if %>

<% else %>

	<p>Please enter a search term.</p>

<% end_if %>
-->
