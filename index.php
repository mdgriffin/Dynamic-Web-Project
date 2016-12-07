<?php
session_start();

// TODO The admin user should not be able to access the login and register user routes

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
require_once "app/models/Booking.php";

// Home controllers
require_once "app/controllers/HomeController.php";
require_once "app/controllers/PackageController.php";

// Admin Controllers
require_once "app/controllers/AdminController.php";
require_once "app/controllers/AdminVenuesController.php";
require_once "app/controllers/AdminPackageController.php";
require_once "app/controllers/AdminUsersController.php";
require_once "app/controllers/AdminImagesController.php";

/**
 * Routing
 */

// Restful controller for managing venues
Router::restful("/^.+admin\/venues(?:\.php)?(?:\?id=[0-9]{1,9})?$/", function () {
	return new AdminVenuesController();
});

// Restful controller for managing users
Router::restful("/^.+admin\/users(?:.*)?(?:\?id=[0-9]{1,9})?$/", function () {
	return new AdminUsersController();
});

/**
 * Admin Manage Packages
 */

// Show Index view of Venue Packages
Router::get("/^.+admin\/packages\?venue_id=([0-9]{1,9})$/", function ($matches) {
	return (new AdminPackageController())->getIndex($matches[1]);
});

// Register a new package
Router::post("/^.+admin\/packages\?venue_id=([0-9]{1,9})$/", function ($matches) {
	return (new AdminPackageController())->postIndex($matches[1], $_POST);
});

// Delete a package
Router::delete("/^.+admin\/packages\?venue_id=([0-9]{1,9})$/", function ($matches) {
	return (new AdminPackageController())->postDelete($matches[1], $_POST);
});

// Show update form
Router::get("/^.+admin\/packages\?venue_id=([0-9]{1,9})\&package_id=([0-9]{1,9})$/", function ($matches) {
	return (new AdminPackageController())->getUpdate($matches[1], $matches[2]);
});

// Update a package
Router::post("/^.+admin\/packages\?venue_id=([0-9]{1,9})\&package_id=([0-9]{1,9})$/", function ($matches) {
	return (new AdminPackageController())->postUpdate($matches[1], $matches[2], $_POST);
});

// Admin Home Page
Router::get("/^.+admin\/?(?:home)?$/", function () {
	(new AdminController)->getIndex();
});

// Show admin login form
Router::get("/^.+admin\/login(?:.*)?$/", function () {
	(new AdminController)->getLogin();
});

// Admin Login
Router::post("/^.+admin\/login(?:\.php)?$/", function () {
	(new AdminController)->postLogin($_POST["email"], $_POST["password"]);
});

// Admin Logout
Router::post("/^.+admin\/logout(?:\.php)?$/", function () {
	(new AdminController)->postLogout($_POST);
});

/**
 * Admin Images
 */

// Show index of admin images
Router::get("/^.+admin\/venues\/([0-9]{1,9})\/images?$/", function ($matches) {
	if (Auth::admin()) {
		(new AdminImagesController)->index($matches[1]);
	} else {
		header('Location:login');
	}
});

// Create and delete an image
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
Router::get("/^" . $config["base_url"] . "(?:home)?$/", function () {
	(new HomeController)->getIndex();
});

// Show user login form
Router::get("/^" . $config["base_url"] . "login$/", function () {
	// Only allow acces to route if there is no user logged in
	if (!Auth::admin() && !Auth::user()) {
		(new HomeController)->getLogin();
	} else {
		header('Location:home');
}
});

// Handle User Login
Router::post("/^" . $config["base_url"] . "login$/", function () {
(new HomeController)->postLogin($_POST["email"], $_POST["password"]);
});

// Handle User logout
Router::post("/^" . $config["base_url"] . "logout$/", function () {
	(new HomeController)->postLogout($_POST);
});

// Show Register Form
Router::get("/^" . $config["base_url"] . "register$/", function () {
	// Only allow acces to route if there is no user logged in
	if (!Auth::admin() && !Auth::user()) {
		(new HomeController)->getRegister();
	} else {
		header('Location:home');
	}
});

//Handle User Registration
Router::post("/^" . $config["base_url"] . "register$/", function () {
	(new HomeController)->postRegister($_POST);
});

// Show user profile
Router::get("/^" . $config["base_url"] . "profile$/", function () {
	// Only allow acces to route if there is a user logged in
	if (Auth::user()) {
		(new HomeController)->getprofile();
	} else {
		header('Location:home');
	}
});

// Handle updating of a users profile (details)
Router::post("/^" . $config["base_url"] . "profile$/", function () {
	(new HomeController)->postprofile($_POST);
});

// Show Index of Venues
Router::get("/^" . $config["base_url"] . "venues$/", function () {
	(new HomeController)->getVenueIndex();
});

// Show a single Venue
Router::get("/^" . $config["base_url"] . "venues\/([0-9]{1,9})$/", function ($matches) {
	(new HomeController)->getVenue($matches[1]);
});

// Get package details and booking form
Router::get("/^" . $config["base_url"] . "packages\/([0-9]{1,9})$/", function ($matches) {
	(new PackageController)->getPackage($matches[1]);
});

// Book a package
Router::post("/^" . $config["base_url"] . "packages\/([0-9]{1,9})$/", function ($matches) {
	(new PackageController)->postPackage($matches[1], $_POST);
});

// handle the missing routes
Router::missing(function () {
	echo "404!";
});

?>
