<% if $MoreThanOnePage %>
	<% if $NotFirstPage %>
		<a title="View previous page of results" href="$PrevLink.RAW">Prev</a>
	<% else %>
		<a title="View previous page of results">Prev</a>
	<% end_if %>
	<% loop $PaginationSummary(4) %>
		<% if $CurrentBool %>
			<div>
				<a title="Viewing page $PageNum of results">$PageNum</a>
			</div>
		<% else %>
			<% if $Link %>
				<div>
					<a title="View page $PageNum of results" href="$Link.RAW">$PageNum</a>
				</div>
			<% else %>
				<div class="disabled"><a class="disabled">...</a></div>
			<% end_if %>
		<% end_if %>
	<% end_loop %>
	<% if $NotLastPage %>
		<a title="View next page of results" href="$NextLink.RAW">Next</a>
	<% else %>
		<a title="View next page of results">Next</a>
	<% end_if %>
<% end_if %>