
<% loop $Builder %>
	<h2>Model ID $id - ($name)</h2>
	<p>Vehicle: $Vehicle</p>
	<p>Model: $Model</p>
	<p>Colour: $Colour</p>
	<p>Accessories: $Accessories</p>
	<p>AccessoryPacks: $AccessoryPacks</p>
	<p>Email: $Email</p>

<% end_loop %>



<% loop $Summary %>
	<h2>Model ID $id - ($name)</h2>
	<h3>Unique Specs</h3>
	<% loop $uniqueSpecs %>
		<p>$name ($icon)</p>
	<% end_loop %>
	<h3>Grouped Specs</h3>
	<% loop $specs %>

		<h5>$groupName</h5>

		<% loop $categories %>

			<br><h6>$categoryName</h6><br>

			<% loop $categories %>
				<p>$name: $value</p>
			<% end_loop %>

		<% end_loop %>
	<% end_loop %>
<% end_loop %>
