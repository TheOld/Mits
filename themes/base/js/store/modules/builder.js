// mutation type
import * as types from '../mutation-types';
import sumBy from 'lodash/sumBy';
import { color, lightness } from 'kewler';

// persistance layer
import { fetch, save } from '../localstorage';

// define vehicle model object structure
const VehicleModel = {
	name: null,
	colour: '#595959',
	background: null,
	clearcut: null,
	theme: 'dark',
	slug: null,
	threesixty: {}
};

// initial state
const state = {
	total: fetch('total') || 0,
	vehicle: fetch('vehicle') || {
		id: null,
		name: null,
		lifestyleImage: null,
		colour: '#ffffff',
		theme: 'dark',
		lowestRRP: null,
		slug: null,
		threesixty: {}
	},
	model: fetch('model') || VehicleModel,
	accessories: fetch('accessories') || []
};

// getters
const getters = {
	total: state => state.total,
	vehicle: state => state.vehicle,
	model: state => state.model,
	accessories: state => state.accessories
};

// actions
const actions = {
};

// mutations
const mutations = {
	[types.UPDATE_TOTAL](state, payload) {
		if (state.model.rrp) state.total = ~~state.model.rrp;
		else state.total = ~~state.vehicle.rrp;

		if (state.accessories.length) state.total += sumBy(state.accessories, (accessory) => { return ~~accessory.rrp; });

		save('total', state.total);
	},
	[types.SET_BUILDER_VEHICLE](state, payload) {
		state.model = VehicleModel;
		state.vehicle = payload.vehicle;
		state.accessories = [];
		save('vehicle', state.vehicle);
	},
	[types.SET_BUILDER_MODEL_SLUG](state, model) {
		state.model.slug = model.slug;
		state.model.rrp = model.rrp;
		state.model.name = model.name;
		save('model', state.model);
	},
	[types.SET_BUILDER_MODEL_DETAILS](state, payload) {
		state.model = payload;
		state.model.background = color(payload.colour, lightness(15));
		save('model', state.model);
	},
	[types.ADD_ACCESSORY](state, payload) {
		if (!state.accessories) state.accesories = [];
		state.accessories.push(payload);
		save('accessories', state.accessories);
	},
	[types.REMOVE_ACCESSORY](state, payload) {
		state.accessories = state.accessories.filter(function(accesory) {
			return accesory.id !== payload.id;
		});
		save('accessories', state.accessories);
	},
	[types.RESET_ACCESSORY](state, payload) {
		state.accessories = [];
		save('accessories', state.accessories);
	}
};

export default {
	state,
	getters,
	actions,
	mutations
};
