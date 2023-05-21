<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
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
        // get all from request
        $req = $request->all();

        // validate the request
        $validator = Validator::make($req, [
            'email' =>'required|email|max:255',
            'name' =>'required|max:255',
            'password' =>'required|min:8',
            'cfPassword' =>'required|same:password',
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

        // set role and Hash password
        $req['role'] = 'user';
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
     */
    public function login(Request $request): Response
    {
        // get all from request
        $req = $request->all();

        // validate the request
        $validator = Validator::make($req, [
            'email' =>'required|email|max:255',
            'password' =>'required|min:8',
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
     * Social Login
     */
    public function redirectToProvider($provider): Response
    {
        // check if provider exists
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
        // check if provider exists
        if(!in_array($provider, self::PROVIDERS)){
            return Response([
                'status' => 200,
                'message' => 'provider not found',
            ], 200);
        }

        try {
            // get user from provider
            $providerUser = Socialite::driver($provider)->stateless()->user();

            // query user from database
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

            // store user in database
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
        } catch (Exception $ex) {
            return Response([
                'status' => 500,
                'error' => $ex
            ], 500);
        }
    }

    public function logout(): Response
    {
        $user = Auth::user()->token();
        $user->revoke();

        return Response([
            'status' => 200,
            'massage' => 'logout successfully'
        ],200);
    }

    public function getUser(): Response
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
            'status' => 200,
            'message' => 'your email is not verified',
        ], 200);
    }

    public function editUser(Request $request): Response
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
            'status' => 200,
            'message' => 'your email is not verified',
        ], 200);
    }

    public function changePassword(Request $request): Response
    {
        // get user id
        $userid = Auth::guard('api')->user()->id;

        // validate the request
        $validator = Validator::make($request->all(), [
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8',
            'cfPassword' => 'required|same:newPassword'
        ]);

        if ($validator->fails()){
            return Response([
                "status" => 400,
                "message" => $validator->errors()->first()
            ], 400);
        }

        try {
            if (!(Hash::check(request('oldPassword'), Auth::user()->password))) {
                return Response([
                    "status" => 400,
                    "message" => "check your old password"
                ], 400);
            } else if ((Hash::check(request('newPassword'), Auth::user()->password))) {
                return Response(["status" => 400,
                    "message" => "please enter a password which is not similar then current password"
                ], 400);
            } else {
                User::where('id', $userid)->update(['password' => Hash::make($request->newPassword)]);
                return Response([
                    "status" => 200,
                    "message" => "password updated successfully."
                ], 200);
            }
        } catch (Exception $ex) {
            return Response([
                "status" => 500,
                "message" => $ex->errorInfo[2] ?? $ex->getMessage()
            ], 500);
        }
    }

    public function forgotPassword(Request $request): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'email' => "required|email"
        ]);

        if ($validator->fails()){
            return Response([
                "status" => 400,
                "message" => $validator->errors()->first()
            ], 400);
        }

        try {
            $response = Password::sendResetLink($request->only('email'));

            return match ($response) {
                Password::RESET_LINK_SENT => Response([
                    "status" => 200,
                    "message" => trans($response)
                ], 200),
                Password::INVALID_USER => Response([
                    "status" => 400,
                    "message" => trans($response)
                ], 400),
                default => Response([
                    "status" => 200,
                    "message" => 'success'
                ], 200),
            };

        } catch (\Swift_TransportException|Exception $ex) {
            return Response([
                "status" => 500,
                "message" => $ex->getMessage(),
            ], 500);
        }
    }

    public function resetPassword(Request $request): Response
    {
        // validate the request
        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', RulesPassword::defaults()],
        ]);

        if ($validator->fails()){
            return Response([
                "status" => 400,
                "message" => $validator->errors()->first()
            ], 400);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'cfPassword', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])->save();

                $user->tokens()->delete();

                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return Response([
                'message'=> 'password reset successfully'
            ]);
        }

        return Response([
            'message'=> __($status)
        ], 500);
    }
}
