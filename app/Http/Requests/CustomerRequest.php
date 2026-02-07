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
            "image"=>["nullable","max:2048","mimes:png,jpg"],
            "email"=>["required","email"],
            "first_name"=>["required","string","max:255"],
            "last_name"=> ["required","string","max:255"],
            "phone"=>["required","string"],
            "bank_account_number"=>["required","numeric"],
            "about"=>["nullable","string"]
        ];
    }
}
