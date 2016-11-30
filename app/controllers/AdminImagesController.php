<?php

class AdminImagesController {

	private $viewData = array();

	public function __construct () {
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
	public function index ($venue_id) {
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["image"] = new VenueImage($venue_id, "", "");
		$this->viewData["venue_images"] = VenueImage::getAll($venue_id);
		$this->viewData["venue_id"] = $venue_id;

		return View::create("admin/images")->with($this->viewData);
	}

	public function create($venue_id, $data, $files) {
		$viewData = array();
		$this->viewData["errors"] = array();
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["venue_id"] = $venue_id;
		$target_dir = "Assets/uploads/";
		$imageFileType = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);

		if ($imageFileType) {
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
				$this->viewData["flash_error"] = "Sorry, your file was not uploaded.";
			} else {
				if (move_uploaded_file($files["image_file"]["tmp_name"], $target_file)) {
					$this->viewData["image"] = new VenueImage($venue_id, $target_file, $data["title"]);

					if (!$this->viewData["image"]->errors()) {
						$this->viewData["image"]->save();
							$this->viewData["flash_message"] = "Successfully created a new venue image.";
					} else {
						$this->viewData["errors"] = $this->viewData["image"]->errors();
					}
				} else {
					$this->viewData["flash_error"] = "Sorry, there was an error uploading your file.";
				}
			}
		} else {
			$this->viewData["flash_error"] = "Please select an image file";
			$this->viewData["image"] = new VenueImage($venue_id, "", "");
		}

		$this->viewData["venue_images"] = VenueImage::getAll($venue_id);

		return View::create("admin/images")->with($this->viewData);
	}

	public function delete($venue_id, $data) {
		$this->viewData = array();
		$this->viewData["errors"] = array();
		$this->viewData["venue"] = Venue::get($venue_id);
		$this->viewData["venue_id"] = $venue_id;
		$this->viewData["image"] = new VenueImage($venue_id, "", "");

		$res = VenueImage::delete($data["image_id"]);
		if ($res) {
			$this->viewData["flash_message"] = "Successfully Delete Image";

			unlink($data["source"]);

			// remove the deleted image from the file system
		} else {
			$this->viewData["flash_error"] = "Failed to Delete Image";
		}

		$this->viewData["venue_images"] = VenueImage::getAll($venue_id);

		return View::create("admin/images")->with($this->viewData);
	}
}

?>
