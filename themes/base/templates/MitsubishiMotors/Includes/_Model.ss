<div class="js-item">
    <h4 class="type--left type--uppercase center-mobile">$name</h4>
	<% if $Type == "Builder" %>
		<a href="/spec/full/$slug" class="links links--arrow-right center-mobile">Full specs</a>
	<% end_if %>
    <div class="clearfix align--vertical my--4x">
        <div class="grid--6 grid__sm--18 grid__md--6 relative mb--10x">
			<div class="image--responsive" style="padding-bottom: 41.8%;">
            	<lazyimage image="$defaultRightAngleClearCut" mask="transparent" spinner="spinner"></lazyimage>
			</div>
        </div>
        <div class="grid--1 spacer not-mobile"></div>
        <div class="grid--5 grid__sm--10 grid__md--5 my--4x">
            <ul class="unique-selling-point">
                <% if $uniqueSpecs %>
                    <% loop $uniqueSpecs %>
                        <li class="unique-selling-point__item mb--4x">
                            <span class="unique-selling-point__icon">
                                {$SVG($icon).fill(#767676).height(20)}
                            </span>
                            <span class="unique-selling-point__label">$name</span>
                        </li>
                    <% end_loop %>
                <% end_if %>
            </ul>
        </div>
        <div class="grid--1">
            <div class="separator separator--vertical"></div>
        </div>
        <div class="grid--5 grid__sm--8 grid__md--5 my--4x center-mobile">
            <div class="price <% if $onPromotion %>price--offer<% end_if %>">
                <% if $onPromotion %><span class="special-offer">Special offer</span><% end_if %>
                <span class="price__amount">${{ $rrp | currency }}</span>
                <span class="price__conditions pt--2x">RRP* + ORC</span>
            </div>
			<% if $Type == "Builder" %>
				<a href="/builder/colour/$Vehicle/$slug" class="button button--uppercase mt--4x" @click="callback({slug: '$slug', rrp: '$rrp', name: '$name'})">
					<span>select</span>
				</a>
			<% else %>
				<a href="/spec/full/$slug" class="button button--uppercase mt--4x">
					<span>view specs</span>
				</a>
			<% end_if %>
        </div>
    </div>
</div>
