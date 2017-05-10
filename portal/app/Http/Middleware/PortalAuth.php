<?php

namespace App\Http\Middleware;

use Closure;

class PortalAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->session()->get('authenticated') !== true)
        {
            return redirect("/")->withError(trans("errors.notAuthenticated"));
        }
        return $next($request);
    }
}
