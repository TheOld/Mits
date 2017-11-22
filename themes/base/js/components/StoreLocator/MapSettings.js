/*global google */

import Vue from 'vue';
import { loaded } from 'vue2-google-maps';

var settings = new Vue({
	data: {
		defaultMapOptions: {
			styles: require('./style.json'),
			zoomControl: true,
			streetViewControl: false,
			fullscreenControl: false,
			mapTypeControl: false,
			clickableIcons: true
		},
		dealerIconSeller: {
			url: '../themes/base/images/temp/dealer-seller-icon.png',
			size: null,
			scaledSize: null
		},
		dealerIconService: {
			url: '../themes/base/images/temp/dealer-service-icon.png',
			size: null,
			scaledSize: null
		},
		defaultClusterSettings: [
			{
				textColor: 'white',
				url: '../themes/base/images/svg/dealer-cluster.svg',
				height: 30,
				width: 30,
				textSize: 14
			},
			{
				textColor: 'white',
				url: '../themes/base/images/svg/dealer-cluster.svg',
				height: 50,
				width: 50,
				textSize: 14
			},
			{
				textColor: 'white',
				url: '../themes/base/images/svg/dealer-cluster.svg',
				height: 70,
				width: 70,
				textSize: 14
			}
		],
		init: null
	}
});

export default settings;

loaded.then(() => {
	// now we can use google.maps.*
	settings.dealerIconSeller.size = settings.dealerIconService.size = new google.maps.Size(32, 43);
	settings.dealerIconSeller.scaledSize = settings.dealerIconService.scaledSize = new google.maps.Size(32, 43);

	if (typeof settings.init === 'function') settings.init();
});
