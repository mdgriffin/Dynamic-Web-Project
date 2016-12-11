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

		$descriptionValidator = (new Validator($this->description))->isMinLength(30)->isMaxLength(1000);

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
		} else {
			return null;
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
		$venue_res = $select_stmt->fetch(PDO::FETCH_ASSOC);

		// if there is a venue
		if ($venue_res) {
			$venue = new Venue($venue_res["name"], $venue_res["address"], $venue_res["description"], $venue_res["latitude"], $venue_res["longitude"]);
			$venue->setId($id);

			return $venue;
		} else {
			return null;
		}

	}

	private static function _delete ($id) {
		$delete_stmt = self::$db->prepare("DELETE FROM Venues WHERE venue_id=?");
		$res = $delete_stmt->execute(array($id));

		return $res;
	}

	private static function _getAllWithImage () {
		$select_stmt = self::$db->prepare("SELECT *  FROM Venues V, Venue_Images I where V.venue_id = I.venue_id AND I.image_id = (SELECT MAX(image_id) FROM Venue_Images WHERE venue_id = V.venue_id)");
		$select_stmt->execute();
		return $select_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private static function _find ($searchterm, $min_guests, $max_guests, $date) {
		$select_stmt = self::$db->prepare(
			"SELECT V.venue_id, V.name, V.description AS venue_description, V.latitude, V.longitude, P.package_id, P.title, P.description AS package_description, P.price_per_guest FROM Venues V, Packages P " .
			"WHERE (LOWER(V.address) LIKE :location OR LOWER(V.name) LIKE :venue) " .
				"AND P.min_guests <= :min_guests " .
				"AND P.max_guests >= :max_guests " .
				"AND V.venue_id NOT IN (SELECT B.venue_id FROM Bookings B WHERE B.event_date = :event_date) " .
				"AND V.venue_id = P.venue_id " .
				"AND :date BETWEEN P.start_date AND P.end_date"
		);

		$select_stmt->execute(array(
			':location' => "%" . strtoLower($searchterm) . "%",
			':venue' => "%" . strtoLower($searchterm) . "%",
			':min_guests' => $min_guests,
			':max_guests' => $max_guests,
			":event_date" => $date,
			":date" => $date
		));

		return $select_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

}

?>
