<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index(): Response
    {
        $categories = Category::all();

        return response()->json([
            "status" => 200,
            "data" => $categories
        ]);
    }

    public function searchCategory(Request $request): Response
    {
        $categoryId = $request->id;

        if ($categoryId > 0) {
            $category = Category::find($categoryId);

            if ($category) {
                return response()->json([
                    "status" => 200,
                    "data" => $category
                ]);
            }

            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 400
        ]);
    }

    public function createCategory(Request $request): Response
    {
        $validatedData = $request->validate([
            "name" => "required"
        ]);

        if ($validatedData) {
            $category = Category::create([
                'name' => $request->input('name')
            ]);

            return response()->json([
                "status" => 200,
                "data" => $category
            ]);
        }

        return response()->json([
            "status" => 405
        ]);
    }

    public function updateCategory(Request $request): Response
    {
        $validatedData = $request->validate([
            "name" => "required"
        ]);

        if ($validatedData) {
            $category = Category::find($request->id);

            if ($category) {
                $category->update([
                    'name' => $request->name,
                ]);

                return response()->json([
                    "status" => 200,
                    "data" => $category
                ]);
            }

            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 405
        ]);
    }

    public function deleteCategory(Request $request): Response
    {
        $categoryId = $request->id;

        if ($categoryId > 0) {
            $category = Category::destroy($categoryId);

            if ($category) {
                return response()->json([
                    "status" => 200
                ]);
            }

            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 400
        ]);
    }
}
