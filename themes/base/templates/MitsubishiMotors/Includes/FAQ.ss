<section class="editorial grid__container clearfix type--center my--10x">
	<% if $Subtitle %>
	<h6>$Subtitle</h6>
	<% end_if %>

	<% if $Title %>
	<h3 class="mt--5x mb--10x">$Title</h3>
	<% end_if %>


	<% if $hasFAQs %>
		<% include MitsubishiMotors/_FAQ FAQs=$FAQs %>
	<% end_if %>
</section>
