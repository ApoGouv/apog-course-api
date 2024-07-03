<?php

namespace App\Http\Requests;

use App\Enums\CourseStatusEnum;
use Illuminate\Validation\Rule;
use App\Http\Requests\BaseCourseRequest;

class StoreCourseRequest extends BaseCourseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => [
                'required',
                Rule::enum(CourseStatusEnum::class),
            ],
            'is_premium' => 'required|boolean', // Accepted input are true, false, 1, 0, "1", and "0".
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
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'description.required' => 'The description field is required.',
            'description.string' => 'The description must be a string.',
            'status.required' => 'The status field is required.',
            'status.Illuminate\Validation\Rules\Enum' => "The status must be one of the following values: {$statusOptions}.",
            'is_premium.required' => 'The is_premium field is required.',
            'is_premium.boolean' => 'The is_premium field must be true or false (also it can be 0 or 1).',
        ];
    }
}
