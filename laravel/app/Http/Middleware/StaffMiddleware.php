<?php

namespace App\Http\Middleware;

use Closure;

class StaffMiddleware
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
        if (($request->user()->account_type != 'Admin') && ($request->user()->account_type != 'Staff'))
        {
            return redirect('home');
        }

        return $next($request);
    }
}
