<?php
class	User {
	use Model;

	private $id;
	private $forename;
	private $surname;
	private $email;
	private $telephone;
	private $password;
	private $admin;

	public function __construct ($forename, $surname, $email, $password, $isAdmin) {
		$this->setForename($forename);
		$this->setSurname($surname);
		$this->setEmail($email);
		$this->setPassword($password);
		$this->setAdmin($isAdmin);
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
		$insert_stmt = self::$db->prepare("INSERT INTO Users (forename, surname, email, password, is_admin) VALUES(:forename, :surname, :email, :password, :is_admin)");

		$insert_stmt->execute(array(
			':forename' => $this->forename,
			':surname' => $this->surname,
			':email' => $this->email,
			':password' => $this->password,
			':is_admin' => $this->admin
		));

		$this->id = self::$db->lastInsertId("admin_id");
	}

	public static function _isUser($email, $password) {
		$user_pass_stmt = self::$db->prepare("SELECT password FROM Users WHERE email=:email");

		$user_pass_stmt->execute(array(
			':email' => $email
		));

		$user = $user_pass_stmt->fetch(PDO::FETCH_ASSOC);

		if (hash_equals($user["password"], crypt($password, $user["password"]))) {
				return true;
		} else {
			return false;
		}
	}

	public static function _isAdmin ($email, $password) {
		$admin_pass_stmt = self::$db->prepare("SELECT password FROM Users WHERE email=:email AND is_admin=1");

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
