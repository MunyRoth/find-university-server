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
            'data' => $department->get()
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
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department): Response
    {
        return Response([
            'status' => '200',
            'data' => $department->load('majors')
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department): Response
    {
        $department->name_km = $request->name_km;
        $department->name_en = $request->name_en;
        $department->save();

        return Response([
            'status' => 200,
            'data' => $department
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department): Response
    {
        $department->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully'
        ], 200);
    }
}
