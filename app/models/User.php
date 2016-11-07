<?php
class	User {
	use Model;

	private $id;
	private $forename;
	private $surname;
	private $email;
	private $telephone;
	private $password;

	public function __construct ($forename, $surname, $email, $telephone, $password) {
		$this->setForename($forename);
		$this->serSurname($surname);
		$this->setEmail($email);
		$this->setTelephone($telephone);
		$this->setPassword();
	}

	public function setPassword ($password) {
		// hash the password
	}

	public static function isUser ($username, $password) {
		// check if this is a registered user
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
