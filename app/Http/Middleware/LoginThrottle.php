<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Cache\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class LoginThrottle
{
    protected $limiter;

    public function __construct(RateLimiter $limiter)
    {
        $this->limiter = $limiter;
    }

    public function handle($request, Closure $next, $maxAttempts, $decayMinutes)
    {
        $key = $request->ip();

        if ($this->limiter->tooManyAttempts($key, $maxAttempts)) {
            return $this->buildCustomResponse();
        }

        $this->limiter->hit($key, $decayMinutes * 60);

        $response = $next($request);

        return $this->addHeaders(
            $response,
            $this->limiter->availableIn($key)
        );
    }

    protected function buildCustomResponse(): Response
    {
        return \response()->json([
            'status' => 500,
            'message' => __('messages.validation.Login_throttle'),
            'errors' => [
                'message' => [__('messages.validation.Login_throttle')]
            ]

        ], 500);
    }

    protected function addHeaders($response, $retryAfter)
    {
        return $response->withHeaders([
            'Retry-After' => $retryAfter,
        ]);
    }
}
