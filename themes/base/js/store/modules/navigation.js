// import apollo client
import { graphqlClient } from '@js/graphql.js';

// the graphql query
import NAVIGATION_QUERY from '@graphql/navigation.graphql';

// mutation type
import * as types from '../mutation-types';

// initial state
const state = {
	all: null
};

// getters
const getters = {
	navigation: state => state.all
};

// actions
const actions = {
	getMenus({ commit }) {
		graphqlClient.query(NAVIGATION_QUERY)
		.then((payload) => {
			commit(types.SET_MENUS, payload.data.getMenus);
		});
	}
};

// mutations
const mutations = {
	[types.SET_MENUS](state, menus) {
		state.all = menus;
	}
};

export default {
	state,
	getters,
	actions,
	mutations
};
