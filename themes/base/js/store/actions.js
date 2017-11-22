import * as types from './mutation-types';

// app methods
export const saveSize = ({ commit }, size) => {
	commit(types.RESIZE, size);
};

export const saveHeaderOpacity = ({ commit }, isOpaque) => {
	commit(types.SET_HEADER_OPACITY, isOpaque);
};

// builder methods
export const updateTotal = ({ commit }) => {
	commit(types.UPDATE_TOTAL);
};

export const saveBuilderVehicle = ({ commit }, vehicle) => {
	commit(types.SET_BUILDER_VEHICLE, vehicle);
	commit(types.UPDATE_TOTAL, vehicle.rrp);
};

export const saveBuilderModelSlug = ({ commit }, model) => {
	commit(types.SET_BUILDER_MODEL_SLUG, model);
	commit(types.UPDATE_TOTAL, model.rrp);
};

export const saveBuilderModelDetails = ({ commit }, model) => {
	commit(types.SET_BUILDER_MODEL_DETAILS, model);
};

// accessories methods
export const addAccessory = ({ commit }, accessory) => {
	commit(types.ADD_ACCESSORY, accessory);
	commit(types.UPDATE_TOTAL);
};

export const removeAccessory = ({ commit }, accessory) => {
	commit(types.REMOVE_ACCESSORY, accessory);
	commit(types.UPDATE_TOTAL);
};

export const resetAccessory = ({ commit }) => {
	commit(types.RESET_ACCESSORY);
	commit(types.UPDATE_TOTAL);
};

// search
export const toggleSearch = ({ commit }) => {
	commit(types.TOGGLE_SEARCH);
};

export const openSearch = ({ commit }) => {
	commit(types.OPEN_SEARCH);
};

export const closeSearch = ({ commit }) => {
	commit(types.CLOSE_SEARCH);
};

export const saveSearchQuery = ({ commit }, query) => {
	commit(types.SAVE_SEARCH, query);
};

// comparator methods
