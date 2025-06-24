<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MemberUpdate;
use App\Http\Requests\MemberRequest;

class MemberController extends Controller
{
    // GET /members
    public function index()
    {
        return response()->json(Member::all(), 200);
    }

    // POST /members
    public function store(MemberRequest $request)
    {
        $validated = $request->validated();

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
    public function update(MemberUpdate $request, $id)
    {
        $member = Member::find($id);
        if (!$member) {
            return response()->json(['message' => 'Member not found'], 404);
        }

        $validated = $request->validated();

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

