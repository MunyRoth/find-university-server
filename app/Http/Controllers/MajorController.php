<?php

namespace App\Http\Controllers;

use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
        $major->major_type_id = $major->major_type_id;
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
            'data' => $major
        ], 200);
    }
}
