<?php

namespace App\Http\Controllers;

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
            'data' => $department->with('faculty')->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Department  $department): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'faculty_id' => 'required|max:127',
            'name_km' => 'required|max:127'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
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
            'data' => $department
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department): Response
    {
        return Response([
            'status' => '200',
            'data' => $department
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
