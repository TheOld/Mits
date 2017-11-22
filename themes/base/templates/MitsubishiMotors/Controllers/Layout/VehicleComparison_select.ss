<h1>Vehicle Comparison - Step 1 > select a vehicle</h1>

<% loop $StepData %>
	<br>
	<br>
	<div style="border: 1px solid red; margin-bottom: 2em;">
		<p>
			<strong style="color: black;">Id:</strong> $id<br>
			<strong style="color: black;">Name:</strong> $name<br>
			<strong style="color: black;">Slug:</strong> $slug<br>
			<strong style="color: black;">Logo URL:</strong> $logo<br>
			<strong style="color: black;">Lowest RRP:</strong> $lowestRRP<br>
			<strong style="color: black;">Default right angle image:</strong> <% with $defaultModel %>defaultRightAngleClearCut<% end_with %><br>

		<p>Select this vehicle to compare<a href="{$CurrentLink}/$slug">$name</a> </p>
		</p>
</div>
<% end_loop %>

