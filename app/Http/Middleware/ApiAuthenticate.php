<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Helper;

class ApiAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    const API_KEY_HEADER = 'x-api-key';

    public function handle(Request $request, Closure $next)
    {
        $token = $request->header(self::API_KEY_HEADER);

        if ($token === null || $token != config('services.api.token')) {
            return Helper::sendError('Не авторизований', [], 401);
        }

        return $next($request);
    }
}
