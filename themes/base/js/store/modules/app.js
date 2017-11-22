// mutation type
import * as types from '../mutation-types';

// initial state
const state = {
	width: 0,
	height: 0,
	device: null,
	opaqueHeader: null
};

// getters
const getters = {
	width: state => state.width,
	height: state => state.height,
	counter: state => state.counter,
	device: state => state.device,
	opaqueHeader: state => state.opaqueHeader
};

// actions
const actions = {
};

// mutations
const mutations = {
	[types.RESIZE](state, payload) {
		state.width = payload.width;
		state.height = payload.height;
		state.device = payload.device;
	},
	[types.SET_HEADER_OPACITY](state, payload) {
		state.opaqueHeader = payload;
	}
};

export default {
	state,
	getters,
	actions,
	mutations
};
