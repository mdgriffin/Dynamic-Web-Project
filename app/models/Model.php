<?php

trait Model {
	protected static $db;

	public function __call ($name, $arguments) {
		// if the method called starts with set and the property exists, set the property
		if (substr($name, 0,3) == "set" && property_exists($this, strtolower(substr($name, 3)))) {
			$propName = strtolower(substr($name, 3));
			$this->$propName = $arguments[0];
		// otherwise try and call one of the other methods
		} else {
			if (!isset(self::$db)) {
				self::$db = Connection::get_connection();
			}

			$name = '_' . $name;

			if (method_exists($this, $name)) {
				return $this->$name(implode(', ', $arguments));
			} else {
				return null;
			}
		}
	}

	public static function __callStatic ($name, $arguments) {
		if (!isset(self::$db)) {
			self::$db = Connection::get_connection();
		}



		$name = '_' . $name;

		if (method_exists(get_class(), $name)) {
			return self::$name(implode(', ', $arguments));
		} else {
			return null;
		}
	}
}

?>
