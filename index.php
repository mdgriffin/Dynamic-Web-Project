<?php
session_start();

// Config
require_once "app/config.php";

// Library
require_once "lib/connection.php";
require_once "lib/Validator.php";
require_once "lib/Router.php";
require_once "lib/View.php";
require_once "lib/Model.php";
require_once "lib/RestfulController.php";

// Models
require_once "app/models/User.php";
require_once "app/models/Venue.php";
require_once "app/models/Package.php";

// Controllers

require_once "app/controllers/AdminVenuesController.php";
require_once "app/controllers/PackageController.php";

// Routing
Router::restful("/^.+admin\/venues(?:.*)?$/", new AdminVenuesController());
Router::restful("/^.+admin\/packages(?:.*)?$/", new PackageController());

Router::post("/^.+admin\/login(?:.*)?$/", function () {
	if (isset($_POST["login"])) {
		if (User::isAdmin($_POST["email"], $_POST["password"])) {
			$_SESSION["admin_logged_in"] = true;
			header('Location:index.php');
		} else {
			echo "<h1>Not an admin</h1>";
		}
	}
});

Router::post("/^.+admin\/logout(?:.*)?$/", function () {
	if (isset($_POST["logout"])) {
		session_destroy();
		header("Location:login.php");
	}
});

Router::get("/^.+admin\/login(?:.*)?$/", function () {
	die("show the admin login");
});

Router::get("/^" . $config["base_url"] . "(?:index.php)?$/", function () {
	View::create("home")->with(array("pageTitle" => "Home Page"));
});

// handle the missing routes
//Router::missing();


?>
