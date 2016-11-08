<?php
class	 Admin {
	use Model;

	private $id;
	private $forename;
	private $surname;
	private $email;
	private $password;

	public function __construct ($forename, $surname, $email, $password) {
		$this->setForename($forename);
		$this->setSurname($surname);
		$this->setEmail($email);
		$this->setPassword();
	}

	/**
	 * Example of good Password Security found here: https://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/
	 **/

	public function setPassword ($password) {
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;

		$this->password = crypt($password, $salt);
	}

	public static function isAdmin ($username, $password) {
		// check if this is a registered user
	}

	public function errors () {
		$errors = array();

		return $errors;
	}

	private function _save () {
		$insert_stmt = self::$db->prepare("INSERT INTO Admins (forename, surname, email, password) VALUES(:forename, :surname, :email, :password)");

		$insert_stmt->execute(array(
			':forename' => $this->forename,
			':surname' => $this->surname,
			':email' => $this->email,
			':password' => $this->password
		));

		$this->id = self::$db->lastInsertId("admin_id");
	}

	private function _update () {

	}

	private static function _getAll ($arg) {

	}

	private static function _get($id) {

	}

}

?>
