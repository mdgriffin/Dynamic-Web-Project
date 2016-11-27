<?php

class HomeController {

	private $viewData = array();

	public function __construct () {
		if (Auth::admin()) {
			$this->viewData["auth_admin"] = User::get(Auth::admin());
		} else if (Auth::user()) {
			$this->viewData["auth_user"] = User::get(Auth::user());
		}

		if (isset($_SESSION["flash_message"])) {
			$this->viewData["flash_message"] = $_SESSION["flash_message"];
			// TODO Uncomment
			// unset($_SESSION["flash_message"])

		} else {
			die("flash message not set");
		}
	}

	public function getIndex () {
		$this->viewData["pageTitle"] = "VenYou - Find the Perfect Venue";

		// TODO viewData not getting passed to header
		View::create("home")->with(array($this->viewData));
	}

	public function getLogin () {
		if (!Auth::user()) {
			$this->viewData["pageTitle"] = "Please Log in";
			View::create("login")->with($this->viewData);
		} else {
			header('Location:home');
		}
	}

	public function getRegister () {
		if (!Auth::user()) {
			$this->viewData["pageTitle"] = "Create a new account";
			$this->viewData["errors"] = array();
			$this->viewData["user"] = new User("", "", "", "", 0);
			View::create("register")->with($this->viewData);
		} else {
			header('Location:home');
		}
	}

	public function postRegister ($data) {
		// TODO Log the User in
		$user = new User($data["forename"], $data["surname"], $data["email"], $data["password"], 0);

		if (!$user->errors()) {
			$user->save();
			$_SESSION["flash_message"] = "Account Successfully Registered";

			header('Location:home');
		} else {
			$this->viewData["errors"] = $user->errors();
			$this->viewData["flash_error"] = "Register form has errormnmns";
			$this->viewData["user"] = $user;

			View::create("register")->with($this->viewData);
		}
	}

	public function getVenueIndex () {
		$this->viewData["pageTitle"] = "Find the Perfect Venue";
		View::create("venues/index")->with($this->viewData);
	}

	public function getVenue ($venue_id) {
		$this->viewData["pageTitle"] = "Create a new account";
		$this->viewData["venue_id"] = $venue_id;

		View::create("venues/single")->with($this->viewData);
	}

}

?>
