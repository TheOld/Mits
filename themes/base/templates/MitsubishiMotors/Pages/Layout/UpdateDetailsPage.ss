<section data-header="opaque" class="page page--py page--light page--noise">
	<div class="grid__container grid__xl--10 grid__lg--16 grid--center clearfix pb--10x">
		<!-- header -->
		<% if $Subtitle %>
		<h6 class="type--center mb--6x">$Subtitle</h6>
		<% end_if %>
		<h2 class="type--center">$Title</h2>
		$Content
		<hr class="gradient-border my--10x">
		<!-- /header -->

		<div class="grid--12 grid__sm--18 grid__md--12 mb--4x grid--center">
			<!-- form -->
			$UpdateDetailsForm
			<!-- /form -->
		</div>
	</div>
</section>

