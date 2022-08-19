<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\SkillsRepositery;
use Exception;
use Illuminate\Support\Facades\log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\RedirectResponse;

class SkillsService
{
    /**
     * @var SkillsRepositery $skillsRepositery
     */
    protected $skillsRepositery;

    public function __construct(SkillsRepositery $skillsRepositery)
    {
        $this->skillsRepositery = $skillsRepositery;
    }

    /**
     * get all skills
     */
    public function getAllSkills(): object
    {
        $getAllSkills = $this->skillsRepositery->querySkills();

        return $getAllSkills;
    }

    /**
     * get active list of skills
     */
    public function getActiveSkills(): object
    {
        $getAllSkills = $this->skillsRepositery->queryActiveSkills();

        return $getAllSkills;
    }


    /**
     * Adminstration backend.
     * Handles adding new skills request.
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function addSkill(object $request)
    {
        $validator = Validator::make($request->all(), [
            'skill_name' => 'required|string|max:255',
            'skill_status' => 'required|numeric|in:1,2',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $addNewSkill = $this->skillsRepositery->addNewSkill($request->skill_name, (int) $request->skill_status);

            if ($addNewSkill) {
                return back()->with('successstatus', __('backendLang.succAddSkill'));
            }
            if (!$addNewSkill) {
                return back()->with('failedstatus', __('backendLang.failedToAddSKill'));
            }
        }
    }


    /**
     * Adminstration backend.
     * handles updating skill request.
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function updateSkill(object $request)
    {

        $validator = Validator::make($request->all(), [
            'skill_id' => 'required|numeric|exists:skills,id',
            'skill_name' => 'required|string|max:255',
            'skill_status' => 'required|numeric|in:1,2',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $addNewSkill = $this->skillsRepositery
            ->updateSkillQuery((int) $request->skill_id, $request->skill_name, (int) $request->skill_status);

            if ($addNewSkill) {
                return back()->with('successstatus', __('backendLang.succUpdatedSkill'));
            }
            if (!$addNewSkill) {
                return back()->with('failedstatus', __('backendLang.failedToUpdateSKill'));
            }
        }
    }

    /**
     * Adminstration backend.
     * handles removing skill request.
     * @param object $request
     * @return \Illuminate\Http\Response
     */
    public function removeSkill(object $request): object
    {
        $validator = Validator::make($request->all(), [
            'skill_ID' => 'required|numeric|exists:skills,id',
        ]);

        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator) // send back all errors to user
                ->withInput();
        }

        if (!$validator->fails()) {
            $addNewSkill = $this->skillsRepositery->removeSkillQuery((int) $request->skill_ID);

            if ($addNewSkill) {
                return back()->with('successstatus', __('backendLang.succRemoveSkill'));
            }
            if (!$addNewSkill) {
                return back()->with('failedstatus', __('backendLang.failedToRemoveSKill'));
            }
        }
    }
}
