<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VerifyEmailController extends Controller
{
    public function __invoke(Request $request): Response
    {
        $user = User::find($request->route('id'));

        if ($user->hasVerifiedEmail()) {
            return Response([
                'status' => 200,
                'message' => 'email is verified'
            ], 200);
//            return redirect(env('FRONT_URL') . '/email/verify/already-success');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return Response([
            'status' => 200,
            'massage' => 'your account has been verified already'
        ], 200);
//        return redirect(env('FRONT_URL') . '/email/verify/success');
    }
}
