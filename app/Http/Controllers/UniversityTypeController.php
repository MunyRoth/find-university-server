<?php

namespace App\Http\Controllers;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UniversityType $universityType): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'type_km' => 'required|max:127',
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
     * Display the specified resource.
     */
    public function show(UniversityType $universityType): Response
    {
        return Response([
            'status' => 200,
            'data' => $universityType
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UniversityType $universityType): Response
    {
        return Response([
            'status' => 200,
            'data' => $universityType
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UniversityType $universityType): Response
    {
        $universityType->type = $request->type;
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
            'data' => $universityType
        ]);
    }
}
