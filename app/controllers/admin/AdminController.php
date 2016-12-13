<?php

class AdminController {

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

	public function getIndex () {
		if (Auth::admin()) {
			$this->viewData["pageTitle"] = "Home Page";
			$this->viewData["booking_stats"] = Booking::getStats();
			$this->viewData["latest_bookings"] = Booking::getLatest(10);
			$this->viewData["venue_stats"] = Venue::getStats();
			$this->viewData["user_stats"] = User::getStats();
			$this->viewData["package_stats"] = Package::getStats();


			View::create("admin/index")->with($this->viewData);
		} else {
			header('Location:admin/login');
		}
	}

	public function getLogin () {
		if (!Auth::admin()) {
			$this->viewData["pageTitle"] = "Admin Login";

			View::create("admin/login")->with($this->viewData);
		} else {
			header('Location:home');
		}
	}

	public function postLogin ($email, $password) {
		$admin_id  = User::isAdmin($email, $password);

		if ($admin_id) {
			$_SESSION["admin_logged_in"] = true;
			$_SESSION["admin_id"] = $admin_id;
			header('Location:home');
		} else {
			$viewData["pageTitle"] = "Admin Login";
			$viewData["flash_error"] = "Username and/or password is incorrect";

			View::create("admin/login")->with($this->viewData);
		}
	}

	public function postLogout ($data) {
		if (isset($data["logout"])) {
			session_destroy();
			header('Location:login');
		} else {
			$viewData["pageTitle"] = "Admin Home";
			$viewData["flash_error"] = "Failed To Logout";

			View::create("admin/home")->with($this->viewData);
		}
	}


}



?>
