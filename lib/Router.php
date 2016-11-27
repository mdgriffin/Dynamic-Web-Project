<?php

class Router {
	private $controller;

	public static function get ($regMatchStr, $callback_fn) {
		if (preg_match($regMatchStr, $_SERVER["REQUEST_URI"], $matches) && $_SERVER["REQUEST_METHOD"] == "GET") {
			$callback_fn($matches);
		}
	}

	public static function post ($regMatchStr, $callback_fn) {
		if (preg_match($regMatchStr, $_SERVER["REQUEST_URI"], $matches) && $_SERVER["REQUEST_METHOD"] == "POST") {
			$callback_fn($matches);
		}
	}

	public static function restful ($regMatchStr, $controller ) {
		if (preg_match($regMatchStr, $_SERVER["REQUEST_URI"])) {

			$controller->before();

			if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
				$controller->read($_GET["id"]);
			} else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["METHOD"]) && $_POST["METHOD"] == "DELETE") {
				$controller->delete($_POST["id"]);
			}  else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["id"])) {
				$controller->update($_GET["id"], $_POST);
			} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$controller->create($_POST);
			} else {
				$controller->index();
			}

		}
	}

}

?>
