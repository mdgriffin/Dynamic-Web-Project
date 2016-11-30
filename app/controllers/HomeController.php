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
			unset($_SESSION["flash_message"]);
		}

		if (isset($_SESSION["flash_error"])) {
			$this->viewData["flash_error"] = $_SESSION["flash_error"];
			unset($_SESSION["flash_error"]);
		}
	}

	public function getIndex () {
		$this->viewData["pageTitle"] = "VenYou - Find the Perfect Venue";
		View::create("home")->with($this->viewData);
	}

	public function getLogin () {
		if (!Auth::user()) {
			$this->viewData["pageTitle"] = "Please Login";
			View::create("login")->with($this->viewData);
		} else {
			header('Location:home');
		}
	}

	public function postLogin ($email, $password) {
		$user_id  = User::isUser($email, $password);

		if ($user_id) {
			$_SESSION["auth_user_logged_in"] = true;
			$_SESSION["auth_user_id"] = $user_id;

			header('Location:home');
		} else {
			$viewData["pageTitle"] = "Please Login";
			$viewData["flash_error"] = "Username and/or password is incorrect";

			View::create("admin/login")->with($this->viewData);
		}
	}

	public function postLogout ($data) {
		if (isset($data["logout"])) {
			session_destroy();
			$_SESSION["flash_message"] = "Logged Out Successfully";
		} else {
			$_SESSION["flash_error"] = "Failed to Logout";
		}

		header('Location:home');
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

		$user = new User($data["forename"], $data["surname"], $data["email"], $data["password"], 0);

		if (!$user->errors()) {
			$user->save();
			$_SESSION["flash_message"] = "Account Successfully Registered";

			// TODO Log the User in
			$_SESSION["auth_user_logged_in"] = true;
			$_SESSION["auth_user_id"] = $user->getId();

			header('Location:home');
		} else {
			$this->viewData["errors"] = $user->errors();
			$this->viewData["flash_error"] = "Register form has errors";
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
