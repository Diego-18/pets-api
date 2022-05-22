<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        if($categories){
            return response()->json([
                "status" => 200,
                "data" => $categories
            ]);
        }

        return response()->json([
            "status" => 500
        ]);
    }

    public function searchCategory(Request $request)
    {
        $category = Category::where("id", $request->id)->get();

        if($category->count() > 0){
            return response()->json([
                "status" => 200,
                "data" => $category
            ]);
        }

        return response()->json([
            "status" => 404
        ]);
    }

    public function createCategory(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        if(!$category->save()){
            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 200,
            "data" => $category
        ]);
    }

    public function updateCategory(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->name = $request->name;
        $category->save();

        if(!$category->save()){
            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 200,
            "data" => $category
        ]);
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::destroy($request->id);
        if(!$category){
            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 200
        ]);
    }
}
