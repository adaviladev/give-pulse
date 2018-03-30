<?php

namespace App\Controllers;

use Event;
use Impact;
use User;

class EventsController
{
    /**
     * @var $user User
     * @return mixed
     */
    public function index()
    {
        $events = Event::findAll()
                       ->orderBy('created', 'ASC')
                       ->get();

        echo(json_encode($events));
    }
}