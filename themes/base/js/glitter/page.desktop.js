'use strict';

module.exports = [
	{
		el: 'js-smooth-page',
		animations: [{
			transform: [
				{
					start: 'in-viewport',
					end: 'out-viewport',
					initialValue: 1,
					finalValue: 2.2,
					transformType: 'scale3d',
					axis: 'y',
					ease: 0.1
				}
			]
		}]
	}
];
