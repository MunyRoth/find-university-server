<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('api')->user();

        if (!$user || ($user->role !== config('settings.roles.admin'))) {
            return Response([
                'status' => 403,
                'message' => 'you are not allowed to access this.'
            ], 403);
        }

        return $next($request);
    }
}
