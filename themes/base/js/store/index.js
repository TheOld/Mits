import Vue from 'vue';
import Vuex from 'vuex';
import * as actions from './actions';

// module imports
import app from './modules/app';
import navigation from './modules/navigation';
import dealers from './modules/dealers';
import builder from './modules/builder';
import search from './modules/search';
import comparator from './modules/comparator';

Vue.use(Vuex);

export default new Vuex.Store({
	actions,
	modules: {
		app,
		navigation,
		dealers,
		builder,
		search,
		comparator
	}
});
