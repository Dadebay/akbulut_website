<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromHeader
{
    /**
     * Read the Accept-Language header sent by the Flutter app and set
     * app()->setLocale() so that all API Resources return the correct
     * localised fields (_tk / _ru / _en).
     *
     * Supported values sent by the app: 'tk', 'ru', 'en'
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported = ['tk', 'ru', 'en'];

        $lang = $request->header('Accept-Language');

        if ($lang) {
            // Accept-Language may contain quality factors like "ru,en;q=0.9"
            // Take only the first token and strip regional subtags (e.g. "ru-RU" -> "ru")
            $primary = strtolower(explode(',', $lang)[0]);
            $primary = explode('-', $primary)[0];
            $primary = explode(';', $primary)[0];
            $primary = trim($primary);

            if (in_array($primary, $supported, true)) {
                app()->setLocale($primary);
            }
        }

        return $next($request);
    }
}
