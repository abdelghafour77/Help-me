<?php

namespace App\Http\Requests;

use App\Http\Controllers\LogController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'string|max:255|unique:tags,slug',
            'color' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $log = new LogController();

        $errors = implode(' ', $validator->errors()->all());

        $log->logMe('error', "Tag cannot be created cause of : $errors ", 'POST', $this->ip());

        return redirect()->back()->withErrors($validator)->withInput();
    }
}
