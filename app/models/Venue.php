<?php
class	Venue {
	use Model;

	private $id;
	private $name;
	private $address;
	private $description;
	private $latitude;
	private $longitude;

	public function __construct ($name, $address, $description, $latitude, $longitude) {
		$this->setName($name);
		$this->setAddress($address);
		$this->setDescription($description);
		$this->setLatitude($latitude);
		$this->setLongitude($longitude);
	}

	public function errors () {
		$errors = array();

		$nameValidator = (new Validator($this->name, array("isMinLength" => "Hotel Name must contain at least 7 characters")))->isMinLength(7)->isMaxLength(50);

		if (!$nameValidator->isValid()) {
			$errors["name"] = $nameValidator->errors();
		}

		$addressValidator = (new Validator($this->address))->isMinLength(20)->isMaxLength(150);

		if (!$addressValidator->isValid()) {
			$errors["address"] = $addressValidator->errors();
		}

		$descriptionValidator = (new Validator($this->description))->isMinLength(30)->isMaxLength(150);

		if (!$descriptionValidator->isValid()) {
			$errors["description"] = $descriptionValidator->errors();
		}

		return $errors;
	}

	private function _save () {

		$insert_stmt = self::$db->prepare("INSERT INTO Venues (name, address, description, latitude, longitude) VALUES(:name, :address, :description, :latitude, :longitude)");

		$insert_stmt->execute(array(
			':name' => $this->name,
			':address' => $this->address,
			':description' => $this->description,
			':latitude' => $this->latitude,
			':longitude' => $this->longitude
		));

		$this->id = self::$db->lastInsertId("venue_id");
	}

	private function _update () {
		if (isset($this->id)) {
			$update_stmt = self::$db->prepare("UPDATE Venues SET name=:name, address=:address, description=:description, latitude=:latitude, longitude=:longitude WHERE venue_id=:id");

			$update_stmt->execute(array(
				':name' => $this->name,
				':address' => $this->address,
				':description' => $this->description,
				':latitude' => $this->latitude,
				':longitude' => $this->longitude,
				':id' => $this->id
			));
		}
	}

	private static function _getAll () {
		$select_stmt = self::$db->prepare("SELECT * FROM Venues");
		$select_stmt->execute();
		return $select_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private static function _get($id) {
		$select_stmt = self::$db->prepare("SELECT * FROM Venues WHERE venue_id=?");
		$select_stmt->execute(array($id));
		return $select_stmt->fetch(PDO::FETCH_ASSOC);
	}

	private function _getRooms () {
		// get the related room of this venue
	}

}

?>
