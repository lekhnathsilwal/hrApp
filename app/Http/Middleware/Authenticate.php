<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @param null $guard
     * @return string
     */
    protected function redirectTo($request)
    {
        if(!Auth::guard('admin')->check()){
            return redirect()->route('admin'); // to login page
        }
        if(!$request->expectsJson()) {
            return route('admin');
        }
    }
}
