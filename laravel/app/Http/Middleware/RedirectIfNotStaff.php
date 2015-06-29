<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotStaff
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
        if (! $request->user()->isStaff())
        {
            return redirect('/auth/logout');
        }

        return $next($request);
    }
}
