<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CorsMiddleware {

    static function getEnvCorsDomain()
    {
        return env('CORS_DOMAIN');
    }

    public function handle($request, Closure $next)
    {
        $headers = [
           'Access-Control-Allow-Origin'      => self::getEnvCorsDomain(),
           'Access-Control-Allow-Methods'     => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Credentials' => 'true',
            'Access-Control-Max-Age'           => '86400',
            'Access-Control-Allow-Headers'     => 'access-control-allow-origin,authorization,content-type, x-request-with, x-requested-with',
        ];

        if ($request->isMethod('OPTIONS'))
        {
            return new Response('{"method":"OPTIONS"}', 200, $headers);
        }

        $response = $next($request);
        if($response instanceof BinaryFileResponse) {
            $response->headers->set('Access-Control-Allow-Origin', self::getEnvCorsDomain());
            return $response;
        }
        $response->header('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->header('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
        $response->header('Access-Control-Allow-Origin', self::getEnvCorsDomain());
        $response->header('Access-Control-Allow-Credentials', 'true');
        return $response;
    }
}
