<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Year $year): Response
    {
        return Response([
            'status' => 200,
            'data' => $year->with('major')->get()
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
    public function store(Request $request, Year  $year): Response
    {
        $year->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Year $year): Response
    {
        return Response([
            'status' => '200',
            'data' => $year
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Year $year): Response
    {
        return Response([
            'status' => '200',
            'data' => $year
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Year $year): Response
    {
        $year->year = $request->year;
        $year->save();

        return Response([
            'status' => 200,
            'data' => $year
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Year $year): Response
    {
        $year->delete();

        return Response([
            'status' => 200,
            'data' => $year
        ], 200);
    }
}
