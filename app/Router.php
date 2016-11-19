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

}

?>
