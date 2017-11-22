'use strict';

module.exports = [
	{
		el: 'js-tile',
		animations: [
			{
				transform: [
					{
						start: 'in-viewport',
						end: 'out-viewport',
						initialValue: 0,
						finalValue: -200,
						transformType: 'translate3d',
						axis: 'y',
						ease: 0.2
					}
				]
			}
		]
	}
];
