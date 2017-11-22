import select from 'dom-select';
import dataset from 'dataset';
import { getResponsiveTag } from '@js/utils';

function glitterFactory(smoothInstance) {
	const container = select('.barba-container [data-section]');

	if (container) {
		const section = dataset(container, 'section');

		// no data-section specified on the page
		// do nothing (but you should be ashamed)
		if (!section) return;

		// get current device used and load
		// [glitter].[target].js
		const target = getResponsiveTag();

		return import(
			/* webpackChunkName: "transitions/[request]" */
			`./${section}.${target}`
		).then((glitter) => {
			// display useful information about the loaded glitter
			console.log(`%c Lazy load glitter: ${section}.${target} `, 'background: #3C3B3F; color: #bada55; padding: 5px 0');

			// instanciate smooth scroll instance
			smoothInstance.init();
			smoothInstance.addElements(JSON.parse(JSON.stringify(glitter)));
			smoothInstance.start();
		}).catch((err) => {
			console.log(`%c Lazy load glitter error \n\n`, 'background: #3C3B3F; color: #f05053; padding: 5px 0', err);
		});
	} else {
		console.warn('if you want to add special glitter effect to that page you need to wrap the content with a tag containing a data-section attribute');
	}
}

export { glitterFactory };
