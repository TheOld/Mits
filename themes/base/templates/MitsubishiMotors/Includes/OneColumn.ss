<section class="editorial grid__container clearfix grid__md--16 grid__xl--14 grid__lg--16 grid--center">
	<div class="editorial__header editorial__header--large px--5x mb--10x type--center grid__xl--10 grid--center">
		<h6>$Subtitle</h6>
		<% if $Title %>
		<h3 class="mt--5x">$Title</h3>
		<% end_if %>
		<% if $Blurb %>
		<div class="editorial__emphasize color--mid my--10x font--5x">$Blurb</div>
		<% end_if %>
		<% if $Copy %>
		<div class="color--dark my--10x type--left">$Copy</div>
		<% end_if %>
	</div>
</section>
