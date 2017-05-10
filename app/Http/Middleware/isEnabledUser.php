<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isEnabledUser
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
        $user = Auth::user();
	    if(config('customuser.customUserEnabled') == 0){
	        if($user->enabled == 0){
	            return redirect('/not_enabled_account');
	        }
	        else{
	            return $next($request);
	        }
	    }
    }
}
