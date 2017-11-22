<section data-header="opaque" class="page page--pt page--light page--noise">
	<div class="grid__container grid__xl--10 grid__lg--16 grid--center clearfix pb--10x">
		<!-- header -->
		<div class="grid--18 type--center">
			<h2>$Title</h2>
			<p class="my--6x color--mid-light">$Blurb</p>
			<% if $Email %><a href="mailto:$Email" class="font--bold">$Email</a> <br><% end_if %>
			<% if $Phone %>
				<a href="tel:$PhoneNice" class="button mt--4x">
					<span>$Phone</span>
				</a>
			<% end_if %>
		</div>
		<!-- /header -->

		<hr class="grid--18 gradient-border my--10x">

		<!-- form -->
		<div class="grid--6 grid__md--6 grid__sm--18 push__md--2 mb--4x">
			<h4 class="mb--4x">Get in touch online</h4>
			<p class="mb--6x">All fields with a<i class="form-symbol-required"></i>are required.</p>
			$ContactForm
		</div>
		<!-- /form -->

		<!-- link & address -->
		<div class="grid--6 grid__md--6 grid__sm--18 push__md--2">
			<h4 class="mb--5x">Chat with us online</h4>

			<div>
				<% if $SiteConfig.FacebookLink %>
					<a href="$SiteConfig.FacebookLink" class="links links--arrow-right links--social-facebook">
						facebook
					</a>
				<% end_if %>
				<% if $SiteConfig.TwitterLink %>
					<a href="$SiteConfig.TwitterLink" class="links links--arrow-right links--social-twitter">
						twitter
					</a>
				<% end_if %>
			</div>

			<% if $PostalAddress %>
			<div>
				<h4 class="my--5x">Physical locations</h4>
				<h5>Mitsubishi Head Office</h5>
				<p class="font--bold my--4x">Postal address</p>
				<p class="color--dark">$PostalAddress</p>
			</div>
			<% end_if %>

			<% if $StreetAddress %>
			<div>
				<p class="font--bold my--4x">Street address</p>
				<p class="color--dark">$StreetAddress</p>
			</div>
			<% end_if %>

			<% if $LocatorPageLink %>
			<a href="$LocatorPageLink" class="button button--uppercase mb--10x mt--4x">
				<span>find a dealer</span>
			</a>
			<% end_if %>
		</div>
		<!-- /link & address -->
	</div>

	<% if $hasSlices %>
	<section class="page pt--10x" style="background-color: #F6F6F6;">
		<% loop $Slices %>

			<% if $Type == 'RelatedContent' %>
				<% include MitsubishiMotors/RelatedContent Pos=$Pos %>
			<% else_if $Type == 'TabbedContent' %>
				<% include MitsubishiMotors/TabbedContent Pos=$Pos %>
			<% end_if %>

		<% end_loop %>
	</section>
	<% end_if %>
</section>

