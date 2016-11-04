<?php

class Validator {
	private $value;
	private $errors = array();
	private $error_messages = array(
		"isMinLength" => "Insuffient Length",
		"isMaxLength" => "Too Long",
		"isNumeric" => "Must contain only numeric characters",
		"isAlpha" => "Must contain only alphabetic characters",
		"isAlphaNumeric" => "Must contain only alpha-numeric characters",
		"isEmpty" => "Cannot be empty",
		"isEmail" => "Must be a valid email address"
	);

	public function __construct ($value, $error_messages = array()) {
		$this->value = $value;

		// merge the error messages and the default error messages
		$this->error_messages = array_merge($this->error_messages, $error_messages);
	}

	public function isNumeric () {
		$this->errors["isNumeric"] = $this->error_messages["isNumeric"];

		return $this;
	}

	public function isAlpha () {
		$this->errors["isAlpha"] = $this->error_messages["isAlpha"];

		return $this;
	}

	public function isAlphaNumeric () {
		$this->errors["isAlphaNumeric"] = $this->error_messages["isAlphaNumeric"];

		return $this;
	}

	public function isMinLength ($length) {
		$this->errors["isMinLength"] = $this->error_messages["isMinLength"];

		return $this;
	}

	public function isMaxLength ($length) {
		$this->errors["isMaxLength"] = $this->error_messages["isMaxLength"];

		return $this;
	}

	public function isEmpty () {
		$this->errors["isEmpty"] = $this->error_messages["isEmpty"];

		return $this;
	}

	public function isEmail () {
		$this->errors["isEmail"] = $this->error_messages["isEmail"];

		return $this;
	}

	public function errors () {
		return $this->errors;
	}

	public function isValid () {
		return false;
	}

}

?>
