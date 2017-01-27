<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Response;
use Illuminate\Auth\AuthManager;

class ApiDpossMiddleware
{

	public function __construct(AuthManager $auth) {
		$this->auth = $auth;
	}

	/**
	* Handle an incoming request.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @param  \Closure  $next
	     * @return mixed
	     */
	    public function handle($request, Closure $next)
	    {
            $user = $this->auth->setRequest($request)->user();

            if ($user) return $next($request);

            return Response::json([
                'error' => [
                    'code' => 'ERR-FORBIDDEN',
                    'http_code' => 401,
                    'message' =>'Unauthorized.',
                ]
            ], 401);
	    }
}
