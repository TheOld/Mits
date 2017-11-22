import some from 'lodash/some';
import { mapGetters } from 'vuex';

/*
 *  ==== ManageAccessories ====
 */

export default {
	computed: {
		...mapGetters({
			accessories: 'accessories'
		})
	},
	methods: {
		toggleAccessory(id, name, rrp) {
			const exist = some(this.accessories, { id: id });
			if (exist) this.$store.dispatch('removeAccessory', { id: id });
			else this.$store.dispatch('addAccessory', { id: id, name: name, rrp: rrp });
		},
		isSelectedAccessory(id) {
			return some(this.accessories, { id: id });
		}
	}
};
