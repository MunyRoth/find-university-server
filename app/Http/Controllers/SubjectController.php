<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Subject  $subject): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'major_id' => 'required|max:127',
            'year_id' => 'required|max:2',
            'semester_id' => 'required|max:2',
            'name_km' => 'required|max:63'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

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
            'message' => 'deleted successfully'
        ], 200);
    }
}
