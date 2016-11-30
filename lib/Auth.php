<?php

class Auth {
	public static function admin () {
		if (isset($_SESSION["admin_logged_in"]) && $_SESSION["admin_logged_in"]) {
			return $_SESSION["admin_id"];
		} else {
			return false;
		}
	}

	public static function user () {
		if (isset($_SESSION["auth_user_logged_in"]) && $_SESSION["auth_user_logged_in"]) {
			return $_SESSION["auth_user_id"];
		} else {
			return false;
		}
	}
}

?>
