<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(Book::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'librarian_id' => 'nullable|exists:librarians,id',
            'category_id' => 'nullable|exists:categories,id',
            'member_id' => 'nullable|exists:members,id',
        ]);

        $book = Book::create($validated);
        return response()->json($book, 201);
    }

    public function show($id)
    {
        $book = Book::with(['librarian', 'category', 'member'])->find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }
        return response()->json($book);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'librarian_id' => 'nullable|exists:librarians,id',
            'category_id' => 'nullable|exists:categories,id',
            'member_id' => 'nullable|exists:members,id',
        ]);

        $book->update($validated);
        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();
        return response()->json(['message' => 'Book deleted']);
    }
}
