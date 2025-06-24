<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookUpdate extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $currentYear = date('Y');

        return [
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'year' => "sometimes|required|integer|min:1000|max:$currentYear",
            'librarian_id' => 'nullable|exists:librarians,id',
            'category_id' => 'nullable|exists:categories,id',
            'member_id' => 'nullable|exists:members,id',
        ];
    }
}
