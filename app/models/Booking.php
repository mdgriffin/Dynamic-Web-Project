<?php

class Booking {
	use Model;

	private $id;
	private $user_id;
	private $package_id;
	private $venue_id;
	private $num_guests;
	private $booking_date;
	private $event_date;
	private $total;

	public function __construct ($user_id, $package_id, $venue_id, $num_guests, $booking_date, $event_date) {
		$this->setUser_id($user_id);
		$this->setPackage_id($package_id);
		$this->setVenue_id($venue_id);
		$this->setNum_guests($num_guests);
		$this->setBooking_date($booking_date);
		$this->setEvent_date($event_date);
	}

	public function errors () {

	}

	private function _save () {
		$insert_stmt = self::$db->prepare("INSERT INTO Bookings (user_id, package_id, venue_id, num_guests, booking_date, event_date, total) VALUES(:user_id, :package_id, :venue_id, :num_guests, :booking_date, :event_date, (SELECT price_per_guest FROM Packages WHERE package_id = :package_id)) * :num_guests");

		$insert_stmt->execute(array(
			':venue_id' => $this->venue_id,
			':user_id' => $this->user_id,
			':package_id' => $this->package_id,
			':venue_id' => $this->venue_id,
			':num_guests,' => $this->num_guests,
			':booking_date' => $this->booking_date,
			':event_date' => $this->event_date
		));

		$this->id = self::$db->lastInsertId("booking_id");
	}

}

?>
