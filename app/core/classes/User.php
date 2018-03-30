<?php
/**
 * Basic stub for storing database entities in their appropriate class
 */

use App\Models\Model;

class User extends Model
{
    public function __construct()
    {
        // silence is golden
    }

    public function hydrate()
    {
        $this->skills();
        $this->impact();
    }

    public function skills()
    {
        $userSkills = Skill::findAll(['skill_id'])
                           ->table('user_skills')
                           ->where(['user_id'], ['='], [$this->id])
                           ->get();
        if(count($userSkills)) {
            $skillIds = [];
            foreach ($userSkills as $userSkill) {
                $skillIds[] = $userSkill->skill_id;
            }
            $this->skills = Skill::findAll()
                                 ->whereIn($skillIds, 'id')
                                 ->get();
        } else {
            $this->skills = [];
        }
    }

    public function impact()
    {
        $this->impact = Impact::findAll()
                           ->where(['user_id'], ['='], [$this->id])
                           ->get();
    }
}