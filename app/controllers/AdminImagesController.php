<?php

class AdminImagesController {

	public static function before () {
		// check that the user is logged in
		if (!isset($_SESSION["admin_logged_in"]) || !$_SESSION["admin_logged_in"]) {
			header('Location:login.php');
		}
	}

	// display the index view
	public static function index ($venue_id) {
		return View::create("admin/images")->with(array(
			"venue" => Venue::get($venue_id)
		));
	}

	public static function create($venue_id, $data) {}

	public static function delete($id) {}
}

?>
