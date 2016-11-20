<?php

class PackageController {

	public static function before () {
		// check that the user is logged in
		if (!isset($_SESSION["admin_logged_in"]) || !$_SESSION["admin_logged_in"]) {
			header('Location:login.php');
		}
	}

	public static function after () {}

	// display the index view
	public static function index () {
		//$venue = Venue::get($_GET["id"]);
		$package = new Package("", "", "", "", "", "", "");
		$pageTitle = "Manage Packages";
		$errors = array();

		// 1. The method should

		//include_once("../app/templates/admin/packages.php");
		//return "<h1>This is some html being echoed from the index method</h1>";
		return View::create("admin/packages")->with(array("pageTitle" => $pageTitle, "package" => $package, "errors" => $errors));
	}

	public static function view($venue_id) {
		$venue = Venue::get($venue_id);
		$package = new Package("", "", "", "", "", "", "");
		$packages = Package::getAll();

		include_once("../app/templates/admin/packages.php");
	}

	public static function create($data) {
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
	}

	public static function update($venue_id, $data) {
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

		include_once("../app/templates/admin/packages.php");
	}

	public static function delete($id) {
		$venue_id = Package::get($id)->getVenue_id;
		$venue = Venue::get($venue_id);
		$packages = Package::getAll();

		Package::delete($id);
		$package = new Package("", "", "", "", "", "");
		$flash_message = "Package Deleted";

		include_once("../app/templates/admin/packages.php");
	}
}

?>
