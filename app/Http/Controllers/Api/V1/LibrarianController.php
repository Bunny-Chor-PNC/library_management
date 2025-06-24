<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Librarian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\LibrarianRequest;
use App\Http\Requests\LibrarianUpdate;

class LibrarianController extends Controller
{
    // List all librarians
    public function index()
    {
        return response()->json(Librarian::all());
    }

    // Create a new librarian
    public function store(LibrarianRequest $request)
    {
        $validated = $request->validate();

        $librarian = Librarian::create($validated);

        return response()->json($librarian, 201);
    }

    // Show a librarian by id
    public function show($id)
    {
        $librarian = Librarian::find($id);
        if (!$librarian) {
            return response()->json(['message' => 'Librarian not found'], 404);
        }
        return response()->json($librarian);
    }

    // Update librarian by id
    public function update(LibrarianUpdate $request, $id)
    {
        $librarian = Librarian::find($id);
        if (!$librarian) {
            return response()->json(['message' => 'Librarian not found'], 404);
        }

        $validated = $request->validate();

        $librarian->update($validated);

        return response()->json($librarian);
    }

    // Delete librarian by id
    public function destroy($id)
    {
        $librarian = Librarian::find($id);
        if (!$librarian) {
            return response()->json(['message' => 'Librarian not found'], 404);
        }
        $librarian->delete();
        return response()->json(['message' => 'Librarian deleted']);
    }
}
