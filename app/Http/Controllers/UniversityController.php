<?php

namespace App\Http\Controllers;

use App\Models\University;
use App\Models\UniversityType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(University $universities): Response
    {
        return Response([
            'status' => 200,
            'data' => $universities->with('UniversityType')->get()
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $universityType = UniversityType::pluck('type', 'id');

        return Response([
            'status' => 200,
            'universityTypes' => $universityType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, University  $university): Response
    {
        $university->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university): Response
    {
        return Response([
            'status' => '200',
            'data' => $university
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(University $university): Response
    {
        return Response([
            'status' => '200',
            'data' => $university
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University  $university): Response
    {
        $university->name_km = $request->name_km;
        $university->name_en = $request->name_en;
        $university->about_km = $request->about_km;
        $university->about_en = $request->about_en;
        $university->logo = $request->logo;
        $university->website = $request->website;
        $university->email = $request->email;
        $university->phone = $request->phone;
        $university->images = $request->images;
        $university->save();

        return Response([
            'status' => 200,
            'data' => $university
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university): Response
    {
        $university->delete();

        return Response([
            'status' => 200,
            'data' => $university
        ], 200);
    }
}
