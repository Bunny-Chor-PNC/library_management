<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorrowRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'member_id' => 'required|exists:members,id',
            'librarian_id' => 'required|exists:librarians,id',
            'book_id' => 'required|exists:books,id',
        ];
    }
}
