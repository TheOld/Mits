const store = require('store2');

export const fetch = (name) => {
	try {
		const state = store.get(name);
		if (state === null) {
			return undefined;
		}
		return state;
	} catch (err) {
		return undefined;
	}
};

export const save = (name, state) => {
	try {
		store.set(name, state);
	} catch (err) {
		console.error(`Something went wrong: ${err}`);
	}
};
