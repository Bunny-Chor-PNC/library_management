<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibrarianUpdate extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('librarain'); 
        return [
            'name' => 'sometimes|required|string|max:255',
            'age' => 'nullable|integer',
            'email' => 'sometimes|required|email|unique:librarians,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ];
    }
}
