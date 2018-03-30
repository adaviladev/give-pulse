<?php

/**
 * This script will fill the database with
 * the dummy data found in the SQL files
 * in this directory.
 *
 * To run, SSH into your VM, navigate to
 * ~/Code/cosc3380/core/database/sql
 * and run the following command
 *
 * php factory.php
 */

use App\Core\App;

require __DIR__.'/../../App.php';
require __DIR__.'/../Connection.php';
require __DIR__.'/../QueryBuilder.php';

App::bind('config', require __DIR__.'/../../config.php');
try {
    App::bind('database', new QueryBuilder(Connection::make(App::get('config')['database'])));
} catch (Exception $e) {
}

$seeders = [];
$seeders['seeder'] = file_get_contents(__DIR__.'/givepulse_test.sql');

foreach ($seeders as $file => $contents) {
    try {
        App::get('database')
           ->run($contents, true);
    } catch (Exception $e) {
    }
    echo $file."SQL executed\n";
}
