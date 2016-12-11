<?php
class	Package {
	use Model;

	private $id;
	private $venue_id;
	private $title;
	private $description;
	private $price_per_guest;
	private $min_guests;
	private $max_guests;
	private $start_date;
	private $end_date;

	public function __construct ($venue_id, $title, $description, $price_per_guest, $min_guests, $max_guests, $start_date, $end_date) {
		$this->setVenue_id($venue_id);
		$this->setTitle($title);
		$this->setDescription($description);
		$this->setPrice_per_guest($price_per_guest);
		$this->setMin_guests($min_guests);
		$this->setMax_guests($max_guests);
		$this->setStart_date($start_date);
		$this->setEnd_date($end_date);
	}

	public function errors () {
		$errors = array();

		$titleValidator = (new Validator($this->title, array("isMinLength" => "Package Title must contain at least 7 characters")))->isMinLength(7)->isMaxLength(50);
		if (!$titleValidator->isValid()) {
			$errors["title"] = $titleValidator->errors();
		}

		$descriptionValidator = (new Validator($this->description))->isMinLength(24);
		if (!$descriptionValidator->isValid()) {
			$errors["description"] = $descriptionValidator->errors();
		}

		$pricePerGuesValidator = (new Validator($this->price_per_guest))->isPositiveNumber();
		if (!$pricePerGuesValidator) {
			$errors["price_per_guest"] = $pricePerGuesValidator->errors();
		}

		$minGuestsValidator = (new Validator($this->min_guests))->isInteger();
		if (!$minGuestsValidator->isValid()) {
			$errors["min_guests"] = $minGuestsValidator->errors();
		}

		$maxGuestsValidator = (new Validator($this->max_guests))->isInteger();
		if (!$maxGuestsValidator->isValid()) {
			$errors["max_guests"] = $maxGuestsValidator->errors();
		}

		$startDateValidator = (new Validator($this->start_date))->isDate();
		if (!$startDateValidator->isValid()) {
			$errors["start_date"] = $startDateValidator->errors();
		}

		$endDateValidator = (new Validator($this->end_date))->isDate();
		if (!$endDateValidator->isValid()) {
			$errors["end_date"] = $endDateValidator->errors();
		}

		return $errors;
	}

	private function _save () {
		$insert_stmt = self::$db->prepare("INSERT INTO Packages (venue_id, title, description, price_per_guest, min_guests, max_guests, start_date, end_date) VALUES(:venue_id, :title, :description, :price_per_guest, :min_guests, :max_guests, :start_date, :end_date)");

		$insert_stmt->execute(array(
			':venue_id' => $this->venue_id,
			':title' => $this->title,
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
			$update_stmt = self::$db->prepare("UPDATE Packages SET venue_id=:venue_id, title=:title, description=:description, price_per_guest=:price_per_guest, min_guests=:min_guests, max_guests=:max_guests, start_date=:start_date, end_date=:end_date WHERE package_id=:package_id");

			$update_stmt->execute(array(
				':venue_id' => $this->venue_id,
				':title' => $this->title,
				':description' => $this->description,
				':price_per_guest' => $this->price_per_guest,
				':min_guests' => $this->min_guests,
				':max_guests' => $this->max_guests,
				':start_date' => $this->start_date,
				':end_date' => $this->end_date,
				':package_id' => $this->id
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

	private static function _getAllByVenue ($venue_id) {
		$select_stmt = self::$db->prepare("SELECT * FROM Packages WHERE venue_id = ?");
		$select_stmt->execute(array($venue_id));
		return $select_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private static function _get($id) {
		$select_stmt = self::$db->prepare("SELECT * FROM Packages WHERE package_id=?");
		$select_stmt->execute(array($id));
		$package_res = $select_stmt->fetch(PDO::FETCH_ASSOC);

		// if there is a package
		if ($package_res) {
			$package = new Package($package_res["venue_id"], $package_res["title"], $package_res["description"], $package_res["price_per_guest"], $package_res["min_guests"], $package_res["max_guests"], $package_res["start_date"], $package_res["end_date"]);
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
