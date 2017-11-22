/**
 * Head
 *
 * This file should only include basic environment setup logic and browser feature tests
 *
 * This should be included before the stylesheet so the browser doesn't need to reflow after adding the feature
 * detect classes from modernizer. Since this goes before the stylesheet this file should be placed inline into the html.
 *
 * Where possible this file should always be minified and obfuscated via `gulp prod`.
 *
 * BEWARE: This file and all dependencies of this file should not exceed 1.5kb or it will slow down every page
 * request as it can't be cached since it's inline and all.
 *
 */
'use strict';

require('./modernizr.js');
