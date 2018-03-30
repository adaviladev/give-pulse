<?php

	/**
	 * Declare all routes here.
	 */
$router->get( '' , 'PagesController@index' );
$router->get( 'events' , 'EventsController@index' );