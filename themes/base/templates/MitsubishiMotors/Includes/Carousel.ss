<% if $hasCarouselItems %>
<carousel inline-template>
	<section class="carousel py--10x">
		<div class="vehicle-slideshow">
			<div class="vehicle-slideshow__container">
				<a class="controls__nav controls__nav--prev" v-if="index > 0" @click="index -= 1">
					{$SVG('/themes/base/images/svg/nav-prev').width(35).fill('#FFFFFF')}
				</a>

				<a class="controls__nav controls__nav--next" v-if="index < $CarouselItems.Count - 1" @click="index += 1">
					{$SVG('/themes/base/images/svg/nav-next').width(35).fill('#FFFFFF')}
				</a>

				<ul class="vehicle-slideshow__images" :style="{ transform: 'translateX(' + index * -100 + '%)' }">
					<% loop $CarouselItems %>
						<% if $Image && $File %>
						<li>
							<video-player
								video="$File.URL"
								poster="$Image.URL"
								loop="true"
								muted="true">
							</video-player>
						</li>
						<% else_if YouTubeId %>
						<li>
							<iframe src="https://www.youtube.com/embed/$YouTubeId?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
						</li>
						<% else_if $Image %>
						<li>
							<img src="$Image.Link" alt="">
						</li>
						<% end_if %>
					<% end_loop %>
				</ul>
			</div>
			<div class="vehicle-slideshow__description">
				<ul class="vehicle-slideshow__keypoints" :style="{ transform: 'translateX(' + index * -100 + '%)' }">
					<% loop $CarouselItems %>
					<li>
						<h6 class="vehicle-slideshow__label">$Title</h6>
						<h3 class="vehicle-slideshow__title my--4x">$Subtitle</h3>
						<p class="vehicle-slideshow__content">$Copy</p>
					</li>
					<% end_loop %>
				</ul>
				<ul class="bullets center-mobile px--14x py--2x">
					<% loop $CarouselItems %>
						<% if TotalItems > 1 %>
							<li @click="index = $Pos - 1" class="bullets__item" :class="{'bullets__item--active': index == $Pos - 1}"></li>
						<% end_if %>
					<% end_loop %>
				</ul>
			</div>
		</div>
	</section>
</carousel>
<% end_if %>
