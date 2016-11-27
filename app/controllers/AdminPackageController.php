<?php

class AdminPackageController implements RestfulControllerInterface {
	use Controller;

	private $viewData = array();

	public function before () {
		// check that the user is logged in
		if (!Auth::admin()) {
			header('Location:login.php');
		}

		if (Auth::admin()) {
			$this->viewData["auth_admin"] = User::get(Auth::admin());
		} else if (Auth::user()) {
			$this->viewData["auth_user"] = User::get(Auth::user());
		}
	}

	// display the index view
	public function index () {
		die("index package view");
		//header("location:admin/venues");
	}

	public function create($data) {
		/*
		$venue_id = $data["venue_id"];
		$package = new Package($data["venue_id"], $data["description"], $data["price_per_guest"], $data["min_guests"], $data["max_guests"], $data["start_date"], $data["end_date"]);
		$venue = Venue::get($venue_id);
		$packages = Package::getAll();

		if (!$package->errors()) {
			$package->save();
			$flash_message = "New Package Created";
		} else {
			$errors = $package->errors();
			$flash_error = "Form has errors";
		}

		include_once("../app/templates/admin/packages.php");
		*/
	}

	public function read($venue_id) {
		$this->viewData["pageTitle"] = "Manage Packages";
		$this->viewData["errors"] = array();
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["package"] = new Package("", "", "", "", "", "", "");
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
