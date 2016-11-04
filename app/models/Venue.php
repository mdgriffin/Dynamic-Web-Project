<?php

class	Venue {
	// reference to the db connection
	private static $db;

	private $id;
	private $name;
	private $address;
	private $description;
	private $latitude;
	private $longitude;

	public function __construct ($name, $address, $description, $latitude, $longitude) {
		$this->name = $name;
		$this->address = $address;
		$this->description = $description;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
	}

	public function __call ($name, $arguments) {
		// if the method called starts with set and the property exists, set the property
		if (substr($name, 0,3) == "set" && property_exists($this, strtolower(substr($name, 3)))) {
			$propName = strtolower(substr($name, 3));
			$this->$propName = $arguments[0];
		// otherwise try and call one of the other methods
		} else {
			if (!isset(self::$db)) {
				self::$db = Connection::get_connection();
			}

			$name = '_' . $name;

			if (method_exists($this, $name)) {
				return $this->$name(implode(', ', $arguments));
			} else {
				return null;
			}
		}
	}

	public static function __callStatic ($name, $arguments) {
		if (!isset(self::$db)) {
			self::$db = Connection::get_connection();
		}

		$name = '_' . $name;

		if (method_exists(get_class(), $name)) {
			return self::$name(implode(', ', $arguments));
		} else {
			return null;
		}
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

	private static function _getAll ($arg) {
		$select_stmt = self::$db->prepare("SELECT * FROM Venues");
		$select_stmt->execute();
		return $select_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private static function _get($id) {
		$select_stmt = self::$db->prepare("SELECT * FROM Venues WHERE venue_id=?");
		$select_stmt->execute(array($id));
		return $select_stmt->fetch(PDO::FETCH_ASSOC);
	}

}

?>
