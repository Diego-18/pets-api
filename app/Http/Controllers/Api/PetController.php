<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use Symfony\Component\HttpFoundation\Response;

class PetController extends Controller
{
    public function searchPet(Request $request): Response
    {
        $petId = $request->id;

        if ($petId > 0) {
            $pet = Pet::find($petId);

            if ($pet) {
                return response()->json([
                    "status" => 200,
                    "data" => $pet
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

    public function searchStatus(Request $request): Response
    {
        $validatedData = $request->validate([
            "status" => "required|in:available,sold,pending"
        ]);

        $status = $validatedData['status'];

        $pets = Pet::join('category', 'pet.category_fk', '=', 'category.id')
            ->join('tag', 'pet.tag_fk', '=', 'tag.id')
            ->select('pet.*', 'category.name as category_name', 'tag.name as tag_name')
            ->where("status", $status)
            ->get();

        if ($pets->count() > 0) {
            return response()->json([
                "status" => 200,
                "data" => $pets
            ]);
        } else {
            return response()->json([
                "status" => 404
            ]);
        }
    }

    public function createPet(Request $request): Response
    {
        $validatedData = $request->validate([
            "name" => "required",
            "category_fk" => "required",
            "tag_fk" => "required",
            "photoUrls" => "required",
            "status" => "required"
        ]);

        $pet = new Pet();
        $pet->name = $validatedData['name'];
        $pet->category_fk = $validatedData['category_fk'];
        $pet->tag_fk = $validatedData['tag_fk'];
        $pet->photoUrls = $request->photoUrls;
        $pet->status = $validatedData['status'];
        $pet->save();

        return response()->json([
            "status" => 200,
            "data" => $pet
        ]);
    }

    public function updatePet(Request $request): Response
    {
        $validatedData = $request->validate([
            "id" => "required|integer|min:1",
            "name" => "required",
            "category_fk" => "required",
            "tag_fk" => "required",
            "status" => "required"
        ]);

        $petId = $validatedData['id'];

        $pet = Pet::find($petId);

        if ($pet) {
            $pet->name = $validatedData['name'];
            $pet->category_fk = $validatedData['category_fk'];
            $pet->tag_fk = $validatedData['tag_fk'];
            $pet->photoUrls = $request->photoUrls;
            $pet->status = $validatedData['status'];
            $pet->save();

            return response()->json([
                "status" => 200,
                "data" => $pet
            ]);
        }

        return response()->json([
            "status" => 404
        ]);
    }

    public function deletePet(Request $request): Response
    {
        $petId = $request->id;

        if ($petId > 0) {
            $pet = Pet::destroy($petId);

            if ($pet) {
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
