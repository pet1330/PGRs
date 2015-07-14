<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class RedirectIfAuthenticated
{
    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
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
        if ($this->auth->check()) {
            if ($request->user()->account_type == 'Admin')
            {
                return redirect()->action('StudentsController@index');
            }
            elseif ($request->user()->account_type == 'Staff') {
                return redirect()->action('StudentsController@index');
            }
            elseif ($request->user()->account_type == 'Student') {
                return redirect()->action('StudentsController@index');
            }

            //logout because the user can't exist!
            return redirect('/logout');
        }

        return $next($request);
    }
}
