<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;

class PetController extends Controller
{
    public function searchPet(Request $request)
    {
        if($request->id > 0){
            $pet = Pet::join('category', 'pet.category_fk', '=', 'category.id')
                ->join('tag', 'pet.tag_fk', '=', 'tag.id')
                ->select('pet.*', 'category.name as category_name', 'tag.name as tag_name')
                ->where("id", $request->id)
                ->get();

            if($pet){
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

    public function searchStatus(Request $request)
    {
        $validatedData = $request->validate([
            "status" => "required"
        ]);

        if($validatedData['status'] === "available" || $validatedData['status'] === "sold" || $validatedData['status'] === "pending"){
            $pet = Pet::join('category', 'pet.category_fk', '=', 'category.id')
                ->join('tag', 'pet.tag_fk', '=', 'tag.id')
                ->select('pet.*', 'category.name as category_name', 'tag.name as tag_name')
                ->where("status", $validatedData['status'])
                ->get();

            if($pet){
                return response()->json([
                    "status" => 200,
                    "data" => $pet
                ]);
            }
        }
        else{
            return response()->json([
                "status" => 400
            ]);
        }


    }

    public function createPet(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required",
            "category_fk" => "required",
            "tag_fk" => "required",
            "photoUrls" => "required",
            "status" => "required",
        ]);

        if($validatedData){
            $pet = new Pet();
            $pet->name = $validatedData['name'];
            $pet->category_fk = $validatedData['category_fk'];
            $pet->tag_fk = $validatedData['tag_fk'];
            $pet->photoUrls = $request->photoUrls;
            $pet->status = $validatedData['status'];
            $pet->save();

            if(!$pet->save()){
                return response()->json([
                    "status" => 400
                ]);
            }

            return response()->json([
                "status" => 200,
                "data" => $pet
            ]);
        }

        return response()->json([
            "status" => 405
        ]);
    }

    public function updatePet(Request $request)
    {
        $validatedData = $request->validate([
            "id" => "required",
            "name" => "required",
            "category_fk" => "required",
            "tag_fk" => "required",
            "status" => "required",
        ]);

        if($validatedData['id'] == 0 ){
            return response()->json([
                "status" => 400
            ]);
        }

        if($validatedData){
            $pet = Pet::find($validatedData['id']);
            if($pet != null){
                $pet->name = $validatedData['name'];
                $pet->category_fk = $validatedData['category_fk'];
                $pet->tag_fk = $validatedData['tag_fk'];
                $pet->photoUrls = $request->photoUrls;
                $pet->status = $validatedData['status'];
                $pet->save();

                if($pet->save()){
                    return response()->json([
                        "status" => 200,
                        "data" => $pet
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

    public function deletePet(Request $request)
    {
        if($request->id > 0){
            $pet = Pet::destroy($request->id);
            if(!$pet){
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
