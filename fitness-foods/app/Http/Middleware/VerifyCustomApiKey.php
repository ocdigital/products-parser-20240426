<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyCustomApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = config('app.custom_api_key');

        $apiKeyIsValid = (
            ! empty($apiKey) && $request->header('X-Custom-API-Key') === $apiKey
        );

        abort_if(! $apiKeyIsValid, 403, 'Unauthorized (Invalid API Key)');

        return $next($request);
    }
}
