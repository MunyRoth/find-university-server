<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\HighSchoolSubject;
use App\Models\MajorSubject;
use App\Models\MajorType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class MajorSubjectController extends Controller
{
    public function store(Request $request, MajorSubject $majorSubject): Response
    {
        // get all from request
        $req = $request->all();

        // validate the request
        $validator = Validator::make($req, [
            'major_type_id' =>'required|string',
            'high_school_subject_id' => 'required|string',
            'is_needed' => 'required|boolean'
        ]);

        if ($validator->fails()){
            return Response([
                "status" => 400,
                "message" => $validator->errors()->first(),
                'data' => ''
            ], 400);
        }

        if(!MajorType::where('id', $request->major_type_id)->exists() || !HighSchoolSubject::where('id', $request->high_school_subject_id)->exists()) {
            return Response([
                'status' => 404,
                'message' => 'not found',
                'data' => ''
            ], 404);
        }

        $isExists = MajorSubject::where('major_type_id', $request->major_type_id)
            ->where('high_school_subject_id', $request->high_school_subject_id)
            ->first();

        if($isExists) {
            $isExists->update([
                'is_needed' => $request->is_needed
            ]);

            return Response([
                'status' => 200,
                'massage' => 'updated successfully',
                'data' => ''
            ], 200);
        }

        $majorSubject->create($req);

        return Response([
            'status' => 201,
            'massage' => 'created successfully',
            'data' => ''
        ], 201);
    }
}
