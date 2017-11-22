/**
 * Give some styling love to console.log
 *
 */
const styles = {
	'green': 'background: #3C3B3F; color: #8ABEB7; padding: 5px; font-weight: bold;',
	'orange': 'background: #3C3B3F; color: #DE935F; padding: 5px; font-weight: bold;',
	'red': 'background: #3C3B3F; color: #CC6666; padding: 5px; font-weight: bold;'
};

/**
 * Give some styling love to console.log
 *
 */
exports.log = (type, message) => {
	console.log(message);
	switch (type) {
		case 'error':
			console.log(`%c${message}`, styles.red);
			break;
		case 'warning':
			console.log(`%c${message}`, styles.orange);
			break;
		case 'success':
			console.log(`%c${message}`, styles.green);
			break;
		default:
			console.log(message);
			break;
	}
};
