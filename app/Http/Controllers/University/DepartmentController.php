<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Department $department): Response
    {
        return Response([
            'status' => 200,
            'message' => 'got successfully',
            'data' => $department->with('majors')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Department  $department): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'faculty_id' => 'required|integer',
            'name_km' => 'required|string|max:127'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 400,
                'message' => $validator->errors()->first(),
                'data' => ''
            ], 400);
        }

        $department->create($request->all());

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
        $department = Department::find($id);

        if ($department) {
            return Response([
                'status' => 200,
                'message' => 'got successfully',
                'data' => $department->load('majors')
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
        $department = Department::find($id);

        if ($department) {
            if ($request->name_km != '') {
                $department->update([
                    'name_km' => $request->name_km
                ]);
            }

            if ($request->name_en != '') {
                $department->update([
                    'name_en' => $request->name_en
                ]);
            }

            return Response([
                'status' => 200,
                'message' => 'updated successfully',
                'data' => $department
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
        $department = Department::find($id);

        if ($department) {
            $department->delete();

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
