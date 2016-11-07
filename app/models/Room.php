<?php
class	 Room {
	use Model;

	private $id;
	private $venue_id
	private $capacity;

	public function __construct ($venue_id, $capacity) {
		$this->setVenue_id($venue_id);
		$this->setCapacity($capacity);
	}

	public function errors () {
		$errors = array();

		return $errors;
	}


	private function _save () {
	}

	private function _update () {

	}

	private static function _getAll ($arg) {

	}

	private static function _get($id) {

	}

}

?>
