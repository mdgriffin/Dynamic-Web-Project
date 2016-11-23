<?php
class	Package {
	use Model;

	private $id;
	private $venue_id;
	private $description;
	private $price_per_guest;
	private $min_guests;
	private $max_guests;
	private $start_date;
	private $end_date;

	public function __construct ($venue_id, $description, $price_per_guest, $min_guests, $max_guests, $start_date, $end_date) {
		$this->setVenue_id($venue_id);
		$this->setDescription($description);
		$this->setPrice_per_guest($price_per_guest);
		$this->setMin_guests($min_guests);
		$this->setMax_guests($max_guests);
		$this->setStart_date($start_date);
		$this->setEnd_date($end_date);
	}

	public function errors () {
		$errors = array();

		return $errors;
	}

	private function _save () {
		$insert_stmt = self::$db->prepare("INSERT INTO Packages (venue_id, description, price_per_guest, min_guests, max_guests, start_date, end_date) VALUES(:venue_id, :description, :price_per_guest, :min_guests, :max_guests, :start_date, :end_date)");

		$insert_stmt->execute(array(
			':venue_id' => $this->venue_id,
			':description' => $this->description,
			':price_per_guest' => $this->price_per_guest,
			':min_guests' => $this->min_guests,
			':max_guests' => $this->max_guests,
			':start_date' => $this->start_date,
			':end_date' => $this->end_date
		));

		$this->id = self::$db->lastInsertId("venue_id");
	}

	private function _update () {
		if (isset($this->id)) {
			$update_stmt = self::$db->prepare("UPDATE Packages SET venue_id=, description=:description, price_per_guest=:price_per_guest, min_guests=:min_guests, max_guests=:max_guests, start_date=:start_date, end_date=:end_date");

			$update_stmt->execute(array(
				':venue_id' => $this->venue_id,
				':description' => $this->description,
				':price_per_guest' => $this->price_per_guest,
				':min_guests' => $this->min_guests,
				':max_guests' => $this->max_guests,
				':start_date' => $this->start_date,
				':end_date' => $this->end_date
			));
		} else {
			return null;
		}
	}

	private static function _getAll () {
		$select_stmt = self::$db->prepare("SELECT * FROM Packages");
		$select_stmt->execute();
		return $select_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private static function _get($id) {
		$select_stmt = self::$db->prepare("SELECT * FROM Packages WHERE package_id=?");
		$select_stmt->execute(array($id));
		$package_res = $select_stmt->fetch(PDO::FETCH_ASSOC);

		// if there is a venue
		if ($package_res) {
			$package = new Venue($package_res["name"], $package_res["address"], $package_res["description"], $package_res["latitude"], $package_res["longitude"]);
			$package->setId($id);

			return $package;
		} else {
			return null;
		}

	}

	private static function _delete ($id) {
		$delete_stmt = self::$db->prepare("DELETE FROM Packages WHERE package_id=?");
		$res = $delete_stmt->execute(array($id));

		return $res;
	}

}

?>
