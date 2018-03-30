<?php

	namespace App\Core;

	use Exception;

	/**
	 * Class Router
	 * @package App\Core
	 *
	 * The Router class is the junction of application.
	 * It determines which controllers and methods need to be called.
	 */
	class Router {

		/**
		 * Routes are separated into their respective
		 * request methods.
		 */
		protected $routes = [
			'GET'  => [] ,
			'POST' => []
		];

		public static function load( $file ) {
			$router = new self;
			require $file;

			return $router;
		}

		/**
		 * Called from ./routes.php
		 *
		 * @param string $uri URI path in address bar
		 * @param string $controller name of controller that should be called
		 */
		public function get( $uri , $controller ) {
			$this->routes[ 'GET' ][ $uri ] = $controller;
		}

		/**
		 * Called from ./routes.php
		 *
		 * @param string $uri URI path in address bar
		 * @param string $controller name of controller that should be called
		 */
		public function post( $uri , $controller ) {
			$this->routes[ 'POST' ][ $uri ] = $controller;
		}

		public function direct( $uri , $requestType ) {
			if( array_key_exists( $uri , $this->routes[ $requestType ] ) ) {
				return $this->callAction( ...
					explode( '@' , $this->routes[ $requestType ][ $uri ] ) );
			}

			foreach( $this->routes[ $requestType ] as $route => $controller ) {
				if( $route == '' ) {
					continue;
				}

				$patternStr = explode( '/' , $route );
				if( count( explode( '/' , $uri ) ) != count( $patternStr ) ) {
					continue;
				}

				$regex = $this->getRegex( $patternStr );
				if( preg_match( $regex , $uri , $matches ) ) {
					$params = explode( '@' , $controller );
					array_shift( $matches );

					return $this->callAction( $params[ 0 ] , $params[ 1 ] , $matches );
				}
			}

			return redirect( '' );
			// throw new Exception( 'No route defined for URI.' );
		}

		protected function callAction( $controller , $method , $params = [] ) {

			$controller = "App\\Controllers\\{$controller}";
			$controller = new $controller;
			if( ! method_exists( $controller , $method ) ) {
				throw new Exception( "Controller {$controller} does not have method {$method}()." );
			}

			return $controller->$method( ...$params );
		}

		private function getRegex( $route ) {
			$regex    = '#';
			$ctr      = 0;
			$wildcard = false;
			foreach( $route as $pattern ) {
				if( $pattern[ 0 ] == ':' ) {
					$wildcard = true;
					$pattern  = str_replace( ':' , '' , $pattern );
				}
				if( $ctr > 0 ) {
					$regex .= '/';
				}
				if( $wildcard ) {
					$regex .= '([a-z0-9]+)';
				} else {
					$regex .= $pattern;
				}
				$ctr++;
				$wildcard = false;
			}
			$regex .= '#';

			return $regex;
		}
	}