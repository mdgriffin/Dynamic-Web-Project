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
		$this->setPassword($password);
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

	public static function _isAdmin ($email, $password) {
		$admin_pass_stmt = self::$db->prepare("SELECT password FROM Admins WHERE email=:email");

		$admin_pass_stmt->execute(array(
			':email' => $email
		));

		$admin = $admin_pass_stmt->fetch(PDO::FETCH_ASSOC);

		if (hash_equals($admin["password"], crypt($password, $admin["password"]))) {
				return true;
		} else {
			return false;
		}
	}

	private function _update () {

	}

	private static function _getAll ($arg) {

	}

	private static function _get($id) {

	}

}

?>
