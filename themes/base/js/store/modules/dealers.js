// import apollo client
import groupBy from 'lodash/groupBy';
import { findLimitedClosest } from '@js/utils/maps';
import { graphqlClient } from '@js/graphql.js';

// mutation type
import * as types from '../mutation-types';

// the graphql query
import DEALERS_QUERY from '@graphql/dealers.graphql';

// initial state
const state = {
	all: null,
	dealers: null,
	grouped: null,
	processing: true,
	query: null
};

// getters
const getters = {
	dealers: state => state.dealers,
	grouped: state => groupBy(state.dealers, 'location'),
	processing: state => state.processing,
	query: state => state.query
};

// actions
const actions = {
	getDealers({ commit }) {
		graphqlClient.query(DEALERS_QUERY)
		.then((payload) => {
			const dealers = JSON.parse(JSON.stringify(payload.data.getDealers));
			commit(types.SET_DEALERS, dealers);
		});
	},

	filterDealers({ commit }, query) {
		commit(types.FILTER_DEALERS, query);
	}
};

// mutations
const mutations = {
	[types.SET_DEALERS](state, dealers) {
		// the data coming from the backend are not using
		// lat/long coordinate as a number, need extra casting
		dealers.map((dealer) => {
			dealer.position = {};
			dealer.position.lat = parseFloat(dealer.locationY);
			dealer.position.lng = parseFloat(dealer.locationX);
		});

		// store the output to the store
		state.dealers = state.all = dealers;

		state.processing = false;
	},

	[types.FILTER_DEALERS](state, query) {
		state.processing = true;
		state.query = query;

		// if no query are passed return the full list of dealer
		if (!query) {
			state.dealers = state.all;
			state.query = null;
			state.processing = false;
			return;
		}

		// if a query exist, create the corresponding location
		// using google geocoder (restricted in New Zealand)
		const geocoder = new google.maps.Geocoder();
		const request = {
			'address': query,
			componentRestrictions: {
				country: 'NZ'
			}
		};
		// start geocoder
		geocoder.geocode(request, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				// compute distances and return a custom numbr of the closest ones
				const closest = findLimitedClosest(results[0].geometry.location, state.all, 3);
				// update store (will trigger component update)
				state.dealers = closest;
				state.processing = false;
			} else {
				state.dealers = state.all;
				console.log('Geocode was not successful for the following reason: ', status);
			}
		});
	}
};

export default {
	state,
	getters,
	actions,
	mutations
};
