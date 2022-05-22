<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();

        if($tags){
            return response()->json([
                "status" => 200,
                "data" => $tags
            ]);
        }

        return response()->json([
            "status" => 500
        ]);
    }

    public function searchTag(Request $request)
    {
        $tag = Tag::where("id", $request->id)->get();

        if($tag->count() > 0){
            return response()->json([
                "status" => 200,
                "data" => $tag
            ]);
        }

        return response()->json([
            "status" => 404
        ]);
    }

    public function createTag(Request $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->save();

        if(!$tag->save()){
            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 200,
            "data" => $tag
        ]);
    }

    public function updateTag(Request $request)
    {
        $tag = Tag::findOrFail($request->id);
        $tag->name = $request->name;
        $tag->save();

        if(!$tag->save()){
            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 200,
            "data" => $tag
        ]);
    }

    public function deleteTag(Request $request)
    {
        $tag = Tag::destroy($request->id);
        if(!$tag){
            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 200
        ]);
    }
}
