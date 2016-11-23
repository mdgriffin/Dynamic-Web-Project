<?php

class VenueImage {
	use Model;

	private $id;
	private $venue_id;
	private $source;
	private $title;

	public function __construct ($venue_id, $source, $title) {
		$this->setVenue_id($venue_id);
		$this->setSource($source);
		$this->setTitle($title);
	}

	public function errors () {
		$errors = array();

		$titleValidator = (new Validator($this->title, array("isMinLength" => "Image Title must contain at least 7 characters")))->isMinLength(7)->isMaxLength(75);

		if (!$titleValidator->isValid()) {
			$errors["title"] = $titleValidator->errors();
		}
		return $errors;
	}

	private function _save () {

		$insert_stmt = self::$db->prepare("INSERT INTO Venue_Images (venue_id, source, title) VALUES(:venue_id, :source, :title)");

		$insert_stmt->execute(array(
			':venue_id' => $this->venue_id,
			':source' => $this->source,
			':title' => $this->title
		));

		$this->id = self::$db->lastInsertId("image_id");
	}

	private static function _delete ($id) {
		$delete_stmt = self::$db->prepare("DELETE FROM Venue_Images WHERE image_id=?");
		$res = $delete_stmt->execute(array($id));

		return $res;
	}

	private static function _get ($image_id) {
		$select_stmt = self::$db->prepare("SELECT * FROM Venue_Images WHERE image_id=?");
		$select_stmt->execute(array($id));
		$image_res = $select_stmt->fetch(PDO::FETCH_ASSOC);

		if ($image_res) {
			$image = new VenueImage($image_res["name"], $image_res["address"], $image_res["description"], $image_res["latitude"], $image_res["longitude"]);
			$image->setId($id);

			return $image;
		} else {
			return null;
		}
	}

	private static function _getAll ($venue_id) {
		$select_stmt = self::$db->prepare("SELECT * FROM Venue_Images WHERE venue_id=?");
		$select_stmt->execute(array($venue_id));
		return $select_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}

?>
