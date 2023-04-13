<?php

namespace App\Http\Controllers;

use App\Models\UniversityType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $universityType->type = $request->type;
        $universityType->save();

        return Response([
            'status' => 200,
            'data' => $universityType
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(UniversityType $universityType): Response
    {
        return Response([
            'status' => 200,
            'data' => $universityType
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UniversityType $universityType)
    {
        //
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
        ]);
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
