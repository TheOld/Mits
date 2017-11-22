# Standard Interface Build
> NOTE: This file structure can be pulled from the base theme directory for other projects, but the basic file structure should remain the same.

___

### Build

The build system for all projects is webpack. Both production and source files compile to the same folder within the themes directory `/build/`
What this means is that you don't need to define different paths in your template to delegate your source and production build to, because they both build to the same file.

###### Watch (development)
To build your development files and run a **watch** task over the theme source files, run this from the root theme directory:

```sh
$ yarn start
```
> NOTE: Remember to cancel your watch task when committing or pulling changes.

###### Build (production)
To build your production files, run this from the root theme directory:

```sh
$ yarn run prod
```

### Modernizr
A default Modernizr config is `modernizr-config.json`. Add any additional tests to the *feature-detects* array in this file (or browse to the url in the `modernizr.js` file and add your tests from the Modernizr Download Builder). Then run the following command from the theme directory:

```sh
$ modernizr -c modernizr-config.json -d js/head/
```

### Dependencies

Yarn is now the package manager of choice, it acts in a very similar way to npm, however also produces a `yarn.lock` file from the `package.json` which locks the package versions down to a specific release. This is intended to solve issues of npm installing slightly different package versions, and based on the sheer amount of dependencies one package can have, this can be a complete nightmare. Yarn banishes this nightmare.

Please check out the documentation for further information:
https://yarnpkg.com/en/docs/usage

Some npm to yarn comparisons:

```sh
npm run prod 												-> 		yarn run prod
npm install													->		yarn install
npm install --save [package]				->		yarn add [package]
npm install --save-dev [package]		->		yarn add [package] --dev
npm uninstall --save [package]			->		yarn remove [package]
npm uninstall --save-dev [package]	->		yarn remove [package]
```

___

### CSS

> NOTE: While making global changes within core is recommended, each new css module requires its own file within `/css/modules/`.
Individual JS components ideally should have a css file imported to the component .js file. Webpack will extract the css and include it in the outputted bundle styles automatically.

```sh
js/
	components/
		ActionButton/
			ActionButton.js
			actionButton.less
```

> WARNING: It is **essential** to run a build task *before* deploying to a live environment, as `live` and `dev` environments both read the same file.

___

### Styleguide (KSS: Knyle Style Sheets )

To generate your styleguide, run this from the root theme directory:

```sh
yarn run styleguide
```

Please check out the documentation for further information:
http://warpspire.com/kss/


### Dependencies

This project uses the following framework and libraries:
- [Vue.js](https://vuejs.org/) as the main framework
- [Vuex](https://github.com/vuejs/vuex) as a centralized state management
- [Barba](http://barbajs.org/) for PJAX support
- [Apollo](http://dev.apollodata.com/) as a graphQL client
- [Cypress](https://www.cypress.io/) as a e2e tool
- [LESS](http://lesscss.org/) as CSS preprocessor

## Project structure

This uses a couple of specific jargon that might need some clarifications:

**`/pages`**
Page to page transitions (powered by [Barba.js](http://barbajs.org/)). At the moment there is only one transitions used (`default.js`) which is just a cross-fade. As there is no use for multiple transitions support the logic for multiple transitions has not been implemented yet (your time to shine).

**`/transitions`**
Internal transitions used by the Vue component. This leverage the power of [vue transitions](https://vuejs.org/v2/guide/transitions.html) using functional components.
If you want to use one of the available transitions, simply wrap your html structure with the transition tag name:
```html
<slide-fade-transition>
	<!-- more html -->
</slide-fade-transition>
```



**`/mixins`**
Extracted functional behaviour shared accross components. You can use a mixin in any components by including it like so:

```js
import EnterViewportMixin from '@js/mixins/EnterViewport';

export default {
	name: 'my-kick-ass-component',
	mixins: [EnterViewportMixin],
	...
}
```



**`/form`**

Extracted form management. This is just a layer on top of the Silverstripe form using our [in-house form management module](https://git.heyday.net.nz/heyday/ajax-form). If this is removed the form keep workink as expected they will not have the extra level of Javascript fancyness (ajax validation, no hard reload...).




**`/glitter`**
This is the extra layer of goodness responsible of scroll magic, paralax and other joys. This will not be bundled with the main javascript package but lazy loaded on the fly based on the page the user is curently in.
You can add any available glitter config (or even create your own) by adding an extra data attribtues to your page template structure:

```html
<section data-section="make-it-rain">
</section>
```

This will, once again, lazy load (❤️ Webpack) the glitter config `/js/glitter/make-it-rain.[device].js`. Yep, you can define different glitter rainfall depending of the device by simply creating the dedicated files `make-it-rain.desktop.js`, `make-it-rain.tablet.js` or `make-it-rain.mobile.js`.

With that you have no excuse not to add the extra level of pimp to any (new) pages.



### GraphQL

All the ajax requests are made using GraphQL. For a better clarity all the external requests used for the site are store in a specific folder located in `/graphql`.

For a better separation of concerns the only place where these graphql queries are loaded is in the store (`/js/store`). A dedicated webpack loader is included allowing to require the graphql like any other dependencies:

```js
import DEALERS_QUERY from '@graphql/dealers.graphql';
```

Note that the `@graphql` variables is a simple webpack alias (see [webpack.config.babel.js](./webpack.config.babel.js))

### e2e testing

The project implements some end to end testing using [cypress](https://www.cypress.io/).
