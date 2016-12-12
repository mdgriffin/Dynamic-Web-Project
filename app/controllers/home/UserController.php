<?php

class UserController {

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

		$this->viewData["latest_venues"] = Venue::getLatestSummarized(10);
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

			if (isset($_SESSION["after_login"])) {
				header("Location:" . $_SESSION["after_login"]);
				unset($_SESSION["after_login"]);
			} else {
				header('Location:home');
			}

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

			$_SESSION["auth_user_logged_in"] = true;
			$_SESSION["auth_user_id"] = $user->getId();

			if (isset($_SESSION["after_login"])) {
				header("Location:" . $_SESSION["after_login"]);
				unset($_SESSION["after_login"]);
			} else {
				header('Location:home');
			}

		} else {
			$this->viewData["errors"] = $user->errors();
			$this->viewData["flash_error"] = "Register form has errors";
			$this->viewData["user"] = $user;

			View::create("register")->with($this->viewData);
		}
	}

	public function getProfile () {
		$this->viewData["pageTitle"] = "Manage Profile";
		View::create("profile")->with($this->viewData);
	}

	public function postProfile ($data) {
		if (isset($this->viewData["auth_user"]) && $this->viewData["auth_user"]) {
			$this->viewData["pageTitle"] = "Manage Profile";

			$this->viewData["auth_user"]->setForename($data["forename"]);
			$this->viewData["auth_user"]->setSurname($data["surname"]);
			$this->viewData["auth_user"]->setEmail($data["email"]);
			$this->viewData["auth_user"]->setPassword($data["password"]);

			if (!$this->viewData["auth_user"]->errors()) {
				$this->viewData["auth_user"]->update();
				$this->viewData["flash_message"] = "Profile Updated";
			} else {
				$this->viewData["errors"] = $this->viewData["auth_user"]->errors();
				$this->viewData["flash_error"] = "Form has errors";
			}

			View::create("profile")->with($this->viewData);
		} else {
			header('Location:home');
		}
	}

	public function getBookings () {
		// display a list of bookings the user has made
		$this->viewData["pageTitle"] = "Manage Your Bookings";

		$this->viewData["bookings"] = User::getBookings($_SESSION["auth_user_id"]);

		View::create("bookings")->with($this->viewData);
	}

}

?>
