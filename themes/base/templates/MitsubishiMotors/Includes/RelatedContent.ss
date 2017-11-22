<% if $hasRelatedContent %>
<section class="customise type--center mt--10x" style="background-color: #F6F6F6;">
	<% if $Subtitle %>
	<h6 class="pt--10x">$Subtitle</h6>
	<% end_if %>

	<% if $Title %>
	<h3 class="my--4x">$Title</h3>
	<% end_if %>

	<!-- tiles -->
	<div class="grid__container grid__xl--14 grid__lg--16 grid--center py--10x clearfix">
		<% loop $RelatedContent.Limit(4) %>
			<% if $Link %>
				<div class="grid--4 grid__sm--18 grid__md--4 mb--2x">
					<a href="$Link.Link">
						<div class="tile">
							<div class="tile__image">
								<% if $Image %>
									<img src="$Image.Link" alt="$Title">
								<% end_if %>
							</div>
							<div class="tile__infos">
								<span class="tile__title type--center">$Title</span>
								<span class="tile__subtitle tile__subtitle--small type--center">$Copy</span>
							</div>
						</div>
					</a>
				</div>
			<% end_if %>
		<% end_loop %>
	</div>
	<!-- /tiles -->
</section>
<% end_if %>
