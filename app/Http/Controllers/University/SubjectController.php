<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
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
            'message' => 'got successfully',
            'data' => $subject->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Subject  $subject): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'major_id' => 'required|integer',
            'year' => 'required|integer|max:15',
            'semester' => 'required|integer|max:31',
            'name_km' => 'required|string|max:63'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 400,
                'message' => $validator->errors()->first(),
                'data' => ''
            ], 400);
        }

        $subject->create($request->all());

        return Response([
            'status' => 201,
            'message' => 'created successfully',
            'data' => ''
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $subject = Subject::find($id);

        if ($subject) {
            return Response([
                'status' => 200,
                'message' => 'got successfully',
                'data' => $subject
            ], 200);
        }

        return Response([
            'status' => 404,
            'message' => 'not found',
            'data' => ''
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): Response
    {
        $subject = Subject::find($id);

        if ($subject) {
            if ($request->name_km != '') {
                $subject->update([
                    'name_km' => $request->name_km
                ]);
            }

            if ($request->name_en != '') {
                $subject->update([
                    'name_en' => $request->name_en
                ]);
            }

            return Response([
                'status' => 200,
                'message' => 'updated successfully',
                'data' => $subject
            ], 200);
        }

        return Response([
            'status' => 404,
            'message' => 'not found',
            'data' => ''
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): Response
    {
        $subject = Subject::find($id);

        if ($subject) {
            $subject->delete();

            return Response([
                'status' => 200,
                'message' => 'deleted successfully',
                'data' => ''
            ], 200);
        }

        return Response([
            'status' => 404,
            'message' => 'not found',
            'data' => ''
        ], 404);
    }
}
