<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;
use App\User;
use App\Invites;
use App\Mail\SendInvite;
use Illuminate\Support\Facades\Mail;
use Socialite;
use Storage;
use Image;

class UserCP extends Controller
{
    public function index(){
    	return view('users.user.usercp',['title'=> __('auth.ControlPannel')]);
    }
    public function changePassRules(array $data){
		$messages = [
			'current-password.required' => __('auth.reqCurrPass'),
			'password.required' => __('auth.reqPass'),
		];

		$validator = Validator::make($data, [
			'current-password' => 'required',
			'password' => 'required|same:password',
			'password_confirmation' => 'required|same:password',     
		], $messages);

		return $validator;
	}  
    public function postChangePass(Request $request){
		if(Auth::Check()){
			$request_data = $request->All();
			$validator = $this->changePassRules($request_data);
			if($validator->fails()){
				return back()->withErrors($validator)->withInput();
			}
			else{  
				$current_password = Auth::User()->password;           
				if(Hash::check($request_data['current-password'], $current_password)){           
					$user_id = Auth::User()->id;                       
					$obj_user = User::find($user_id);
					$obj_user->password = Hash::make($request_data['password']);;
					$obj_user->save(); 
					return back()->with('message',__('auth.passIsChanged'));
				}
				else{  
					return back()->with('message',__('auth.filCorrectPass'))->withInput();
				}
			}        
		}
		else{
			return redirect()->to('/');
		} 
	}
	
	public function postSentInvite(Request $request){
		$user = User::find(Auth::user()->id);
		if($user->invites <1){
			return back();
		}else{
			$this->validate($request, [
				'email' => 'required|email',
			]);
			$code = str_random(32);
			$inv = Invites::create([
				'uid' 	=> Auth::user()->id,
				'email'		=> $request->email,
				'icode'		=> $code
				]);
			
			if(Mail::to($request->email)->send(new SendInvite($inv))){
				$user->invites = $user->invites - 1;
				$user->save();
			}
			return back()->with('message',__('auth.invSended'));
		}
	}
	
	public function postChangeAvatar(Request $request){
		$user = User::findOrFail(Auth::user()->id);
		$file = $request->file('avatar');
		$path = $file->hashName('avatars/'.$user->id);
		
		$image = Image::make($file);
		
		$image->fit(config('customuser.avatarW'), config('customuser.avatarH'), function ($constraint) {
		    $constraint->aspectRatio();
		});
		
		if(Storage::put($path, (string) $image->encode())){
			/// remove old avatar
			Storage::delete($user->avatar);
			$user->avatar = $path;
			$user->save();
			return back()->with('message',__('auth.avatarChanged'));
		}else{
			return back()->with('error','Upload failed');
		}
		
	}
	
}
