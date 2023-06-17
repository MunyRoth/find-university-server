<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function getProfile(): Response
    {
        $user = Auth::guard('api')->user();

        // check email verification
        if ($user->hasVerifiedEmail() || $user->provider_id != '') {
            return Response([
                'status' => 200,
                'massage' => 'success',
                'data' => $user
            ],200);
        }

        return Response([
            'status' => 403,
            'message' => 'your email is not verified',
            'email' => $user->email
        ], 403);
    }

    public function updateProfile(Request $request): Response
    {
        $user =  Auth::guard('api')->user();
        $userid = $user->id;
        $userUpdate = User::where('id', $userid);

        // check email verification
        if ($user->hasVerifiedEmail() || $user->provider_id != '') {

            if ($request->username != '') {
                $userUpdate->update(['username' => $request->username]);
            }

            if ($request->email != '') {
                $userUpdate->update(['email' => $request->email]);
            }

            if ($request->phone != '') {
                $userUpdate->update(['phone' => $request->phone]);
            }

            if ($request->avatar != '') {
                $userUpdate->update(['avatar' => $request->avatar]);
            }

            if ($request->name != '') {
                $userUpdate->update(['name' => $request->name]);
            }

            return Response([
                'status' => 200,
                'message' => 'updated successfully'
            ]);
        }

        return Response([
            'status' => 403,
            'message' => 'your email is not verified',
        ], 403);
    }
}
