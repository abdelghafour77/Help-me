<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use App\Http\Controllers\LogController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
    public function failedValidation(Validator $validator)
    {
        $log = new LogController();

        $errors = implode(' ', $validator->errors()->all());

        $log->logMe('error', "User cannot be updated cause of : $errors ", 'PUT', $this->ip());

        return redirect()->back()->withErrors($validator)->withInput();
    }
}
