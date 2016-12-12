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

		$this->viewData["latest_venues"] = Venue::getLatestSummarized(10);
	}

	public function getIndex () {
		$this->viewData["pageTitle"] = "VenYou - Find the Perfect Venue";
		$this->viewData["featured_venues"] = Venue::getAllWithImage(3);

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

	public function getVenueCard ($venue_id) {
		$venue_images = VenueImage::getAll($venue_id);

		if ($venue_images) {
			$image = $venue_images[0];
		}
		return View::create("venues/card")->with(array("venue" => Venue::get($venue_id), "image" => $image));
	}

	public function getSearch ($params) {
		$num_guests = explode("-", $params["num_guests"]);
		$min_guests = $num_guests[0];
		$max_guests = $num_guests[1];
		$this->viewData["pageTitle"] = "Venue Search Results";

		$this->viewData["results"] = Venue::find($params["term"], $min_guests, $max_guests, $params["date"]);

		return View::create("search")->with($this->viewData);

	}

	public function getLocations () {
		$this->viewData["pageTitle"] = "View Venues by Location";
		$this->viewData["venues"] = Venue::getAll();
		$this->viewData["scripts"] = array("Assets/location-map.js", "https://maps.googleapis.com/maps/api/js?key=AIzaSyDbgC6kK0wUhX1WExJo7Qavhx-UWp94xvE&callback=initMap");

		return View::create("locations")->with($this->viewData);
	}

}

?>
