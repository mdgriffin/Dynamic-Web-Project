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
require_once "app/models/VenueImage.php";

// Controllers

require_once "app/controllers/AdminVenuesController.php";
require_once "app/controllers/AdminPackageController.php";
require_once "app/controllers/AdminUsersController.php";
require_once "app/controllers/AdminImagesController.php";

// Routing
Router::restful("/^.+admin\/venues(?:\.php)?(?:\?id=[0-9]{1,9})?$/", new AdminVenuesController());
Router::restful("/^.+admin\/packages(?:\.php)?(?:\?id=[0-9]{1,9})?$/", new AdminPackageController());
Router::restful("/^.+admin\/users(?:.*)?(?:\?id=[0-9]{1,9})?$/", new AdminUsersController());

/**
 * Home Page
 */

Router::get("/^.+admin\/?(?:home)?$/", function () {
	View::create("admin/index")->with(array("pageTitle" => "Home Page"));
});

/**
 * Admin Login
 */

Router::get("/^.+admin\/login(?:.*)?$/", function () {
	if (!$_SESSION["admin_logged_in"]) {
		View::create("admin/login")->with(array("pageTitle" => "Admin Login"));
	} else {
		header('Location:home');
	}

});

Router::post("/^.+admin\/login(?:\.php)?$/", function () {
	if (User::isAdmin($_POST["email"], $_POST["password"])) {
		$_SESSION["admin_logged_in"] = true;
		header('Location:home');
	} else {
		View::create("admin/login")->with(array("pageTitle" => "Admin Login", "flash_error" => "Username and/or password is incorrect"));
	}
});

Router::post("/^.+admin\/logout(?:\.php)?$/", function () {
	if (isset($_POST["logout"])) {
		session_destroy();
		header('Location:login');
	}
});



Router::get("/^" . $config["base_url"] . "(?:index.php)?$/", function () {
	View::create("home")->with(array("pageTitle" => "Home Page"));
});

/**
 * Admin Images
 */
 Router::get("/^.+admin\/venues\/([0-9]{1,9})\/images?$/", function ($matches) {
	 AdminImagesController::index($matches[1]);
 });

 Router::post("/^.+admin\/venues\/([0-9]{1,9})\/images?$/", function ($matches) {
	AdminImagesController::create($matches[1], $_POST, $_FILES);
 });

// handle the missing routes
//Router::missing();


?>
