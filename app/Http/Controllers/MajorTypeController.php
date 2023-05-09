<?php

namespace App\Http\Controllers;

use App\Models\MajorType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MajorTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MajorType $majorType): Response
    {
        return Response([
            'status' => 200,
            'data' => $majorType->with('department')->get()
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
    public function store(Request $request, MajorType  $majorType): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'name_km' => 'required|max:127'
        ]);
                        
        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }
        
        $majorType->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MajorType $majorType): Response
    {
        return Response([
            'status' => '200',
            'data' => $majorType
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MajorType $majorType): Response
    {
        return Response([
            'status' => '200',
            'data' => $majorType
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MajorType $majorType): Response
    {
        $majorType->name_km = $request->name_km;
        $majorType->name_en = $request->name_en;
        $majorType->save();

        return Response([
            'status' => 200,
            'data' => $majorType
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MajorType $majorType): Response
    {
        $majorType->delete();

        return Response([
            'status' => 200,
            'data' => $majorType
        ], 200);
    }
}
