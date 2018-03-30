<?php

namespace App\Controllers;

use Event;
use Impact;
use User;

class PagesController
{
    /**
     * @var $user User
     * @return mixed
     */
    public function index()
    {
        return view('index');
    }
}