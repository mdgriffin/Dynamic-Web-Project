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
			$output;

			$controller->before();

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$output = $controller->create($_POST);
			} else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
				$output = $controller->read($_GET["id"]);
			} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["id"])) {
				$output = $controller->update($_GET["id"], $_POST);
			} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["METHOD"]) && $_POST["METHOD"] == "DELETE") {
				$output = $controller->delete($_POST["id"]);
			}  else {
				$output = $controller->index();
			}

			$controller->after();

			echo $output;
		}
	}

}

?>
