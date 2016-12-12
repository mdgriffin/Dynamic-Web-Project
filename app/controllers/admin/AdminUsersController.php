<?php

class AdminUsersController implements RestfulControllerInterface {

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

		$this->viewData["latest_venues"] = Venue::getLatestSummarized(10);
	}

	// display the index view
	public function index () {
		$this->viewData["pageTitle"] = "Manage Users";
		$this->viewData["errors"] = array();
		$this->viewData["user"] = new User("", "", "", "", 0);
		$this->viewData["users"] = User::getAll();

		return View::create("admin/users")->with($this->viewData);
	}

	public function create($data) {
		$user = new User($data["forename"], $data["surname"], $data["email"], $data["password"], $data["is_admin"]);

		if (!$user->errors()) {
			$user->save();
			$this->viewData["flash_message"] = "New User Created";
			$this->viewData["user"] = new User("", "", "", "", 0);
		} else {
			$this->viewData["errors"] = $user->errors();
			$this->viewData["flash_error"] = "Register User form has errors";
			$this->viewData["user"] = $user;
		}

		$this->viewData["users"] = User::getAll();
		$this->viewData["pageTitle"] = "Manage Users";

		return View::create("admin/users")->with($this->viewData);
	}

	public function read($user_id) {
		$this->viewData["user_id"] = $user_id;

		$this->viewData["user"] = User::get($user_id);
		$this->viewData["user"]->setPassword("");

		$this->viewData["users"] = User::getAll();
		$this->viewData["pageTitle"] = "Manage Users";

		return View::create("admin/users")->with($this->viewData);
	}

	public function update($user_id, $data) {
		$this->viewData["user_id"] = $user_id;

		$this->viewData["user"] = User::get($user_id);

		$this->viewData["user"]->setForename($data["forename"]);
		$this->viewData["user"]->setSurname($data["surname"]);
		$this->viewData["user"]->setEmail($data["email"]);
		$this->viewData["user"]->setPassword($data["password"]);
		$this->viewData["user"]->setIs_admin( $data["is_admin"]);

		if (!$this->viewData["user"]->errors()) {
			$this->viewData["user"]->update();
			$this->viewData["flash_message"] = "User Updated";
		} else {
			$this->viewData["errors"] = $this->viewData["user"]->errors();
			$this->viewData["flash_error"] = "Form has errors";
		}

		$this->viewData["users"] = User::getAll();
		$this->viewData["pageTitle"] = "Manage Users";

		return View::create("admin/users")->with($this->viewData);
	}

	public function delete($user_id) {
		$this->viewData["user_id"] = $user_id;

		$this->viewData["pageTitle"] = "Manage Users";

		User::delete($user_id);
		$this->viewData["user"] = new User("", "", "", "", "", 0);
		$this->viewData["flash_message"] = "User Deleted";

		$this->viewData["users"] = User::getAll();

		return View::create("admin/users")->with($this->viewData);
	}
}

?>
