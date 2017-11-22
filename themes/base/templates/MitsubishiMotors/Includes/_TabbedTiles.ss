<!-- generic tabbed tile component -->
<a class="grid--6 grid__sm--18 grid__md--6" <% if $LinkedPage %>href="$LinkedPage.Link"<% end_if %>>
	<div class="animated tabbed-tile js-item mb--2x">
		<div class="tabbed-tile__image">
			<lazyimage  image="$Image.Link" mask="#ffffff" spinner="spinner"></lazyimage>
		</div>
		<div class="tabbed-tile__description py--6x px--5x">
			<h4 style="color: $getBestLuminosityContrast($Image.DominantColor);" class="pb--2x">$Title</h4>
			<p style="color: $getBestLuminosityContrast($Image.DominantColor);" class="font--bold">$Subtitle</p>
		</div>
	</div>
</a>
<!-- generic tabbed tile component -->
