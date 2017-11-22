// default.js is the page transition applied by default.
// a new transition for specific page can be added simply
// by adding a `data-section` attribute to the desired page.
import DefaultTransition from './default';

// TODO: handle custom transition (only defaut is used for now).
export function pageTransitionFactory(section) {
	switch (section) {
		default:
			return DefaultTransition;
	}
}
