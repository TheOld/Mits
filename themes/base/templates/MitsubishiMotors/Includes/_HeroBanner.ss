<% if $Video.URL %>
	<div class="skewed-tile__background" style="height: 0; padding-bottom: $Image.GetRatio()%;">
		<video-player
			video="$Video.URL"
			poster="$Image.URL"
			loop="true"
			autoplay="true"
			controls="false"
			muted="true">
		</video-player>
	</div>
<% else_if $Image.Link %>
	<% if isMobile %>
		<div class="skewed-tile__background" style="height: 0; padding-bottom: 160%;">
			<img src="$Image.Fill(400, 700).URL" style="width: 100%; position: absolute; left: 0;" alt="">
		</div>
	<% else %>
		<div class="skewed-tile__background" style="height: 0; padding-bottom: $Image.GetRatio()%;">
			<img src="$Image.Link" style="width: 100%; position: absolute; left: 0;" alt="">
		</div>
	<% end_if %>
<% end_if %>
