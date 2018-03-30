<?php

	/**
	 * List any additionaly helper functions here.
	 */

	/**
	 * @return mixed footer portion
	 */
	function getFooter() {
		return require_once( __DIR__ . "/../../resources/views/partials/footer.php" );
	}

	/**
	 * @param string $file <path|file name> of partial to be retrieved
	 * @param array  $data
	 */
	function getPartial( $file , $data = [] ) {
		extract( $data );

		require( __DIR__ . "/../../resources/views/partials/{$file}.php" );
	}

	/**
	 * @return mixed header portion
	 */
	function getHeader() {
		return require_once( __DIR__ . "/../../resources/views/partials/header.php" );
	}

	/**
	 * @param string $uri REQUEST_URI to be redirected to
	 */
	function redirect( $uri ) {
		header( "Location: /{$uri}" );
	}

	/**
	 * @param string $name <path|file name> for view to be retrieved based on the REQUEST_URI
	 * @param array  $data compact()-ed array for any data required by the view
	 *
	 * @return mixed
	 */
	function view( $name , $data = [] ) {
		extract( $data );

		return require __DIR__ . "/../../resources/views/{$name}.view.php";
	}

	/**
	 * @param array ...$data splatted data to be printed
	 *
	 * Used pured for testing
	 */
	function dd( ...$data ) {
		die( var_dump( ...$data ) );
	}

	function scripts() {
        foreach (glob(__DIR__.'/../../dist/static/js/*.*.js') as $file) {
            $fileNames = explode('/', $file);
            $fileName = $fileNames[count($fileNames) - 1];
            echo '<script src="/dist/static/js/' . $fileName . '"></script>';
	    }
    }