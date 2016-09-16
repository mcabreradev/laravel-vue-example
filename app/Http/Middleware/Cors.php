<?php
namespace App\Http\Middleware;
use Closure;
use Response;

/**
 * Class Cors
 * @package App\Http\Middleware
 */
class Cors
{
    /**
     * Handle an incoming request.
     *
     * Please add header('Access-Control-Allow-Origin: http://example.com');
     * & header('Access-Control-Allow-Credentials: true');
     * at the top of your route file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // ALLOW OPTIONS METHOD
        $headers = [
            'Access-Control-Allow-Origin'  => '*',
            'Access-Control-Allow-Methods' => 'POST, GET, OPTIONS, PUT, DELETE',
            'Access-Control-Allow-Headers' => 'Content-Type, X-Auth-Token, Origin, Authorization'
        ];

        if ($request->getMethod() === 'OPTIONS') {
            // The client-side application can set only headers allowed in Access-Control-Allow-Headers
            return Response::make('OK', 200, $headers);
        }

        $response = $next($request);

        foreach ($headers as $key => $value) {
            $response->header($key, $value);
        }

        return $response;




        // $response = $next($request);

        // $response->header('Access-Control-Allow-Origin', '*')
        //     ->header('Access-Control-Allow-Methods', 'POST, GET, OPTIONS, PUT, DELETE')
        //     ->header('Access-Control-Allow-Headers', 'accept, content-type, x-xsrf-token, x-csrf-token'); // Add any required headers here;

        // return $response;
    }
}
