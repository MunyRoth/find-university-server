<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Register a new user
     */
    public function register(Request $request): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'email' =>'required|email|max:255',
            'fullName' =>'required|max:255',
            'password' =>'required|min:8',
            'cfPassword' =>'required|same:password'
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $req = $request->all();

        // Check if email is registered
        if (User::where('email', '=', $req['email'])->exists()){
            return Response([
                'status' => 200,
                'massage' => 'your email address is already registered',
            ], 200);
        }

        $req['password'] = bcrypt($req['password']);

        // store to database
        $user = User::create($req);

        // send confirmation email
        event(new Registered($user));

        return Response([
            'status' => 201,
            'massage' => 'register successful',
            'token' => $user->createToken('example')->accessToken,
        ], 201);
    }

    /**
     * Login the user
     */
    public function login(Request $request): Response
    {
        $req = $request->all();

        // check email and password
        if (!Auth::attempt($req)) {
            return Response([
                'status' => 403,
                'message' => 'invalid credentials'
            ], 403);
        }

        $user = Auth::user();
        $token = $user->createToken('example')->accessToken;
        return Response([
            'status' => 200,
            'message' => 'login successful',
            'token' => $token,
        ], 200);
    }

    public function logout(): Response
    {
        // check token
        if (Auth::guard('api')->check()){
            $accessToken = Auth::guard('api')->user()->token();

            \DB::table('oauth_refresh_tokens')
                ->where('access_token_id', $accessToken->id)
                ->update(['revoked' => 1]);
            $accessToken->revoke();

            return Response([
                'status' => 200,
                'massage' => 'logout successfully'
            ],200);
        }

        return Response([
            'status' => 401,
            'massage' => 'unauthorized'
        ], 401);
    }


    public function getDetail(): Response
    {
        // check token
        if (Auth::guard('api')->check()){
            $user = Auth::guard('api')->user();
            return Response([
                'status' => 200,
                'massage' => 'success',
                'data' => $user
            ],200);
        }

        return Response([
            'status' => 401,
            'massage' => 'unauthorized'
        ], 401);
    }
}
