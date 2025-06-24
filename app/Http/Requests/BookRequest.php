<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $currentYear = date('Y');

        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => "required|integer|min:1000|max:$currentYear",
            'librarian_id' => 'nullable|exists:librarians,id',
            'category_id' => 'nullable|exists:categories,id',
            'member_id' => 'nullable|exists:members,id',
        ];
    }
}
