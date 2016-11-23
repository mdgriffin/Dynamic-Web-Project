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
			"image" => new VenueImage($venue_id, "", ""),
			"venue_images"=> VenueImage::getAll($venue_id),
			"venue_id" => $venue_id,
		));
	}

	public static function create($venue_id, $data, $files) {
		$viewData = array();
		$viewData["errors"] = array();
		$viewData["venue"] = Venue::get($venue_id);
		$viewData["venue_images"] = VenueImage::getAll($venue_id);
		$target_dir = "Assets/uploads/";
		$imageFileType = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
		$target_file = $target_dir . round(microtime(true) * 10000) . "." . $imageFileType;
		$uploaded = true;

		$uploaded = (getimagesize($files["image_file"]["tmp_name"]) !== false? true:false);

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
				$viewData["image"] = new VenueImage($venue_id, $target_file, $data["title"]);

				if (!$viewData["image"]->errors()) {
					$viewData["image"]->save();
						$viewData["flash_message"] = "Successfully created a new venue image.";
				} else {
					$viewData["errors"] = $viewData["image"]->errors();
				}
			} else {
				$viewData["flash_error"] = "Sorry, there was an error uploading your file.";
			}
		}

		return View::create("admin/images")->with($viewData);
	}

	public static function delete($id) {}
}

?>
