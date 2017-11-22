<%-- Loop is all on one line to prevent whitespace bug in older versions of IE --%>
<% if $Pages %>
<ul class="breadcrumb mb--4x">
	<li class="breadcrumb__item">
		<a href="/">
			{$SVG('/themes/base/images/svg/mitsubishi').width(20)}
		</a>
	</li>
	<% loop $Pages %>
		<% if $Last %>
			<li class="breadcrumb__item breadcrumb__item--bold">
				<a>$MenuTitle.XML</a>
			</li>
		<% else %>
			<li class="breadcrumb__item">
				<a href="$Link">$MenuTitle.XML</a>
			</li>
		<% end_if %>
	<% end_loop %>
</ul>
<% end_if %>
