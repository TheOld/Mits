'use strict';

module.exports = [
	{
		el: 'js-title',
		animations: [
			{
				transform: [
					{
						start: 'in-viewport',
						end: 'out-viewport',
						initialValue: 0,
						finalValue: 100,
						transformType: 'translate3d',
						axis: 'y',
						ease: 0.1
					}
				]
			},
			{
				start: 'in-viewport',
				end: 'out-viewport',
				initialValue: 1,
				finalValue: 0,
				property: 'opacity',
				ease: 0.1,
				viewFactorStart: 1,
				viewFactorEnd: 0.6
			}
		]
	},
	{
		el: 'js-tile-slow',
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
	},
	{
		el: 'js-tile-fast',
		animations: [
			{
				transform: [
					{
						start: 'in-viewport',
						end: 'out-viewport',
						initialValue: 0,
						finalValue: -500,
						transformType: 'translate3d',
						axis: 'y',
						ease: 0.5
					}
				]
			}
		]
	},
	{
		el: 'js-scale',
		animations: [
			{
				transform: [
					{
						start: 'in-viewport',
						end: 'out-viewport',
						initialValue: 0.9,
						finalValue: 0.6,
						transformType: 'scale3d',
						axis: 'x',
						ease: 0.1,
						viewFactorStart: 1,
						viewFactorEnd: 0.8
					},
					{
						start: 'in-viewport',
						end: 'out-viewport',
						initialValue: 0.9,
						finalValue: 0.6,
						transformType: 'scale3d',
						axis: 'y',
						ease: 0.1,
						viewFactorStart: 1,
						viewFactorEnd: 0.8
					}
				]
			}
		]
	}
];
