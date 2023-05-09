<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Semester $semester): Response
    {
        return Response([
            'status' => 200,
            'data' => $semester->with('year')->get()
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
    public function store(Request $request, Semester  $semester): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'semester' => 'required|max:127',
        ]);
        
        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $semester->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Semester $semester): Response
    {
        return Response([
            'status' => '200',
            'data' => $semester
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester): Response
    {
        return Response([
            'status' => '200',
            'data' => $semester
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semester $semester): Response
    {
        $semester->semester = $request->semester;
        $semester->save();

        return Response([
            'status' => 200,
            'data' => $semester
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester): Response
    {
        $semester->delete();

        return Response([
            'status' => 200,
            'data' => $semester
        ], 200);
    }
}
