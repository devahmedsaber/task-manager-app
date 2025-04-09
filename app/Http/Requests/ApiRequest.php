<?php

namespace App\Http\Requests;

use App\Traits\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    use ApiResponse;

    /**
     * Validate if user is authorized
     *
     * @return bool
     */
    abstract public function authorize();

    /**
     * Validation of the request
     *
     * @return array
     */
    abstract public function rules();

    /**
     * Handle validation when attempt fail
     *
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    public function failedValidation(Validator $validator)
    {
        $errors = [];
        foreach ($validator->messages()->toArray() as $key => $value) {
            $errors[$key] = $value;
        }

        throw new HttpResponseException(
            $this->validationErrors($errors, __('app.validation_error'))
        );
    }
}
