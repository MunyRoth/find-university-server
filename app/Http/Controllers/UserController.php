<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    private const PROVIDERS = [
        'google'
    ];

    /**
     * Register a new user
     */
    public function register(Request $request): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'email' =>'required|email|max:255',
            'name' =>'required|max:255',
            'password' =>'required|min:8',
            'cfPassword' =>'required|same:password',
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $req = $request->all();

        // Check if email is registered
        if (User::where('email', $req['email'])->exists()){
            return Response([
                'status' => 200,
                'massage' => 'your email address is already registered',
            ], 200);
        }

        $req['role'] = 'user';
        $req['password'] = bcrypt($req['password']);

        // store to database
        $user = User::create($req);

        // send confirmation email
        event(new Registered($user));

        return Response([
            'status' => 201,
            'massage' => 'register successful',
            'token' => $user->createToken(env('API_AUTH_TOKEN_PASSPORT'))->accessToken,
        ], 201);
    }

    /**
     * Login the user
     */
    public function login(Request $request): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'email' =>'required|email|max:255',
            'password' =>'required|min:8',
        ]);

        if ($validator->fails()){
            return Response([
                'status' => 403,
                'massage' => 'validation failed'
            ], 403);
        }

        $req = $request->all();

        // check email and password
        if (!Auth::attempt($req)) {
            return Response([
                'status' => 403,
                'message' => 'wrong email or password'
            ], 403);
        }

        $user = Auth::user();

        return Response([
            'status' => 200,
            'message' => 'login successful',
            'token' => $user->createToken(env('API_AUTH_TOKEN_PASSPORT'))->accessToken
        ], 200);
    }

    /**
     * Social Login
     */
    public function redirectToProvider($provider): Response
    {
        if(!in_array($provider, self::PROVIDERS)){
            return Response([
                'status' => 200,
                'message' => 'incorrect provider',
            ], 200);
        }

        return Response([
            'status' => 200,
            'provider_redirect' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl()
        ], 200);
    }

    public function handleProviderCallback($provider): Response
    {
        if(!in_array($provider, self::PROVIDERS)){
            return Response([
                'status' => 200,
                'message' => 'provider not found',
            ], 200);
        }

        try {
            $providerUser = Socialite::driver($provider)->stateless()->user();

            $user = User::where('provider_name', $provider)
                ->where('provider_id', $providerUser->getId())
                ->first();

            if ($user) {
                return Response([
                    'status' => 200,
                    'message' => 'login successful',
                    'token' => $user->createToken(env('API_AUTH_TOKEN_PASSPORT_SOCIAL'))->accessToken
                ], 200);
            }

            $user = User::create([
                'provider_name' => $provider,
                'provider_id' => $providerUser->getId(),
                'avatar' => $providerUser->getAvatar(),
                'role' => 'user',
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
            ]);

            return Response([
                'status' => 201,
                'message' => 'register successful',
                'token' => $user->createToken(env('API_AUTH_TOKEN_PASSPORT_SOCIAL'))->accessToken
            ], 201);

//                return redirect(env('CLIENT_SITE'));
        }
        catch (Exception $e) {
            return Response([
                'status' => 500,
                'error' => $e
            ], 500);
        }
    }

    public function logout(): Response
    {
        // check authorization
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

    public function getUser(): Response
    {
        // check authorization
        if (Auth::guard('api')->check()){
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
                'status' => 200,
                'message' => 'your email is not verified',
            ], 200);
        }

        return Response([
            'status' => 401,
            'massage' => 'unauthorized'
        ], 401);
    }

    public function editUser(Request $request): Response
    {
        // check authorization
        if (Auth::guard('api')->check()){
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
                'status' => 200,
                'message' => 'your email is not verified',
            ], 200);
        }

        return Response([
            'status' => 401,
            'massage' => 'unauthorized'
        ], 401);
    }
}
