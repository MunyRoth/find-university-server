<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Faculty $faculty): Response
    {
        return Response([
            'status' => 200,
            'message' => 'got successfully',
            'data' => $faculty->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Faculty  $faculty): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'university_id' => 'required|integer',
            'name_km' => 'required|string|max:127'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => $validator->messages(),
                'data' => ''
            ], 403);
        }

        return Response([
            'status' => 201,
            'message' => 'created successfully',
            'data' => $faculty->create($request->all())
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $faculty = Faculty::find($id);

        if($faculty) {
            return Response([
                'status' => '200',
                'message' => 'got successfully',
                'data' => $faculty->load('departments')
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
        $faculty = Faculty::find($id);

        if($faculty) {
            if ($request->name_km != '') {
                $faculty->update([
                    'name_km' => $request->name_km
                ]);
            }

            if ($request->name_en != '') {
                $faculty->update([
                    'name_en' => $request->name_en
                ]);
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
        $faculty = Faculty::find($id);

        if($faculty) {
            $faculty->delete();

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
