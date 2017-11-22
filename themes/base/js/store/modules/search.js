// mutation type
import * as types from '../mutation-types';

// initial state
const state = {
	display: false,
	query: null
};

// getters
const getters = {
	displaySearch: state => state.display,
	querySearch: state => state.query
};

// actions
const actions = {
};

// mutations
const mutations = {
	[types.TOGGLE_SEARCH](state) {
		state.display = !state.display;
	},
	[types.OPEN_SEARCH](state) {
		state.display = true;
	},
	[types.CLOSE_SEARCH](state) {
		state.display = false;
	},
	[types.SAVE_SEARCH](state, payload) {
		state.query = payload;
	}
};

export default {
	state,
	getters,
	actions,
	mutations
};
