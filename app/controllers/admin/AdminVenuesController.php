<?php

class AdminVenuesController implements RestfulControllerInterface {

	private $viewData = array();

	public function __construct () {
		// check that the user is logged in
		if (!Auth::admin()) {
			header('Location:login');
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
	public function index () {
		$this->viewData["pageTitle"] = "Manage Venues";
		$this->viewData["errors"] = array();
		$this->viewData["venue"] = new Venue("", "", "", "", "", "");
		$this->viewData["venues"] = Venue::getAll();

		return View::create("admin/venues")->with($this->viewData);
	}

	public function create($data) {
		$this->viewData["title"] = "Manage Venues";
		$this->viewData["venue"] = new Venue($data["name"], $data["address"], $data["description"], $data["latitude"], $data["longitude"]);

		if (!$this->viewData["venue"]->errors()) {
			$this->viewData["venue"]->save();
			$this->viewData["flash_message"] = "New Venue Created";
		} else {
			$this->viewData["errors"] = $this->viewData["venue"]->errors();
			$this->viewData["flash_error"] = "Form has errors";
		}

		$this->viewData["venues"] = Venue::getAll();


		return View::create("admin/venues")->with($this->viewData);
	}

	public function read($venue_id) {
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["venues"] = Venue::getAll();
		$this->viewData["pageTitle"] = "Manage " . $this->viewData["venue"]->getName();
		$this->viewData["id"] = $venue_id;

		return View::create("admin/venues")->with($this->viewData);
	}

	public function update($venue_id, $data) {
		$this->viewData["venue"] = Venue::get($venue_id);

		$this->viewData["venue"]->setName($data["name"]);
		$this->viewData["venue"]->setAddress($data["address"]);
		$this->viewData["venue"]->setDescription($data["description"]);
		$this->viewData["venue"]->setLatitude($data["latitude"]);
		$this->viewData["venue"]->setLongitude($data["longitude"]);

		if (!$this->viewData["venue"]->errors()) {
			$this->viewData["venue"]->update();
			$this->viewData["flash_message"] = "Venue Updated";
		} else {
			$this->viewData["errors"] = $this->viewData["venue"]->errors();
			$this->viewData["flash_error"] = "Form has errors";
		}
		$this->viewData["venues"] = Venue::getAll();

		return View::create("admin/venues")->with($this->viewData);
	}

	public function delete($id) {
		Venue::delete($id);
		$this->viewData["venue"] = new Venue("", "", "", "", "", "");
		$this->viewData["venues"] = Venue::getAll();
		$this->viewData["flash_message"] = "Venue Deleted";

		return View::create("admin/venues")->with($this->viewData);
	}
}

?>
