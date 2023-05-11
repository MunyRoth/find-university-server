<?php

namespace App\Http\Controllers;

use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(University $universities): Response
    {
        return Response([
            'status' => 200,
            'data' => $universities->with('universityType', 'universityBranches')->get()
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, University  $university): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'university_type_id' => 'required|max:2',
            'name_km' => 'required|max:255',
            'about_km' => 'required|max:255',
            'logo' => 'required|image|mimes:jpeg,jpg,png|max:4095'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $logo = $request->logo;
        $logoName = time().'logo.'.$logo->extension();
        $logo->storeAs("/images", $logoName);

        $imageName = null;
        if (!empty($request->file('image')))
        {
            $image = $request->image;
            $imageName = time().'image.'.$image->extension();
            $image->storeAs("/images", $imageName);
        }

        $university->university_type_id = $request->university_type_id;
        $university->logo = $logoName;
        $university->name_km = $request->name_km;
        $university->name_en = $request->name_en;
        $university->about_km = $request->about_km;
        $university->about_en = $request->about_en;
        $university->website = $request->website;
        $university->email = $request->email;
        $university->phone = $request->phone;
        $university->images = $imageName;
        $university->save();

        return Response([
            'status' => 201,
            'data' => $university,
            'message' => 'uploaded successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(University $university): Response
    {
        return Response([
            'status' => '200',
            'data' => $university->load('universityType', 'universityBranches', 'faculties.departments.majors.subjects')
        ], 200);
    }
    public function getLogo($name): Response
    {
        $path = storage_path('app/images/' . $name);

        if (!File::exists($path)) {
            return Response([
                'status' => '404',
            ], 404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return Response($file, 200)->header("Content-Type", $type);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, University $university): Response
    {
        $logo = $request->logo;
        $logoName = time().'logo.'.$logo->extension();
        $logo->storeAs("/images", $logoName);

        $imageName = null;
        if (!empty($request->file('image')))
        {
            $image = $request->image;
            $imageName = time().'image.'.$image->extension();
            $image->storeAs("/images", $imageName);
        }

        $university->university_type_id = $request->university_type_id;
        $university->logo = $logoName;
        $university->name_km = $request->name_km;
        $university->name_en = $request->name_en;
        $university->about_km = $request->about_km;
        $university->about_en = $request->about_en;
        $university->website = $request->website;
        $university->email = $request->email;
        $university->phone = $request->phone;
        $university->images = $imageName;
        $university->save();

        return Response([
            'status' => 200,
            'message' => 'updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(University $university): Response
    {
        $university->delete();

        return Response([
            'status' => 200,
            'message' => 'deleted successfully'
        ], 200);
    }
}
