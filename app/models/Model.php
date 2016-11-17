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
				return call_user_func_array (array($this, $name) , $arguments);
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
			//return self::$name(implode(', ', $arguments));
			return call_user_func_array (array(__class__, $name) , $arguments);
		} else {
			return null;
		}
	}
}

?>
