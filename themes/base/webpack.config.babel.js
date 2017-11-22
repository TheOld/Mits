'use strict';

import webpack from 'webpack';
import path from 'path';
import merge from 'webpack-merge';
import ExtractTextPlugin from 'extract-text-webpack-plugin';
import CleanWebpackPlugin from 'clean-webpack-plugin';
import KssWebpackPlugin from 'kss-webpack-plugin';
import { BundleAnalyzerPlugin } from 'webpack-bundle-analyzer';

const DashboardPlugin = require('webpack-dashboard/plugin');
const BabiliPlugin = require('babili-webpack-plugin');

const PATH = (str) => path.resolve(__dirname, str);
let config;

const common = {
	cache: true,
	context: __dirname,
	entry: {
		head: PATH('js/head/index.js'),
		index: [
			PATH('css/style.less'),
			PATH('js/index.js')
		]
	},
	output: {
		path: PATH('build'),
		filename: 'bundle-[name].js',
		chunkFilename: 'bundle-[name].js',
		sourceMapFilename: '[file].map',
		publicPath: '/themes/base/build/'
	},
	performance: {
		maxAssetSize: 250000,
		maxEntrypointSize: 250000
	},
	devServer: {
		// add contentBase if you need to handle a subdomain.
		// For example for z.co.nz/win/ simply add
		// contentBase: '/win/' to serve the content
		// from there.
		// display errors in a webpage overlay
		overlay: true,
		// gzip everything produced by Webpack
		compress: true,
		// serve over https
		https: true,
		// allow Cross Origin Request
		headers: {
			'Access-Control-Allow-Origin': '*'
		},
		// redirect every static assets to the
		// silverstripe instance
		proxy: {
			'/themes': {
				target: {
					// replace this with project
					// host name (eg: zwin.dev)
					host: '',
					// can be changed to handle
					// non-secure website.
					protocol: 'https:',
					port: 443
				},
				secure: false
			}
		}
	},
	module: {
		loaders: [
			{
				test: /\.vue$/,
				loader: 'vue-loader',
				options: {
					// vue-loader options
				}
			},
			{
				test: /\.js$|\.jsx$/,
				use: 'babel-loader',
				include: PATH('js'),
				exclude: /node_modules/
			},
			{
				test: /\.(jpg|png|woff|woff2|eot|ttf|svg)(\?v=[0-9]\.[0-9]\.[0-9])?$/,
				use: 'url-loader'
			},
			{
				test: /\.less$/,
				use: ExtractTextPlugin.extract({
					fallback: 'style-loader',
					use: [
						{
							loader: 'css-loader',
							options: {
								sourceMap: true
							}
						},
						{
							loader: 'postcss-loader',
							options: {
								sourceMap: true,
								plugins: (loader) => [
									require('autoprefixer')(
										{ browsers: ['last 2 versions'] }
									)
								]
							}
						},
						{
							loader: 'less-loader',
							options: {
								sourceMap: true
							}
						}
					]
				}),
				exclude: /node_modules/
			},
			{
				test: /\.(graphql|gql)$/,
				loader: 'raw-loader'
			}
		]
	},
	resolve: {
		alias: {
			'vue$': 'vue/dist/vue.esm.js',
			'@js': PATH('js'),
			'@graphql': PATH('graphql'),
			'@styles': PATH('css')
		}
	},
	plugins: [
		new webpack.NoEmitOnErrorsPlugin(),
		new ExtractTextPlugin({
			filename: 'bundle-style.css',
			disable: false,
			allChunks: true
		}),
		new CleanWebpackPlugin('build', {
			root: process.cwd()
		})
	]
};

switch (process.env.npm_lifecycle_event) {
	case 'prod':
		config = merge(common, {
			entry: {
				vendor: [
					'vue',
					'vuex',
					'barba.js',
					'graphql-client'
				]
			},
			module: {
				loaders: [
					{
						test: /\.js$|\.jsx$/,
						enforce: 'pre',
						use: 'eslint-loader',
						include: PATH('js'),
						exclude: [/node_modules/, PATH('js/head')]
					}
				]
			},
			plugins: [
				// new BabiliPlugin({
				// 	removeDebugger: true
				// }, {
				// 	comments: false
				// }),
				new webpack.DefinePlugin({
					'process.env': {'NODE_ENV': JSON.stringify('production')} }
				),
				new webpack.LoaderOptionsPlugin({
					minimize: true,
					debug: false
				}),
				new webpack.optimize.CommonsChunkPlugin({
					name: ['vendor', 'head']
				}),
				new webpack.optimize.UglifyJsPlugin({
					output: {
						comments: false
					},
					compress: {
						drop_console: true,
						warnings: false
					},
					sourceMap: false
				}),
				// new webpack.optimize.AggressiveMergingPlugin(),
				new webpack.optimize.ModuleConcatenationPlugin(),
				new BundleAnalyzerPlugin()
			]
		});
		break;
	case 'styleguide':
		config = merge(common, {
			plugins: [
				new KssWebpackPlugin({
					source: ['css', 'js'],
					builder: 'kss',
					title: 'Style guide',
					homepage: 'README.md',
					css: ['../kss/css/style.css', '../kss/css/kss.css', '../build/bundle-style.css'],
					js: ['../build/bundle-index.js']
				})
			]
		});
		break;
	default:
		config = merge(common, {
			entry: {
				vendor: [
					'vue',
					'vuex',
					'barba.js'
				]
			},
			plugins: [
				new webpack.optimize.CommonsChunkPlugin({
					name: ['vendor', 'head']
				}),
				new DashboardPlugin()
			],
			devtool: 'source-map'
		});
}

export default config;
