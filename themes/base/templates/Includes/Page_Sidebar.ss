<aside>
	<nav class="nav nav--aside">
		<ul>
			<% loop $Menu(2) %>
				<li>
					<a href="$Link" class="$LinkingMode">$MenuTitle</a>
				</li>
			<% end_loop %>
		</ul>
	</nav>
</aside>
