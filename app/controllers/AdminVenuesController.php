<?php

class AdminVenuesController implements RestfulController {

	public function before () {
		// check that the user is logged in
		if (!isset($_SESSION["admin_logged_in"]) || !$_SESSION["admin_logged_in"]) {
			header('Location:login.php');
		}
	}

	public function after () {}

	// display the index view
	public function index () {
		return View::create("admin/venues")->with(array(
			"pageTitle" => "Manage Venues",
			"errors" => array(),
			"venue" => new Venue("", "", "", "", "", ""),
			"venues" => Venue::getAll(),
		));
	}

	public function create($data) {
		$viewData = array();
		$viewData["title"] = "Manage Venues";
		$viewData["venue"] = new Venue($data["name"], $data["address"], $data["description"], $data["latitude"], $data["longitude"]);

		if (!$viewData["venue"]->errors()) {
			$viewData["venue"]->save();
			$viewData["flash_message"] = "New Venue Created";
		} else {
			$viewData["errors"] = $viewData["venue"]->errors();
			$viewData["flash_error"] = "Form has errors";
		}

		$viewData["venues"] = Venue::getAll();


		return View::create("admin/venues")->with($viewData);
	}

	public function read($venue_id) {
		$viewData = array();
		$viewData["venue"] = Venue::get($venue_id);
		$viewData["venues"] = Venue::getAll();
		$viewData["pageTitle"] = "Manage " . $viewData["venue"]->getName();
		$viewData["id"] = $venue_id;

		return View::create("admin/venues")->with($viewData);
	}

	public function update($venue_id, $data) {
		$viewData = array();
		$viewData["venue"] = Venue::get($venue_id);

		$viewData["venue"]->setName($data["name"]);
		$viewData["venue"]->setAddress($data["address"]);
		$viewData["venue"]->setDescription($data["description"]);
		$viewData["venue"]->setLatitude($data["latitude"]);
		$viewData["venue"]->setLongitude($data["longitude"]);

		if (!$viewData["venue"]->errors()) {
			$viewData["venue"]->update();
			$viewData["flash_message"] = "Venue Updated";
		} else {
			$viewData["errors"] = $viewData["venue"]->errors();
			$viewData["flash_error"] = "Form has errors";
		}
		$viewData["venues"] = Venue::getAll();

		return View::create("admin/venues")->with($viewData);
	}

	public function delete($id) {
		$viewData = array();
		Venue::delete($id);
		$viewData["venue"] = new Venue("", "", "", "", "", "");
		$viewData["venues"] = Venue::getAll();
		$viewData["flash_message"] = "Venue Deleted";

		return View::create("admin/venues")->with($viewData);
	}
}

?>
