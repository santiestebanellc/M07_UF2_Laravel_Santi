<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateUrl
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $url = $request->input('img_url');

        // Verifica que la URL sea válida
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return redirect('/')->withErrors(['img_url' => 'URL de la imagen no válida']);
        }

        return $next($request);
    }
}
