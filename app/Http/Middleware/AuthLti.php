<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AuthLti
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ltik = $request->ltik;

        $ltiaasUrl =  config('lti.ltiaas.url');
        $ltiaasKey = config('lti.ltiaas.key');

        $token = $ltiaasKey . ":" . $ltik;

        $response = Http::withOptions([
            'verify' => false,
        ])
            ->withToken($token, 'LTIK-AUTH-V2')
            ->get($ltiaasUrl . '/api/idtoken');

        if ($response->failed()) {
            abort(403);
        }

        return $next($request);
    }
}
