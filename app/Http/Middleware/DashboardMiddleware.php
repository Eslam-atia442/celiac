<?php

namespace App\Http\Middleware;

use App\Enums\UserTypeEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user() && !count($request->user()->roles)){
            $request->user()->currentAccessToken()->delete();
            return  response()->json(['message'=> __('messages.validation.you_do_not_have_permissions_to_use_the_dashboard')]);
        }

        if ($request->user() && $request->user()->type != UserTypeEnum::admin->value) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }


        return $next($request);
    }
}
