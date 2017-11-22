import Vue from 'vue/dist/vue.js';
import Hello from './Hello.vue';

describe('Hello.vue', () => {
	it('should render correct contents', async () => {
		const hello = await createVm();

		expect(hello.$el.querySelector('.hello h1').textContent)
			.toBe('Hello');
	});
});

async function createVm() {
	const vm = new Vue({
		el: document.createElement('div'),
		render: (h) => h(Hello)
	});

	await Vue.nextTick();

	return vm.$children[0];
}
