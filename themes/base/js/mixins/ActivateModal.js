/*
 *  ==== ActivateModal ====
 */

export default {
	methods: {
		showModal(name, data) {
			this.$refs[name].$set(this.$refs[name]._data, 'content', data);
			this.$refs[name].show = true;
		}
	}
};
