<!-- footer -->
	<footer class="footer">
		<div class="footer__sitemap">
			<div class="grid__container grid__xl--14 grid__lg--16 grid--center">
				<% loop $MenuSet('Footer').MenuItems.Limit(2) %>
					<div class="grid--3 grid__sm--18 grid__md--3 center-mobile">
						<ul>
							<li class="footer__heading">$MenuTitle</li>
							<% loop $Children %>
								<li><a class="link" href="$Link">$MenuTitle</a></li>
							<% end_loop %>
						</ul>
					</div>
				<% end_loop %>

				<div class="grid--3 push__md--1 grid__sm--18 grid__md--3 center-mobile">
					<% loop $MenuSet('Footer').MenuItems.Limit(2, 2) %>
						<ul>
							<li class="footer__heading">$Title</li>
							<% loop $Children %>
								<li><a class="link" href="$Link">$MenuTitle</a></li>
							<% end_loop %>
						</ul>
						<span class="spacer"></span>
					<% end_loop %>
				</div>

				<div class="grid--7 push__md--1 grid__sm--18 grid__md--7 center-mobile">
					<span class="footer__heading">Contact & Support</span>
					<p>For help with any questions you may have our Customer care Centre is available from 8am to 5pm Monday to Friday</p>

					<span class="footer__heading">0800 54 53 52</span>

					<a href="" class="link">customercare@mmnz.co.nz</a>
					<a href="" class="link">Update your details</a>
					<a href="" class="link">Recalls</a>

					<span class="spacer"></span>

					<% if $LocatorPageLink %>
					<a href="$LocatorPageLink" class="button button--uppercase">
						<span>Find dealership</span>
					</a>
					<% end_if %>
				</div>
			</div>
		</div>
		<div class="footer__links">
			<div class="grid__container grid__sm--18 grid__xl--14 grid__lg--16 grid--center">
				<div class="grid--16 grid__sm--18 grid__md--16 footer__legals">
					<span class="copyright center-mobile">
						<span class="copyright__logo">
							<img src="$ThemeDir/images/svg/logo-horizontal.svg" alt="Mitsubishi logo">
						</span>
						<span class="copyright__text">© Mitsubishi Motors New Zealand {$Now.Year}</span>
					</span>

					<ul class="navigation navigation--secondary center-mobile">
						<% loop $MenuSet('Legal').MenuItems %>
							<li class="navigation__item"><a href="$Link">$MenuTitle</a></li>
						<% end_loop %>
					</ul>
				</div>
				<ul class="grid--2 grid__sm--18 grid__md--2 footer__socials center-mobile">
					<li>
						<a href="$SiteConfig.FacebookLink">
							<i class="icon-facebook"></i>
						</a>
					</li>
					<li>
						<a href="$SiteConfig.InstagramLink">
							<i class="icon-instagram"></i>
						</a>
					</li>
					<li>
						<a href="$SiteConfig.TwitterLink">
							<i class="icon-twitter"></i>
						</a>
					</li>
					<li>
						<a href="$SiteConfig.GooglePlusLink">
							<i class="icon-google-plus"></i>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</footer>
	<!-- /footer -->
