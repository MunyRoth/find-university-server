<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Faculty $faculty): Response
    {
        return Response([
            'status' => 200,
            'data' => $faculty->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Faculty  $faculty): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'university_id' => 'required|string|max:127',
            'name_km' => 'required|string|max:127'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $faculty->create($request->all());

        return Response([
            'status' => 201,
            'data' => $request->all()
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Faculty $faculty): Response
    {
        return Response([
            'status' => '200',
            'data' => $faculty->load('departments')
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faculty  $faculty): Response
    {
        $faculty->name_km = $request->name_km;
        $faculty->name_en = $request->name_en;
        $faculty->save();

        return Response([
            'status' => 200,
            'data' => $faculty
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faculty $faculty): Response
    {
        $faculty->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully'
        ], 200);
    }
}
