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
            'message' => 'got successfully',
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
                'status' => 400,
                'message' => $validator->errors()->first(),
                'data' => ''
            ], 400);
        }

        $universityType->create($request->all());

        return Response([
            'status' => 201,
            'message' => 'created successfully',
            'data' => ''
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): Response
    {
        $universityType = UniversityType::find($id);

        if ($universityType) {
            if ($request->type_km != '') {
                $universityType->update([
                    'type_km' => $request->type_km
                ]);
            }

            if ($request->type_en != '') {
                $universityType->update([
                    'type_en' => $request->type_en
                ]);
            }

            return Response([
                'status' => 200,
                'message' => 'updated successfully',
                'data' => $universityType
            ], 200);
        }

        return Response([
            'status' => 404,
            'message' => 'not found',
            'data' => ''
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): Response
    {
        $universityType = UniversityType::find($id);

        if ($universityType) {
            $universityType->delete();

            return Response([
                'status' => 200,
                'message' => 'deleted successfully',
                'data' => ''
            ], 200);
        }

        return Response([
            'status' => 404,
            'message' => 'not found',
            'data' => ''
        ], 404);
    }
}
