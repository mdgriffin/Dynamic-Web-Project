<?php

class AdminUsersController implements RestfulController {

	public function before () {
		// check that the user is logged in
		if (!Auth::admin()) {
			header('Location:login.php');
		}
	}

	public function after () {}

	// display the index view
	public function index () {
		return View::create("admin/users")->with(array(
			"pageTitle" => "Manage Users",
			"errors" => array(),
			"user" => new User("", "", "", "", 0),
			"users" => User::getAll(),
		));
	}

	public function create($data) {
		$viewData = array();
		$user = new User($data["forename"], $data["surname"], $data["email"], $data["password"], 1);

		if (!$user->errors()) {
			$user->save();
			$viewData["flash_message"] = "New User Created";
			$viewData["user"] = new User("", "", "", "", 0);
		} else {
			$viewData["errors"] = $user->errors();
			$viewData["flash_error"] = "Register User form has errors";
			$viewData["user"] = $user;
		}

		$viewData["users"] = User::getAll();
		$viewData["pageTitle"] = "Manage Users";

		return View::create("admin/users")->with($viewData);
	}

	public function read($user_id) {
		$viewData = array();
		$viewData["user_id"] = $user_id;

		$viewData["user"] = User::get($user_id);
		$viewData["user"]->setPassword("");

		$viewData["users"] = User::getAll();
		$viewData["pageTitle"] = "Manage Users";

		return View::create("admin/users")->with($viewData);
	}

	public function update($user_id, $data) {
		$viewData = array();
		$viewData["user_id"] = $user_id;

		$viewData["user"] = User::get($user_id);

		$viewData["user"]->setForename($data["forename"]);
		$viewData["user"]->setSurname($data["surname"]);
		$viewData["user"]->setEmail($data["email"]);
		$viewData["user"]->setPassword($data["password"]);

		if (!$viewData["user"]->errors()) {
			$viewData["user"]->update();
			$viewData["flash_message"] = "User Updated";
		} else {
			$viewData["errors"] = $viewData["user"]->errors();
			$viewData["flash_error"] = "Form has errors";
		}

		$viewData["users"] = User::getAll();
		$viewData["pageTitle"] = "Manage Users";

		return View::create("admin/users")->with($viewData);
	}

	public function delete($user_id) {
		$viewData = array();
		$viewData["user_id"] = $user_id;

		$viewData["pageTitle"] = "Manage Users";

		User::delete($user_id);
		$viewData["user"] = new User("", "", "", "", "", 0);
		$viewData["flash_message"] = "User Deleted";

		$viewData["users"] = User::getAll();

		return View::create("admin/users")->with($viewData);
	}
}

?>
