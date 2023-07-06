<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Major $major): Response
    {
        return Response([
            'status' => 200,
            'message' => 'got successfully',
            'data' => $major->with('majorType', 'department', 'subjects')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Major  $major): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|integer',
            'major_type_id' => 'required|integer',
            'name_km' => 'required|string|max:127'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 400,
                'message' => $validator->errors()->first(),
                'data' => ''
            ], 400);
        }
        $major->create($request->all());

        return Response([
            'status' => 201,
            'message' => 'created successfully',
            'data' => ''
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $major = Major::find($id);

        if ($major) {
            return Response([
                'status' => 200,
                'message' => 'got successfully',
                'data' => $major->load('majorType', 'department', 'subjects')
            ], 200);
        }

        return Response([
            'status' => 404,
            'message' => 'not found',
            'data' => ''
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): Response
    {
        $major = Major::find($id);

        if ($major) {
            if ($request->major_type_id != '') {
                $major->update([
                    'major_type_id' => $request->major_type_id
                ]);
            }

            if ($request->name_km != '') {
                $major->update([
                    'name_km' => $request->name_km
                ]);
            }

            if ($request->name_en != '') {
                $major->update([
                    'name_en' => $request->name_en
                ]);
            }

            return Response([
                'status' => 200,
                'message' => 'updated successfully',
                'data' => $major
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
        $major = Major::find($id);

        if ($major) {
            $major->delete();

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
