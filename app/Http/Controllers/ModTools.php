<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;

class ModTools extends Controller
{
	public function __construct()
    {
        $this->middleware(['auth','isEnabledUser','isModUser']);
    }
    public function index(){
    	$users = User::all();
    	//dd($users->devices[0]["platform"]);
    	return view('users.mod.main',['users'=>$users,'title' => __('menu.Moderation').' - ' . __('menu.Users')]);
    }
    
    public function enableUser(Request $req){
    	$userid = $req->userid;
    	$user = User::find($userid);
    	if($user){
    		if(Auth::user()->class > $user->class){
    			if($user->enabled) $user->enabled = 0;
    			else $user->enabled = 1;
    			$user->save();
    			return redirect()->back()->with('message',__('auth.userIsModify'));
    		}else{
    			return redirect()->back()->with('message',__('auth.noPermModify'));
    		}
    	}else{
    		return redirect()->back()->with('message',__('auth.noSushUser'));
    	}
    }
}
