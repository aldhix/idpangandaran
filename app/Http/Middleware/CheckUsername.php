<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class CheckUsername
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
        $check = User::where('username',$request->username)->count();
        if($check > 0){
            return $next($request);
        }

        return response('Not Found! error 404.');
    }
}
