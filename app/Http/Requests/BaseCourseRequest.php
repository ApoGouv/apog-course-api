<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseCourseRequest extends FormRequest
{

    /**
     * The resource name.
     * Used in error formatting.
     */
    const RESOURCE_NAME = 'Course';

    /**
     * Error codes used in error formatting.
     */
    const VALIDATION_ERROR_CODE = 'validation_failed';
    const NOT_FOUND_ERROR_CODE = 'not_found';

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get all of the input and files for the request.
     *
     * The validated method only validates data coming from the request body, not the route parameters.
     * Here we ensure it also includes any route parameters so we can validate them.
     *
     * @param  array|mixed|null  $keys
     * @return array
     */
    public function all($keys = null)
    {
        $data = parent::all($keys);

        // Merge route parameters into request data
        $data = array_merge($data, $this->route()->parameters());

        return $data;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'message' => 'Validation Failed',
            'errors' => $this->formatErrors($validator)
        ], 422);

        throw new HttpResponseException($response);
    }

    /**
     * Format the validation errors.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $field => $messages) {
            foreach ($messages as $message) {
                $errors[] = [
                    'resource' => self::RESOURCE_NAME,
                    'field' => $field,
                    'code' => self::VALIDATION_ERROR_CODE,
                    'message' => $message
                ];
            }
        }
        return $errors;
    }
}