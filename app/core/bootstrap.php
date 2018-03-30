<?php

	use App\Core\App;

	/**
	 * Because of the concatenation done to all files
	 * in index.php, all requires must be done
	 * based on the project root directory.
	 *
	 * New Classes must be required in core/fileLoader.php
	 */
    require __DIR__ . '/../../vendor/autoload.php';

	/**
	 * Bind values to the global static App class.
	 */
	App::bind( 'config' , require __DIR__ . '/config.php' );
	App::bind( 'database' , new QueryBuilder( Connection::make( App::get( 'config' )[ 'database' ] ) ) );

	require( 'functions.php' );