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
        if($request->id > 0){
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

        return response()->json([
            "status" => 400
        ]);
    }

    public function createCategory(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required"
        ]);

        if($validatedData){
            $category = new Category();
            $category->name = $request->name;
            $category->save();

            if(!$category->save()){
                return response()->json([
                    "status" => 400
                ]);
            }

            return response()->json([
                "status" => 200,
                "data" => $category
            ]);
        }

        return response()->json([
            "status" => 405
        ]);
    }

    public function updateCategory(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required"
        ]);

        if($validatedData){
            $category = Category::find($request->id);

            if($category != null){
                $category->name = $request->name;
                $category->save();

                if($category->save()){
                    return response()->json([
                        "status" => 200,
                        "data" => $category
                    ]);
                }
            }
            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 405
        ]);
    }

    public function deleteCategory(Request $request)
    {
        if($request->id > 0){
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

        return response()->json([
            "status" => 400
        ]);
    }
}
