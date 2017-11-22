'use strict';

// libraries
import Barba from 'barba.js';
import NProgress from 'nprogress';
import select from 'dom-select';
import dataset from 'dataset';

// component
import App from './App';
import { pageTransitionFactory } from './pages';
import { glitterFactory } from './glitter';
import { formHandler } from './form';
import Smooth from '@js/utils/scroll';

// polyfill
require('es6-promise').polyfill();

window.addEventListener('DOMContentLoaded', function() {
	console.log('DOMContentLoaded');

	// init loader
	NProgress.start();

	// this create a vue app instance
	const app = new App(() => {
		NProgress.done();
	});
	const smooth = new Smooth({ smoothContainer: false });

	// get glitter for that page
	glitterFactory(smooth);
	// handle form if any on the page
	formHandler();

	// start pjax
	Barba.Pjax.start();

	Barba.Dispatcher.on('linkClicked', (e) => {
		// override barba transition if needed
		// based on current page
		Barba.Pjax.getTransition = function() {
			const container = select('.barba-container');
			const section = dataset(container, 'section');

			return pageTransitionFactory(section);
		};
		// start progress bar
		NProgress.start();
	});

	Barba.Dispatcher.on('initStateChange', () => {
		console.log('initStateChange');
		NProgress.inc();
		smooth.destroy();
		app.destroy();
		window.element = null;
	});

	Barba.Dispatcher.on('newPageReady', (currentStatus, oldStatus, container) => {
		window.scroll(0, 0);
		NProgress.inc();
	});

	Barba.Dispatcher.on('transitionCompleted', () => {
		console.log('transitionCompleted');
		// re-create vue instance when dom has changed
		// when new vue has been parsed hide the progress bar
		app.reload(() => {
			// update progress bar to the end
			NProgress.done();
		});

		// apply glitter on the page (based on the data-section attribute)
		glitterFactory(smooth);
		formHandler();
	});
});
