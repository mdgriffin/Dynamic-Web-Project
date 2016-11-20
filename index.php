<?php
session_start();

require_once "app/config.php";
require_once "app/connection.php";
require_once "app/Validator.php";
require_once "app/Router.php";

require_once "app/models/Model.php";
require_once "app/models/User.php";
require_once "app/models/Venue.php";
require_once "app/models/Package.php";

require_once "app/View.php";
require_once "app/controllers/PackageController.php";

// Step 1: All traffic (except fro static files should come through the index.php)
// Step 2:

/*
Router::get("admin/login.*", function () {
	AdminController::doSomething();
});

Router::post("admin/login.*", function () {
	AdminController::doSomething();
});

// handle the missing routes
Router::missing();
*/

//Router::restful("/^.+admin\/users(?:.*)?$/", new AdminUsersController());
//Router::restful("/^.+admin\/venues(?:.*)?$/", new AdminVenuesController());
Router::restful("/^.+admin\/packages(?:.*)?$/", new PackageController());




?>
