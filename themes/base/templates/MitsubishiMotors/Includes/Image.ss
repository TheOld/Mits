<section class="feature clearfix mb--10x">
	<div class="grid__container">
		<div class="js-tile-slow grid--10 grid__sm--18 grid__md--10 <% if $ShowImageRight %>float--right<% end_if %>">
			<div class="vehicle-feature-keypoint vehicle-feature-keypoint--light vehicle-feature-keypoint--vertical vehicle-feature-keypoint--large">
				<div class="vehicle-feature-keypoint__image js-smooth-component">
					<img src="$Image.Link" alt="">
				</div>
				<h6 class="vehicle-feature-keypoint__label">$Subtitle $Modifier</h6>
				<div class="vehicle-feature-keypoint__description" <% if $Background%>style="background-color: $Background"<% end_if %>>
					<h4 class="vehicle-feature-keypoint__title my--4x">$Title</h4>
					<p class="vehicle-feature-keypoint__content">$Copy</p>
				</div>
			</div>
		</div>
		<div class="grid--2 spacer <% if ShowImageRight %>float--right<% end_if %>"></div>
		<div class="js-tile-fast grid--4 grid__sm--14 grid__md--4 <% if ShowImageRight %>float--right<% end_if %>">
			<div class="vehicle-feature-image pt--10x mt--10x">
				<img src="$Image2.Link" alt="">
			</div>
		</div>
	</div>
</section>
