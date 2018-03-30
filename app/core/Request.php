<?php

	namespace App\Core;

	/**
	 * Class Request
	 * @package App\Core
	 *
	 * Returns the current URL path to the Router object.
	 */
	class Request {
		/**
		 * @return string Formatted REQUEST_URI used for routing to proper view
		 */
		public static function uri() {
			return trim(
				parse_url( $_SERVER[ 'REQUEST_URI' ] , PHP_URL_PATH ), '/'
			);
		}

		/**
		 * @return mixed Provides the method used to access the current REQUEST_URI
		 */
		public static function method() {
			return $_SERVER[ 'REQUEST_METHOD' ];
		}
	}