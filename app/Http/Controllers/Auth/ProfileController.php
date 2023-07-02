<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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
                'massage' => 'got profile successfully',
                'data' => $user
            ],200);
        }

        return Response([
            'status' => 403,
            'message' => 'your email is not verified',
            'data' => [
                'email' => $user->email
            ],
            'email' => $user->email,
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

            if (!empty($request->avatar))
            {
                // delete the old image file.
                $avatarUrl = $userUpdate->avatar;
                preg_match("/\/v(\d+)\/(\w+)\/(\w+)/",$avatarUrl,$recordMatch);
                $id = $recordMatch[2].'/'.$recordMatch[3];
                Cloudinary::destroy($id);

                // upload new file
                $avatarUrl = Cloudinary::upload($request->file('avatar')->getRealPath(), [
                    'folder' => 'find_university'
                ])->getSecurePath();

                // update in table
                $userUpdate->update(['avatar' => $avatarUrl]);
            }

            if ($request->name != '') {
                $userUpdate->update(['name' => $request->name]);
            }

            return Response([
                'status' => 200,
                'message' => 'updated successfully',
                'data' => ''
            ], 200);
        }

        return Response([
            'status' => 403,
            'message' => 'your email is not verified',
            'data' => ''
        ], 403);
    }
}
