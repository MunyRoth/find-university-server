<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\UniversityBranch;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UniversityBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UniversityBranch $branch): Response
    {
        return Response([
            'status' => 200,
            'message' => 'got successfully',
            'data' => $branch->with('province')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UniversityBranch $branch): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'university_id' => 'required|integer',
            'province_id' => 'required|integer|max:63',
            'address_km' => 'required|string|max:127',
            'location' => 'required|string|max:65535'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 400,
                'message' => $validator->errors()->first(),
                'data' => ''
            ], 400);
        }

        return Response([
            'status' => 201,
            'message' => 'created successfully',
            'data' => $branch->create($request->all())
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $branch = UniversityBranch::find($id);

        if($branch) {
            return Response([
                'status' => 200,
                'message' => 'got successfully',
                'data' => $branch->load('province')
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
        $branch = UniversityBranch::find($id);

        if ($branch) {
            if ($request->province_id != '') {
                $branch->update([
                    'province_id' => $request->province_id
                ]);
            }

            if ($request->address_km != '') {
                $branch->update([
                    'address_km' => $request->address_km
                ]);
            }

            if ($request->address_en != '') {
                $branch->update([
                    'address_en' => $request->address_en
                ]);
            }

            if ($request->location != '') {
                $branch->update([
                    'location' => $request->location
                ]);
            }

            return Response([
                'status' => 200,
                'message' => 'updated successfully',
                'data' => ''
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
        $branch = UniversityBranch::find($id);

        if ($branch) {
            $branch->delete();

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
