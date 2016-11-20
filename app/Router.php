<?php

class Router {
	private $controller;

	public static function get ($regMatchStr, $callback_fn) {
		if (preg_match($regMatchStr, $_SERVER["REQUEST_URI"])) {

		}
	}

	public static function post ($regMatchStr, $callback_fn) {
		if (preg_match($regMatchStr, $_SERVER["REQUEST_URI"])) {

		}
	}

	public static function restful ($regMatchStr, $controller ) {
		if (preg_match($regMatchStr, $_SERVER["REQUEST_URI"])) {
			$output = "";

			$output .+ $controller::before();

			if (isset($_POST["register"])) {
				$output .+ $controller::create($_POST);
			} else if (isset($_GET["id"]) && $_POST["update"]) {
				$output .+ $controller::update($_GET["id"], $_POST);
			} else if (isset($_POST["delete"])) {
				$output .+ $controller::delete($_POST["id"]);
			} else if (isset($_GET["id"])) {
				$output .+ $controller::view($_GET["id"]);
			} else {
				$output .+ $controller::index();
			}

			$output .+ $controller::after();

			echo $output;
		}
	}

}

?>
