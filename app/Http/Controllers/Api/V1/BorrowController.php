<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Borrow;
use Illuminate\Http\Request;
use App\Http\Requests\BorrowRequest;
use App\Http\Requests\BorrowUpdate;

class BorrowController extends Controller
{
    public function index()
    {
        return response()->json(Borrow::all(), 200);
    }

    public function store(BorrowRequest $request)
    {
        $validated = $request->validate();

        $borrow = Borrow::create($validated);
        return response()->json($borrow, 201);
    }

    public function show($id)
    {
        $borrow = Borrow::with(['member', 'librarian', 'book'])->find($id);
        if (!$borrow) {
            return response()->json(['message' => 'Borrow not found'], 404);
        }
        return response()->json($borrow, 200);
    }

    public function update(BorrowUpdate $request, $id)
    {
        $borrow = Borrow::find($id);
        if (!$borrow) {
            return response()->json(['message' => 'Borrow not found'], 404);
        }

        $validated = $request->validate();

        $borrow->update($validated);
        return response()->json($borrow, 200);
    }

    public function destroy($id)
    {
        $borrow = Borrow::find($id);
        if (!$borrow) {
            return response()->json(['message' => 'Borrow not found'], 404);
        }

        $borrow->delete();
        return response()->json(['message' => 'Borrow deleted'], 200);
    }

    public function getDataAllBorrows() {
        $data = Borrow::with(['librarian', 'member', 'book'])->get();
        return response()->json($data, 200);
    }
}