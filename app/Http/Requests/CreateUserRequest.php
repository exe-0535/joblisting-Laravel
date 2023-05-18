<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class CreateUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3'],
            'surname' => ['required', 'min:2'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'company_name' => new RequiredIf($this->request->has("company_name")),
            'phone_number' => new RequiredIf($this->request->has("phone_number")),
            'password' => 'required|confirmed|min:6'
        ];
    }
}
