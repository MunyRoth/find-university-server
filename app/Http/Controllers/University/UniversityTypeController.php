<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\UniversityType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UniversityTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UniversityType $universityTypes): Response
    {
        return Response([
            'status' => 200,
            'data' => $universityTypes->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UniversityType $universityType): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'type_km' => 'required|string|max:31'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $universityType->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UniversityType $universityType): Response
    {
        $universityType->type_km = $request->type_km;
        $universityType->type_en = $request->type_en;
        $universityType->save();

        return Response([
            'status' => 200,
            'data' => $universityType
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UniversityType $universityType): Response
    {
        $universityType->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully'
        ], 200);
    }
}
