<?php
/**
 * Basic stub for storing database entities in their appropriate class
 */

use App\Models\Model;

class Impact extends Model
{
    public function __construct()
    {
        // silence is golden
    }

    public function hydrate()
    {
        $this->user();
        $this->group();
    }

    public function user()
    {
        $this->user = User::find()
                          ->where(['id'], ['='], [$this->user_id])
                          ->get();
    }

    public function group()
    {
        $this->group = Group::find()
                            ->where(['id'], ['='], [$this->group_id])
                            ->get();
    }
}