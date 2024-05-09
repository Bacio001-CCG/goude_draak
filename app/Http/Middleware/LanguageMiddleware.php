<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LanguageMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $language = session()->get('language');

        app()->setLocale($language);

        Log::info("Locale set to: " . $language . " (Selected language: " . $language . ")");

        return $next($request);
    }
}
