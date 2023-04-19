<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subject $subject): Response
    {
        return Response([
            'status' => 200,
            'data' => $subject->with('semester')->get()
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
    public function store(Request $request, Subject  $subject): Response
    {
        $subject->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subject $subject): Response
    {
        return Response([
            'status' => '200',
            'data' => $subject
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject): Response
    {
        return Response([
            'status' => '200',
            'data' => $subject
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject): Response
    {
        $subject->name_km = $request->name_km;
        $subject->name_en = $request->name_en;
        $subject->save();

        return Response([
            'status' => 200,
            'data' => $subject
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject): Response
    {
        $subject->delete();

        return Response([
            'status' => 200,
            'data' => $subject
        ], 200);
    }
}
