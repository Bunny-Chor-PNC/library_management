<?php

namespace App\Http\Controllers\Api\V1;
use App\Models\Book;
use App\Models\Librarian;
use App\Models\Category;
use App\Models\Member;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookUpdate;

class BookController extends Controller
{
    public function index()
    {
        $data = Book::with('librarian', 'category', 'member')->get();
        return response()->json($data, 200);
    }

    public function store(BookRequest $request)
    {
        $validated = $request->validated();

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

    public function update(BookUpdate $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->update($request->validated());

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
