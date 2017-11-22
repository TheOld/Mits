<section class="documents type--center mt--10x">
	<!-- documents -->
	<div class="grid__container py--10x clearfix">

		<% loop $Documents %>
			<% if $File %>
				<div class="document mx--10x my--3x">
					<div class="document__wrapper relative">
						<a href="$File.Link">
							<div class="document__image">
								<div class="document__mask" <% if $Image %>style="background-color: $Image.DominantColor"<% end_if %>></div>
								<% if $Image %>
									<img src="$Image.Link" alt="$Title">
								<% end_if %>
							</div>
							<div class="document__action">
								<i class="icon-download" style="color: $getBestContrast($Image.DominantColor);"></i>
								<span class="font--bold mt--2x" style="color: $getBestContrast($Image.DominantColor);">Download file</span>
							</div>
						</a>
					</div>
					<div class="document__infos">
						<span class="document__label font--4x mt--2x color--mid font--bold">$Title<b class="document__label color--mid font--light">.$File.getExtension</b></span>
						<span class="document__label font--4x color--mid-light">$File.getSize</span>
					</div>
				</div>
			<% end_if %>
		<% end_loop %>
	</div>
	<!-- /documents -->
</section>
