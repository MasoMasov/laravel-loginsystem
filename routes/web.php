<?php

### Пътища, достъпни от всички
Route::get("/not_enabled_account", function(){
	return view('errors.confirm');
});
Route::get("/403", function(){
	return view('errors.403');
});
Route::get("/error", function(){
	return view('errors.error');
});
Route::get("/confirmemail", 'UserController@confirmAccount');
Route::get("/sendactivationemail", 'UserController@sendConfirmationAgain');
Route::post("/sendactivationemail", 'UserController@sendConfirmationPost');
Route::auth();
Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');
//Route::get('/', function() { return view('home'); });
Route::get('/',							['as'=> 'unreg.home', 				'uses'=>'HomeController@index']);
Route::get('/reginvite',				['as'=>'register.invites',			'uses'=>'UserController@showRegistrationFormInv']);


### Пътища, достъпни само от потребители с активен акаунт
Route::group(['middleware' => 'web'], function () {
	if(config('customuser.siteOnlyForReg') == 1){
		Route::get('/',							['as'=> 'auth.home', 			'uses'=>'UserController@showHome'])->middleware(['auth','isEnabledUser']);
	}
	Route::get('/home', 					['as'=> 'auth.home2', 				'uses'=>'UserController@showHome'])->middleware(['auth','isEnabledUser']);
	Route::get('/user/cp', 					['as'=> 'auth.usercp', 				'uses'=>'UserCP@index'])->middleware(['auth','isEnabledUser']);
	Route::post('/user/cp/changePass',		['as'=> 'auth.changePass', 			'uses'=>'UserCP@postChangePass'])->middleware(['auth','isEnabledUser']);
	Route::post('/user/cp/sentInvite',		['as'=> 'auth.sentInvite', 			'uses'=>'UserCP@postSentInvite'])->middleware(['auth','isEnabledUser']);
	Route::post('/user/cp/changeAvatar',	['as'=> 'auth.changeAvatar', 		'uses'=>'UserCP@postChangeAvatar'])->middleware(['auth','isEnabledUser']);
	
	### Пътища, достъпни само от Мод и Админ
	Route::get('/mod', 						['as'=> 'mod.index', 				'uses'=>'ModTools@index'])->middleware(['auth','isEnabledUser','isModUser']);
	Route::post('/mod/enableUser', 			['as'=> 'mod.enableUser',			'uses'=>'ModTools@enableUser'])->middleware(['auth','isEnabledUser','isModUser']);
	
	
	
	### Пътища, достъпни само от Админ
	Route::get('/admin', 					['as'=> 'admin.index', 				'uses'=>'AdminTools@index'])->middleware(['auth','isEnabledUser','isAdminUser']);
	Route::post('/admin/setUserClass',		['as'=> 'admin.setUserClass',		'uses'=>'AdminTools@setUserClass'])->middleware(['auth','isEnabledUser','isAdminUser']);
	Route::post('/admin/setInvites',		['as'=> 'admin.setInvites',			'uses'=>'AdminTools@setInvites'])->middleware(['auth','isEnabledUser','isAdminUser']);
	
});

