<?php

class PackageController {

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

	public function getPackage ($package_id) {
		if (Auth::user() || Auth::admin()) {
			$this->viewData["package"] = Package::get($package_id);
			$this->viewData["booking"] = new Booking();
			$this->viewData["pageTitle"] = $this->viewData["package"]->getTitle() . " make a booking";

			View::create("packages/single")->with($this->viewData);
		} else {
			$this->viewData["pageTitle"] = "Please login to continue booking";

			$_SESSION["after_login"] = "packages/" . $package_id;

			View::create("please-login")->with($this->viewData);
		}

	}

	public function postPackage ($package_id, $data) {
		$this->viewData["package"] = Package::get($package_id);
		$this->viewData["pageTitle"] = $this->viewData["package"]->getTitle() . " make a booking";

		if (Auth::admin()) {
			$user_id = $this->viewData["auth_admin"]->getId();
		} else if (Auth::user()) {
			$user_id = $this->viewData["auth_user"]->getId();
		}

		$booking = new Booking($user_id, $this->viewData["package"]->getVenue_id(), $package_id, $data["num_guests"], $data["event_date"]);

		if (!$booking->errors()) {
			$booking->save();
			$this->viewData["booking"] = new Booking();
			$this->viewData["flash_message"] = "Successfully Booked Venue";
		} else {
			$this->viewData["flash_error"] = "Failed to book venue";
			$this->viewData["errors"] = $booking->errors();
			$this->viewData["booking"] = $booking;
		}

		View::create("packages/single")->with($this->viewData);

	}
}
?>
