<?php

class Booking {
	use Model;

	private $id;
	private $user_id;
	private $venue_id;
	private $package_id;
	private $num_guests;
	private $booking_date;
	private $event_date;
	private $total;

	public function __construct ($user_id = "", $venue_id = "", $package_id = "", $num_guests = "", $event_date = "") {
		$this->setUser_id($user_id);
		$this->setVenue_id($venue_id);
		$this->setPackage_id($package_id);
		$this->setNum_guests($num_guests);
		$this->setEvent_date($event_date);
	}

	public function errors () {
		$errors = array();

		$package = Package::get($this->package_id);

		// validate that num_guests is numeric and greater than package min_guests and less than package max_guests
		$numGuestsValidator = (new Validator($this->num_guests, array(
				"isInRange" => "Number of guests must be between " . $package->getMin_guests() . " and " . $package->getMax_guests()
			)))->isInteger()->isInRange($package->getMin_guests(), $package->getMax_guests());

		if (!$numGuestsValidator->isValid()) {
			$errors["num_guests"] = $numGuestsValidator->errors();
		}

		// validate that venue is available at the selected date
		//$dateValidator = (new Validator($this->event_date, array()))->
		// check the booking table for venue_id date combination
		if (!self::venue_available($this->venue_id, $this->event_date)) {
			$errors["event_date"] = "The Venue is unavilable on the selected date, please try another date or another venue";
		}

		return $errors;
	}

	private function _save () {
		$insert_stmt = self::$db->prepare("INSERT INTO Bookings (user_id, venue_id, package_id, num_guests, booking_date, event_date, total) VALUES(:user_id, :venue_id, :package_id, :num_guests, NOW(), :event_date, (SELECT price_per_guest FROM Packages WHERE package_id = :package_id2) * :num_guests2)");

		$insert_stmt->execute(array(
			':user_id' => $this->user_id,
			':venue_id' => $this->venue_id,
			':package_id' => $this->package_id,
			':package_id2' => $this->package_id,
			':num_guests' => $this->num_guests,
			':num_guests2' => $this->num_guests,
			':event_date' => $this->event_date
		));

		$this->id = self::$db->lastInsertId("booking_id");
	}

	private static function _get($id) {
		$select_stmt = self::$db->prepare("SELECT * FROM Bookings WHERE booking_id=?");
		$select_stmt->execute(array($id));
		$booking_res = $select_stmt->fetch(PDO::FETCH_ASSOC);

		// if there is a package
		if ($booking_res) {
			$booking = new Package($booking_res["user_id"], $booking_res["venue_id"], $booking_res["package_id"], $booking_res["num_guests"], $booking_res["event_date"]);
			$booking->setId($id);
			$booking->setBooking_date($booking_res["booking_date"]);

			return $booking;
		} else {
			return null;
		}

	}

	private static function _venue_available ($venue_id, $event_date) {
		$select_stmt = self::$db->prepare("SELECT booking_id FROM Bookings WHERE venue_id=:venue_id AND event_date=:event_date");
		$select_stmt->execute(array(
			':venue_id' => $venue_id,
			':event_date' => $event_date
		));

		$booking_res = $select_stmt->fetch(PDO::FETCH_ASSOC);

		if ($booking_res) {
			return false;
		} else {
			return true;
		}

	}

}

?>
