<?php

class Connection {
	private static $db;

	public static function get_connection () {
		if (!isset(self::$db)) {
			global $config;

			try {
				self::$db = new PDO ($config["db_connection_string"], $config["db_user"], $config["db_pass"]);
				self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			} catch(PDOException $e) {
				die(print_r($e));
			}
		}

		return self::$db;
	}

}

?>
