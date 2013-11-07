<?php

class Home extends BaseController {

	/*
	   |--------------------------------------------------------------------------
	   | Default Home Controller
	   |--------------------------------------------------------------------------
	   |
	   | You may wish to use controllers instead of, or in addition to, Closure
	   | based routes. That's great! Here is an example controller method to
	   | get you started. To route to this controller, just add the route:
	   |
	   |	Route::get('/', 'HomeController@showWelcome');
	   |
	 */

	public function getIndex()
	{
		$trigger = Triggers::find(1);
		if($trigger->secure == 1){
			return Redirect::to('//localhost/comsoc/public/home')->with('message','You failed to get into the firewall');
		}else{
			$view = View::make('home');
			$view['message'] = Session::get('message');
			return $view;
		}
	}

	public function getEnable($key)
	{
		if(Crypt::decrypt($key) != 'secretpassword'){
			return Redirect::to('//localhost/comsoc/public/mail/messages')->with('response','Access Denied');
		}
		$trigger = Triggers::find(1);
		$trigger->secure = 1;
		$trigger->save();
		return Redirect::to('//localhost/comsoc/public/mail/messages')->with('response','Firewall enabled');
	}

	public function getDisable($key)
	{
		if(Crypt::decrypt($key) != 'secretpassword'){
			return Redirect::to('//localhost/comsoc/public/mail/messages')->with('response','Access Denied');
		}
		$trigger = Triggers::find(1);
		$trigger->secure = 0;
		$trigger->save();
		return Redirect::to('//localhost/comsoc/public/mail/messages')->with('response','Firewall disabled');
	}
}
