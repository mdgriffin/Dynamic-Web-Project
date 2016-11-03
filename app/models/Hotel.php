<?php
class	Hotel {
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

	public function save () {
		global $db;

		$insert_stmt = $db->prepare("INSERT INTO Hotels (name, address, description, latitude, longitude) VALUES(:name, :address, :description, :latitude, :longitude)");

		$insert_stmt->execute(array(
			':name' => $this->name,
			':address' => $this->address,
			':description' => $this->description,
			':latitude' => $this->latitude,
			':longitude' => $this->longitude
		));

		$this->id = $db->lastInsertId("hotel_id");
	}

	public function update () {
		global $db;

		if (isset($this->id)) {
			$update_stmt = $db->prepare("UPDATE Hotels SET name=:name, address=:address, description=:description, latitude=:latitude, longitude=:longitude WHERE hotel_id=:id");

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

	public function setName ($name) {
		$this->name  = $name;
	}

	public function setAddress ($name) {
		$this->address = $address;
	}

	public function setDescription ($description) {
		$this->description = $description;
	}

	public function setLatitude ($latitude) {
		$this->latitude = $latitude;
	}

	public function setLongitude ($longitude) {
		$this->longitude = $longitude;
	}

	public static function getAll () {
		global $db;

		$select_stmt = $db->prepare("SELECT * FROM Hotels");
		$select_stmt->execute();
		return $select_stmt->fetchAll();
	}

}

?>
