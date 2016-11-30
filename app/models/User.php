<?php
class	User {
	use Model;

	private $id;
	private $forename;
	private $surname;
	private $email;
	private $password;
	private $is_admin;

	public function __construct ($forename, $surname, $email, $password, $is_admin) {
		$this->setForename($forename);
		$this->setSurname($surname);
		$this->setEmail($email);
		$this->setPassword($password);
		$this->setIs_admin($is_admin);
	}

	public function getFullname () {
		return $this->forename . " " . $this->surname;
	}

	/**
	 * Example of good Password Security found here: https://alias.io/2010/01/store-passwords-safely-with-php-and-mysql/
	 **/

	public function hashPassword () {
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;

		return crypt($this->password, $salt);
	}

	public function errors () {
		$errors = array();

		$forenameValidator = (new Validator($this->forename, array()))->isMinLength(2)->isMaxLength(30);
		if (!$forenameValidator->isValid()) {
			$errors["forename"] = $forenameValidator->errors();
		}

		$surnameValidator = (new Validator($this->surname, array()))->isMinLength(2)->isMaxLength(30);
		if (!$surnameValidator->isValid()) {
			$errors["surname"] = $surnameValidator->errors();
		}

		$emailValidator = (new Validator($this->email, array()))->isEmail();
		if (!$emailValidator->isValid()) {
			$errors["email"] = $emailValidator->errors();
		}

		$passwordValidator = (new Validator($this->password, array()))->isMinLength(7)->isMaxLength(30);
		if (!$passwordValidator->isValid()) {
			$errors["password"] = $passwordValidator->errors();
		}

		return $errors;
	}

	private function _save () {
		$insert_stmt = self::$db->prepare("INSERT INTO Users (forename, surname, email, password, is_admin) VALUES(:forename, :surname, :email, :password, :is_admin)");

		$insert_stmt->execute(array(
			':forename' => $this->forename,
			':surname' => $this->surname,
			':email' => $this->email,
			':password' => $this->hashPassword(),
			':is_admin' => $this->is_admin
		));

		$this->id = self::$db->lastInsertId("admin_id");
	}

	public static function _isUser($email, $password) {
		$user_pass_stmt = self::$db->prepare("SELECT user_id, password FROM Users WHERE email=:email");

		$user_pass_stmt->execute(array(
			':email' => $email
		));

		$user = $user_pass_stmt->fetch(PDO::FETCH_ASSOC);

		if (hash_equals($user["password"], crypt($password, $user["password"]))) {
				return $user["user_id"];
		} else {
			return null;
		}
	}

	public static function _isAdmin ($email, $password) {
		$admin_pass_stmt = self::$db->prepare("SELECT user_id, password FROM Users WHERE email=:email AND is_admin=1");

		$admin_pass_stmt->execute(array(
			':email' => $email
		));

		$admin = $admin_pass_stmt->fetch(PDO::FETCH_ASSOC);

		if (hash_equals($admin["password"], crypt($password, $admin["password"]))) {
				return $admin["user_id"];
		} else {
			return null;
		}
	}

	private function _update () {
		if (isset($this->id)) {
			$update_stmt = self::$db->prepare("UPDATE Users SET forename=:forename, surname=:surname, email=:email, password=:password, is_admin=:is_admin WHERE user_id=:id");

			$update_stmt->execute(array(
				':forename' => $this->forename,
				':surname' => $this->surname,
				':email' => $this->email,
				':password' => $this->hashPassword(),
				':is_admin' => $this->is_admin,
				':id' => $this->id
			));
		} else {
			return null;
		}
	}

	private static function _getAll () {
		$select_stmt = self::$db->prepare("SELECT * FROM Users");
		$select_stmt->execute();
		return $select_stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private static function _get($id) {
		$select_stmt = self::$db->prepare("SELECT * FROM Users WHERE user_id=?");
		$select_stmt->execute(array($id));
		$user_res = $select_stmt->fetch(PDO::FETCH_ASSOC);

		// if there is a user
		if ($user_res) {
			$user = new User($user_res["forename"], $user_res["surname"], $user_res["email"], $user_res["password"], $user_res["is_admin"]);
			$user->setId($id);

			return $user;
		} else {
			return null;
		}

	}

	private static function _delete ($id) {
		$delete_stmt = self::$db->prepare("DELETE FROM Users WHERE user_id=?");
		$res = $delete_stmt->execute(array($id));

		return $res;
	}

}

?>
