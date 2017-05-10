<?php

namespace App\Http\Controllers;

use App\User as User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ConfirmMail;
use Illuminate\Support\Facades\Mail;
use App\Traits\CaptchaTrait;
use Auth;
use Validator;
use App\Invites;

class UserController extends Controller
{
	use CaptchaTrait;
	
	public function showHome(){
		return view('home');
	}
	
    public function confirmAccount(Request $request){
	    //$req_email = $request->input('email','');
	    //$req_key = $request->input('key','');
	    $this->validate($request,
	        [
	            'email' =>  'required|email',
	            'key'   =>  'required|size:32',
	        ]);
	
	        $user = User::where('email', $request->email)->first();
	        if($user){
	            if($user->enabled == 1){
	                return redirect('/login')->with('message','Акаунта ви вече е потвърден успешно!');
	            }
	            else{
	                if($user->confirmKey == $request->key){
	                    $user->confirmKey = '';
	                    $user->enabled = 1;
	                    $user->save();
	                    return redirect('/login')->with('message','Акаунта ви е потвърден успешно!');
	                }
	                else{
	                    return redirect('/sendactivationemail')->with('message','Неверни данни за активация - несъществуващ потребител!');
	                }
	            }
	        }
	        else {
	            return redirect('/sendactivationemail')->with('message','Неверни данни за активация - несъществуващ потребител!');
	        }
	}
	public function sendConfirmationAgain(){
		if(!Auth::user())
	    	return view('errors.send_activation');
	    else
	    	return redirect('/');
	}
	public function sendConfirmationPost(Request $request){
		$request['captcha'] = $this->captchaCheck();
	    $this->validate($request,
	        [
	            'emailaddress'  =>  'required|email',
	            'g-recaptcha-response'  => 'required',
	            'captcha'               => 'required|min:1',
	        ]);
	
	        $user = User::where('email', $request->emailaddress)->first();
	        if($user){
	        	$rnd = str_random(32);
	        	
	            $user->confirmKey = $rnd;
	            $user->save();
	            Mail::to($user)->send(new ConfirmMail($user));
	            
	            return redirect('/login')->with('message','Писмо с линк за активация изпратено успешно!');
	        }
	        else {
	            return redirect('/sendactivationemail')->with('message','Неверни данни за активация - несъществуващ потребител!');
	        }
	}
	public function showRegistrationFormInv(Request $req){
		$inv_code = $req->key;
		$inv_email = $req->email;
		$validator = Validator::make($req->all(), [
				'email' => 'required|email',
				'key' => 'required|size:32',
		]);
		if ($validator->fails()) {
			return redirect('/403');
		}
		$inv = Invites::where('icode',$inv_code)->where('email',$inv_email)->first();
		if($inv){
			return view('auth.reginvites',['uemail'=>$inv->email]);
		}
		else{
			return redirect('/403');
		}
	}
}
