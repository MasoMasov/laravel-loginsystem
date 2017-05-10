<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Traits\CaptchaTrait;
use App\Mail\ConfirmMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers, CaptchaTrait;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
	{
	    $data['captcha'] = $this->captchaCheck();
	    return Validator::make($data, [
	        'name' 					=> 'required|max:255',
	        'email' 				=> 'required|email|max:255|unique:users',
	        'password' 				=> 'required|min:6|confirmed',
	        'g-recaptcha-response'  => 'required',
	        'captcha'               => 'required|min:1'
	    ]);
	}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
	{
	    $q = User::create([
	        'name' => $data['name'],
	        'email' => $data['email'],
	        'password' => bcrypt($data['password']),
	        // взима от конфигурацията за класа по подразбиране
	        'class' => config('customuser.customUserClass'),
	        // взима от конфигурацията името на класа по подразбиране
	        'className'=>config('customuser.customUserClassName'),
	        //взима от конфигурацията дали потвърждението на акаунта е включено
	        'enabled'=>config('customuser.customUserEnabled'),
	        // създава случаен стринг за потвърждение на акаунта по мейл
	        'confirmKey' => str_random(32),
	    ]);
	    /* ако потвърждението при регистрация е включено ***/
	    if(config('customuser.customUserEnabled') == 0 && is_object($q)){
	        // изпращаме мейл с линк за потвърждение
	        Mail::to($q)->send(new ConfirmMail($q));
	    }
	    return $q;
	    
	}
	public function register(Request $request){
		$validator = $this->validator($request->all());
		if ($validator->fails()){
			$this->throwValidationException(
				$request, $validator
			);
		}

		$this->create($request->all());
		return redirect('/not_enabled_account')->with('message', __('auth.sucRegister'));
    }
}
