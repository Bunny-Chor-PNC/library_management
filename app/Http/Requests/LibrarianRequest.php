<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibrarianRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'email' => 'required|email|unique:librarians,email',
            'password' => 'required|string|min:6',
        ];
    }
}
