<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Librarian;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class LibrarianController extends Controller
{
    // List all librarians
    public function index()
    {
        return response()->json(Librarian::all());
    }

    // Create a new librarian
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'email' => 'required|email|unique:librarians,email',
            'password' => 'required|string|min:6',
        ]);

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
    public function update(Request $request, $id)
    {
        $librarian = Librarian::find($id);
        if (!$librarian) {
            return response()->json(['message' => 'Librarian not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'age' => 'nullable|integer',
            'email' => 'sometimes|required|email|unique:librarians,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ]);

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
