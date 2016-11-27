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
require_once "lib/RestfulControllerInterface.php";
require_once "lib/Image.php";
require_once "lib/Auth.php";

// Models
require_once "app/models/User.php";
require_once "app/models/Venue.php";
require_once "app/models/Package.php";
require_once "app/models/VenueImage.php";

// Home controllers
require_once "app/controllers/HomeController.php";

// Admin Controllers
require_once "app/controllers/AdminController.php";
require_once "app/controllers/AdminVenuesController.php";
require_once "app/controllers/AdminPackageController.php";
require_once "app/controllers/AdminUsersController.php";
require_once "app/controllers/AdminImagesController.php";

// Routing
Router::restful("/^.+admin\/venues(?:\.php)?(?:\?id=[0-9]{1,9})?$/", function () {
	return new AdminVenuesController();
});

Router::restful("/^.+admin\/packages(?:\.php)?(?:\?id=[0-9]{1,9})?$/", function () {
	return new AdminPackageController();
});

Router::restful("/^.+admin\/users(?:.*)?(?:\?id=[0-9]{1,9})?$/", function () {
	return new AdminUsersController();
});

/**
 * Home Page
 */

Router::get("/^.+admin\/?(?:home)?$/", function () {
	(new AdminController)->getIndex();
});

/**
 * Admin Login
 */

Router::get("/^.+admin\/login(?:.*)?$/", function () {
	(new AdminController)->getLogin();
});

Router::post("/^.+admin\/login(?:\.php)?$/", function () {
	(new AdminController)->postLogin($_POST["email"], $_POST["password"]);
});

Router::post("/^.+admin\/logout(?:\.php)?$/", function () {
	(new AdminController)->postLogout($_POST);
});

/**
 * Admin Images
 */
 Router::get("/^.+admin\/venues\/([0-9]{1,9})\/images?$/", function ($matches) {
	 if (Auth::admin()) {
		 (new AdminImagesController)->index($matches[1]);
	 } else {
		 header('Location:login');
	 }
 });

Router::post("/^.+admin\/venues\/([0-9]{1,9})\/images?$/", function ($matches) {
	 if (Auth::admin() && isset($_POST["METHOD"]) && $_POST["METHOD"] == "DELETE") {
		 (new AdminImagesController)->delete($matches[1], $_POST);
	 } else if (Auth::admin()) {
		 (new  AdminImagesController)->create($matches[1], $_POST, $_FILES);
	 } else {
		 header('Location:login');
	 }
 });


	// Home Page
	Router::get("/^" . $config["base_url"] . "(?:index.php)?$/", function () {
		View::create("home")->with(array("pageTitle" => "Home Page"));
	});

	Router::get("/^" . $config["base_url"] . "login$/", function () {
		(new HomeController)->getLogin();
	});

	Router::get("/^" . $config["base_url"] . "register$/", function () {
		(new HomeController)->getRegister();
	});

	Router::post("/^" . $config["base_url"] . "register$/", function () {
		(new HomeController)->postRegister();
	});

	Router::get("/^" . $config["base_url"] . "venues$/", function () {
		(new HomeController)->getVenueIndex();
	});

	Router::get("/^" . $config["base_url"] . "venues\/([0-9]{1,9})$/", function ($matches) {
		(new HomeController)->getVenue($matches[1]);
	});


// handle the missing routes
Router::missing(function () {
	echo "404!";
});


?>
