<?php

class Router {
	private $controller;

	public function __construct ($controller) {
		$this->controller = $controller;

		$this->controller::before();

		if (isset($_POST["register"])) {
			$this->controller::save($_POST);
		} else if (isset($_POST["delete"])) {
			$this->controller::delete($_POST["id"]);
		} else if (isset($_GET["id"])) {
				$this->controller::view($_GET["id"]);
		} else {
			$this->controller::index();
		}

		$this->controller::after();
	}


	public static function match ($regMatchStr, $callback_fn) {
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
