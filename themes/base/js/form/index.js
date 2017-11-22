import select from 'dom-select';

function formHandler() {
	const container = select('.barba-container [data-form]');

	if (container) {
		return import(
			/* webpackChunkName: "form/form-handler" */
			'./form-handler'
		).then((formHandler) => {
			// display useful information about the loaded glitter
			console.log(`%c Form detected on the page, lazy load form handler`, 'background: #3C3B3F; color: #bada55; padding: 5px 0');
			formHandler.init(container);
		}).catch((err) => {
			console.log(`%c Lazy load form error \n\n`, 'background: #3C3B3F; color: #f05053; padding: 5px 0', err);
		});
	}
}

export { formHandler };
