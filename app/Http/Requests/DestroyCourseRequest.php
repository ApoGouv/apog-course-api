<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseCourseRequest;

class DestroyCourseRequest extends BaseCourseRequest
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
        ];
    }
}
