<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch): Response
    {
        return Response([
            'status' => 200,
            'data' => $branch->get()
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
    public function store(Request $request, Branch $branch): Response
    {
        $branch->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch): Response
    {
        return Response([
            'status' => 200,
            'data' => $branch
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch): Response
    {
        return Response([
            'status' => 200,
            'data' => $branch
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch): Response
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
    public function destroy(Branch $branch): Response
    {
        $branch->delete();

        return Response([
            'status' => 200,
            'data' => $branch
        ]);
    }
}
