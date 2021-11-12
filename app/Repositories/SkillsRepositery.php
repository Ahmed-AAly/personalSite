<?php

namespace App\Repositories;

use App\Models\Skills;

class SkillsRepositery
{

    /**
     * @var Skills $skills
     */
    protected $skills;

    public function __construct(Skills $skills)
    {
        $this->skills = $skills;
    }


    /**
     * Query the DB for all user skills
     * @return object
     */
    public function querySkills(): object
    {
        return $this->skills->select('id', 'skill', 'status')->paginate(20);
    }

    /**
     * Query the DB for all active user skills
     * @return object
     */
    public function queryActiveSkills(): object
    {
        return $this->skills->select('id', 'skill', 'status')->where('status', 1)->get();
    }

    /**
     * stores new skills to DB
     * @param string $skillName
     * @param int $skillStatus
     */
    public function addNewSkill(string $skillName, int $skillStatus): bool
    {
        try {
            $addNewSkill = $this->skills;
            $addNewSkill->skill = $skillName;
            $addNewSkill->status = $skillStatus;
            $addNewSkill->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * update skills on DB
     * @param int $skillID
     * @param string $skillName
     * @param int $skillStatus
     */
    public function updateSkillQuery(int $skillID, string $skillName, int $skillStatus): bool
    {
        try {
            $this->skills->where('id', $skillID)->update(['skill' => $skillName, 'status' => $skillStatus]);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    /**
     * removes skills from DB
     * @param int $skillID
     */
    public function removeSkillQuery(int $skillID): bool
    {
        try {
            $this->skills->find($skillID)->delete();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
