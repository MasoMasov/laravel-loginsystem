<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class AdminTools extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','isEnabledUser','isAdminUser']);
    }
	
    public function setUserClass(Request $request){
    	$userid = $request->userid;
    	$user = User::find($userid);
    	if($user){
    		if(Auth::user()->class > $user->class){
    			$user->class = $request->class;
    			$user->className = array_get(config('customuser.userclasses'), $request->class);
    			$user->save();
    			return redirect()->back()->with('message',__('auth.userIsModify'));
    		}else{
    			return redirect()->back()->with('message',__('auth.noPermModify'));
    		}
    	}else{
    		return redirect()->back()->with('message',__('auth.noSushUser'));
    	}
    }
    
    public function index(){
    	return view('users.admin.main',['title'=> __('menu.Administration')]);
    }
    
    public function setInvites(Request $request){
    	//dd($request->inc);
    	$userid = $request->userid;
    	if($userid != 0){
	    	$user = User::find($userid);
	    	$user->invites = $user->invites + $request->inc;
	    	$user->save();
	    	return redirect()->back();
    	}
    	else{
    		User::where('enabled', 1)->increment('invites', $request->inc);
    		return redirect()->back();
    	}
    }
}
