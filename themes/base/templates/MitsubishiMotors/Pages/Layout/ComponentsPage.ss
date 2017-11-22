<section class="background-color--dark" data-section="component">
	<!-- header -->
	<header class="header">
		<div class="grid__container">
		</div>
	</header>
	<!-- /header -->

	<!-- cart -->
	<cart></cart>
	<!-- /cart -->

	<br>
	<br>

	<h2>$Title</h2>
	<h3>ComponentsPage.ss in MitsubishiMotors/Pages/Layout</h3>
	<p>
		included by the 'Layout' template variable in MitsubishiMotors/Pages/Page.ss
	</p>
	$Content

	<br>
	<br>

	<!-- graphql demo -->
	<graphql></graphql>
	<!-- /graphql demo -->

	<br>
	<br>

	<!-- video player -->
	<div style="width: 100%; height: 500px;" class="relative">
		<video-player video="../themes/base/videos/MMNZ-60-1905.mp4" poster="../themes/base/images/temp/home-banner.jpg"></video-player>
	</div>
	<!-- /video player -->

	<br>
	<br>

	<!-- button -->
	<a href="" class="button">
		<span>Explore the Triton</span>
	</a>
	<a href="" class="button">
		<span>Explore ASX</span>
	</a>
	<a href="" class="button button--uppercase">
		<span>Find dealership</span>
	</a>
	<a href="" class="button button--uppercase button--chromeless">
		<span><i class="icon-th mr--2x" aria-hidden="true"></i>browse all ASX accessories</span>
	</a>
	<br>
	<br>
	<a href="" class="button button--dark button--uppercase">
		<span>select a vehicle</span>
	</a>
	<br>
	<br>
	<a href="" class="button button--model">
		<span style="color: #f36e26;">Explore the Mirage</span>
	</a>
	<!-- /button -->

	<br>
	<br>

	<!-- links -->
	<div style="background: white; padding: 10px;">
		<a href="" class="links links--arrow-right links--social-facebook">
			facebook
		</a>
		<a href="" class="links links--arrow-right links--social-twitter">
			twitter
		</a>
		<br>
		<br>
		<a href="" class="links">
			search again
		</a>
		<br>
		<br>
		<a href="" class="links links--arrow-right">
			find a dealer
		</a>
		<br>
		<br>
		<a href="" class="links links--arrow-left">
			find a dealer
		</a>
	</div>
	<!-- /links -->

	<br>
	<br>

	<!-- modal -->
	<button class="color--dark" @click="showModal('foo')">Show Modal 1</button>
	<button class="color--dark" @click="showModal('bar')">Show Modal 2</button>
	<!-- use the modal component, pass in the prop -->
	<modal :ref="'foo'">
		<!-- use the power of vue slots to override modal content -->
		<div slot="media" class="modal__image" style="background-image: url(https://mmnz-hub.dev/storage/accessories/JCO1BlXwBoDyNtzkroNMgx5kEgUjYptKsnDfBygC.jpg)">
		</div>
		<div slot="body">
			<h6>exterior</h6>
			<h3 class="py--4x">17 inch diamond alloy wheel</h3>
			<span class="color--dark">$1299</span>
			<p class="py--4x">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum expedita rerum nam commodi vel fugiat aperiam! Provident aliquid molestias atque ad? Eos inventore omnis culpa repellat beatae doloremque dicta est!</p>
			<a href="" class="button button--uppercase">
				<span><i class="icon-plus mr--2x"></i>add item</span>
			</a>
		</div>
	</modal>
	<!-- /modal -->

	<modal :ref="'bar'">
		<!-- use the power of vue slots to override modal content -->
		<div slot="media" class="modal__image" style="background-image: url(https://mmnz-hub.dev/storage/accessories/JCO1BlXwBoDyNtzkroNMgx5kEgUjYptKsnDfBygC.jpg)">
		</div>
		<div slot="body">
			<h6>exterior</h6>
			<h3 class="py--4x">I am modal 2</h3>
			</a>
		</div>
	</modal>
	<!-- /modal -->

	<br>
	<br>

	<!-- colour swapper -->
	<ul class="colour-swapper">
		<li class="colour-swapper__item">
			<span class="colour-swapper__colour" style="background: #d9ddd1;"></span>
			<span class="colour-swapper__name" style="color: #d9ddd1;">Space grey</span>
		</li>
		<li class="colour-swapper__item">
			<span class="colour-swapper__colour" style="background: #3469b3;"></span>
			<span class="colour-swapper__name" style="color: #3469b3;">Acid blue</span>
		</li>
		<li class="colour-swapper__item colour-swapper__item--active">
			<span class="colour-swapper__colour" style="background: #c1c3cd;"></span>
			<span class="colour-swapper__name" style="color: #c1c3cd;">Cool silver</span>
		</li>
		<li class="colour-swapper__item">
			<span class="colour-swapper__colour" style="background: #100d11;"></span>
			<span class="colour-swapper__name" style="color: #100d11;">Deep black</span>
		</li>
		<li class="colour-swapper__item">
			<span class="colour-swapper__colour" style="background: #932225;"></span>
			<span class="colour-swapper__name" style="color: #932225;">Cobalt red</span>
		</li>
	</ul>
	<!-- /colour swapper -->

	<br>
	<br>

	<!-- tab -->
	<div style="background: white; padding: 100px 10px; text-align: center;">
		<ul class="tab">
			<li class="mx--6x tab__item tab__item--active">
				<a class="tab__link type--uppercase">vehicle pack</a>
			</li>
			<li class="mx--6x tab__item">
				<a class="tab__link type--uppercase">exterior</a>
			</li>
			<li class="mx--6x tab__item">
				<a class="tab__link type--uppercase">interior</a>
			</li>
		</ul>

		<br>
		<br>
		<br>
		<br>

		<ul class="tab">
			<li class="mx--6x tab__item">
				<a class="tab__link type--uppercase">buyers</a>
			</li>
			<li class="mx--6x tab__item tab__item--active">
				<a class="tab__link type--uppercase">current owners</a>
			</li>
			<li class="mx--6x tab__item">
				<a class="tab__link type--uppercase">fleet</a>
			</li>
			<li class="mx--6x tab__item">
				<a class="tab__link type--uppercase">vehicle pack</a>
			</li>
		</ul>
	</div>

	<div style="padding: 100px 10px; text-align: center;">
		<ul class="tab tab--light">
			<li class="mx--6x tab__item tab__item--active">
				<a class="tab__link type--uppercase">vehicle pack</a>
			</li>
			<li class="mx--6x tab__item">
				<a class="tab__link type--uppercase">exterior</a>
			</li>
			<li class="mx--6x tab__item">
				<a class="tab__link type--uppercase">interior</a>
			</li>
		</ul>
	</div>
	<!-- /tab -->

	<br>
	<br>

	<!-- tile -->
	<div class="grid__container clearfix">
		<div class="grid--3">
			<div class="tile">
				<div class="tile__image">
					<img src="../themes/base/images/temp/accessory.jpg" alt="">
				</div>
				<a href="" class="tile__action">
					<i class="icon-plus"></i>
				</a>
				<div class="tile__infos">
					<span class="tile__title">Bonnet protector</span>
					<span class="tile__subtitle">$799</span>
				</div>
			</div>
		</div>
		<div class="grid--3">
			<div class="tile tile--selected">
				<div class="tile__image">
					<img src="../themes/base/images/temp/accessory.jpg" alt="">
				</div>
				<a href="" class="tile__action">
					<i class="icon-tick"></i> added
				</a>
				<div class="tile__infos">
					<span class="tile__title">Bonnet protector</span>
					<span class="tile__subtitle">$799</span>
				</div>
			</div>
		</div>
		<div class="grid--6">
			<div class="tile tile--list">
				<div class="tile__image">
					<img src="../themes/base/images/temp/accessory.jpg" alt="">
				</div>
				<a href="" class="tile__action">
					<i class="icon-plus"></i>
				</a>
				<div class="tile__infos">
					<div class="tile__center">
						<span class="tile__title">Bonnet protector</span>
						<span class="tile__subtitle">
							$799
							<span class="tile__emphasize">save $450</span>
						</span>

						<ul class="tile__list">
							<li class="tile__list__item">Nudge bar</li>
							<li class="tile__list__item">Hood protector</li>
							<li class="tile__list__item">Tow bar and ball</li>
							<li class="tile__list__item">Headlamp protector</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="grid--6">
			<div class="tile tile--list tile--selected">
				<div class="tile__image">
					<img src="../themes/base/images/temp/accessory.jpg" alt="">
				</div>
				<a href="" class="tile__action">
					<i class="icon-tick"></i> added
				</a>
				<div class="tile__infos">
					<div class="tile__center">
						<span class="tile__title">Bonnet protector</span>
						<span class="tile__subtitle">
							$799
							<span class="tile__emphasize">save $450</span>
						</span>

						<ul class="tile__list">
							<li class="tile__list__item">Nudge bar</li>
							<li class="tile__list__item">Hood protector</li>
							<li class="tile__list__item">Tow bar and ball</li>
							<li class="tile__list__item">Headlamp protector</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="grid--3">
			<div class="tile tile--selected tile--no-action">
				<div class="tile__image">
					<img src="../themes/base/images/temp/accessory.jpg" alt="">
				</div>
				<a href="" class="tile__action">
					<i class="icon-tick"></i> added
				</a>
				<div class="tile__infos">
					<span class="tile__title">Bonnet protector</span>
					<span class="tile__subtitle">$799</span>
				</div>
			</div>
		</div>
	</div>
	<!-- /tile -->

	<br>
	<br>

	<!-- price -->
	<div style="background: white; padding: 10px;">
		<div class="price">
			<span class="price__label type--uppercase">total price</span>
			<span class="price__amount">$39,950</span>
		</div>
		<br>
		<br>
		<div class="price">
			<span class="price__amount">$39,950</span>
			<span class="price__conditions">RRP* + ORC</span>
		</div>
		<br>
		<br>
		<div class="price price--offer">
			<span class="special-offer">Special offer</span>
			<span class="price__amount">$39,950</span>
			<span class="price__conditions">RRP* + ORC</span>
		</div>
		<br>
		<br>
		<div class="price price--inline">
			<span class="price__amount">$39,950</span>
			<span class="price__conditions">RRP* + ORC</span>
		</div>
	</div>
	<br>
	<br>
	<div style="padding: 10px;">
		<div class="price price--light">
			<span class="price__label type--uppercase">total price</span>
			<span class="price__amount">$39,950</span>
		</div>
		<br>
		<br>
		<div class="price price--light">
			<span class="price__amount">$39,950</span>
			<span class="price__conditions">RRP* + ORC</span>
		</div>
		<br>
		<br>
		<div class="price price--inline price--light">
			<span class="price__amount">$39,950</span>
			<span class="price__conditions">RRP* + ORC</span>
		</div>
	</div>
	<!-- /price -->

	<br>
	<br>

	<!-- background title -->
	<div style="position: relative; height: 500px;">
		<div class="background-title">
			<span>A</span>
			<span>S</span>
			<span>X</span>
		</div>
	</div>
	<div style="position: relative; height: 500px; background: #932225;">
		<div class="background-title">
			<span>O</span>
			<span>u</span>
			<span>t</span>
			<span>l</span>
			<span>a</span>
			<span>n</span>
			<span>d</span>
			<span>e</span>
			<span>r</span>
		</div>
	</div>
	<div style="position: relative; height: 500px;" class="background-halo">
		<div class="background-title">
			<span>H</span>
			<span>A</span>
			<span>L</span>
			<span>O</span>
		</div>
	</div>
	<div style="position: relative; height: 500px; background: #932225;" class="background-noise">
		<div class="background-title">
			<span>N</span>
			<span>O</span>
			<span>I</span>
			<span>S</span>
			<span>E</span>
		</div>
	</div>
	<!-- /background title -->

	<br>
	<br>

	<!-- vehicle-feature-image -->
	<div class="grid__container clearfix">
		<div class="grid--4">
			<div class="vehicle-feature-image js-smooth-component">
				<img src="../themes/base/images/temp/vehicle-feature-image.jpg" alt="">
			</div>
		</div>
	</div>
	<!-- /vehicle-feature-image -->

	<br>
	<br>

	<!-- vehicle-feature-description -->
	<div class="grid__container clearfix">
		<div class="grid--4">
			<div class="vehicle-feature-description">
				<div class="vehicle-feature-description__image">
					<img src="../themes/base/images/temp/feature-square.jpg" alt="">
				</div>
				<div class="vehicle-feature-description__description">
					<h6 class="vehicle-feature-description__label vehicle-feature-description__label--vertical font--bold pt--4x">you'll get through that</h6>
					<p class="vehicle-feature-description__content font--bold py--4x">UTEs are build to do things. They tow things, carry things, scarmble down steep things and up the other side. Triton can do thing you've never seen from UTE before. You can rely on it to take your further. Ifyou've fot the stomach for it.</p>
				</div>
			</div>
		</div>

		<div class="grid--4 push--1">
			<div class="vehicle-feature-description vehicle-feature-description--vertical">
				<div class="vehicle-feature-description__image">
					<img src="../themes/base/images/temp/feature-square.jpg" alt="">
				</div>
				<div class="vehicle-feature-description__description">
					<h6 class="vehicle-feature-description__label vehicle-feature-description__label--vertical font--bold pt--4x">you'll get through that</h6>
					<p class="vehicle-feature-description__content font--bold py--4x">UTEs are build to do things. They tow things, carry things, scarmble down steep things and up the other side. Triton can do thing you've never seen from UTE before. You can rely on it to take your further. Ifyou've fot the stomach for it.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- /vehicle-feature-description -->

	<br>
	<br>

	<!-- /vehicle-feature-keypoint -->
	<div class="grid__container clearfix">
		<div class="grid--7">
			<div class="vehicle-feature-keypoint">
				<div class="vehicle-feature-keypoint__image">
					<img src="../themes/base/images/temp/feature-rectangle.jpg" alt="">
				</div>
				<div class="vehicle-feature-keypoint__description">
					<h6 class="vehicle-feature-keypoint__label">triton 4wd</h6>
					<h3 class="vehicle-feature-keypoint__title my--4x">Take it easy</h3>
					<p class="vehicle-feature-keypoint__content">Your triton can handle anything the work day demands. When the day's done, it lets you get away from it all in total confort</p>
				</div>
			</div>
		</div>
	</div>
	<div class="grid__container clearfix">
		<div class="grid--7">
			<div class="vehicle-feature-keypoint vehicle-feature-keypoint--light">
				<div class="vehicle-feature-keypoint__image">
					<img src="../themes/base/images/temp/feature-rectangle.jpg" alt="">
				</div>
				<div class="vehicle-feature-keypoint__description">
					<h6 class="vehicle-feature-keypoint__label">triton 4wd</h6>
					<h3 class="vehicle-feature-keypoint__title my--4x">Take it easy</h3>
					<p class="vehicle-feature-keypoint__content">Your triton can handle anything the work day demands. When the day's done, it lets you get away from it all in total confort</p>
				</div>
			</div>
		</div>
	</div>
	<div class="grid__container clearfix">
		<div class="grid--7">
			<div class="vehicle-feature-keypoint vehicle-feature-keypoint--light vehicle-feature-keypoint--vertical">
				<div class="vehicle-feature-keypoint__image">
					<div class="vehicle-feature-keypoint__controls">
						<h2 class="color--light">controls</h2>
					</div>
					<img src="../themes/base/images/temp/feature-rectangle.jpg" alt="">
				</div>
				<h6 class="vehicle-feature-keypoint__label">triton 4wd</h6>
				<div class="vehicle-feature-keypoint__description">
					<h3 class="vehicle-feature-keypoint__title my--4x">Take it easy</h3>
					<p class="vehicle-feature-keypoint__content">Your triton can handle anything the work day demands. When the day's done, it lets you get away from it all in total confort</p>
				</div>
			</div>
		</div>
	</div>
	<div class="grid__container clearfix">
		<div class="grid--9">
			<div class="vehicle-feature-keypoint vehicle-feature-keypoint--light vehicle-feature-keypoint--vertical vehicle-feature-keypoint--large">
				<div class="vehicle-feature-keypoint__image js-smooth-component">
					<div class="vehicle-feature-keypoint__controls">
						<h2 class="color--light">controls</h2>
					</div>
					<img src="../themes/base/images/temp/vehicle-feature-keypoint.jpg" alt="">
				</div>
				<h6 class="vehicle-feature-keypoint__label">triton 4wd</h6>
				<div class="vehicle-feature-keypoint__description">
					<h3 class="vehicle-feature-keypoint__title my--4x">Take it easy</h3>
					<p class="vehicle-feature-keypoint__content">Your triton can handle anything the work day demands. When the day's done, it lets you get away from it all in total confort</p>
				</div>
			</div>
		</div>
	</div>
	<!-- vehicle-feature-keypoint -->

	<br>
	<br>

	<!-- vehicle-slideshow -->
	<div class="vehicle-slideshow">
		<div class="vehicle-slideshow__container">
			<a class="controls__nav controls__nav--prev">
				{$SVG('/themes/base/images/svg/nav-prev').width(45).fill('#FFFFFF')}
			</a>

			<a class="controls__nav controls__nav--next">
				{$SVG('/themes/base/images/svg/nav-next').width(45).fill('#FFFFFF')}
			</a>

			<ul class="vehicle-slideshow__images">
				<li><img src="../themes/base/images/temp/vehicle-slideshow.jpg" alt=""></li>
				<li><img src="../themes/base/images/temp/vehicle-slideshow.jpg" alt=""></li>
				<li><img src="../themes/base/images/temp/vehicle-slideshow.jpg" alt=""></li>
			</ul>
		</div>
		<div class="vehicle-slideshow__description">
			<ul class="vehicle-slideshow__keypoints">
				<li>
					<h6 class="vehicle-slideshow__label">technology</h6>
					<h3 class="vehicle-slideshow__title my--4x">The best views</h3>
					<p class="vehicle-slideshow__content">Watch the best cityscape glide overhead through the new panoramic roof on ASX VRX. You can open or close the roof easily, thank to the electronic blind.</p>
				</li>
				<li>
					<h6 class="vehicle-slideshow__label">technology</h6>
					<h3 class="vehicle-slideshow__title my--4x">The best views</h3>
					<p class="vehicle-slideshow__content">Watch the best cityscape glide overhead through the new panoramic roof on ASX VRX. You can open or close the roof easily, thank to the electronic blind.</p>
				</li>
			</ul>
			<ul class="bullets px--14x pb--5x">
				<li class="bullets__item bullets__item--active"></li>
				<li class="bullets__item"></li>
				<li class="bullets__item"></li>
			</ul>
		</div>
	</div>
	<!-- /vehicle-slideshow -->

	<br>
	<br>

	<!-- typography -->
	<div style="background: white; padding: 10px 0;">
		<h1>Work hard, play harder</h1><br>
		<h2>Explore the ASX range</h2><br>
		<h3>Take it easy</h3><br>
		<h4>The best views</h4><br>
		<h5>Accessories</h5><br>
		<h6>technology</h6><br>
		<p>
			Watch the best cityscape glide overhead through the new panoramic roof on ASX VRX. You can open or close the roof easily, thank to the electronic blind.
		</p>
		<br>
		<p class="font--bold">
			Watch the best cityscape glide overhead through the new panoramic roof on ASX VRX. You can open or close the roof easily, thank to the electronic blind.
		</p>
	</div>
	<div style="padding: 10px 0;">
		<h1 class="color--light">Work hard, play harder</h1><br>
		<h2 class="color--light">Explore the ASX range</h2><br>
		<h3 class="color--light">Take it easy</h3><br>
		<h4 class="color--light">The best views</h4><br>
		<h5 class="color--light">Accessories</h5><br>
		<h6>technology</h6><br>
		<p>
			Watch the best cityscape glide overhead through the new panoramic roof on ASX VRX. You can open or close the roof easily, thank to the electronic blind.
		</p>
		<br>
		<p class="font--bold">
			Watch the best cityscape glide overhead through the new panoramic roof on ASX VRX. You can open or close the roof easily, thank to the electronic blind.
		</p>
		<p class="font--bold color--light">
			Watch the best cityscape glide overhead through the new panoramic roof on ASX VRX. You can open or close the roof easily, thank to the electronic blind.
		</p>
	</div>
	<!-- /typography -->

	<br>
	<br>

	<!-- filter -->
	<ul class="filter filter--center">
		<li class="filter__item px--3x py--1x">map</li>
		<li class="filter__item filter__item--active px--3x py--1x">list</li>
	</ul>
	<br>
	<br>
	<ul class="filter">
		<li class="filter__item filter__item--active px--3x py--1x">all</li>
		<li class="filter__item px--3x py--1x">2wd</li>
		<li class="filter__item px--3x py--1x">4wd</li>
		<li class="filter__item px--3x py--1x">petrol</li>
		<li class="filter__item px--3x py--1x">diesel</li>
	</ul>
	<br>
	<br>
	<ul class="filter">
		<li class="filter__item filter__item--label pr--3x py--1x">compare vehicle</li>
		<li class="filter__item px--3x py--1x">general</li>
		<li class="filter__item px--3x py--1x">technical</li>
		<li class="filter__item px--3x py--1x">safety & security</li>
		<li class="filter__item px--3x py--1x">exterior</li>
		<li class="filter__item px--3x py--1x">comfort & convenience</li>
		<li class="filter__item px--3x py--1x">audio & media</li>
		<li class="filter__item filter__item--active px--3x py--1x">full specs</li>
	</ul>
	<br>
	<br>
	<ul class="filter filter--liquid">
		<li class="filter__item filter__item--label pr--3x py--1x">compare vehicle</li>
		<li class="filter__item px--3x py--1x">general</li>
		<li class="filter__item px--3x py--1x">technical</li>
		<li class="filter__item px--3x py--1x">safety & security</li>
		<li class="filter__item px--3x py--1x">exterior</li>
		<li class="filter__item px--3x py--1x">comfort & convenience</li>
		<li class="filter__item px--3x py--1x">audio & media</li>
		<li class="filter__item filter__item--active px--3x py--1x">full specs</li>
	</ul>
	<!-- /filter -->

	<br>
	<br>

	<!-- accordion -->
	<div style="background: white;">
		<div class="grid__container clearfix">
			<ul class="accordion">
				<li class="accordion__item">
					<h4 class="accordion__title py--4x mx-auto">Auckland <i></i></h4>
					<div class="accordion__content mx-auto">
						<p class="my--4x">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae in ipsam totam veritatis, nobis harum neque tempore optio provident accusamus quidem similique cumque nulla maiores tempora. Dolores, amet, consectetur.
						</p>
					</div>
				</li>
				<li class="accordion__item">
					<h4 class="accordion__title py--4x mx-auto">Northland <i></i></h4>
					<div class="accordion__content mx-auto">
						<p class="my--4x">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae in ipsam totam veritatis, nobis harum neque tempore optio provident accusamus quidem similique cumque nulla maiores tempora. Dolores, amet, consectetur.
						</p>
					</div>
				</li>
				<li class="accordion__item">
					<h4 class="accordion__title py--4x mx-auto">Waikato <i></i></h4>
					<div class="accordion__content mx-auto">
						<p class="my--4x">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae in ipsam totam veritatis, nobis harum neque tempore optio provident accusamus quidem similique cumque nulla maiores tempora. Dolores, amet, consectetur.
						</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<br>
	<br>
	<div style="background: white;">
		<div class="grid__container clearfix">
			<ul class="accordion">
				<li class="accordion__item">
					<h4 class="accordion__title py--4x mx-auto">Auckland <i></i></h4>
					<div class="accordion__content mx-auto">
						<p class="my--4x">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae in ipsam totam veritatis, nobis harum neque tempore optio provident accusamus quidem similique cumque nulla maiores tempora. Dolores, amet, consectetur.
						</p>
					</div>
				</li>
				<li class="accordion__item accordion__item--active">
					<h4 class="accordion__title py--4x mx-auto">Northland <i></i></h4>
					<div class="accordion__content mx-auto">
						<p class="my--4x">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae in ipsam totam veritatis, nobis harum neque tempore optio provident accusamus quidem similique cumque nulla maiores tempora. Dolores, amet, consectetur.
						</p>
					</div>
				</li>
				<li class="accordion__item">
					<h4 class="accordion__title py--4x mx-auto">Waikato <i></i></h4>
					<div class="accordion__content mx-auto">
						<p class="my--4x">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit molestiae in ipsam totam veritatis, nobis harum neque tempore optio provident accusamus quidem similique cumque nulla maiores tempora. Dolores, amet, consectetur.
						</p>
					</div>
				</li>
			</ul>
		</div>
	</div>
	<!-- /accordion -->

	<br>
	<br>

	<!--lists -->
	<ul class="list list--inline list--center">
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">5-star ANCAP <br> safety rating</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">Panoramic roof for <br> VRX models</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">6-Speed CVT with <br> Sports mode</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">6" Touch screen <br>display audio</span>
		</li>
	</ul>

	<br>
	<br>

	<ul class="list list--inline">
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">5-star ANCAP <br> safety rating</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">Panoramic roof for <br> VRX models</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">6-Speed CVT with <br> Sports mode</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">6" Touch screen <br>display audio</span>
		</li>
	</ul>

	<br>
	<br>

	<ul class="list list--inline list--right">
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">5-star ANCAP <br> safety rating</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">Panoramic roof for <br> VRX models</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">6-Speed CVT with <br> Sports mode</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">6" Touch screen <br>display audio</span>
		</li>
	</ul>

	<br>
	<br>

	<ul class="list list--inline">
		<li class="list__item">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold">5-star ANCAP <br> safety rating</span>
		</li>
		<li class="list__item">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold">Panoramic roof for <br> VRX models</span>
		</li>
		<li class="list__item">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold">6-Speed CVT with <br> Sports mode</span>
		</li>
		<li class="list__item">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold">6" Touch screen <br>display audio</span>
		</li>
	</ul>

	<br>
	<br>

	<ul class="list list--stacked">
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">5-star ANCAP <br> safety rating</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">Panoramic roof for <br> VRX models</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">6-Speed CVT with <br> Sports mode</span>
		</li>
		<li class="list__item list__item--stacked">
			<span><img src="http://via.placeholder.com/200x100" alt=""></span>
			<span class="font--bold type--center">6" Touch screen <br>display audio</span>
		</li>
	</ul>
	<!--/lists -->

	<br>
	<br>

	<!-- editorial -->
	<div style="background: white;" class="clearfix">
		<div class="grid__container">
			<section class="editorial">
				<div class="editorial__header editorial__header--offset py--10x mb--10x type--center">
					<h6>content page subtitle</h6>
					<h2 class="mt--10x">Content page <br>components</h2>
					<p class="my--10x">Minor Mechanical or Electronical Breakdown</p>
					<p class="color--dark">Minor Mechanical or Electronical Breakdown</p>
				</div>

				<div class="editorial__paragraph py--10x">
					<p class="font--bold color--dark">Minor Mechanical or Electronical Breakdown</p>
					<p class="color--dark">If the problem Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
					<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
					<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
				</div>

				<div class="editorial__media py--10x ">
					<div class="editorial__image">
						<img src="../themes/base/images/temp/accessory.jpg" alt="">
					</div>
					<div class="editorial__content">
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
					</div>
				</div>

				<div class="editorial__media py--10x ">
					<div class="editorial__image">
						<img src="../themes/base/images/temp/accessory.jpg" alt="">
					</div>
					<div class="editorial__content">
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- /editorial -->

	<br>
	<br>

	<!-- editorial -->
	<div style="background: white;" class="clearfix">
		<div class="grid__container">
			<section class="editorial">
				<div class="editorial__header py--10x mb--10x type--center">
					<h6>content page subtitle</h6>
					<h2 class="mt--10x">Content page <br>components</h2>
					<p class="my--10x">Minor Mechanical or Electronical Breakdown</p>
					<p class="color--dark">Minor Mechanical or Electronical Breakdown</p>
				</div>

				<div class="editorial__paragraph">
					<p class="font--bold color--dark mb--2x">Minor Mechanical or Electronical Breakdown</p>
					<p class="color--dark mb--2x">If the problem Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
					<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
					<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
				</div>

				<div class="editorial__media py--10x ">
					<div class="editorial__image">
						<img src="../themes/base/images/temp/accessory.jpg" alt="">
					</div>
					<div class="editorial__content">
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
					</div>
				</div>

				<div class="editorial__media editorial__media--inverted py--10x ">
					<div class="editorial__image">
						<img src="../themes/base/images/temp/accessory.jpg" alt="">
					</div>
					<div class="editorial__content">
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
						<p class="mb--2x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
					</div>
				</div>
			</section>
		</div>
	</div>
	<!-- /editorial -->

	<br>
	<br>

	<!-- dealer detail tile -->
	<div style="background: white; padding: 100px 0;" class="clearfix">
		<div class="grid__container">
			<div class="grid--4 push--2">
				<div class="dealer-detail-tile p--8x mb--4x">
					<h4>Wellington Mitsubishi</h4>

					<div class="dealer-detail-tile__content">
						<span class="dealer-detail-tile__label pt--4x">Address</span>
						<span class="dealer-detail-tile__text">75-78 Cambridge Terrace, WELLINGTON</span>

						<span class="dealer-detail-tile__label pt--4x">Phone number</span>
						<span class="dealer-detail-tile__text">(04) 385 2252</span>

						<span class="dealer-detail-tile__label pt--4x">Email</span>
						<span class="dealer-detail-tile__text font--bold">sales@mmnz.co.nz</span>
					</div>

					<ul class="dealer-detail-tile__links pt--4x">
						<li>
							<a href="" class="links links--arrow-right mr--4x">
								Visit website
							</a>
						</li>
						<li>
							<a href="" class="links links--arrow-right">
								get directions
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="grid--4">
				<div class="dealer-detail-tile p--8x mb--4x">
					<h4>Wellington Mitsubishi</h4>

					<div class="dealer-detail-tile__content">
						<span class="dealer-detail-tile__label pt--4x">Address</span>
						<span class="dealer-detail-tile__text">75-78 Cambridge Terrace, WELLINGTON</span>

						<span class="dealer-detail-tile__label pt--4x">Phone number</span>
						<span class="dealer-detail-tile__text">(04) 385 2252</span>

						<span class="dealer-detail-tile__label pt--4x">Email</span>
						<span class="dealer-detail-tile__text font--bold">sales@mmnz.co.nz</span>
					</div>

					<ul class="dealer-detail-tile__links pt--4x">
						<li>
							<a href="" class="links links--arrow-right mr--4x">
								Visit website
							</a>
						</li>
						<li>
							<a href="" class="links links--arrow-right">
								get directions
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="grid--4 push--2">
				<div class="dealer-detail-tile p--8x">
					<h4>Wellington Mitsubishi</h4>

					<div class="dealer-detail-tile__content">
						<span class="dealer-detail-tile__label pt--4x">Address</span>
						<span class="dealer-detail-tile__text">75-78 Cambridge Terrace, WELLINGTON</span>

						<span class="dealer-detail-tile__label pt--4x">Phone number</span>
						<span class="dealer-detail-tile__text">(04) 385 2252</span>

						<span class="dealer-detail-tile__label pt--4x">Email</span>
						<span class="dealer-detail-tile__text font--bold">sales@mmnz.co.nz</span>
					</div>

					<ul class="dealer-detail-tile__links pt--4x">
						<li>
							<a href="" class="links links--arrow-right mr--4x">
								Visit website
							</a>
						</li>
						<li>
							<a href="" class="links links--arrow-right">
								get directions
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="grid--4">
				<div class="dealer-detail-tile p--8x">
					<h4>Wellington Mitsubishi</h4>

					<div class="dealer-detail-tile__content">
						<span class="dealer-detail-tile__label pt--4x">Address</span>
						<span class="dealer-detail-tile__text">75-78 Cambridge Terrace, WELLINGTON</span>

						<span class="dealer-detail-tile__label pt--4x">Phone number</span>
						<span class="dealer-detail-tile__text">(04) 385 2252</span>

						<span class="dealer-detail-tile__label pt--4x">Email</span>
						<span class="dealer-detail-tile__text font--bold">sales@mmnz.co.nz</span>
					</div>

					<ul class="dealer-detail-tile__links pt--4x">
						<li>
							<a href="" class="links links--arrow-right mr--4x">
								Visit website
							</a>
						</li>
						<li>
							<a href="" class="links links--arrow-right">
								get directions
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- /dealer detail tile -->

	<br>
	<br>

	<!-- document -->
	<div style="background: white; padding: 100px 0;" class="clearfix">
		<div class="grid__container">
			<div class="document mx--10x">
				<div class="document__wrapper relative">
					<a href="/">
						<div class="document__image">
							<div class="document__mask" style="background-color: #1D2944"></div>
							<img src="../themes/base/images/temp/brochure.jpg" alt="$Title">
						</div>
						<div class="document__action">
							<i class="icon-download"></i>
							<span class="font--bold mt--2x">Download file</span>
						</div>
					</a>
				</div>
				<div class="document__infos">
					<span class="document__label mt--2x color--mid font--bold">The All New ASX brochure<b class="document__label color--mid font--light">.pdf</b></span>
					<span class="document__label color--mid-light">62KB</span>
				</div>
			</div>
			<div class="document mx--10x">
				<div class="document__wrapper relative">
					<a href="/">
						<div class="document__image">
							<div class="document__mask" style="background-color: #1D2944"></div>
							<img src="../themes/base/images/temp/brochure.jpg">
						</div>
						<div class="document__action">
							<i class="icon-download"></i>
							<span class="font--bold mt--2x">Download file</span>
						</div>
					</a>
				</div>
				<div class="document__infos">
					<span class="document__label mt--2x color--mid font--bold">The All New ASX brochure<b class="document__label color--mid font--light">.pdf</b></span>
					<span class="document__label color--mid-light">62KB</span>
				</div>
			</div>
		</div>
	</div>
	<!-- /document -->

	<br>
	<br>

	<!-- tabbed tile -->
	<div style="background: white; padding: 100px 0;" class="clearfix">
		<div class="grid__container">
			<div class="grid--4">
				<div class="tabbed-tile">
					<div class="tabbed-tile__image">
						<img src="../themes/base/images/temp/tabbed-tile-1.jpg" alt="">
					</div>
					<div class="tabbed-tile__description py--6x px--10x">
						<h4 class="pb--4x">Genuine parts and accessories</h4>
						<p class="font--bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
					</div>
				</div>
			</div>
			<div class="grid--4">
				<div class="tabbed-tile">
					<div class="tabbed-tile__image">
						<img src="../themes/base/images/temp/tabbed-tile-2.jpg" alt="">
					</div>
					<div class="tabbed-tile__description py--6x px--10x">
						<h4 class="pb--4x">Warranty and servicing</h4>
						<p class="font--bold">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
					</div>
				</div>
			</div>
			<div class="grid--4">
				<div class="tabbed-tile">
					<div class="tabbed-tile__image">
						<img src="../themes/base/images/temp/tabbed-tile-3.jpg" alt="">
					</div>
					<div class="tabbed-tile__description py--6x px--10x">
						<h4 class="color--light pb--4x">Special offers</h4>
						<p class="color--light font--bold">Maecenas sed diam eget risus varius amet, consectetur adipisicing elit.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- tabbed tile -->

	<br>
	<br>

	<!-- sticky navigation -->
	<nav class="sticky-navigation clearfix">
		<div class="sticky-navigation__logo mt--4x">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 108.8 17.8"><path class="st0" d="M89.1 6.7C91.6 5 94 3.3 96.5 1.6h12c-2 1.3-8.4 5.4-12.3 7.8 4 2.8 8.5 5.5 12.3 8.3H96.8l-7.6-5.2c-2.6 1.6-5 3.5-7.6 5.2h-12c3.9-2.7 8.7-5.7 12.5-8.2-1.4-1-6.3-3.9-6.3-3.9s-28.4-.2-30.7 0c-.4 0-1.9.3-2 1 0 .5.8.9 1.1.9 1.5.4 4 .2 5.8.2h8c5.4 0 10.6 0 12.9 3.1.8 1.2.7 2.8-.2 4-3 3.6-11.4 2.8-18.4 2.8h-21s-5.3-6.1-7.5-8.4c-1-1.1-2.1-2.4-4.2-2.1-.5.1-.9.3-1.3.5-2.3 1.4-3.5 3.5-5.7 6.2h11.1s1.6 1.8 3.4 3.9H0c.9-1.3 5.5-6.6 8.1-9.6 2.9-3.4 5.8-6.5 11.5-6.8 5-.3 8.3 2.1 10.6 4.5 2.1 2.1 4.1 4.7 6.1 7.1l.9.9h20.3c1.7 0 5.6.2 5.7-1.1 0-.8-1.6-1-2.6-1.1-3.5-.1-7.4 0-10.7 0-4.5 0-9.8.1-12.7-1.6-1.2-.7-2.7-2-2.3-4 .6-2.9 4.7-4.2 8.4-4.4 4.2-.2 27.5 0 35.1 0h3.2c.2 0 5.7 3.7 7.5 5.1"/></svg>
		</div>

		<div class="sticky-navigation__action">
			<ul class="navigation navigation--primary">
				<li class="navigation__item font--bold p--4x">
					<a href="">Overview</a>
				</li>
				<li class="navigation__item font--bold p--4x">
					<a href="">Design</a>
				</li>
				<li class="navigation__item font--bold p--4x">
					<a href="">Technology</a>
				</li>
				<li class="navigation__item font--bold p--4x">
					<a href="">Safety</a>
				</li>
				<li class="navigation__item font--bold p--4x">
					<a href="">Accessories</a>
				</li>
				<li class="navigation__item font--bold p--4x">
					<a href="">Range</a>
				</li>
				<li class="navigation__item pt--2x">
					<a href="" class="button button--uppercase">
						<span>Find dealership</span>
					</a>
				</li>
			</ul>
		</div>
	</nav>

	<div style="background: white;">
		<nav class="sticky-navigation sticky-navigation--dark clearfix">
			<div class="sticky-navigation__logo mt--4x">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 108.8 17.8"><path class="st0" d="M89.1 6.7C91.6 5 94 3.3 96.5 1.6h12c-2 1.3-8.4 5.4-12.3 7.8 4 2.8 8.5 5.5 12.3 8.3H96.8l-7.6-5.2c-2.6 1.6-5 3.5-7.6 5.2h-12c3.9-2.7 8.7-5.7 12.5-8.2-1.4-1-6.3-3.9-6.3-3.9s-28.4-.2-30.7 0c-.4 0-1.9.3-2 1 0 .5.8.9 1.1.9 1.5.4 4 .2 5.8.2h8c5.4 0 10.6 0 12.9 3.1.8 1.2.7 2.8-.2 4-3 3.6-11.4 2.8-18.4 2.8h-21s-5.3-6.1-7.5-8.4c-1-1.1-2.1-2.4-4.2-2.1-.5.1-.9.3-1.3.5-2.3 1.4-3.5 3.5-5.7 6.2h11.1s1.6 1.8 3.4 3.9H0c.9-1.3 5.5-6.6 8.1-9.6 2.9-3.4 5.8-6.5 11.5-6.8 5-.3 8.3 2.1 10.6 4.5 2.1 2.1 4.1 4.7 6.1 7.1l.9.9h20.3c1.7 0 5.6.2 5.7-1.1 0-.8-1.6-1-2.6-1.1-3.5-.1-7.4 0-10.7 0-4.5 0-9.8.1-12.7-1.6-1.2-.7-2.7-2-2.3-4 .6-2.9 4.7-4.2 8.4-4.4 4.2-.2 27.5 0 35.1 0h3.2c.2 0 5.7 3.7 7.5 5.1"/></svg>
			</div>

			<div class="sticky-navigation__action">
				<ul class="navigation navigation--primary">
					<li class="navigation__item font--bold p--4x">
						<a href="">Overview</a>
					</li>
					<li class="navigation__item font--bold p--4x">
						<a href="">Design</a>
					</li>
					<li class="navigation__item font--bold p--4x">
						<a href="">Technology</a>
					</li>
					<li class="navigation__item font--bold p--4x">
						<a href="">Safety</a>
					</li>
					<li class="navigation__item font--bold p--4x">
						<a href="">Accessories</a>
					</li>
					<li class="navigation__item font--bold p--4x">
						<a href="">Range</a>
					</li>
					<li class="navigation__item pt--2x">
						<a href="" class="button button--uppercase">
							<span>Find dealership</span>
						</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
	<!-- sticky navigation -->

	<br>
	<br>

	<!-- unique selling point -->
	<ul class="unique-selling-point">
		<li class="unique-selling-point__item mb--2x">
			<span class="unique-selling-point__icon">
				<img src="../themes/base/images/temp/unique-selling-point.svg">
			</span>
			<span class="unique-selling-point__label">2.0L DOHC MIVEC Petrol engine</span>
		</li>
		<li class="unique-selling-point__item mb--2x">
			<span class="unique-selling-point__icon">
				<img src="../themes/base/images/temp/unique-selling-point.svg">
			</span>
			<span class="unique-selling-point__label">Fuel Economy 7.4L/100km</span>
		</li>
		<li class="unique-selling-point__item mb--2x">
			<span class="unique-selling-point__icon">
				<img src="../themes/base/images/temp/unique-selling-point.svg">
			</span>
			<span class="unique-selling-point__label">6.1" touch screen audio display <br>with reversin camera</span>
		</li>
	</ul>
	<!-- /unique selling point -->

	<br>
	<br>

	<!-- skewed tile -->
	<div class="skewed-tile skewed-tile--bottom-down">
		<div class="skewed-tile__wrapper">
			<div class="skewed-tile__container">
				<div class="skewed-tile__background" style="height: 0; padding-bottom: 37.51%;">
					<img src="../themes/base/images/temp/hero.jpg" style="width: 100%; position: absolute; left: 0;" alt="">
				</div>
				<div class="skewed-tile__content">
					<h6 class="mb--6x">mitsubishi</h6>
					<h2 class="color--light">Content</h2>
				</div>
			</div>
		</div>
	</div>
	<!-- demo purposes: simulate next bloc -->
	<div style="height: 400px; background: white;">
		<div>
			<h1>hey</h1>
		</div>
	</div>

	<div class="skewed-tile skewed-tile--bottom-up">
		<div class="skewed-tile__wrapper">
			<div class="skewed-tile__container">
				<div class="skewed-tile__background" style="height: 0; padding-bottom: 37.51%;">
					<img src="../themes/base/images/temp/hero.jpg" style="width: 100%; position: absolute; left: 0;" alt="">
				</div>
				<div class="skewed-tile__content">
					<img class="logo mb--6x" src="../themes/base/images/temp/asx.svg" alt="">
					<h2 class="color--light">Content</h2>
				</div>
			</div>
		</div>
	</div>
	<!-- demo purposes: simulate next bloc -->
	<div style="height: 400px; background: white;">
		<div>
			<h1 class="type--right">hey</h1>
		</div>
	</div>

	<div class="grid__container">
		<div class="skewed-tile skewed-tile--bottom-down">
			<div class="skewed-tile__wrapper">
				<div class="skewed-tile__container">
					<div class="skewed-tile__background" style="height: 0; padding-bottom: 37.51%;">
						<img src="../themes/base/images/temp/hero.jpg" style="width: 100%; position: absolute; left: 0;" alt="">
					</div>
					<div class="skewed-tile__content">
						<h2 class="color--light">Content</h2>
					</div>
				</div>
			</div>
		</div>
		<!-- demo purposes: simulate next bloc -->
		<div style="height: 400px; background: white;">
			<div>
				<h1>hey</h1>
			</div>
		</div>
	</div>

	<div class="grid__container">
		<div class="skewed-tile skewed-tile--bottom-up">
			<div class="skewed-tile__wrapper">
				<div class="skewed-tile__container">
					<div class="skewed-tile__background" style="height: 0; padding-bottom: 37.51%;">
						<img src="../themes/base/images/temp/hero.jpg" style="width: 100%; position: absolute; left: 0;" alt="">
					</div>
					<div class="skewed-tile__content">
						<h2 class="color--light">Content</h2>
					</div>
				</div>
			</div>
		</div>
		<!-- demo purposes: simulate next bloc -->
		<div style="height: 400px; background: white;">
			<div>
				<h1 class="type--right">hey</h1>
			</div>
		</div>
	</div>

	<div class="grid__container">
		<div class="skewed-tile skewed-tile--top-up">
			<div class="skewed-tile__wrapper">
				<div class="skewed-tile__container">
					<div class="skewed-tile__background" style="height: 0; padding-bottom: 37.51%;">
						<img src="../themes/base/images/temp/hero.jpg" style="width: 100%; position: absolute; left: 0;" alt="">
					</div>
					<div class="skewed-tile__content">
						<h2 class="color--light">Content</h2>
					</div>
				</div>
			</div>
		</div>
		<!-- demo purposes: simulate next bloc -->
		<div style="height: 400px; background: white;">
			<div>
				<h1 class="type--right">hey</h1>
			</div>
		</div>
	</div>

	<div class="grid__container">
		<div class="skewed-tile skewed-tile--top-down">
			<div class="skewed-tile__wrapper">
				<div class="skewed-tile__container">
					<div class="skewed-tile__background" style="height: 0; padding-bottom: 37.51%;">
						<img src="../themes/base/images/temp/hero.jpg" style="width: 100%; position: absolute; left: 0;" alt="">
					</div>
					<div class="skewed-tile__content">
						<h2 class="color--light">Content</h2>
					</div>
				</div>
			</div>
		</div>
		<!-- demo purposes: simulate next bloc -->
		<div style="height: 400px; background: white;">
			<div>
				<h1 class="type--right">hey</h1>
			</div>
		</div>
	</div>
	<!-- /skewed tile -->

	<br>
	<br>

	<!-- comparison-table -->
	<div class="grid__container" style="background: white; padding: 100px 0;">
		<div class="comparison-table">
			<table class="comparison-table__wrapper">
				<tbody>
					<tr class="comparison-table__line">
						<td class="comparison-table__cell">Transmission</td>
						<td class="comparison-table__cell">5 speed auto with Sports Mode</td>
						<td class="comparison-table__cell">6 Speed CVT with Sports mode and Paddle Shift</td>
					</tr>
					<tr class="comparison-table__line">
						<td class="comparison-table__cell">Hill assist</td>
						<td class="comparison-table__cell comparison-table__cell--none"></td>
						<td class="comparison-table__cell comparison-table__cell--included"></td>
					</tr>
					<tr class="comparison-table__line">
						<td class="comparison-table__cell">Engine type</td>
						<td class="comparison-table__cell">4N15 2.4L D4 MIVEC Intercoolded turbo petrol engine</td>
						<td class="comparison-table__cell">4N15 D4 MIVEC Intercoolded turbo petrol engine</td>
					</tr>

				</tbody>
			</table>
			<hr class="comparison-table__separator mt--10x">
		</div>
	</div>
	<!-- comparison-table -->

	<br>
	<br>

	<!-- special-offer -->
	<span class="special-offer">Special offer</span>
	<!-- /special-offer -->

	<br>
	<br>

	<!-- vehicle-list -->
	<div class="grid__container">
		<ul class="vehicle-list">
			<li class="vehicle-list__item">
				<div class="vehicle-list__images">
					<div class="vehicle-list__wires">
						<img src="../themes/base/images/temp/vehicle-list-wires.svg" alt="">
					</div>
					<div class="vehicle-list__photo">
						<img src="../themes/base/images/temp/vehicle-list-photo.png" alt="">
					</div>
				</div>
				<span class="vehicle-list__name pt--2x">Outlander</span>
			</li>
			<li class="vehicle-list__item">
				<div class="vehicle-list__images">
					<div class="vehicle-list__wires">
						<img src="../themes/base/images/temp/vehicle-list-wires.svg" alt="">
					</div>
					<div class="vehicle-list__photo">
						<img src="../themes/base/images/temp/vehicle-list-photo.png" alt="">
					</div>
				</div>
				<span class="vehicle-list__name pt--2x">Outlander</span>
			</li>
			<li class="vehicle-list__item">
				<div class="vehicle-list__images">
					<div class="vehicle-list__wires">
						<img src="../themes/base/images/temp/vehicle-list-wires.svg" alt="">
					</div>
					<div class="vehicle-list__photo">
						<img src="../themes/base/images/temp/vehicle-list-photo.png" alt="">
					</div>
				</div>
				<span class="vehicle-list__name pt--2x">Outlander</span>
			</li>
		</ul>
	</div>

	<br>
	<br>

	<div class="grid__container">
		<ul class="vehicle-list">
			<li class="vehicle-list__item">
				<div class="vehicle-list__images">
					<div class="vehicle-list__wires">
						<img src="../themes/base/images/temp/vehicle-list-wires.svg" alt="">
					</div>
					<div class="vehicle-list__photo">
						<img src="../themes/base/images/temp/vehicle-list-photo.png" alt="">
					</div>
				</div>
				<span class="vehicle-list__name pt--2x">Outlander</span>
			</li>
			<li class="vehicle-list__item">
				<div class="vehicle-list__images">
					<div class="vehicle-list__wires">
						<img src="../themes/base/images/temp/vehicle-list-wires.svg" alt="">
					</div>
					<div class="vehicle-list__photo">
						<img src="../themes/base/images/temp/vehicle-list-photo.png" alt="">
					</div>
				</div>
				<span class="vehicle-list__name pt--2x">Outlander</span>
			</li>
			<li class="vehicle-list__item vehicle-list__item--active">
				<div class="vehicle-list__images">
					<div class="vehicle-list__wires">
						<img src="../themes/base/images/temp/vehicle-list-wires.svg" alt="">
					</div>
					<div class="vehicle-list__photo">
						<img src="../themes/base/images/temp/vehicle-list-photo.png" alt="">
					</div>
				</div>
				<span class="vehicle-list__name pt--2x">Outlander</span>
			</li>
		</ul>
	</div>
	<!-- /vehicle-list -->

	<br>
	<br>

	<!-- search -->
	<section style="background: white; padding: 100px 0;">
		<div class="grid__container clearfix">

			<div class="search">

				<div class="grid--6 push--3">
					<!-- search input -->
					<div class="search__holder my--10x">
						<input placeholder="[Search items]" class="search__input" type="text">
						<a href="" class="search__button links links--arrow-right">search again</a>
					</div>
					<!-- /search input -->

					<!-- search offset -->
					<div class="search__label color--dark font--bold my--5x">Showing 10 of 24</div>
					<!-- /search offset -->
				</div>

				<div class="grid--10 push--1">
					<!-- search separator -->
					<hr class="gradient-border my--5x">
					<!-- /search separator -->
				</div>

				<div class="grid--6 push--3">
					<!-- search result -->
					<div class="my--5x">
						<h4>Global Mitsubishi</h4>
						<p class="my--4x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
						<span class="search__label color--mid">
							Found in:
							<span class="search__label color--dark">About</span>
						</span>
					</div>
					<!-- /search result -->
				</div>

				<div class="grid--10 push--1">
					<!-- search separator -->
					<hr class="gradient-border my--5x">
					<!-- /search separator -->
				</div>

				<div class="grid--6 push--3">
					<!-- search result -->
					<div class="my--5x">
						<h4>Global Mitsubishi</h4>
						<p class="my--4x">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sagittis velit risus, et aliquet nibh tristique in. Integer odio ex, vehicula vel lobortis mollis, facilisis non felis. Ut scelerisque, mi id venenatis pellentesque, lectus nulla mattis quam, eget pretium purus diam vel enim.</p>
						<span class="search__label color--mid">
							Found in:
							<span class="search__label color--dark">About</span>
						</span>
					</div>
					<!-- /search result -->
				</div>

				<div class="grid--10 push--1">
					<!-- search separator -->
					<hr class="gradient-border my--5x">
					<!-- /search separator -->
				</div>

				<div class="grid--6 push--3">
					<!-- search pagination -->
					<div class="search__pagination">
						<a class="links links--inactive links--arrow-left">prev</a>
						<ul class="filter filter--center">
							<li class="filter__item filter__item--active px--3x py--1x">1</li>
							<li class="filter__item px--3x py--1x">2</li>
							<li class="filter__item px--3x py--1x">3</li>
							<li class="filter__item px--3x py--1x">4</li>
							<li class="filter__item px--3x py--1x">5</li>
							<li class="filter__item px--3x py--1x">6</li>
							<li class="filter__item px--3x py--1x">7</li>
						</ul>
						<a href="" class="links links--arrow-right">next</a>
					</div>
					<!-- /search pagination -->
				</div>

			</div>
		</div>
	</section>
	<!--/ search -->

	<br>
	<br>

	<!-- form -->
	<section style="background: white; padding: 100px 0;">
		<div class="grid__container clearfix relative">
			<form>
				<fieldset>
					<div class="grid--3">
						<div class="form__group">
							<div class="form__input">
								<input type="text" placeholder="First name">
								<label>first name <i></i></label>
							</div>
						</div>
					</div>
					<div class="grid--3">
						<div class="form__group form__group--required">
							<div class="form__input">
								<input type="text" placeholder="First name">
								<label>first name <i></i></label>
							</div>
						</div>
					</div>
					<div class="grid--3">
						<div class="form__group form__group--valid">
							<div class="form__input">
								<input type="text" placeholder="First name">
								<label>first name <i></i></label>
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="grid--6">
						<div class="form__group">
							<div class="form__input">
								<textarea placeholder="Please type here"></textarea>
								<label>What details would you like to update and what would you like them changed to? <i></i></label>
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="grid--2">
						<div class="form__group">
							<div class="form__input">
								<select>
									<option value="" disabled selected>Pick a dealer</option>
									<option value="">Dealer 1</option>
									<option value="">Dealer 2</option>
									<option value="">Dealer 3</option>
								</select>
								<label>closest dealer <i></i></label>
							</div>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="grid--2">
						<div class="form__group">
							<select class="model">
								<option value="">VRX</option>
								<option value="">2.4D 2WD</option>
							</select>
						</div>
					</div>
				</fieldset>
				<fieldset>
					<div class="grid--4">
						<div class="form__group">
							<ul class="form__products">
								<li class="align--vertical mb--3x">
									<div class="form__products__label">
										<div class="form__image mr--2x">
											<img src="../themes/base/images/temp/feature-square.jpg" alt="">
										</div>
										<span class="color--mid font--bold">
											Sports rear spoiler
										</span>
									</div>
									<div class="form__products__action type--right color--mid">
										$ 900
										<i class="icon-times color--brand ml--2x" aria-hidden="true"></i>
									</div>
								</li>
								<li class="align--vertical">
									<div class="form__products__label">
										<div class="form__image mr--2x">
											<img src="../themes/base/images/temp/feature-square.jpg" alt="">
										</div>
										<span class="color--mid font--bold">
											Sports rear spoiler
										</span>
									</div>
									<div class="form__products__action type--right color--mid">
										$ 900
										<i class="icon-times color--brand ml--2x" aria-hidden="true"></i>
									</div>
								</li>
								<li class="align--vertical my--6x">
									<div class="form__products__label">
										<span class="color--mid font--bold">
											Total
										</span>
									</div>
									<div class="form__products__action type--right color--mid font--bold">
										$ 5750
										<i class="icon-times color--brand invisible ml--2x" aria-hidden="true"></i>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</fieldset>
				<div class="grid--3">
					<button class="button button--uppercase">
						<span>send update</span>
					</button>
				</div>
			</form>
		</div>
	</section>
	<!-- /form -->

	<br>
	<br>

	<!-- vehicle-special-offer -->
	<div class="vehicle-special-offer">
		<div class="vehicle-special-offer__wrapper">
			<div class="skewed-tile skewed-tile--content-top skewed-tile--top-up">
				<div class="skewed-tile__wrapper">
					<div class="skewed-tile__container">
						<div class="skewed-tile__background background-halo" style="height: 0; padding-bottom: 35%; background-color: #f15b0a;">
							<div class="vehicle-special-offer__landscape" style="background-image: url(../themes/base/images/temp/cityscape.png);"></div>
						</div>
						<div class="skewed-tile__content">
							<h6>special offer</h6>
							<h5 class="color--light my--4x">Starting from $18,990</h5>
							<a href="" class="button button--model">
								<span style="color: #f36e26;">Explore the Mirage</span>
							</a>
						</div>
					</div>
				</div>
			</div>
			<div class="vehicle-overlap">
				<div class="grid__container">
					<div class="vehicle-overlap__container">
						<img src="../themes/base/images/temp/mirage.png" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>

	<div style="background: white; height: 200px;"></div>
	<!-- /vehicle-special-offer -->

	<br>
	<br>

	<!-- breadcrumb -->
	<section style="background: white; padding: 20px 0;">
		<ul class="breadcrumb">
			<li class="breadcrumb__item">
				<a href="/">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80.7 69.9">
						<path d="M40.4 46.6l13.4 23.3h26.9L67.3 46.6z" class="right"/>
						<path d="M40.4 46.6H13.5L0 69.9h26.9l13.5-23.3z" class="left"/>
						<path d="M40.4 0L26.9 23.3l13.5 23.3 13.4-23.3z" class="top"/>
					</svg>
				</a>
			</li>
			<li class="breadcrumb__item">
				<a href="">Breadcrumb</a>
			</li>
			<li class="breadcrumb__item breadcrumb__item--bold">
				<a href="">Basic form template</a>
			</li>
		</ul>
	</section>
	<!-- /breadcrumb -->

	<br>
	<br>

	<!-- whitespace -->
	<section style="text-align: center;">
		<ul>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--1x">.m--1x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--2x">.m--2x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--3x">.m--3x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--4x">.m--4x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--5x">.m--5x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--6x">.m--6x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--7x">.m--7x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--8x">.m--8x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--9x">.m--9x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="m--10x">.m--10x</li>
		</ul>
	</section>

	<section style="text-align: center;">
		<ul>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--1x">.p--1x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--2x">.p--2x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--3x">.p--3x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--4x">.p--4x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--5x">.p--5x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--6x">.p--6x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--7x">.p--7x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--8x">.p--8x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--9x">.p--9x</li>
			<li style="border: 1px solid grey; background: white; color: black;" class="p--10x">.p--10x</li>
		</ul>
	</section>
	<!-- /whitespace -->

	<br>
	<br>

	<!-- threesixty -->
	<div class="relative" style="width: 600px; height: 338px; margin: 0 auto;">
		<threesixty base-url="../themes/base/images/temp/360/low-res/" :total-images="83" :first-image="20"></threesixty>
	</div>

	<br>
	<br>

	<div class="relative" style="width: 1080px; height: 416px; margin: 0 auto;">
		<threesixty base-url="../themes/base/images/temp/360/triton-clubcab-black/" extension="png" :total-images="125" :first-image="20"></threesixty>
	</div>
	<!-- /threesixty -->

	<br>
	<br>

</section>

