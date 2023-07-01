<?php

namespace App\Http\Controllers;

use App\Models\UniversityBranch;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Province $province): Response
    {
        return Response([
            'status' => 200,
            'data' => $province->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Province $province): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'name_km' => 'required|string|max:127'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $province->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Province $province): Response
    {
        return Response([
            'status' => 200,
            'data' => $province
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Province $province): Response
    {
        $province->province = $request->province;
        $province->save();

        return Response([
            'status' => 200,
            'data' => $province
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Province $province): Response
    {
        $province->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully'
        ], 200);
    }
}
