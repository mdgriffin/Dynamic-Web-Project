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
Router::match("admin/login.*", function () {
	AdminController::doSomething();
});
*/

Router::restful("/^.+admin\/packages(?:.*)?$/", new PackageController());

// handle the missing routes
// Router::missing();

?>

<h1>This is the index file: <?php echo $_SERVER["REQUEST_URI"];?></h1>
