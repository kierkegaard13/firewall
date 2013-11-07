<?php

class BaseController extends Controller {

	public $secure = 1;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */

	public function __construct(){
		View::share('base','//localhost/comsoc');
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
