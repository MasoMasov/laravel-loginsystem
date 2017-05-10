<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class isSocAcc
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
    	if($request->email != ''){
	    	$user = User::where('email',$request->email)->first();
	    	if($user){
	    		if($user->provider != ''){
	    			return redirect('/error')->with('message', __('auth.emailSoc'))->with('soc',$user->provider);
	    		}else{
	    			return $next($request);
	    		}
	    	}
    	}
        return $next($request);
    }
}
