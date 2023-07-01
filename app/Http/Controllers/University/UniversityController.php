<?php

namespace App\Http\Controllers\University;

use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(University $universities): Response
    {
        return Response([
            'status' => 200,
            'message' => 'got successfully',
            'data' => $universities->with('universityType', 'universityBranches.province')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, University  $university): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'university_type_id' => 'required|string|max:2',
            'name_km' => 'required|string|max:255',
            'about_km' => 'required|string|max:65535',
            'logo' => 'required|image|mimes:jpeg,jpg,png|max:8095' // kilobytes
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed',
                'data' => $request->all(),
            ], 403);
        }

        $logoUrl = Cloudinary::upload($request->file('logo')->getRealPath(), [
            'folder' => 'find_university'
        ])->getSecurePath();

        $university->university_type_id = $request->university_type_id;
        $university->logo = $logoUrl;
        $university->name_km = $request->name_km;
        $university->name_en = $request->name_en;
        $university->about_km = $request->about_km;
        $university->about_en = $request->about_en;
        $university->website = $request->website;
        $university->email = $request->email;
        $university->phone = $request->phone;
        $university->save();

        return Response([
            'status' => 201,
            'message' => 'uploaded successfully',
            'data' => $university
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id): Response
    {
        $university = University::find($id);
        if ($university) {
            return Response([
                'status' => 200,
                'message' => 'got successfully',
                'data' => $university->load('universityType', 'universityBranches.province', 'faculties.departments.majors.subjects', 'images')
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
        $university = University::find($id);

        if ($university) {
            // update logo
            if (!empty($request->logo))
            {
                // Delete the old image file.
                $logoUrl = $university->logo;
                preg_match("/\/v(\d+)\/(\w+)\/(\w+)/",$logoUrl,$recordMatch);
                $id = $recordMatch[2].'/'.$recordMatch[3];
                Cloudinary::destroy($id);

                //upload new file
                $logoUrl = Cloudinary::upload($request->file('logo')->getRealPath(), [
                    'folder' => 'find_university'
                ])->getSecurePath();

                //update in table
                $university->update([
                    'logo' => $logoUrl
                ]);
            }

            if ($request->name_km != '') {
                $university->update([
                    'name_km' => $request->name_km
                ]);
            }

            if ($request->name_en != '') {
                $university->update([
                    'name_en' => $request->name_en
                ]);
            }

            if ($request->about_km != '') {
                $university->update([
                    'about_km' => $request->about_km
                ]);
            }

            if ($request->about_en != '') {
                $university->update([
                    'about_en' => $request->about_en
                ]);
            }

            if ($request->website != '') {
                $university->update([
                    'website' => $request->website
                ]);
            }

            if ($request->email != '') {
                $university->update([
                    'email' => $request->email
                ]);
            }

            if ($request->phone != '') {
                $university->update([
                    'phone' => $request->phone
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
        $university = University::find($id);

        if ($university) {
            // delete logo
            $logoUrl = $university->logo;
            preg_match("/\/v(\d+)\/(\w+)\/(\w+)/",$logoUrl,$recordMatch);
            $id = $recordMatch[2].'/'.$recordMatch[3];
            Cloudinary::destroy($id);

            $university->delete();

            return Response([
                'status' => 200,
                'message' => 'deleted successfully'
            ], 200);
        }

        return Response([
            'status' => 404,
            'message' => 'not found',
            'data' => ''
        ], 404);
    }
}
