<?php

/**
 * This is the entry point to our application.
 * All necessary files will be concatenated to here.
 */
use App\Core\Request;
use App\Core\Router;

/**
 * Load in the files to get the app up and running.
 * Will need to be manually updated with each new
 * Class, Controller, Model, et al.
 */
require __DIR__ . '/app/core/bootstrap.php';

/**
 * Sessions will be used for storing the User
 * data while they are logged in.
 */
session_start();

/**
 * $router will hold all of the available routes
 * for the application.
 */
$router = new Router;

/**
 * Store routes here
 */
require_once __DIR__ . '/app/routes.php';

/**
 * This method chain will call the appropriate
 * method from the requested Controller based
 * on the request URI.
 */
Router::load( __DIR__ . '/app/routes.php' )->direct( Request::uri() , Request::method() );
