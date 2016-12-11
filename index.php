<?php
session_start();

// TODO The admin user should not be able to access the login and register user routes

// Config
require_once "app/config.php";

// Class Autoloading
spl_autoload_register(function ($class_name) {
	if (file_exists("lib/" . $class_name . ".php")) {
		include "lib/" . $class_name . ".php";
	} else if (file_exists("app/models/" . $class_name . ".php")) {
		include "app/models/" . $class_name . ".php";
	} else if (file_exists("app/controllers/admin/" . $class_name . ".php")) {
		include "app/controllers/admin/" . $class_name . ".php";
	} else if (file_exists("app/controllers/home/" . $class_name . ".php")) {
		include "app/controllers/home/" . $class_name . ".php";
	} else {
		return false;
	}
});

/**
 * Routing
 */

// Restful controller for managing venues
Router::restful("/^.+admin\/venues(?:\?id=[0-9]{1,9})?$/", function () {
	return new AdminVenuesController();
});

// Restful controller for managing users
Router::restful("/^.+admin\/users(?:\?id=[0-9]{1,9})?$/", function () {
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
Router::post("/^.+admin\/login\/?$/", function () {
	(new AdminController)->postLogin($_POST["email"], $_POST["password"]);
});

// Admin Logout
Router::post("/^.+admin\/logout\/??$/", function () {
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

/**
 * Admin Manage Bookings
 */

 Router::get("/^.+admin\/bookings$/", function () {
 	if (Auth::admin()) {
 		(new AdminBookingsController)->index();
 	} else {
 		header('Location:login');
 	}
 });

/**
 * Home Pages
 */

// Home Page
Router::get("/^" . $config["base_url"] . "(?:home)?$/", function () {
	(new HomeController)->getIndex();
});

// Show user login form
Router::get("/^" . $config["base_url"] . "login$/", function () {
	// Only allow acces to route if there is no user logged in
	if (!Auth::admin() && !Auth::user()) {
		(new UserController)->getLogin();
	} else {
		header('Location:home');
}
});

// Handle User Login
Router::post("/^" . $config["base_url"] . "login$/", function () {
	(new UserController)->postLogin($_POST["email"], $_POST["password"]);
});

// Handle User logout
Router::post("/^" . $config["base_url"] . "logout$/", function () {
	(new UserController)->postLogout($_POST);
});

// Show Register Form
Router::get("/^" . $config["base_url"] . "register$/", function () {
	// Only allow acces to route if there is no user logged in
	if (!Auth::admin() && !Auth::user()) {
		(new UserController)->getRegister();
	} else {
		header('Location:home');
	}
});

//Handle User Registration
Router::post("/^" . $config["base_url"] . "register$/", function () {
	(new UserController)->postRegister($_POST);
});

// Show user profile
Router::get("/^" . $config["base_url"] . "profile$/", function () {
	// Only allow acces to route if there is a user logged in
	if (Auth::user()) {
		(new UserController)->getprofile();
	} else {
		header('Location:home');
	}
});

Router::get("/^" . $config["base_url"] . "bookings$/", function () {
	// Only allow acces to route if there is a user logged in
	if (Auth::user()) {
		(new UserController)->getBookings();
	} else {
		header('Location:home');
	}
});


// Handle updating of a users profile (details)
Router::post("/^" . $config["base_url"] . "profile$/", function () {
	(new UserController)->postprofile($_POST);
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

// Search Results
Router::get("/^" . $config["base_url"] . "search(?:\?.+)$/", function () {
	(new HomeController)->getSearch($_GET);
});

// handle the missing routes
Router::missing(function () {
	header($_SERVER["SERVER_PROTOCOL"]. " 404 Not Found", true, 404);
	echo "404!";
});

?>
