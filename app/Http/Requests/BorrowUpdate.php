<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowUpdate extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'member_id' => 'sometimes|exists:members,id',
            'librarian_id' => 'sometimes|exists:librarians,id',
            'book_id' => 'sometimes|exists:books,id',
        ];
    }
}
