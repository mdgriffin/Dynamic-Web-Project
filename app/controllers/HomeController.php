<?php

class HomeController implements ControllerInterface {
	use Controller;

	private $viewData = array();

	public function before () {
		if (Auth::admin()) {
			$this->viewData["auth_admin"] = User::get(Auth::admin());
		} else if (Auth::user()) {
			$this->viewData["auth_user"] = User::get(Auth::user());
		}
	}

	private function _getLogin () {
		if (!Auth::user()) {
			$this->viewData["pageTitle"] = "Please Log in";
			View::create("login")->with($this->viewData);
		} else {
			header('Location:home');
		}
	}

	private function _getRegister () {
		if (!Auth::user()) {
			$this->viewData["pageTitle"] = "Create a new account";
			View::create("register")->with($this->viewData);
		} else {
			header('Location:home');
		}
	}

	private function _getVenueIndex () {
		$this->viewData["pageTitle"] = "Find the Perfect Venue";
		View::create("venues/index")->with($this->viewData);
	}

	private function _getVenue ($venue_id) {
		$this->viewData["pageTitle"] = "Create a new account";
		$this->viewData["venue_id"] = $venue_id;

		View::create("venues/single")->with($this->viewData);
	}

}

?>
