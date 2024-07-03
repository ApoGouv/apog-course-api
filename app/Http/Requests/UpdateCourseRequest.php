<?php

namespace App\Http\Requests;

use App\Enums\CourseStatusEnum;
use Illuminate\Validation\Rule;
use App\Http\Requests\BaseCourseRequest;

class UpdateCourseRequest extends BaseCourseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => [
                'required', 
                Rule::enum(CourseStatusEnum::class)
            ],
            'is_premium' => 'required|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        $statusOptions = implode(', ', CourseStatusEnum::getArrayValues());

        return [
            'id.required' => 'The course ID is required.',
            'id.integer' => 'The course ID must be an integer.',
            'id.exists' => 'The specified course does not exist.',
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'status.required' => 'The status field is required.',
            'status.enum' => "The status must be one of the following values: {$statusOptions}.",
            'is_premium.required' => 'The is_premium field is required.',
            'is_premium.boolean' => 'The is_premium field must be true or false (also it can be 0 or 1).',
        ];
    }
}
