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
     * get all user skillset from storage.
     * @return object
     */
    public function querySkills(): object
    {
        return $this->skills->select('id', 'skill', 'status')->paginate(20);
    }

    /**
     * get all active skillset from storage.
     * @return object
     */
    public function queryActiveSkills(): object
    {
        return $this->skills->select('id', 'skill', 'status')->where('status', 1)->get();
    }

    /**
     * store new skill to storage
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
     * update skill on storage.
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
     * removes skills from storage.
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
