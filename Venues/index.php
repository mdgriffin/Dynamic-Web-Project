<?php
require_once "../app/config.php";
require_once "../app/connection.php";
require_once "../app/models/Model.php";
require_once "../app/Validator.php";
require_once "../app/models/Venue.php";


$venues = Venue::getAll();

$pageTitle = "Find the perfect venue";

include_once("../partials/header.php");

?>

<h1>Display a Venue Listing</h1>

<?php include_once("../partials/footer.php"); ?>
