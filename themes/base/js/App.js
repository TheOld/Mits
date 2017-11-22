import Vue from 'vue';
import VueSticky from 'vue-sticky';
import Scrollactive from 'vue-scrollactive';
import EventHub from '@js/core/emitter';
import store from '@js/store';

// app dependencies
import { mapGetters } from 'vuex';
import { getResponsiveTag, currency } from '@js/utils';
import { headroom } from 'vue-headroom';
import debounce from 'lodash/debounce';
import select from 'dom-select';
import dataset from 'dataset';

// import component (bundled in bundle-index.js file)
import Loader from '@js/components/Loader/Loader.vue';
import Lazyimage from '@js/components/Lazyimage/Lazyimage.vue';
import Threesixty from '@js/components/Threesixty/Threesixty.vue';
import Graphql from '@js/components/Graphql/Graphql.vue';
import TabbedTiles from '@js/components/TabbedTiles/TabbedTiles.vue';
import Accordion from '@js/components/Accordion/Accordion.vue';
import Carousel from '@js/components/Carousel/Carousel.vue';
import DealerSearch from '@js/components/DealerSearch/DealerSearch.vue';
import CombinedFilters from '@js/components/Filters/Combined.vue';
import Filters from '@js/components/Filters/Filters.vue';

// mixins
import ActivateModal from '@js/mixins/ActivateModal';
import ManageAccessories from '@js/mixins/ManageAccessories';
import BindEscapeKey from '@js/mixins/BindEscapeKey';

// import async components (requested on the fly, in that case a separated bundle-async.js)
const StoreLocator = () => import('@js/components/StoreLocator/StoreLocator.vue'/* webpackChunkName: "maps" */);
const Cart = () => import('@js/components/Cart/Cart.vue'/* webpackChunkName: "cart" */);
const Modal = () => import('@js/components/Modal/Modal.vue'/* webpackChunkName: "modal" */);
const VideoPlayer = () => import('@js/components/VideoPlayer/VideoPlayer.vue'/* webpackChunkName: "video" */);
const Search = () => import('@js/components/Search/Search.vue'/* webpackChunkName: "search" */);
const SearchInput = () => import('@js/components/Search/SearchInput.vue'/* webpackChunkName: "search" */);

const HeaderMobile = () => import('@js/components/Header/mobile/Header.vue'/* webpackChunkName: "header/mobile" */);
const HeaderDesktop = () => import('@js/components/Header/desktop/Header.vue'/* webpackChunkName: "header/desktop" */);

const Builder = () => import('@js/components/Builder/Builder.vue'/* webpackChunkName: "builder/builder" */);
const BackgroundImage = () => import('@js/components/Backgrounds/Image.vue'/* webpackChunkName: "backgrounds/image" */);
const BackgroundTitle = () => import('@js/components/Backgrounds/Title.vue'/* webpackChunkName: "backgrounds/title" */);

const Counter = () => import('@js/components/Counter/counter.vue'/* webpackChunkName: "counter/counter" */);

// component registration for global use
// (don't need to import the component again inside sub-component)
Vue.component('video-player', VideoPlayer);
Vue.component('accordion', Accordion);
Vue.component('loader', Loader);
Vue.component('lazyimage', Lazyimage);
Vue.component('headroom', headroom);
Vue.component('combined-filters', CombinedFilters);
Vue.component('filters', Filters);
Vue.component('modal', Modal);
Vue.component('threesixty', Threesixty);
Vue.component('background-image', BackgroundImage);
Vue.component('background-title', BackgroundTitle);
Vue.component('search-input', SearchInput);
Vue.component('counter', Counter);

// global filter
Vue.filter('currency', currency);

// global directives
Vue.directive('sticky', VueSticky);

// global mixins
Vue.mixin(ActivateModal);
Vue.mixin(ManageAccessories);
Vue.mixin(BindEscapeKey);

// directives
Vue.use(Scrollactive);

// generic transitions functional component
require('@js/transitions');

// Expose a getter for $bus
Object.defineProperties(Vue.prototype, {
	$bus: {
		get: function() {
			return EventHub;
		}
	}
});

// main Vue instance
class App {
	constructor(cb) {
		this.init(cb);
	}
	init(cb) {
		this.app = new Vue({ // eslint-disable-line no-new
			name: 'app',
			el: '#app',
			store,
			components: {
				HeaderMobile,
				HeaderDesktop,
				Lazyimage,
				Graphql,
				StoreLocator,
				TabbedTiles,
				Accordion,
				Carousel,
				Cart,
				VideoPlayer,
				DealerSearch,
				Builder,
				Search
			},
			computed: {
				...mapGetters({
					device: 'device',
					displaySearch: 'displaySearch'
				})
			},
			mounted() {
				console.log('Root ready.');
				// once app is ready call the callback function
				// that will hide the spinner (avoid any flickering between views)
				this.$nextTick(cb);
			},
			methods: {
				onResize() {
					this.$store.dispatch('saveSize', {
						width: window.innerWidth,
						height: window.innerHeight,
						device: getResponsiveTag()
					});
					this.$bus.$emit('SITE_RESIZE');
				},
				getHeaderOpacity() {
					const container = select('.barba-container [data-header]');
					let isOpaque = false;
					if (container) {
						const header = dataset(container, 'header');
						if (header) isOpaque = true;
					}
					this.$store.dispatch('saveHeaderOpacity', isOpaque);
				}
			},
			created() {
				this.onResize();
				this.getHeaderOpacity();
				this.resize = debounce(this.onResize, 500);
				window.addEventListener('resize', this.resize, false);
			},
			beforeDestroy() {
				window.removeEventListener('resize', this.resize, false);
			}
		});
	}
	destroy() {
		this.app.$destroy();
	}
	reload(cb) {
		this.init(cb);
	}
}

module.exports = App;
