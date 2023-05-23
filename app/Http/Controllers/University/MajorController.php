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
            'data' => $major->with('department')->get()
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
    public function store(Request $request, Major  $major): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'department_id' => 'required|max:127',
            'major_type_id' => 'required|max:127',
            'name_km' => 'required|max:127',
            'num_semesters' => 'required|max:2'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }
        $major->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major): Response
    {
        return Response([
            'status' => '200',
            'data' => $major
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Major $major): Response
    {
        return Response([
            'status' => '200',
            'data' => $major
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Major $major): Response
    {
        $major->major_type_id = $request->major_type_id;
        $major->name_km = $request->name_km;
        $major->name_en = $request->name_en;
        $major->save();

        return Response([
            'status' => 200,
            'data' => $major
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major): Response
    {
        $major->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully'
        ], 200);
    }
}
