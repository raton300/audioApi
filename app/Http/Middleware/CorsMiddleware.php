<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware
{
    public function handle($request, Closure $next)
    {
        // Si la requête est OPTIONS, répondre directement sans passer par la logique de l'application
        if ($request->isMethod('OPTIONS')) {
            $headers = [
                'Access-Control-Allow-Methods' => ' OPTIONS',
            ];


            return response('', 200)->withHeaders($headers);
        }

        return $next($request);
    }





}

