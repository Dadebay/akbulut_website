<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SkipLocalizationForAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
	       if ($request->is('admin') || $request->is('admin/*')) {
        // Отключаем локализацию
        if (app()->bound('laravellocalization')) {
            app()->forgetInstance('laravellocalization');
        }

        // Удаляем все флаги редиректа пакета
	app()->setLocale(config('app.fallback_locale'));
	config([
            'laravellocalization.useAcceptLanguageHeader' => false,
            'laravellocalization.hideDefaultLocaleInURL' => true,
        ]);
    }

    return $next($request);
    }
}
