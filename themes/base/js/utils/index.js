/**
 * get the current device breakpoint
 * based on breakpoints.less
 *
 */
exports.getResponsiveTag = function() {
	let tag = window.getComputedStyle(document.body, ':before').getPropertyValue('content');
	tag = tag.split(' ')[0].replace(/"|'/g, '');
	return tag;
};

/**
 * normalize a value
 *
 */
exports.normalize = function(val, max, min) {
	return (val - min) / (max - min);
};

/**
 * currency formatter
 *
 */
exports.currency = function(val) {
	return (val) ? Number(val).toFixed(0).replace(/(\d)(?=(\d{3})+\b)/g, '$1,') : '-';
};
