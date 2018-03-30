<?php

	namespace App\Core;

	use Exception;

	class App {
		protected static $registry = [];

		/**
		 * @param string $key Key to bind provided $value to
		 * @param mixed  $value
		 */
		public static function bind( $key , $value ) {
			static::$registry[ $key ] = $value;
		}

		/**
		 * @param string $key key for the requested value
		 *
		 * @return mixed The Value for the requested key
		 * @throws Exception If key does not exist, throw exception
		 */
		public static function get( $key ) {
			if( ! array_key_exists( $key , static::$registry ) ) {
				throw new Exception( "No {$key} does not exists." );
			}

			return static::$registry[ $key ];
		}
	}