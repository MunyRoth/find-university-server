<?php

namespace App\Http\Controllers;

use App\Models\MajorType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MajorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MajorType $majorType): Response
    {
        return Response([
            'status' => 200,
            'message' => 'got successfully',
            'data' => $majorType->with('majors', 'subjects')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, MajorType  $majorType): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'name_km' => 'required|string|max:127'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $majorType->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $majorType = MajorType::find($id);

        return Response([
            'status' => '200',
            'data' => $majorType
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): Response
    {
        $majorType = MajorType::find($id);

        if ($majorType) {
            if ($request->name_km != '') {
                $majorType->update([
                    'name_km' => $request->name_km
                ]);
            }

            if ($request->name_en != '') {
                $majorType->update([
                    'name_en' => $request->name_en
                ]);
            }

            if ($request->subjects != '') {
                $majorType->subjects()->sync($request->subjects);
            }

            return Response([
                'status' => 200,
                'message' => 'updated successfully',
                'data' => ''
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
        $majorType = MajorType::find($id);

        $majorType->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully'
        ], 200);
    }
}
