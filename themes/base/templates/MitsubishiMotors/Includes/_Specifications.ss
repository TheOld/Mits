<% loop $Specifications %>
		<% loop $specs %>
			<div v-if="query == '$groupName' || query == 'all'">
				<h4 class="mb--5x">$groupName</h4>

				<!-- comparison-table -->
				<div class="comparison-table comparison-table--two-columns js-item">
					<table class="comparison-table__wrapper">
						<tbody>
							<% loop $categories %>
									<!-- only display sub-category if different from main category -->
									<!-- (should be only for technical) -->
									<% if $categoryName != $Up.groupName %>
									<tr class="comparison-table__line">
										<td class="comparison-table__cell"><h6>$categoryName</h6></td>
										<td class="comparison-table__cell"></td>
									</tr>
									<% end_if %>

									<!-- display elements -->
									<% loop $categories %>
									<tr class="comparison-table__line">
										<td class="comparison-table__cell font--5x">	$name</td>

										<% if $value == 'Y' %>
											<td class="comparison-table__cell comparison-table__cell--included font--5x"></td>
										<% else_if $value == 'N' %>
											<td class="comparison-table__cell comparison-table__cell--none font--5x"></td>
										<% else %>
											<td class="comparison-table__cell font--5x">$value</td>
										<% end_if %>
									</tr>
									<% end_loop %>
							<% end_loop %>
						</tbody>
					</table>
				</div>
				<!-- /comparison-table -->

				<hr class="grid--18 gradient-border mt--5x mb--10x">
			</div>
		<% end_loop %>
	<% end_loop %>
