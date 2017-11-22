<section data-header="opaque" data-section="content" class="page page--noise page--pt">
	<div class="grid__container grid__xl--14 grid__lg--16 grid--center clearfix">
		$BreadCrumbs
	</div>

	<section class="editorial grid__container clearfix grid__md--16 grid__xl--14 grid__lg--16 grid--center">
		<div class="editorial__banner relative" style="height: 0; padding-bottom: $BannerImage.GetRatio()%;">
			<img src="$BannerImage.Link" style="width: 100%; position: absolute; left: 0;" alt="">
		</div>

		<div class="editorial__header grid__sm--15 grid__md--10 grid__xl--10 grid--center <% if $BannerImage.Link %>editorial__header--offset<% end_if %>  py--15x px--5x mb--10x type--center">
			<h6>$BannerTitle</h6>
			<h2 class="mt--2x">$Title</h2>
			<% if $BannerLeadIn %>
			<div class="editorial__emphasize font--5x color--mid-light mt--10x">$BannerLeadIn</div>
			<% end_if %>
			<% if $Content %>
			<div class="color--dark mt--10x type--left">$Content</div>
			<% end_if %>
		</div>
	</section>


	<% if $hasSlices %>
		<% loop $Slices %>

			<% if $Type == 'Image' %>
				<% include MitsubishiMotors/Image Pos=$Pos, Background="#fcfcfc" %>
			<% else_if $Type == 'Carousel' %>
				<% include MitsubishiMotors/Carousel Pos=$Pos %>
			<% else_if $Type == 'Document' %>
				<% include MitsubishiMotors/Document Pos=$Pos %>
			<% else_if $Type == 'RelatedContent' %>
				<% include MitsubishiMotors/RelatedContent Pos=$Pos %>
			<% else_if $Type == 'FAQ' %>
				<% include MitsubishiMotors/FAQ Pos=$Pos %>
			<% else_if $Type == 'Accordion' %>
				<% include MitsubishiMotors/Accordion Pos=$Pos %>
			<% else_if $Type == 'TwoColumnWithImage' %>
				<% include MitsubishiMotors/TwoColumnWithImage Pos=$Pos %>
			<% else_if $Type == 'TwoColumn' %>
				<% include MitsubishiMotors/TwoColumn Pos=$Pos %>
			<% else_if $Type == 'OneColumn' %>
				<% include MitsubishiMotors/OneColumn Pos=$Pos %>
			<% else_if $Type == 'TabbedContent' %>
				<% include MitsubishiMotors/TabbedContent Pos=$Pos %>
			<% end_if %>

		<% end_loop %>
	<% end_if %>

</section>
