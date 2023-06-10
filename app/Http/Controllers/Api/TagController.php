<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function index(): Response
    {
        $tags = Tag::all();

        return response()->json([
            "status" => 200,
            "data" => $tags
        ]);
    }

    public function searchTag(Request $request): Response
    {
        $tagId = $request->id;

        if ($tagId > 0) {
            $tag = Tag::find($tagId);

            if ($tag) {
                return response()->json([
                    "status" => 200,
                    "data" => $tag
                ]);
            }
        }

        return response()->json([
            "status" => 404
        ]);
    }

    public function createTag(Request $request): Response
    {
        $validatedData = $request->validate([
            "name" => "required"
        ]);

        $tag = Tag::create([
            "name" => $validatedData["name"]
        ]);

        return response()->json([
            "status" => 200,
            "data" => $tag
        ]);
    }

    public function updateTag(Request $request): Response
    {
        $validatedData = $request->validate([
            "name" => "required"
        ]);

        if ($validatedData) {
            $tag = Tag::find($request->id);

            if ($tag) {
                $tag->update([
                    'name' => $request->name,
                ]);

                return response()->json([
                    "status" => 200,
                    "data" => $tag
                ]);
            }

            return response()->json([
                "status" => 404
            ]);
        }

        return response()->json([
            "status" => 404
        ]);
    }

    public function deleteTag(Request $request): Response
    {
        $tagId = $request->id;

        if ($tagId > 0) {
            $tag = Tag::destroy($tagId);

            if ($tag) {
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
