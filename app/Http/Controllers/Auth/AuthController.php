<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    private const PROVIDERS = [
        'google'
    ];

    /**
     * Register a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function register(Request $request): Response
    {
        // get all from request
        $req = $request->all();

        // validate the request
        $validator = Validator::make($req, [
            'name' =>'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|confirmed'
        ]);

        if ($validator->fails()){
            return Response([
                "status" => 400,
                "message" => $validator->errors()->first()
            ], 400);
        }

        // Check if email is registered
        if (User::where('email', $req['email'])->exists()){
            return Response([
                'status' => 200,
                'massage' => 'your email address is already registered',
            ], 200);
        }

        // set Hash password
        $req['password'] = Hash::make($req['password']);

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
     *
     * @param  Request  $request
     * @return Response
     */
    public function login(Request $request): Response
    {
        // get all from request
        $req = $request->all();

        // validate the request
        $validator = Validator::make($req, [
            'email' => 'required|email|max:255',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails()){
            return Response([
                "status" => 400,
                "message" => $validator->errors()->first()
            ], 400);
        }

        // check email and password
        if (!Auth::attempt($req)) {
            return Response([
                'status' => 403,
                'message' => 'wrong email or password'
            ], 403);
        }

        // get user from database
        $user = Auth::user();

        return Response([
            'status' => 200,
            'message' => 'login successful',
            'token' => $user->createToken(env('API_AUTH_TOKEN_PASSPORT'))->accessToken
        ], 200);
    }

    /**
     * Logout the user
     *
     * @return Response
     */
    public function logout(): Response
    {
        $user = Auth::user()->token();
        $user->revoke();

        return Response([
            'status' => 200,
            'massage' => 'logout successfully'
        ],200);
    }

    /**
     * Social login:redirect to provider.
     *
     * @param $provider
     * @return RedirectResponse
     */
    public function redirectToProvider($provider): RedirectResponse
    {
        // check if provider exists
        if(!in_array($provider, self::PROVIDERS)){
            return redirect(env('FRONT_URL') . '/providers/notfound');
        }

        return redirect(Socialite::driver($provider)->stateless()->redirect()->getTargetUrl());
    }

    /**
     * Social login:handle provider callback.
     *
     * @param $provider
     * @return RedirectResponse
     */
    public function handleProviderCallback($provider): RedirectResponse
    {
        // check if provider exists
        if(!in_array($provider, self::PROVIDERS)){
            return redirect(env('FRONT_URL') . '/providers/notfound');
        }

        try {
            // get user from provider
            $providerUser = Socialite::driver($provider)->stateless()->user();

            // query user from database
            $user = User::where('provider_name', $provider)
                ->where('provider_id', $providerUser->getId())
                ->first();

            if ($user) {
                return redirect(env('FRONT_URL') . '/login?token='.$user->createToken(env('API_AUTH_TOKEN_PASSPORT_SOCIAL'))->accessToken);
            }

            // store user in database
            $user = User::create([
                'provider_name' => $provider,
                'provider_id' => $providerUser->getId(),
                'avatar' => $providerUser->getAvatar(),
                'name' => $providerUser->getName(),
                'email' => $providerUser->getEmail(),
            ]);
            return redirect(env('FRONT_URL') . '/register?token='.$user->createToken(env('API_AUTH_TOKEN_PASSPORT_SOCIAL'))->accessToken);
        } catch (Exception $ex) {
            return redirect(env('FRONT_URL') . '/server?error='.$ex);
        }
    }
}
