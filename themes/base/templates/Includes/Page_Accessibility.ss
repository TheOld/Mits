<nav>
	<ul class="visuallyhidden">
		<li><a href="#nav" title="Skip to navigation" accesskey="n">Skip to site navigation</a></li>
		<li><a href="#content" title="Skip to content" accesskey="s">Skip to content</a></li>
		<li><a href="#" title="Top of page" accesskey="/">Top of page</a></li>
		<% if $MenuSet("Accessibility") %>
			<% loop $MenuSet("Accessibility").MenuItems %>
				<li><a href="$Link" accesskey="$pos">$MenuTitle</a></li>
			<% end_loop %>
		<% end_if %>
	</ul>
</nav>
