'use strict';

module.exports = [
	{
		el: 'js-smooth-component',
		animations: [{
			transform: [
				{
					start: 'in-viewport',
					end: 'out-viewport',
					initialValue: 1,
					finalValue: 1.5,
					transformType: 'scale3d',
					axis: 'x',
					ease: 0.1
				},
				{
					start: 'in-viewport',
					end: 'out-viewport',
					initialValue: 1,
					finalValue: 1.5,
					transformType: 'scale3d',
					axis: 'y',
					ease: 0.1
				}
			]
		}]
	}
];
