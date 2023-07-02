<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Rate;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RateController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Rate $rate): Response
    {
        $user = Auth::guard('api')->user();

        // check email verification
        if ($user->hasVerifiedEmail() || $user->provider_id != '') {

            // get all from request
            $req = $request->all();

            // validate the request
            $validator = Validator::make($req, [
                'university_id' =>'required|integer',
                'rate' => 'required|integer|max:7'
            ]);

            if ($validator->fails()) {
                return Response([
                    'status' => 400,
                    'message' => $validator->errors()->first(),
                    'data' => ''
                ], 400);
            }

            if (!University::where('id', $request->university_id)->exists()) {
                return Response([
                    'status' => 404,
                    'message' => 'not found',
                    'data' => ''
                ], 404);
            }

            $isExists = Rate::where('user_id', $user->id)
                ->where('university_id', $request->university_id)
                ->first();

            if ($isExists) {

                $isExists->update([
                    'rate' => $request->rate
                ]);

                return Response([
                    'status' => 200,
                    'massage' => 'updated successfully',
                    'data' => ''
                ], 200);
            }

            $rate->user_id = $user->id;
            $rate->university_id = $request->university_id;
            $rate->rate = $request->rate;
            $rate->save();

            return Response([
                'status' => 201,
                'massage' => 'rated successfully',
                'data' => ''
            ], 201);
        }

        return Response([
            'status' => 403,
            'message' => 'your email is not verified',
            'data' => [
                'email' => $user->email
            ],
        ], 403);
    }

    /**
     * Display the specified resource.
     */
    public function showByUser(): Response
    {
        $user = Auth::guard('api')->user();

        $rates = Rate::where('user_id', $user->id)->get();

        return Response([
            'status' => 200,
            'massage' => 'success',
            'data' => $rates
        ], 200);
    }
    public function showByUserUniversity(string $universityId): Response
    {
        $user = Auth::guard('api')->user();

        $rates = Rate::where('user_id', $user->id)
            ->where('university_id', $universityId)
            ->get();

        if ($rates) {
            return Response([
                'status' => 200,
                'massage' => 'success',
                'data' => $rates
            ], 200);
        }

        return Response([
            'status' => 404,
            'message' => 'not found',
            'data' => ''
        ], 404);
    }
    public function showByUniversity(string $universityId): Response
    {
        $rates = Rate::where('university_id', $universityId)
            ->where('is_approved', true)
            ->get();

        if ($rates) {
            $data = [];
            foreach ($rates as $rate) {
                $user = User::where('id', $rate->user_id)->first();

                $data[] = [
                    'user_profile' => $user->profile,
                    'user_name' => $user->name,
                    'rate' => $rate->rate
                ];
            }

            return Response([
                'status' => 200,
                'massage' => 'got successfully',
                'data' => $data
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $user = Auth::guard('api')->user();

        $rate = Rate::where('id', $id)
            ->where('user_id', $user->id)
            ->first();

        if ($rate) {
            $rate->delete();

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
