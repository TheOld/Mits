/**
 * Handle form validation
 *
 */

import { AjaxForm } from '@heyday/ajax-form';

var FormHandler = {
	init: (form) => {
		console.log('init form management with', form, AjaxForm);
		const ajaxForm = new AjaxForm(form, {
			button: {
				labelSubmit: 'Processing...'
			},
			success: {
				template: '<p class="type--center color--dark">{{message}}</p>'
			},
			error: {
				template: '<p class="type--center color--brand">{{message}}</p>'
			},
			scrollToError: {
				active: true,
				speed: 250,
				offset: 140,
				easing: 'easeOutQuad'
			}
		});
		ajaxForm.render();
	}
};

module.exports = FormHandler;
