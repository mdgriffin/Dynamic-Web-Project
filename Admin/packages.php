<?php
session_start();

require_once "../app/config.php";
require_once "../app/connection.php";
require_once "../app/Router.php";
require_once "../app/models/Model.php";
require_once "../app/Validator.php";
require_once "../app/models/Venue.php";
require_once "../app/models/Package.php";
require_once "../app/controllers/PackageController.php";

$packageRouter = new Router(new PackageController());
