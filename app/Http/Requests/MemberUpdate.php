<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberUpdate extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $id = $this->route('member'); 
        return [
            'name' => 'sometimes|required|string|max:255',
            'age' => 'nullable|integer',
            'email' => 'sometimes|required|email|unique:members,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ];
    }
}
