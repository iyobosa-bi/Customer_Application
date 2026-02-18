<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "email"=>["required","email"],
            "first_name"=>["required","string","max:255"],
            "last_name"=> ["required","string","max:255"],
            "phone"=>["required","string"],
            "bank_account_number"=>["required","numeric"],
            "about"=>["nullable","string"],
            'image' => ['nullable', 'file', 'image', 'max:2048'] // 

        ];
    }
}
