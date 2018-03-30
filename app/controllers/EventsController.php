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
        $sql = "SELECT 
                events.title, 
                events.created,
                events.start_date_time, 
                events.end_date_time,
                events.description 
                FROM events 
                WHERE start_date_time IS NOT NULL
                ORDER BY created ASC";
        $events = Event::raw($sql);

        //$sortedEvents = [];
        //
        //foreach ($events as $event) {
        //    $dateTime = \DateTime::createFromFormat("Y-m-d H:i:s", $event->start_date_time);
        //    $hour = $dateTime->format('H');
        //    $sortedEvents[$hour][] = $event;
        //}
        //
        //foreach ($sortedEvents as $sortedEvent) {
        //    echo count($sortedEvent) . "<br/>";
        //}

        //dd(array_keys($sortedEvents));
        echo(json_encode($events));
        //return view('index', compact('events'));
    }
}