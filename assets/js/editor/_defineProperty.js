/* eslint-disable no-unused-vars */

/**
 * Handle duplicate keys in strict mode on older browsers.
 *
 * This function converts duplicated properties into normal objects
 * older browsers can understand. Used for adding `align` support when
 * registering blocks through registerBlockType().
 *
 * @package    AJV_Proto
 * @author     Alexis J. Villegas
 * @link       http://www.alexisvillegas.com
 * @license    GPL-2.0+
 */

function _defineProperty( obj, key, value ) {
	if ( key in obj ) {
		Object.defineProperty( obj, key, { value: value, enumerable: true, configurable: true, writable: true });
	} else {
		obj[key] = value;
	} return obj;
}
