<?php
namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobQuestion;
use App\Models\JobSkill;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'category' => 'required|string',
            'job_type' => 'required|in:Full Time,Part Time,Freelance',
            'work_place' => 'required|in:On Site,Remote,Hybrid',
            'country' => 'required|string',
            'city' => 'required|string',
            'experience_from' => 'required|integer|min:0',
            'experience_to' => 'required|integer|min:0|gte:experience_from',
            'salary_range' => 'required|string',
            'deadline' => 'required|date',
            'skills' => 'nullable|array',
            'skills.*' => 'string',
            'questions' => 'nullable|array',
            'questions.*' => 'string'
        ]);

        $job = Job::create([
            'user_id' => $request->user()->id,
            'title' => $request->title,
            'category' => $request->category,
            'job_type' => $request->job_type,
            'work_place' => $request->work_place,
            'country' => $request->country,
            'city' => $request->city,
            'experience_from' => $request->experience_from,
            'experience_to' => $request->experience_to,
            'salary_range' => $request->salary_range,
            'deadline' => $request->deadline
        ]);

        foreach ($request->questions ?? [] as $q) {
            JobQuestion::create(['job_id' => $job->id, 'question_text' => $q]);
        }

        foreach ($request->skills ?? [] as $skill) {
            JobSkill::create(['job_id' => $job->id, 'skill' => $skill]);
        }

        return response()->json([
    'message' => 'Job posted successfully','job_id' => $job->id], 201);
    }
}
