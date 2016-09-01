<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
	 * @param array $roles
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
		if(!in_array($request->user()->getLevel(), $roles)){
			if($request->ajax() || $request->wantsJson()) {
				return response('Unauthorized!!!', 401);
			}
			else {
				return response('Unauthorized action', 403);
			}
		}
		return $next($request);
    }
}
