import Vue from 'vue';

// load transitions
import SlideSkewTransition from '@js/transitions/slide-skew-transition';
import SlideScaleTransition from '@js/transitions/slide-scale-transition';
import SlideFadeTransition from '@js/transitions/slide-fade-transition';
import FadeTransition from '@js/transitions/fade-transition';

// available globally
Vue.component('slide-skew-transition', SlideSkewTransition);
Vue.component('slide-scale-transition', SlideScaleTransition);
Vue.component('slide-fade-transition', SlideFadeTransition);
Vue.component('fade-transition', FadeTransition);
