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


	public function getVenueIndex () {
		$this->viewData["pageTitle"] = "Find the Perfect Venue";
		$this->viewData["venues"] = Venue::getAllWithImage();

		View::create("venues/index")->with($this->viewData);
	}

	public function getVenue ($venue_id) {
		$this->viewData["venue_id"] = $venue_id;
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["images"] = VenueImage::getAll($venue_id);
		$this->viewData["packages"] = Package::getAllByVenue($venue_id);

		$this->viewData["pageTitle"] = $this->viewData["venue"]->getName();

		View::create("venues/single")->with($this->viewData);
	}



}

?>
