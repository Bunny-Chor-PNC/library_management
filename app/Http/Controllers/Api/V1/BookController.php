<?php

namespace App\Http\Controllers\Api\V1;
use Illuminate\Support\Facades\Log;
use App\Models\Book;
use App\Models\Librarian;
use App\Models\Category;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index()
    {
        $data = Book::with('librarian', 'category', 'member')->get();
        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'year' => 'required|integer|min:1000|max:' . date('Y'),
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
            'year' => 'sometimes|integer|min:1000|max:' . date('Y'),
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

    public function fetchRelatedData()
    {
        return response()->json([
            'categories' =>Category::select('id', 'name')->get(),
            'members' => Member::select('id', 'name')->get(),
            'librarians' => Librarian::select('id', 'name')->get(),
        ]);
    }

}
