<?php

class Auth {
	public static function admin () {
		if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"]) {
			return $_SESSION["admin_logged_in"];
		} else {
			return false;
		}
	}

	public static function user () {
		if (isset($_SESSION["user_logged_in"]) && $_SESSION["user_logged_in"]) {
			return $_SESSION["user_logged_in"];
		} else {
			return false;
		}
	}
}

?>
