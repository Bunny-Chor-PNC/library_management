<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Http\Requests\BorrowRequest;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with(['member', 'librarian', 'book'])->get();
        return response()->json($borrows);
    }

    public function store(BorrowRequest $request)
    {
        $data = $request->validated();
        $borrow = Borrow::create($data);
        $borrow->load(['member', 'librarian', 'book']);
        return response()->json($borrow, 201);
    }
    public function update(BorrowRequest $request, $id)
    {
        $borrow = Borrow::findOrFail($id);
        $borrow->update($request->validated());
        $borrow->load(['member', 'librarian', 'book']);
        return response()->json($borrow);
    }

    public function destroy($id)
    {
        $borrow = Borrow::find($id);
        if (!$borrow) {
            return response()->json(['message' => 'Borrow not found'], 404);
        }

        $borrow->delete();
        return response()->json(['message' => 'Borrow deleted successfully'], 200);
    }
}
