<?php

namespace App\Http\Requests;

use App\Http\Controllers\LogController;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateTagRequest extends FormRequest
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
            'slug' => 'string|max:255|unique:tags,slug,' . $this->tag->id,
            'color' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        // dd($validator);
        $log = new LogController();

        $errors = implode(' ', $validator->errors()->all());

        $log->logMe('error', "Tag cannot be updated cause of : $errors ", 'PUT', $this->ip());

        return redirect()->back()->withErrors($validator)->withInput();
    }
}
