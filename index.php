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

Router::restful("/^.+admin\/venues(?:.*)?$/", new AdminVenuesController());
Router::restful("/^.+admin\/packages(?:.*)?$/", new PackageController());




?>
