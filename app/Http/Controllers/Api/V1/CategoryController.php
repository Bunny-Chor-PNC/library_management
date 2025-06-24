<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryUpdate;
class CategoryController extends Controller
{
    // List all categories
    public function index()
    {
        return response()->json(Category::all(), 200);
    }

    // Store a new category
    public function store(CategoryRequest $request)
    {
        $validated = $request->validated();

        $category = Category::create($validated);
        return response()->json([
            'message' => 'Category created successfully',
            'data' => $category
        ], 201);
    }

    // Show a specific category
    public function show($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
        return response()->json($category);
    }

    // Update a category
    public function update(CategoryUpdate $request, $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validated = $request->validate();

        $category->update($validated);
        return response()->json($category);
    }

    // Delete a category
    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
