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
		$this->viewData["package"] = new Package("", "", "", "", "", "", "");
		$this->viewData["packages"] = Package::getAll();

		return View::create("admin/packages")->with($this->viewData);
	}

	public function postIndex($venue_id, $data) {
		$this->viewData["pageTitle"] = "Manage Packages";
		$this->viewData["errors"] = array();
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["venue_id"] = $venue_id;
		$package = new Package($data["venue_id"], $data["description"], $data["price_per_guest"], $data["min_guests"], $data["max_guests"], $data["start_date"], $data["end_date"]);

		if (!$package->errors()) {
			$package->save();
			$this->viewData["package"] = new Package("", "", "", "", "", "", "");
			$this->viewData["flash_message"] = "New Package Created";
		} else {
			$this->viewData["errors"] = $package->errors();
				$this->viewData["package"] = $package;
				$this->viewData["flash_error"] = "Form has errors";
		}

			$this->viewData["packages"] = Package::getAll();

		return View::create("admin/packages")->with($this->viewData);
	}

	public function update($venue_id, $data) {
		/*
		$venue = Venue::get($venue_id);
		$packages = Package::getAll();

		$package->setVenueid($data["venue_id"]);
		$package->setDescription($data["description"]);
		$package->setPrice_per_guest($data["price_per_guest"]);
		$package->setMin_guests($data["min_guests"]);
		$package->setMax_guests($data["max_guests"]);
		$package->setStart_date($data["start_date"]);
		$package->setEndDate($data["end_date"]);

		if (!$package->errors()) {
			$package->update();
			$flash_message = "Package Updated";
		} else {
			$errors = $package->errors();
			$flash_error = "Form has errors";
		}

		return View::create("admin/packages")->with(array(
			"pageTitle" => $pageTitle,
			"errors" => $errors,
			"venue" => $venue,
			"venue_id" => $venue_id,
			"package" => $package,
			"packages" => $packages
		));
		*/
	}

	public function delete($id) {
		/*
		$venue_id = Package::get($id)->getVenue_id;
		$venue = Venue::get($venue_id);
		$packages = Package::getAll();

		Package::delete($id);
		$package = new Package("", "", "", "", "", "");
		$flash_message = "Package Deleted";

		include_once("../app/templates/admin/packages.php");
		*/
	}
}

?>
