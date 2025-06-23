<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    // GET /members
    public function index()
    {
        return response()->json(Member::all(), 200);
    }

    // POST /members
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'email' => 'required|email|unique:members,email',
            'password' => 'required|string|min:6',
        ]);

        $member = Member::create($validated);
        return response()->json($member, 201);
    }

    // GET /members/{id}
    public function show($id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }
        return response()->json($member);
    }

    // PUT /members/{id}
    public function update(Request $request, $id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'age' => 'nullable|integer',
            'email' => 'sometimes|required|email|unique:members,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
        ]);

        $member->update($validated);
        return response()->json($member);
    }

    // DELETE /members/{id}
    public function destroy($id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $member->delete();
        return response()->json(['message' => 'Member deleted']);
    }
}

