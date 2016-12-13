<?php

class Validator {
	private $value;
	private $errors = array();
	private $error_messages = array(
		"isMinLength"       => "Insuffient Length",
		"isMaxLength"       => "Too Long",
		"isInteger"         => "Must contain only numeric characters",
		"isNumeric"         => "Must be a valid number",
		"isPositiveNumber"  => "Must be a valid number greater than zero",
		"isAlpha"           => "Must contain only alphabetic characters",
		"isInRange"         => "Value outside of range",
		"isAlphaNumeric"    => "Must contain only alpha-numeric characters",
		"isEmpty"           => "Cannot be empty",
		"isEmail"           => "Must be a valid email address",
		"isDate"            => "Must be a valid date in the format YY-MM-DD"
	);

	public function __construct ($value, $error_messages = array()) {
		$this->value = $value;

		// merge the error messages and the default error messages
		$this->error_messages = array_merge($this->error_messages, $error_messages);
	}

	public function isInteger () {
		if (!ctype_digit($this->value)) {
			$this->errors["isInteger"] = $this->error_messages["isInteger"];
		}

		return $this;
	}

	public function isNumeric () {
		if (!is_numeric($this->value)) {
			$this->errors["isNumeric"] = $this->error_messages["isNumeric"];
		}

		return this;
	}

	public function isPositiveNumber () {
		if (!is_numeric($this->value) || (double)$this->value <= 0) {
			$this->errors["isPositiveNumber"] = $this->error_messages["isPositiveNumber"];
		}

		return $this;
	}

	public function isInRange($range_start, $range_end) {
		if ($this->value < $range_start || $this->value > $range_end) {
			$this->errors["isInRange"] = $this->error_messages["isInRange"];
		}

		return $this;
	}

	public function isAlpha () {
		if (!ctype_alpha($this->value)) {
			$this->errors["isAlpha"] = $this->error_messages["isAlpha"];
		}

		return $this;
	}

	public function isAlphaNumeric () {
		if (!ctype_alnum($this->value)) {
			$this->errors["isAlphaNumeric"] = $this->error_messages["isAlphaNumeric"];
		}

		return $this;
	}

	public function isMinLength ($min_length) {
		if (strlen($this->value) < $min_length) {
			$this->errors["isMinLength"] = $this->error_messages["isMinLength"];
		}

		return $this;
	}

	public function isMaxLength ($max_length) {
		if (strlen($this->value) > $max_length) {
			$this->errors["isMaxLength"] = $this->error_messages["isMaxLength"];
		}

		return $this;
	}

	public function isEmpty () {
		if (!strlen($this->value)) {
			$this->errors["isEmpty"] = $this->error_messages["isEmpty"];
		}

		return $this;
	}

	public function isEmail () {
		if (!(bool)filter_var($this->value, FILTER_VALIDATE_EMAIL)) {
			$this->errors["isEmail"] = $this->error_messages["isEmail"];
		}

		return $this;
	}

	public function isDate () {
		$dt = DateTime::createFromFormat('Y-m-d', $this->value);
		if (!$dt) {
			$this->errors["isDate"] = $this->error_messages["isDate"];
		}

		return $this;
	}

	public function errors () {
		return $this->errors;
	}

	public function isValid () {
		if (count($this->errors)) {
			return false;
		}
		return true;
	}

}

?>
