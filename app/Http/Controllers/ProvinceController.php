<?php

namespace App\Http\Controllers;

use App\Models\UniversityBranch;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Province $province): Response
    {
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
     * Show the form for editing the specified resource.
     */
    public function edit(Province $province): Response
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
            'data' => $province
        ]);
    }
}
