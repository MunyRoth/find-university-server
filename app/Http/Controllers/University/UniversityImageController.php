<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\UniversityImage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UniversityImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UniversityImage $universityImage): Response
    {
        return Response([
            'status' => 200,
            'message' => 'got successfully',
            'data' => $universityImage->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, UniversityImage $universityImage): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'university_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:8095' // kilobytes
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 400,
                'message' => $validator->errors()->first(),
                'data' => ''
            ], 400);
        }

        $imageUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'find_university'
        ])->getSecurePath();

        $universityImage->university_id = $request->university_id;
        $universityImage->image_url = $imageUrl;
        $universityImage->save();

        return Response([
            'status' => 201,
            'message' => 'uploaded successfully',
            'data' => ''
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UniversityImage $universityImage): Response
    {
        $universityImage->image_url = $request->image_url;
        $universityImage->save();

        return Response([
            'status' => 200,
            'message' => 'updated successfully',
            'data' => $universityImage
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UniversityImage $universityImage): Response
    {
        $universityImage->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully',
            'data' => ''
        ], 200);
    }
}
