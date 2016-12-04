<?php

class Router {
	private $controller;
	private static $routeMatched = false;

	public static function delete ($regMatchStr, $callback_fn) {
		if (!self::$routeMatched && preg_match($regMatchStr, $_SERVER["REQUEST_URI"], $matches) && $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["METHOD"]) && $_POST["METHOD"] == "DELETE") {
			$callback_fn($matches);
			self::$routeMatched = true;
		}
	}

	public static function get ($regMatchStr, $callback_fn) {
		if (!self::$routeMatched && preg_match($regMatchStr, $_SERVER["REQUEST_URI"], $matches) && $_SERVER["REQUEST_METHOD"] == "GET") {
			$callback_fn($matches);
			self::$routeMatched = true;
		}
	}

	public static function post ($regMatchStr, $callback_fn) {
		if (!self::$routeMatched && preg_match($regMatchStr, $_SERVER["REQUEST_URI"], $matches) && $_SERVER["REQUEST_METHOD"] == "POST") {
			$callback_fn($matches);
			self::$routeMatched = true;
		}
	}

	public static function restful ($regMatchStr, $cb) {
		if (!self::$routeMatched && preg_match($regMatchStr, $_SERVER["REQUEST_URI"])) {

			$controller = $cb();

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

			self::$routeMatched = true;

		}
	}

	public static function missing ($cb) {
		if (!self::$routeMatched) {
			$cb();
		}
	}

}

?>
