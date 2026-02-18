/**
 * G2F Functionality - Webpack Configuration
 *
 * @package G2F_Functionality
 */

const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

module.exports = {
	...defaultConfig,
	entry: {
		'project-grid': path.resolve(__dirname, 'includes/blocks/project-grid/index.js'),
		'testimonial-slider': path.resolve(__dirname, 'includes/blocks/testimonial-slider/index.js'),
		'client-marquee': path.resolve(__dirname, 'includes/blocks/client-marquee/index.js'),
	},
	output: {
		...defaultConfig.output,
		path: path.resolve(__dirname, 'build'),
	},
};
