<?php
namespace App\Http\Controllers;

use App\Models\ApplyService;
use App\Models\Job;
use Illuminate\Http\Request;

class ApplyServiceController extends Controller
{
    public function apply(Request $request, Job $job)
    {
        $user = $request->user();

        // Ensure only providers (solo/company) can apply
        if ($user->user_role !== 'provider' || !in_array($user->account_type, ['solo', 'company'])) {
            return response()->json(['message' => 'Only providers can apply for jobs.'], 403);
        }

        // Prevent re-application
        if (ApplyService::where('job_id', $job->id)->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'You have already applied.'], 409);
        }

        // Validate request
        $request->validate([
            'answers' => 'required|array|min:1',
        ]);

        ApplyService::create([
            'user_id' => $user->id,
            'job_id' => $job->id,
            'answers' => $request->answers,
        ]);

        return response()->json(['message' => 'Application submitted successfully.'], 201);
    }
}
