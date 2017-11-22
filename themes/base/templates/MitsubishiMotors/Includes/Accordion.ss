<section class="editorial grid__container grid__sm--15 grid__md--10 grid__xl--8 grid--center clearfix type--center my--10x">
		<% if $Subtitle%>
		<h6>$Subtitle</h6>
		<% end_if %>

		<% if $Title %>
		<h3 class="mt--5x mb--10x">$Title</h3>
		<% end_if %>

		<% if $hasAccordions %>
			<% include MitsubishiMotors/_Accordion Accordions=$Accordions %>
		<% end_if %>

</section>
