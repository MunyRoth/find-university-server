<?php

namespace App\Http\Controllers;

use App\Models\UniversityBranch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UniversityBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UniversityBranch $branch): Response
    {
        return Response([
            'status' => 200,
            'data' => $branch->with('province')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UniversityBranch $branch): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'university_id' => 'required|max:127',
            'province_id' => 'required|max:63',
            'address_km' => 'required|max:127',
            'location' => 'required|max:65535'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $branch->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(UniversityBranch $branch): Response
    {
        return Response([
            'status' => 200,
            'data' => $branch->load('province')
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UniversityBranch $branch): Response
    {
        return Response([
            'status' => 200,
            'data' => $branch
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UniversityBranch $branch): Response
    {
        $branch->university_id = $request->university_id;
        $branch->province_id = $request->province_id;
        $branch->address_km = $request->address_km;
        $branch->address_en = $request->address_en;
        $branch->save();

        return Response([
            'status' => 200,
            'data' => $branch
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UniversityBranch $branch): Response
    {
        $branch->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully'
        ], 200);
    }
}
