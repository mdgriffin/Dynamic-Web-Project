<?php

class AdminPackageController {

	private $viewData = array();

	public function __construct () {
		// check that the user is logged in
		if (!Auth::admin()) {
			header('Location:login.php');
		}

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

	// display the index view
	public function getIndex($venue_id) {
		$this->viewData["pageTitle"] = "Manage Packages";
		$this->viewData["errors"] = array();
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["venue_id"] = $venue_id;
		$this->viewData["package"] = new Package("", "", "", "", "", "", "", "");
		$this->viewData["packages"] = Package::getAllByVenue($venue_id);

		return View::create("admin/packages")->with($this->viewData);
	}

	public function postIndex($venue_id, $data) {
		$this->viewData["pageTitle"] = "Manage Packages";
		$this->viewData["errors"] = array();
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["venue_id"] = $venue_id;
		$package = new Package($data["venue_id"], $data["title"], $data["description"], $data["price_per_guest"], $data["min_guests"], $data["max_guests"], $data["start_date"], $data["end_date"]);

		if (!$package->errors()) {
			$package->save();
			$this->viewData["package"] = new Package("", "", "", "", "", "", "", "");
			$this->viewData["flash_message"] = "New Package Created";
		} else {
			$this->viewData["errors"] = $package->errors();
				$this->viewData["package"] = $package;
				$this->viewData["flash_error"] = "Form has errors";
		}

			$this->viewData["packages"] = Package::getAllByVenue($venue_id);

		return View::create("admin/packages")->with($this->viewData);
	}

	public function getUpdate($venue_id, $package_id) {
		$this->viewData["errors"] = array();
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["venue_id"] = $venue_id;
		$this->viewData["package_id"] = $package_id;
		$this->viewData["package"] = Package::get($package_id);
		$this->viewData["packages"] = Package::getAllByVenue($venue_id);
		$this->viewData["pageTitle"] = "Updating package " . $this->viewData["package"]->getTitle();

		return View::create("admin/packages")->with($this->viewData);
	}

	public function postUpdate ($venue_id, $package_id, $data) {
		$this->viewData["errors"] = array();
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["venue_id"] = $venue_id;
		$this->viewData["package_id"] = $package_id;
		$this->viewData["package"] = Package::get($package_id);
		$this->viewData["pageTitle"] = "Updating package " . $this->viewData["package"]->getTitle();

		$this->viewData["package"]->setVenueid($data["venue_id"]);
		$this->viewData["package"]->setTitle($data["title"]);
		$this->viewData["package"]->setDescription($data["description"]);
		$this->viewData["package"]->setPrice_per_guest($data["price_per_guest"]);
		$this->viewData["package"]->setMin_guests($data["min_guests"]);
		$this->viewData["package"]->setMax_guests($data["max_guests"]);
		$this->viewData["package"]->setStart_date($data["start_date"]);
		$this->viewData["package"]->setEndDate($data["end_date"]);

		if (!$this->viewData["package"]->errors()) {
			$this->viewData["package"]->update();
			$this->viewData["flash_message"] = "Package Updated";
		} else {
			$this->viewData["errors"] = $this->viewData["package"]->errors();
			$this->viewData["flash_error"] = "Form has errors";
		}

		$this->viewData["packages"] = Package::getAllByVenue($venue_id);

		return View::create("admin/packages")->with($this->viewData);
	}

	public function postDelete($venue_id, $data) {
		$res = Package::delete($data["package_id"]);

		if ($res) {
			$_SESSION["flash_message"] = "Package Deleted";
		} else {
			$_SESSION["flash_error"] = "Failed To Delete Package";
		}

		header('Location:admin/packages?venue_id=' . $venue_id);
	}
}

?>
