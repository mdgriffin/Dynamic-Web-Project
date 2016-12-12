<?php

class AdminBookingsController {

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

	// display the index view
	public function index () {
		$this->viewData["pageTitle"] = "Manage Bookings";
		$this->viewData["bookings"] = Booking::getAll();

		return View::create("admin/bookings")->with($this->viewData);
	}

}

?>
