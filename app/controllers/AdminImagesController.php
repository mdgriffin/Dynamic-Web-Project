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
			"venue" => Venue::get($venue_id),
			"venue_id" => $venue_id
		));
	}

	public static function create($venue_id, $data, $files) {
		$viewData = array();
		$target_dir = "Assets/uploads/";
		$target_file = $target_dir . basename($files["image_file"]["name"]);
		$uploaded = true;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		if(isset($_POST["submit"])) {
			$check = getimagesize($files["image_file"]["tmp_name"]);
			if($check !== false) {
				$uploaded = true;
			} else {
				$uploaded = false;
			}
		}
		if (file_exists($target_file)) {
			$uploaded = false;
		}
		if ($files["image_file"]["size"] > 500000) {
			$uploaded = false;
		}
		// Limit to image formats only
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			$uploaded = false;
		}

		if ($uploaded == false) {
			$viewData["flash_error"] = "Sorry, your file was not uploaded.";
		} else {
			if (move_uploaded_file($files["image_file"]["tmp_name"], $target_file)) {
				$viewData["flash_message"] = "The file ". basename( $files["image_file"]["name"]). " has been uploaded.";
			} else {
				$viewData["flash_error"] = "Sorry, there was an error uploading your file.";
			}
		}

		return View::create("admin/images")->with($viewData);
	}

	public static function delete($id) {}
}

?>
