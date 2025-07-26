<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'job_type' => 'required|in:Full Time,Part Time,Freelance',
        'work_place' => 'required|in:On Site,Remote,Hybrid',
        'country' => 'nullable|string|max:255',
        'city' => 'nullable|string|max:255',
        'experience_from' => 'nullable|integer|min:0|max:50',
        'experience_to' => 'nullable|integer|min:0|max:50|gte:experience_from',
        'salary_range' => 'nullable|string|max:255',
        'application_deadline' => 'nullable|date|after_or_equal:today',

        // Mandatory questions
        'questions' => 'required|array|min:1',
        'questions.*' => 'required|string|max:1000',
    ];
}

}
